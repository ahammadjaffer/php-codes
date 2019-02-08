<?php
	session_start();
	$connect = mysql_connect("localhost","root","");
	mysql_select_db('bstudio',$connect);
	
	//To get item id and Rating
	$QID = $_REQUEST['qId'];
	$OPID = $_REQUEST['opId'];
	
	$flag=0;
	
	//To check already entered
	$selAnsQuery="select * from tbl_exam_answers where userId='".$_SESSION['LogeduserId']."'";
	$ansRes=mysql_query($selAnsQuery);
	while($row=mysql_fetch_array($ansRes))
	{
		if($row['qId']==$QID)
		{
			$flag=1;
		}
		else
		{
			$flag=0;
		}
	}
	
	if($flag==0)
	{
		$ansQry="insert into tbl_exam_answers(qId,optionId,userId) value('".$QID."','".$OPID."','".$_SESSION['LogeduserId']."')";
		mysql_query($ansQry);
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