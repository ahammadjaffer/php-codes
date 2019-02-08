<?php
	session_start();
	$connect = mysql_connect("localhost","root","root");
	mysql_select_db('db_bmail',$connect);
	
	//date and time
	$date=date("d.m.y");
	date_default_timezone_set("Asia/Kolkata");
	$time=date("h:i:sa");
	
	//To get mailId from draft
	$mailIdDraft=$_REQUEST['mailId'];
	
	$selQuery="select * from tbl_messages";
	$res=mysql_query($selQuery);
	
	//To check mail reciever account is true
	$flag=0;
	$to = $_POST['txtto'];
	$selReceiverQuery = "select * from tbl_userreg where userUsername='".$to."'";
	$resReceiver = mysql_query($selReceiverQuery);
	$rowReceiver = mysql_fetch_array($resReceiver);
	if($rowReceiver=="")
	{
		$flag=0;
	}
	else
	{
		$flag = 1;
		$receiver = $rowReceiver['userId'];
	}
	$subject = $_POST['txtsubject'];
	$message = $_POST['txtmessage'];
	
	//Draft edit
	if($_GET['mailId'])
	{
		$editDraftQuery="select * from tbl_messages m inner join tbl_userreg u on m.mailTo=u.userId where mailFrom='".$_SESSION['userid']."' and mailDraftStatus=1 and mailId='".$mailIdDraft."'";
		$resDraft=mysql_query($editDraftQuery) or die("its an error");
		$rowDraft=mysql_fetch_array($resDraft);
	}
	
	//To send mail
	if(isset($_POST['btnSend']))
	{
		if($flag==0)
		{
			echo"<script>alert('Entered Receiver mail is wrong or user does not exist') </script>";
		}
		else
		{
		  	$insertQuery="insert into tbl_messages (mailFrom,mailTo,mailSubject,mailMessage,mailDate,mailTime,mailStarstatus,mailReadstatus,mailDeletestatus,mailImportantstatus,mailDraftStatus) 
		 	value ('".$_SESSION['userid']."','".$receiver."','".$subject."','".$message."','".$date."','".$time."',0,0,0,0,0)";
			mysql_query($insertQuery);
		}
		
	}
	
	//Draft
	if(isset($_POST['btnSaveDraft']))
	{
		
		  $insertQuery="insert into tbl_messages (mailFrom,mailTo,mailSubject,mailMessage,mailDate,mailTime,mailStarstatus,mailReadstatus,mailDeletestatus,mailImportantstatus,mailDraftStatus) 
		  value ('".$_SESSION['userid']."','".$receiver."','".$subject."','".$message."','".$date."','".$time."',0,0,0,0,1)";
		  mysql_query($insertQuery);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BMAIL | COMPOSE MAIL</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" type="text/css" href="style.css"/>
</head>

<body>
<div class="main">
    	<h3 class="mainHeader homeheader"><span class="b">C</span>ompose</h3>
        <hr color="#099"/>

  <form id="form1" name="form1" method="post" action="" class="composemail">
    <input type="text" name="txtto" id="txtto" class="inputcomposemail" placeholder="To" value="<?php echo $rowDraft['userUsername']; ?>"/>
    <input type="text" name="txtsubject" id="txtsubject" class="inputcomposemail" placeholder="Subject" value="<?php echo $rowDraft['mailSubject']; ?>"/>
    <textarea name="txtmessage" id="txtmessage" cols="45" rows="5"class="inputcomposemail" placeholder="Message"  value="<?php echo $rowDraft['mailMessage']; ?>"></textarea>
    <input type="submit" name="btnSend" id="btnSend" value="Send" class="button"/>
    <input type="submit" name="btnSaveDraft" id="btnSaveDraft" value="Save" class="button"/>
  </form>
</div>
</body>
</html>