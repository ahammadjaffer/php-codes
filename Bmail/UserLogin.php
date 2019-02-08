<?php
	session_start();
	$connect = mysql_connect("localhost","root","root");
	mysql_select_db('db_bmail',$connect);
	
	$userName = $_POST['txtUsername'];
	$password = $_POST['txtPassword'];
	
	if(isset($_POST['btnLogin']))
	{
		$selQuery = "select userId,userUsername,userPassword from tbl_userreg";
		$res = mysql_query($selQuery);
		while($row=mysql_fetch_array($res))
			{
				if(($row['userUsername']==$userName)&&($row['userPassword']==$password))
				{
					$_SESSION['userid']=$row['userId'];
					echo"<script>alert('login Successfull') </script>";
					header('location:HomePage.php');
				}
				else if(($row['userUsername']==$userName)&&($row['userPassword']!=$password))
				{
					echo"<script>alert('Invalid Password') </script>";
				}
				else if(($row['userUsername']!=$userName)&&($row['userPassword']==$password))
				{
					echo"<script>alert('Invalid Username') </script>";
				}
				else
				{
					echo"<script>alert('User Not Found') </script>";
				}
			}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BMAIL | LOGIN</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" type="text/css" href="style.css"/>
</head>

<body>
<!--HEADER-->
<div class="container">
	<h3 class="header login">Login</h3>
</div>
<div class="container">
<form id="form1" name="form1" method="post" action="" class="loginform">
	<div>
 		<input type="text" name="txtUsername" id="txtUsername" class="field" placeholder="Username"/>
    </div>
    <div>
    	<input type="text" name="txtPassword" id="txtPassword" class="field" placeholder="Password"/>
    </div><br />
    <div class="field" align="center">
    	<input type="submit" name="btnLogin" id="btnLogin" value="Submit" class="button" />
    </div>
</form>
</div>
</body>
</html>