<?php
	$connect = mysql_connect("localhost","root","root");
	mysql_select_db("db_mywork",$connect);
	
	$idNo=$_REQUEST['id'];
	
	if($_GET['delId'])
	{
		$delQry="delete from tbl_dept where dept_id=".$idNo."";
		//echo $delQry;
		mysql_query($delQry);
		echo"<script>alert('Successfully deleted')</script>";
		header('location:Department.php');
	}
	if($_GET['editId'])
	{
		$editValue="select * from tbl_dept where  dept_id=".$idNo."";
		$res=mysql_query($editValue,$connect) or die("it an error");
		$rowEdit=mysql_fetch_array($res);
	}
	
	if(isset($_POST['btnsubmit']))
	{
		$department = $_POST['txtdept'];
		if($idNo=="")
		{
			//INSERT
			$ins = "insert into tbl_dept (dept_name) values('".$department."')";
			mysql_query($ins);
		}
		else
		{
			//UPDATE
			$upQry="update tbl_dept set dept_name='".$department."' where dept_id=".$idNo."";
			mysql_query($upQry);
			echo"<script>alert('Successfully Updated')</script>";
			$idNo="";
			header('location:Department.php');
		}
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Department Details</title>
</head>

<body>
<h3>Department Details</h3>
<form id="form1" name="form1" method="post" action="">
  <table width="200">
    <tr>
      <td>Department</td>
      <td><label for="txtdept"></label>
      <input type="text" name="txtdept" id="txtdept" value="<?php echo $rowEdit['dept_name'];?>"/></td>
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
        <th>Department</th>
    </tr>
    <?php
			$selQry="select * from tbl_dept";
			$res=mysql_query($selQry,$connect) or die("its an error");
			while($row=mysql_fetch_array($res))
			{
				
	?>
    <tr>
           <td align="center"><?php echo $row['dept_id'] ;?></td>
           <td><?php echo $row['dept_name'] ;?></td>
           <td><a href="Department.php?delId=1&amp;id=<?php echo $row['dept_id'] ?>">Delete</a></td>
           <td><a href="Department.php?editId=1&amp;id=<?php echo $row['dept_id'] ?>">Edit</a></td>
  </tr>
           
     <?php
				}
	?>
</table>
</body>
</html>