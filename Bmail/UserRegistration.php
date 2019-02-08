<?php
	$connect = mysql_connect("localhost","root","root");
	mysql_select_db('db_bmail',$connect);
	
	//To fetch values from form
	$fname = $_POST['txtFname'];
	$lname = $_POST['txtLname'];
	$dob = $_POST['txtDob'];
	$gender = $_POST['rdoGender'];
	$number = $_POST['txtNumber'];
	$username = $_POST['txtUsername'];
	$password = $_POST['txtPassword'];
	$sqquestion = $_POST['selSequrityQuestion'];
	$sqans = $_POST['txtSqAnswer'];
	
	if(isset($_POST['btnRegister']))
	{
		$insQuery = "insert into tbl_userreg (userFirstName,userLastName,userDob,userGender,userContact,userUsername,userPassword,userSQQ,userSQA) 
		value ('".$fname."','".$lname."','".$dob."','".$gender."','".$number."','".$username."','".$password."','".$sqquestion."','".$sqans."')";
		mysql_query($insQuery);
		header('location:UserLogin.php');
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BMAIL | NEW USER</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" type="text/css" href="style.css"/>
</head>

<body>
<!--HEADER-->
<div class="container">
	<h3 class="header">Register</h3>
</div>
<!--REGISTER FORM-->
<div class="container">
  <form id="form1" name="form1" method="post" action="" class="loginform">
    	<div class="field">
    	  <label for="txtFname"></label>
    	  <input type="text" name="txtFname" id="txtFname" placeholder="First name" required="required" class="field"/>
   	  </div>
        <div class="field">
		  <label for="txtLname"></label>
          <input type="text" name="txtLname" id="txtLname" placeholder="Last name" required="required" class="field"/>
        </div>
        <div class="field">
          <label for="txtDob"></label>
          <input type="text" name="txtDob" id="txtDob" placeholder="Dob" required="required" class="field"/>
        </div>
        <div class="field" align="center">
          <input type="radio" name="rdoGender" id="rdoGender" value="Male" required="required"/>
          <label for="txtGender">Male</label>
          <input type="radio" name="rdoGender" id="rdoGender" value="Female" required="required"/>
          <label for="rdoGender">Female</label>
        </div>
        <div class="field">
          <label for="txtNumber"></label>
          <input type="text" name="txtNumber" id="txtNumber" placeholder="Contact Number" required="required" class="field"/>
        </div>
        <div class="field">
          <label for="txtUsername"></label>
          <input type="text" name="txtUsername" id="txtUsername" placeholder="Email(Username)" required="required" class="field"/>
        </div>
        <div class="field">
          <label for="txtPassword"></label>
          <input type="password" name="txtPassword" id="txtPassword" placeholder="Password" required="required" class="field"/>
        </div>
        <div class="field" align="center">
         <select name="selSequrityQuestion" id="selSequrityQuestion" class="field sel">
            <option>---Select---</option>
            <option>Favorite Color</option>
            <option>Favorite Sport</option>
            <option>Favorite Food</option>
         </select>
        </div>
        <div class="field">
        <label for="txtSqAnswer"></label>
      <input type="text" name="txtSqAnswer" id="txtSqAnswer" placeholder="Answer" required="required" class="field"/>
        </div>
        <div class="field">
          <input type="checkbox" name="txtTc" id="txtTc" required="required"/>
          <label for="txtTc">Agree to Terms and condition</label>
        </div>
        <div class="field">
          <input type="submit" name="btnRegister" id="btnRegister" value="Register" class="button"/>
        </div>
  </form>
</div>
</body>
</html>