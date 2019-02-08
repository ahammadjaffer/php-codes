<?php
	session_start();
	$connect = mysql_connect("localhost","root","root");
	mysql_select_db('db_bmail',$connect);
	
	$selQuery="select * from tbl_messages m inner join tbl_userreg u on m.mailFrom=u.userId where mailTo='".$_SESSION['userid']."' and mailDeletestatus=1";
	$res=mysql_query($selQuery);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BMAIL | TRASH</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" type="text/css" href="style.css"/>
</head>

<body>
<div class="main">
<h3 class="mainHeader homeheader"><span class="b">T</span>rash</h3>
        <hr color="#099"/>
<?php
		while($row=mysql_fetch_array($res))
		{
			$mailId=$row['mailId'];
			?>
            	 <div class="inbmsg">
                 	<input type="checkbox" name="txtInbox[]" id="txtInbox" value="<?php echo $row['mailId']; ?>" class="inboxcontent chk"/>
					<p class="inboxcontent"><a href="ajaxViewMessage.php?&mailId=<?php echo $row['mailId']; ?>" class="linkNoDecor"><?php echo $row['userFirstName']; ?></a></p>
                    <p class="inboxcontent"><a href="ajaxViewMessage.php" class="linkNoDecor"><?php echo $row['mailSubject']; ?></a></p>
                    <p class="inboxcontent"><a href="ajaxViewMessage.php" class="linkNoDecor"><?php echo $row['mailDate']; ?></a></p>
           		</div>
            <?php
		}
	?>
</div>
</body>
</html>