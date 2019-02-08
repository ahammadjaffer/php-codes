<?php

	$connect = mysql_connect("localhost","root","root");
	mysql_select_db("db_mywork",$connect);
?>	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<table width="50%" border="5" >
  <tr>
    <th>Name</th>
    <th>Age</th>
    <th>Position</th>
    <th>Club</th>
    <th>Logo</th>
  </tr>
   <tr>
	<?php
		$sel_id = $_REQUEST ['id'];
		$selQueryPlayer = "select * from tbl_playerselection p inner join tbl_players d on p.playerId=d.playerId inner join tbl_teams s on s.teamId = p.teamId where p.teamId= '".$sel_id."'";
		
		$resPlayer=mysql_query($selQueryPlayer,$connect) or die('Cannot connect to table');
		
		while($row=mysql_fetch_array($resPlayer))
		{
			
	?>
   
    <p id="sem">
    <td align="center"><?php echo $row['playerName']; ?></td>
    <td align="center"><?php echo $row['playerAge']; ?></td>
    <td align="center"><?php echo $row['playerPosition']; ?></td>
    <td align="center"><?php echo $row['teamName']; ?></td>
    <td align="center"><img src="images/<?php echo $row['teamLogo'] ;?>" height="50" width="50"/></td>
    </p>
   </tr>
    <?php
		}
	?>
    
    
    
</table>
</body>
</html>