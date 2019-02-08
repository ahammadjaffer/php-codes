<?php
	session_start();
	$connect = mysql_connect("localhost","root","root");
	mysql_select_db('db_bmail',$connect);
	
	$selQuery="select * from tbl_messages m inner join tbl_userreg u on m.mailFrom=u.userId where mailTo='".$_SESSION['userid']."' and mailDraftStatus=0";
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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BMAIL | INBOX</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" type="text/css" href="style.css"/>
<script src="jQuery.js" type="text/javascript"></script>
</head>

<body>
<div class="main">
    	<h3 class="mainHeader homeheader"><span class="b">I</span>nbox</h3>
        <hr color="#099"/>
        
        <input type="submit" name="showmenu" id="clickme" value="Menu" class="nav2btn"/></li>
        <div class="clear"></div>
        <form id="form1" name="form1" method="post" action="">
        
        <!--NAVIGATION-->
            <ul class="navigation2" id="nav2">
                <li class="navitem"><input type="submit" name="selectAll" id="selectAll" value="Select All" class="nav2btn"/></li>
                <li class="navitem"><input type="submit" name="selectReaded" id="selectReaded" value="Select Readed" class="nav2btn"/></li>
                <li class="navitem"><input type="submit" name="unReaded" id="unReaded" value="UnReaded" class="nav2btn"/></li>
                <li class="navitem"><input type="submit" name="starred" id="starred" value="Starred" class="nav2btn"/></li>
                <li class="navitem"><input type="submit" name="unStarred" id="unStarred" value="UnStarred" class="nav2btn"/></li>
                <li class="navitem"><input type="submit" name="delete" id="delete" value="Delete" class="nav2btn"/></li>
           		<li class="navitem"><input type="submit" name="hidemenu" id="clickme1" value="Hide Menu" class="nav2btn" align="right"/></li>
                <div class="clear"></div>
            </ul>
        
        <div class="inbmsg">
       	  	<p class="inboxcontent chk"></p>
            <p class="inboxcontent starred">Star</p>
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
                 	  <input type="checkbox" name="txtInbox[]" id="txtInbox" value="<?php echo $row['mailId']; ?>" class="inboxcontent chk" 
                     	<?php 
						
						if(isset($_POST['selectAll']))
							{
								echo "checked";
							}
							
						if(isset($_POST['selectReaded']))
							{
								if($row['mailReadstatus']==1)
								{
									echo "checked";
								}
							}
							
						if(isset($_POST['starred']))
							{
								if($row['mailStarstatus']==1)
								{
									echo "checked";
								}
							}
							
						if(isset($_POST['unStarred']))
							{
								if($row['mailStarstatus']==0)
								{
									echo "checked";
								}
							}
							
						if(isset($_POST['unReaded']))
							{
								if($row['mailReadstatus']==0)
								{
									echo "checked";
								}
							}
						?>
                      />
                    <p class="inboxcontent starred">
                    	<a href="updateStarStatus.php?&mailId=<?php echo $row['mailId']; ?>">
                            <img src=<?php 
                            if($row['mailStarstatus']==1)
                                { ?>"images/staryellow.png"<?php 
                                }
                            else
                                {?>"images/black.png"<?php 
                                } ?> class="star" id="starid"/> 
                        </a>
                    </p>
					<p class="inboxcontent"><a href="ajaxViewMessage.php?&mailId=<?php echo $row['mailId']; ?>" class="linkNoDecor"><?php echo $row['userFirstName']; ?></a></p>
                    <p class="inboxcontent"><a href="ajaxViewMessage.php" class="linkNoDecor"><?php echo $row['mailSubject']; ?></a></p>
                    <p class="inboxcontent"><a href="ajaxViewMessage.php" class="linkNoDecor"><?php echo $row['mailDate']; ?></a></p>
           		</div>
            <?php
		}
	?>
    </div>
</div>
</p>

<script>
$( "#clickme" ).click(function() {
  $("#nav2").show("slow");
  $("#nav2").attr("visibility","visible");
});
</script>

<script>
	$( "#clickme1" ).click(function() {
  $( "#nav2" ).hide( "slow");
});
</script>

</form>
<div class="container">
</div>
</body>
	
    
</body>
</html>