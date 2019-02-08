<?php
	session_start();
	$connect = mysql_connect("localhost","root","");
	mysql_select_db('bstudio',$connect);
	
	//To select from table ExamType
	$selETypeQuery = "select * from tbl_testtype";
	$ETypeRes=mysql_query($selETypeQuery);
	
	//To select from table Schedule
	$selScheduleQuery = "select * from tbl_adminshedule";
	$ScheduleRes=mysql_query($selScheduleQuery);
	
	$EtypeId = $_POST['selTestType'];
	$SchId = $_POST['selSchedule'];
	
	if(isset($_POST['btnQuestion']))
	{
		$insertQuery="insert into tbl_registrations(userId,testId,SchId,attendStatus) values('".$_SESSION['LogeduserId']."','".$EtypeId."','".$SchId."',0)";
		mysql_query($insertQuery);
		
		$updateQuery = "update tbl_userreg set userRegStatus = 1 where userId='".$_SESSION['LogeduserId']."'";
		mysql_query($updateQuery);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>B EXAM | HOME</title>
<link rel="stylesheet" type="text/css" href="styleMain.css"/>
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="jQuery.js" type="text/javascript"></script>
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
	<label for="selTestType"> Select Exam Type</label>
      <select name="selTestType" id="selTestType" class="btn btn-success sel">
      <option class="list-group-item">---Select---</option>
      <?php
	  	while($row=mysql_fetch_array($ETypeRes))
		{
	  	?>
      <option class="list-group-item" value="<?php echo $row['testId'];?>"><?php echo $row['testName'];?></option>
      <?php
		}
		?>
      </select><br />
      
      <label for="selSchedule">Select Schedule</label>
      <select name="selSchedule" id="selSchedule" class="btn btn-success sel">
      <option class="list-group-item">---Select---</option>
      <?php
	  	while($row=mysql_fetch_array($ScheduleRes))
		{
	  	?>
      <option class="list-group-item" value="<?php echo $row['SchId'];?>"><?php echo $row['schDate'];echo $row['schTime'];?></option>
      <?php
		}
		?>
      </select><br />
      <input type="submit" name="btnQuestion" id="btnQuestion" value="Submit" class="btn btn-warning btnREg"/>
</form>
</div>
</body>
</html>