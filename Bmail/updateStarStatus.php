<?php
	session_start();
	$connect = mysql_connect("localhost","root","root");
	mysql_select_db('db_bmail',$connect);
	
	//To het mailId
	$mailId=$_GET['mailId'];
	
	//Select from table messages
	$selQuery="select * from tbl_messages where mailId='".$mailId."'";
	$res=mysql_query($selQuery);
	$row=mysql_fetch_array($res);
	
	if($row['mailStarstatus']==0)
	  {
			$updateStarQuery = "update tbl_messages set mailStarstatus=1 where mailId='".$mailId."'";
			mysql_query($updateStarQuery);
			header('location:HomePage.php');
	  }
	  
	if($row['mailStarstatus']==1)
	  {
			$updateUnstarQuery = "update tbl_messages set mailStarstatus=0 where mailId='".$mailId."'";
			mysql_query($updateUnstarQuery);
			header('location:HomePage.php');
	  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>