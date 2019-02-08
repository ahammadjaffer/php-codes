<?php
	session_start();
	$connect = mysql_connect("localhost","root","root");
	mysql_select_db('db_bmail',$connect);
	
	$mailId = $_GET['mailId'];
	
	//date and time
	$date=date("d.m.y");
	date_default_timezone_set("Asia/Kolkata");
	$time=date("h:i:sa");
	
	//To select message
	$selQuery="select * from tbl_messages where mailId='".$mailId."'";
	$res=mysql_query($selQuery);
	$row=mysql_fetch_array($res);
	
	//To update read status
	$updateReadQuery = "update tbl_messages set mailReadstatus=1 where mailId='".$mailId."'";
	mysql_query($updateReadQuery);
	
	//To select user data
	$selSenderQuery = "select * from tbl_userreg where userId = '".$row['mailFrom']."'";
	$resSender=mysql_query($selSenderQuery);
	$rowSender=mysql_fetch_array($resSender);
	
	if(isset($_POST['delete']))
	  {
			$updateDeleteQuery = "update tbl_messages set mailDeletestatus=1 where mailId='".$mailId."'";
			mysql_query($updateDeleteQuery);
	  }
	  
	  if(isset($_POST['star']))
	  {
			$updateStarQuery = "update tbl_messages set mailStarstatus=1 where mailId='".$mailId."'";
			mysql_query($updateStarQuery);
	  }
	  
	  if(isset($_POST['unstar']))
	  {
			$updateUnstarQuery = "update tbl_messages set mailStarstatus=0 where mailId='".$mailId."'";
			mysql_query($updateUnstarQuery);
	  }
	  
	  //Reply to mail
	  $receiver=$row['mailFrom'];
	  $subject=$_POST['txtReplySubject'];
	  $message=$_POST['txtReply'];
	  
	  if(isset($_POST['btnReply']))
	  {
			$insertQuery="insert into tbl_messages (mailFrom,mailTo,mailSubject,mailMessage,mailDate,mailTime,mailStarstatus,mailReadstatus,mailDeletestatus,mailImportantstatus,mailDraftStatus) 
		 	value ('".$_SESSION['userid']."','".$receiver."','".$subject."','".$message."','".$date."','".$time."',0,0,0,0,0)";
			mysql_query($insertQuery);
	  }
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BMAIL | VIEW MAIL</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" type="text/css" href="style.css"/>
<script src="jQuery.js" type="text/javascript"></script>
</head>

<body>
<div class="main">
  <form id="form1" name="form1" method="post" action="">
  
   <div class="container">
   <ul class="navigation2">
                <li class="navitem"><input type="submit" name="delete" id="delete" value="Delete" class="nav2btn"/></li>
                <li class="navitem"><input type="submit" name="star" id="star" value="Star" class="nav2btn"/></li>
                <li class="navitem"><input type="submit" name="unstar" id="unstar" value="UnStar" class="nav2btn"/></li>
            </ul>
    <div class="messageViewBody">
        <p>From &nbsp; : &nbsp; <?php echo $rowSender['userFirstName']; ?></p>
        <p class="messageViewBoxtd">Date &nbsp; : &nbsp; <?php echo $row['mailDate']; ?>&nbsp;Time &nbsp; : &nbsp; <?php echo $row['mailTime']; ?></p>
        <p>Subject &nbsp; : &nbsp; <?php echo $row['mailSubject']; ?></p>
        <hr color="#099"/>
        <p class="messageViewBox"><?php echo $row['mailMessage']; ?></p>
        <hr color="#099"/>
    </div>
   </div>
   
   <!--REPLY MAIL-->
   <div class="container">
   	<div class="messageViewBody" >
    	<label for="txtReplySubject"></label>
    	<input type="text" name="txtReplySubject" id="txtReplySubject" class="inputcomposemail"/>
    	<label for="txtReply"></label>
      <textarea name="txtReply" id="txtReply" cols="45" rows="5" class="inputcomposemail" placeholder="Type Reply Here"></textarea>
      <input type="submit" name="btnReply" id="btnReply" value="Send" class="button" />
    </div>
  </div>

   </form>
</div>

</body>
</html>