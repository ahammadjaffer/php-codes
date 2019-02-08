<?php
	$connect = mysql_connect("localhost","root","root");
	mysql_select_db("db_mywork",$connect);
	
	$idNo=$_REQUEST['id'];
	
	if($_GET['delId'])
	{
		$delQry="delete from tbl_subject where subject_id=".$idNo."";
		//echo $delQry;
		mysql_query($delQry);
		echo"<script>alert('Successfully deleted')</script>";
		header('location:Subject.php');
	}
	if($_GET['editId'])
	{
		$editValue="select * from tbl_subject where  subject_id=".$idNo."";
		$res=mysql_query($editValue,$connect) or die("its an error");
		$rowEdit=mysql_fetch_array($res);
	}
	
	if(isset($_POST['btnsubmit']))
	{
		$subject = $_POST['txtsubject'];
		if($idNo=="")
		{
			//INSERT
			$ins = "insert into tbl_subject (subject_name) values('".$subject."')";
			mysql_query($ins);
		}
		else
		{
			//UPDATE
			$upQry="update tbl_subject set subject_name='".$subject."' where subject_id=".$idNo."";
			mysql_query($upQry);
			echo"<script>alert('Successfully Updated')</script>";
			$idNo="";
			header('location:Subject.php');
		}
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Subject Details</title>
</head>

<body>
<h3>Subject Details</h3>
<form id="form1" name="form1" method="post" action="">
  <table width="200">
    <tr>
      <td>Subject</td>
      <td><label for="txtsubject"></label>
      <input type="text" name="txtsubject" id="txtsubject" value="<?php echo $rowEdit['subject_name'];?>" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="btnsubmit" id="btnsubmit" value="Submit" />
      <input type="reset" name="btncancel" id="btncancel" value="Cancel" /></td>
    </tr>
  </table>
</form>

<table width = "35%" border="1">
	<tr>
    	<th>ID</th>
        <th>Subject</th>
    </tr>
    <?php
			$selQry="select * from tbl_subject";
			$res=mysql_query($selQry,$connect) or die("its an error");
			while($row=mysql_fetch_array($res))
			{
				
	?>
    <tr>
           <td align="center"><?php echo $row['subject_id'] ;?></td>
           <td><?php echo $row['subject_name'] ;?></td>
           <td><a href="Subject.php?delId=1&amp;id=<?php echo $row['subject_id'] ?>">Delete</a></td>
           <td><a href="Subject.php?editId=1&amp;id=<?php echo $row['subject_id'] ?>">Edit</a></td>
  </tr>
           
     <?php
				}
	?>
</table>
</body>
</html>