<?php
	session_start();
	$connect = mysql_connect("localhost","root","");
	mysql_select_db('bstudio',$connect);
	
	$Count=1;
	$Score=0;
	
	$selQuery = "select testId from tbl_registrations where userId='".$_SESSION['LogeduserId']."'";
	$res=mysql_query($selQuery);
	$row=mysql_fetch_array($res);
	
	$selQQuery = "select * from tbl_questions where testId='".$row['testId']."'";
	$resQ=mysql_query($selQQuery);
	
	$total=$_REQUEST['Score'];
	echo $total;
	
	$Qid=$_REQUEST['Qid'];
	$OpId=$_REQUEST['OpId'];
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>B EXAM | EXAM PAGE</title>
<link rel="stylesheet" type="text/css" href="styleMain.css"/>
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="jQuery.js" type="text/javascript"></script>
<script>
	function insertAnswer(QID,OPID)
	{
		$.ajax 
		(
			{
				url:"ajax_insertAnswer.php",
				data:{qId:QID,opId:OPID},
				success: function(result){}
			}
		);
	}
</script>
</head>

<body>
<div class="container">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#"><span class="heading">B Exam</span></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Logout</a>
      </li>
    </ul>
  </div>
</nav>

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
	
	  	while($rowOp=mysql_fetch_array($resOp))
		{
	  	?>
    	
        <input type="radio"  id="optionradio" name="optionradio" value="<?php echo $rowOp['optionId'];?>" onclick="insertAnswer(<?php echo $QId; ?>,this.value)">
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
        <a href="HomePage.php" class="btn btn-primary">Finish</a>
</form>
</div>
</body>
</html>