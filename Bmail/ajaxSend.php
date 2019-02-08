<?php
	session_start();
	$connect = mysql_connect("localhost","root","root");
	mysql_select_db('db_bmail',$connect);
	
	$selQuery="select * from tbl_messages m inner join tbl_userreg u on m.mailFrom=u.userId where mailFrom='".$_SESSION['userid']."'";
	$res=mysql_query($selQuery);
	
	if(isset($_POST['delete']))
	{
		if(!empty($_POST['txtInbox']))
		{
			foreach($_POST['txtInbox'] as $check)
			{
				$updateDeleteQuery = "update tbl_messages set mailDeletestatus=1 where mailId='".$check."'";
				mysql_query($updateDeleteQuery);
			}
		}
	}
	
	if(isset($_POST['star']))
	{
		if(!empty($_POST['txtInbox']))
		{
			foreach($_POST['txtInbox'] as $check)
			{
				$updateDeleteQuery = "update tbl_messages set mailStarstatus=1 where mailId='".$check."'";
				mysql_query($updateDeleteQuery);
			}
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BMAIL | SEND</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" type="text/css" href="style.css"/>
</head>

<body>
<div class="main">
    	<h3 class="mainHeader homeheader"><span class="b">I</span>nbox</h3>
        <hr color="#099"/>
        
        <!--NAVIGATION-->
            <ul class="navigation2">
                <li class="navitem"><input type="submit" name="star" id="star" value="Star" class="nav2btn"/></li>
                <li class="navitem"><input type="submit" name="star" id="star" value="Delete" class="nav2btn"/></li>
            </ul>
        
        <div class="inbmsg">
       	  <p class="inboxcontent chk"></p>
            <p class="inboxcontent"><b>From</b></p>
            <p class="inboxcontent"><b>Subject</b></p>
            <p class="inboxcontent"><b>Date</b></p>
        </div>
        
        <?php
		while($row=mysql_fetch_array($res))
		{
			$mailId=$row['mailId'];
			?>
            	 <div class="inbmsg">
                 	  <input type="checkbox" name="txtInbox[]" id="txtInbox" value="<?php echo $row['mailId']; ?>" class="inboxcontent chk" />
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