<?php
	session_start();
	$connect = mysql_connect("localhost","root","");
	mysql_select_db('bstudio',$connect);
	
	$selRegStatusQuery = "select attendStatus from tbl_registrations where userId='".$_SESSION['LogeduserId']."'";
	$res=mysql_query($selRegStatusQuery);
	$row=mysql_fetch_array($res);
	
	
	
	if($_GET['delId'])
	{
		if($row['attendStatus']==1)
		{
			header('location:ExamPage.php');
		}
		else
		{
			echo"<script>alert('Make sure you have registerd and approved by admin.') </script>";
		}
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
<!--REGISTER-->
<div class="card cm">
  <div class="card-header">
    <span class="heading"> Register</span>
  </div>
  <div class="card-body">
    <h5 class="card-title">Register now for 2018-19 B Exam Context</h5>
    <p class="card-text">You can only attend exam only once in a year. You miss the chance, you have to waite for the next year.</p>
    <a href="Register_exam.php" class="btn btn-primary">Register</a>
  </div>
</div>
<!--START EXAM-->
<div class="card cm">
  <div class="card-header">
   <span class="heading"> Start Exam</span>
  </div>
  <div class="card-body">
    <h5 class="card-title">Start your exam at your scheduld time</h5>
    <p class="card-text">Once you have started writing then you are left with no second chance. Complete now or attend next year.</p>
    <a href="HomePage.php?delId=1" class="btn btn-primary">Start Exam</a>
  </div>
</div>
<!--SCORE-->
<div class="card cm">
  <div class="card-header">
   <span class="heading">Result</span>
  </div>
  <div class="card-body">
    <h5 class="card-title">Your Score</h5>
    <p class="card-text"><?php 
	$scoreQ="select score from tbl_score where userId='".$_SESSION['LogeduserId']."'";
	$scoreres=mysql_query($scoreQ);
	$scorerow=mysql_fetch_array($scoreres);
	?>
    <h3>Total Score : <?php echo $scorerow['score']; ?></h3></p>
  </div>
</div>
    

</div>
</body>
</html>