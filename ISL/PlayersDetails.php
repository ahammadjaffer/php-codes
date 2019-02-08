<?php
	$connect=mysql_connect("localhost","root","root");
	mysql_select_db("db_mywork",$connect);
	
	$playerName=$_POST['txtPlayerName'];
	$playerAge=$_POST['txtPlayerAge'];
	$playerPosition=$_POST['txtPlayerPosition'];
	
	$idNo=$_REQUEST['id'];
	
	if($_GET['delId'])
	{
		$delQry="delete from tbl_players where playerId=".$idNo."";
		mysql_query($delQry);
		echo"<script>alert('Successfully deleted')</script>";
		header('location:PlayersDetails.php');
	}
	if($_GET['editId'])
	{
		$editValue="select * from tbl_players where  playerId=".$idNo."";
		$res=mysql_query($editValue,$connect) or die("its an error");
		$rowEdit=mysql_fetch_array($res);
	}
	
	if(isset($_POST['btn_submit']))
	{
		if($idNo=="")
		{
			//INSERT
			$ins="insert into tbl_players(playerName,playerAge,playerPosition)value('".$playerName."','".$playerAge."','".$playerPosition."')";
			mysql_query($ins);
		}
		else
		{
			//UPDATE
			$upQry="update tbl_players set playerName='".$playerName."',playerAge='".$playerAge."',playerPosition='".$playerPosition."' where playerId=".$idNo."";
			mysql_query($upQry);
			echo"<script>alert('Successfully Updated')</script>";
			$idNo="";
			header('location:PlayersDetails.php');
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Player Details</title>
</head>

<body>
<h3 align="center">Player Details</h3>
<form id="form1" name="form1" method="post" action="">
  <table width="50%" align="center">
    <tr align="center">
      <td>Player Name</td>
      <td><label for="txtPlayerName"></label>
      <input type="text" name="txtPlayerName" id="txtPlayerName" value="<?php echo $rowEdit['playerName'];?>"/></td>
    </tr>
    <tr align="center">
      <td>Age</td>
      <td><label for="txtPlayerAge"></label>
      <input type="text" name="txtPlayerAge" id="txtPlayerAge" value="<?php echo $rowEdit['playerAge'];?>"/></td>
    </tr>
    <tr align="center">
      <td>Position</td>
      <td><label for="txtPlayerPosition"></label>
      <input type="text" name="txtPlayerPosition" id="txtPlayerPosition" value="<?php echo $rowEdit['playerPosition'];?>"/></td>
    </tr>
    <tr align="center">
      <td>&nbsp;</td>
      <td><input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
      <input type="reset" name="btn_cancel" id="btn_cancel" value="Cancel" /></td>
    </tr>
  </table>
</form>
<table width = "50%" align="center" border="5">
	<tr>
    	<th>Player Name</th>
        <th>Age</th>
        <th>Position</th>
    </tr>
    <?php
			$selQry="select * from tbl_players";
			$res=mysql_query($selQry,$connect) or die("its an error");
			while($row=mysql_fetch_array($res))
			{
				
	?>
    <tr>
           <td align="center"><?php echo $row['playerName'] ;?></td>
           <td><?php echo $row['playerAge'] ;?></td>
           <td><?php echo $row['playerPosition'] ;?></td>
           <td><a href="PlayersDetails.php?delId=1&amp;id=<?php echo $row['playerId'] ?>">Delete</a></td>
           <td><a href="PlayersDetails.php?editId=1&amp;id=<?php echo $row['playerId'] ?>">Edit</a></td>
 	</tr>
           
     <?php
				}
	?>
</table>
</body>
</html>