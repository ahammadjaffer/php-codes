<?php
	$connect = mysql_connect("localhost","root","");
	mysql_select_db('bstudio',$connect);
	
	$UId=$_REQUEST['UId'];
	
	$Count=1;
	$Score=0;
	
	$selQuery = "select testId from tbl_registrations where userId='".$UId."'";
	$res=mysql_query($selQuery);
	$row=mysql_fetch_array($res);
	
	$selQQuery = "select * from tbl_questions where testId='".$row['testId']."'";
	$resQ=mysql_query($selQQuery);
	
	$ScoreCalcQuery = "select * from tbl_exam_answers an inner join tbl_option op on an.optionId=op.optionId where userId='".$UId."'";
	$ScoreCalcRes = mysql_query($ScoreCalcQuery);
	while($ScoreCalcRow=mysql_fetch_array($ScoreCalcRes))
	{
		if($ScoreCalcRow['optionAnswer']=="T")
		{$Score++;}
		else
		{
			continue;
		}
	}
	$insertScoreQuery="insert into tbl_score (userId,score) value('".$UId."','".$Score."')";
    mysql_query($insertScoreQuery);
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>ADMIN HOME</title>
<link rel="stylesheet" type="text/css" href="../styleMain.css"/>
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>

<body>
<div class="container">
<!--NAVIGATION-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#"><span class="heading">BExam</span></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="../AdminHomePage.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../MenuPages/ExamTypes.php">Exam Types</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../MenuPages/Questions.php">Questions</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../MenuPages/Schedules.php">Schedules</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../MenuPages/Registrations.php">Registratons</a>
      </li>
      <li class="nav-item">
		<a class="nav-link" href="../MenuPages/Registered.php">Registered</a>
      </li>
    </ul>
  </div>
</nav>

<div class="card">
  <div class="card-body">
    <?php 
	$scoreQ="select score from tbl_score where userId='".$UId."'";
	$scoreres=mysql_query($scoreQ);
	$scorerow=mysql_fetch_array($scoreres);
	?>
    <h3>Total Score : <?php echo $scorerow['score']; ?></h3>
  </div>
</div>

<form id="form1" name="form1" method="post" action="">
<?php
	  	while($rowQ=mysql_fetch_array($resQ))
		{
	  	?>
<div class="card">
  <div class="card-header">
    Q.&nbsp;<?php echo $Count; $Count++;?>
  </div>
  <div class="card-body">
    <h5 class="card-title"><?php echo $rowQ['qQuestion']; $QId=$rowQ['qId'];?></h5>
    <p class="card-text">
    <div class="custom-control custom-radio">
    <?php
	
		$selOpQuery = "select * from tbl_option where qId='".$rowQ['qId']."'";
		$resOp=mysql_query($selOpQuery);
		
		$selAnsOpQuery = "select * from tbl_exam_answers where userId='".$UId."' and qId='".$rowQ['qId']."'";
		$selAnsOpRes = mysql_query($selAnsOpQuery);
	
	  	while($rowOp=mysql_fetch_array($resOp))
		{
			
			while($rowOpAns=mysql_fetch_array($selAnsOpRes))
		{
			$AnsExistFlag = 0;
			if($rowOp['optionId']==$rowOpAns['optionId'])
			{
				$AnsExistFlag = 1;
			}
			else
			{
				$AnsExistFlag = 0;
			}
		}
	  	?>
    	
        <input type="radio" disabled="disabled" id="optionradio" name="optionradio" value="<?php echo $rowOp['optionId'];?>" onclick="insertAnswer(<?php echo $QId; ?>,this.value)"
        <?php if($AnsExistFlag == 1){?> checked="checked"<?php }?>
        <?php if($rowOp['optionAnswer'] == "T"){?> class="rdoGreen"<?php }else{?> class="rdoRed"<?php }?>
        >
       <?php echo $rowOp['optionName'];?><br />
      <?php
	  
	  $opId=$rowOp['optionId'];
		}
		?>
      </div>
    </p>
   
  </div>
</div>
<?php
		}
		?>
</form>

</div>
</body>
</html>