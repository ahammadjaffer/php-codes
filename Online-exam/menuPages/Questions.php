<?php
	$connect = mysql_connect("localhost","root","");
	mysql_select_db('bstudio',$connect);
	
	$selQQuery = "select * from tbl_questions";
	$QRes=mysql_query($selQQuery);
	
	$idNo=$_REQUEST['id'];
	
	if($_GET['delId'])
	{
		$delQry="delete from tbl_questions where qId=".$idNo."";
		//echo $delQry;
		mysql_query($delQry);
		echo"<script>alert('Successfully deleted')</script>";
		header('location:Questions.php');
	}
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
        <a class="nav-link" href="../AdminHomePage.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../MenuPages/ExamTypes.php">Exam Types <span class="sr-only">(current)</span></a>
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

<!--TABLE-->
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">&nbsp;</th>
    </tr>
  </thead>
  <tbody>
   <?php
	  	while($row=mysql_fetch_array($QRes))
		{
	  	?>
        <tr>
      <td value="<?php echo $row['qId'];?>"><?php echo $row['qQuestion'];?></td>
      <td><a href="Questions.php?delId=1&amp;id=<?php echo $row['qId'] ?>"><span class="delete">X</span></a></td>
    </tr>
      <?php
		}
		?>
    
  </tbody>
</table>
</div>
</body>
</html>