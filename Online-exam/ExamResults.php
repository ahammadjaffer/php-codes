<?php
	$connect = mysql_connect("localhost","root","");
	mysql_select_db('bstudio',$connect);
	
	$selQuery="select * from tbl_userreg u inner join tbl_registrations r on u.userId=r.userId inner join tbl_testtype y on r.testId=y.testId inner join tbl_adminshedule a on r.schId=a.schId where u.userRegStatus=1 and r.attendStatus=1";
	$res = mysql_query($selQuery);
	
	
	
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

<!--TABLE-->
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Exam Type</th>
      <th scope="col">Date</th>
      <th scope="col">Time</th>
    </tr>
  </thead>
  <tbody>
   <?php
	  	while($row=mysql_fetch_array($res))
		{
	  	?>
        <tr>
      <td value="<?php echo $row['userId'];?>"><a href="ViewAnswer.php?UId=<?php echo $row['userId'];?>"> <?php echo $row['userFname'];?></td>
      <td value="<?php echo $row['userId'];?>"><?php echo $row['testName'];?></td>
      <td value="<?php echo $row['userId'];?>"><?php echo $row['schDate'];?></td>
      <td value="<?php echo $row['userId'];?>"><?php echo $row['schTime'];?></td>
    </tr>
      <?php
		}
		?>
    
  </tbody>
</table>
</div>
</body>
</html>