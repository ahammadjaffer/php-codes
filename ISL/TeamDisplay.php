<?php
	$connect = mysql_connect("localhost","root","root");
	mysql_select_db("db_mywork",$connect);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Team Display</title>
<script src="jQuery.js" type="text/javascript"></script>
<script>
	function getplayers(a)
	{
		$.ajax(
		{
			url:"ajax_selPlayer.php?id="+a,
			success:function(result)
			{
				$('#player').html(result);
			}

		}
		);
	}
</script>
</head>

<body>
<h3 align="center">Team Display</h3>
<form id="form1" name="form1" method="post" action="">
  <table width="35%">
    <tr>
      <td>Select Team</td>
      <td>
      <?php
	  $sel = "select * from tbl_teams";
	  $res = mysql_query($sel,$connect);
	  ?>
      <label for="selTeam"></label>
        <select name="selTeam" id="selTeam" onchange="getplayers(this.value)">
        <option>---Select---</option>
        <?php
		while($row = mysql_fetch_array($res))
		{
		?>
        <option value="<?php echo $row['teamId']; ?>"><?php echo $row['teamName']; ?></option>
        <?php
		}
		?>
      </select></td>
    </tr>
  </table>
  
  <p id="player"></p>
  
</form>
</body>
</html>