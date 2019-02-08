<?php
	$connect = mysql_connect("localhost","root","root");
	mysql_select_db("db_mywork",$connect);
	
	$teamName = $_POST['txtTeamName'];
	$ownerName = $_POST['txtOwnerName'];
	$img = $_FILES['fileLogo']['name'];
	$temp = $_FILES['fileLogo']['tmp_name'];
	move_uploaded_file($temp,"../ISL/images/".$img);
	
	$idNo=$_REQUEST['id'];
	
	if($_GET['delId'])
	{
		$delQry="delete from tbl_teams where teamId=".$idNo."";
		mysql_query($delQry);
		echo"<script>alert('Successfully deleted')</script>";
		header('location:TeamDetails.php');
	}
	if($_GET['editId'])
	{
		$editValue="select * from tbl_teams where  teamId=".$idNo."";
		$res=mysql_query($editValue,$connect) or die("its an error");
		$rowEdit=mysql_fetch_array($res);
	}
	
	if(isset($_POST['btn_submit']))
	{
		
	}
	
	if(isset($_POST['btn_submit']))
	{
		if($idNo=="")
		{
			//INSERT
			$ins = "insert into tbl_teams(teamName,teamOwner,teamLogo)value('".$teamName."','".$ownerName."','".$img."')";
			mysql_query($ins);
		}
		else
		{
			//UPDATE
			$upQry="update tbl_teams set teamName='".$teamName."',teamOwner='".$ownerName."',teamLogo='".$img."' where teamId=".$idNo."";
			mysql_query($upQry);
			echo"<script>alert('Successfully Updated')</script>";
			$idNo="";
			header('location:TeamDetails.php');
		}
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Team Details</title>
</head>

<body>

<h3 align="center">Team Details</h3>

<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table width="50%" align="center">
    <tr align="center">
      <td>Team Name</td>
      <td><label for="txtName"></label>
      <input type="text" name="txtTeamName" id="txtTeamName" value="<?php echo $rowEdit['teamName'];?>"/></td>
    </tr>
    <tr align="center">
      <td>Owner</td>
      <td><label for="txtOwnerName"></label>
      <input type="text" name="txtOwnerName" id="txtOwnerName" value="<?php echo $rowEdit['teamOwner'];?>"/></td>
    </tr>
    <tr align="center">
      <td>Logo</td>
      <td><label for="fileLogo"></label>
      <input type="file" name="fileLogo" id="fileLogo" value="<?php echo $rowEdit['teamLogo'];?>"/></td>
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
    	<th>Club Name</th>
        <th>Owner</th>
        <th>Logo</th>
    </tr>
    <?php
			$selQry="select * from tbl_teams";
			$res=mysql_query($selQry,$connect) or die("its an error");
			while($row=mysql_fetch_array($res))
			{
				
	?>
    <tr>
           <td align="center"><?php echo $row['teamName'] ;?></td>
           <td><?php echo $row['teamOwner'] ;?></td>
           <td><img src="images/<?php echo $row['teamLogo'] ;?>" height="50" width="50"/></td>
           <td><a href="TeamDetails.php?delId=1&amp;id=<?php echo $row['teamId'] ?>">Delete</a></td>
           <td><a href="TeamDetails.php?editId=1&amp;id=<?php echo $row['teamId'] ?>">Edit</a></td>
  </tr>
           
     <?php
				}
	?>
</table>
</body>
</html>
