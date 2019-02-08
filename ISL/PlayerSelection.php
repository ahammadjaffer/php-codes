<?php
	$connect=mysql_connect("localhost","root","root");
	mysql_select_db("db_mywork",$connect);
	
	if(isset($_POST['btn_submit']))
	{
		$teamId = $_POST['selTeam'];
		
		if(!empty($_POST['chk_players']))
		{
			foreach($_POST['chk_players'] as $Chk_player)
				{
					$ins = "insert into tbl_playerSelection(teamId,playerId) value('".$teamId."','".$Chk_player."')";
					mysql_query($ins);
		
				}
		}
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Player Selection</title>
</head>

<body>
<h3 align="center">Player Details</h3>
<form id="form1" name="form1" method="post" action="">
  <table width="100%">
    <tr>
      <td>Select Team</td>
      <td>
      <?php
      $SelQurey="select * from tbl_teams";
	  $res=mysql_query($SelQurey,$connect) or die('Cannot connect to table');
	  ?>
      <label for="selTeam"></label>
        <select name="selTeam" id="selTeam">
        <option>---Select---</option>
        <?php 
		while ($row=mysql_fetch_array($res))
		{
		?>
			<option value="<?php echo $row['teamId']; ?>"><?php echo $row['teamName']; ?></option>
		<?php
		}
		?>
      </select></td>
    </tr>
    <tr>
      <td>Select Player</td>
      <?php
	  	$selPlayer = "select * from tbl_players";
		$resPlayer=mysql_query($selPlayer,$connect) or die('Cannot connect to table');
		?>
  
     <?php
		while ($rowPlayer=mysql_fetch_array($resPlayer))
		{
	  ?>

      <td><input type="checkbox" name="chk_players[]" id="chk_players" value="<?php echo $rowPlayer['playerId'];?>">
      <?php echo $rowPlayer['playerName'];?></input>
      </td>

     <?php
		}
	  ?>
      </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
      <input type="reset" name="btn_cancel" id="btn_cancel" value="Cancel" /></td>
    </tr>
  </table>
</form>
</body>
</html>