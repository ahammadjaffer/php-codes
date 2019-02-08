<?php
	$connect = mysql_connect("localhost","root","");
	mysql_select_db('bstudio',$connect);
	
	$firstname=$_POST['txtFname'];
	$lastname=$_POST['txtLname'];
	$dob=$_POST['txtDob'];
	$email=$_POST['txtEmail'];
	$username=$_POST['txtUsername'];
	$password=$_POST['txtPassword'];
	
	//To insert into tbl_Admin
	if(isset($_POST['btnRegister']))
	{
		$insertQuery="insert into tbl_adminreg (adminFname,adminLname,adminDob,adminEmail,adminUsername,adminPassword) 
		value('".$firstname."','".$lastname."','".$dob."','".$email."','".$username."','".$password."')";
		mysql_query($insertQuery);
	}
	
	//To login user
	
	$uname=$_POST['txtUname'];
	$pword=$_POST['txtPword'];
	
	if(isset($_POST['btnLogin']))
	{
		$selQuery="select * from tbl_adminreg";
		$res=mysql_query($selQuery);
		while($row=mysql_fetch_array($res))
			{
				if(($row['adminUsername']==$uname)&&($row['adminUsername']==$pword))
				{
					echo"<script>alert('login Successfull') </script>";
					header('location:../AdminHomePage.php');
				}
				else if(($row['adminUsername']==$uname)&&($row['adminUsername']!=$pword))
				{
					echo"<script>alert('Invalid Password') </script>";
				}
				else if(($row['adminUsername']!=$uname)&&($row['adminUsername']==$pword))
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
<title>REGISTER AND LOGIN</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" type="text/css" href="style.css"/>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css?family=Fredoka+One" rel="stylesheet">
<script src="jQuery.js" type="text/javascript"></script>
<script>
function pswdCheck(rpwd,pwd)
{
	if(rpwd.value != pwd.value)
	{
		alert('Password Mismatch');
		rpwd.value = '';
		pwd.focus();	
	}
}

</script>
</head>

<body>
<div class="container">
<div class="Login">
  <form id="form1" name="form1" method="post" action="">
  <div class="form-group">
    <table width="100%" >
      <tr>
        <td width="15%"><span class="heading">BExam</span></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td width="45%">&nbsp;</td>
        <td width="10%">Admin Login</td>
        <td><label for="txtUname2"></label>
        <input type="text" name="txtUname" id="txtUname2" class="form-control"/></td>
        <td><label for="txtPword"></label>
        <input type="password" name="txtPword" id="txtPword" class="form-control"/></td>
        <td><input type="submit" name="btnLogin" id="btnLogin" value="Login"  class="btn btn-primary"/></td>
      </tr>
    </table>
    </div>
  </form>
  </div>
  <div class="Register">
  <form id="form1" name="form1" method="post" action="">
  	<table width="40%" >
  	  <tr>
  	    <td>Register</td>
      </tr>
  	  <tr>
  	    <td><label for="txtFname"></label>
  	      <input type="text" name="txtFname" id="txtFname" placeholder="First Name" class="form-control"/></td>
      </tr>
  	  <tr>
  	    <td><label for="txtLname"></label>
  	      <input type="text" name="txtLname" id="txtLname" placeholder="Last Name" class="form-control"/></td>
      </tr>
  	  <tr>
  	    <td><label for="txtDob"></label>
  	      <input type="text" name="txtDob" id="txtDob" placeholder="DoB" class="form-control" /></td>
      </tr>
  	  <tr>
  	    <td><label for="txtEmail"></label>
  	      <input type="text" name="txtEmail" id="txtEmail" placeholder="Email" class="form-control"/></td>
      </tr>
      <tr>
  	    <td><label for="txtUsername"></label>
  	      <input type="text" name="txtUsername" id="txtUsername" placeholder="Username" class="form-control"/></td>
      </tr>
  	  <tr>
  	    <td><label for="txtPassword"></label>
        <input type="password" name="txtPassword" id="txtPassword" placeholder="Password" class="form-control"/></td></tr>
  	  <tr>
  	    <td><label for="txtCpassword"></label>
  	      <input type="password" name="txtCpassword" id="txtCpassword" placeholder="Confirm Password" onblur="pswdCheck(this,txtPassword)" class="form-control"/></td>
      </tr>
  	  <tr>
  	    <td><input type="submit" name="btnRegister" id="btnRegister" value="Register" class="btn btn-primary"/></td>
      </tr>

    </table>
  </form>
  </div>
</div>
</body>
</html>