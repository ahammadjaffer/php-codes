<?php
	$connect = mysql_connect("localhost","root","root");
	mysql_select_db("db_mywork",$connect);
	
	$idNo=$_REQUEST['id'];
	
	if($_GET['delId'])
	{
		$delQry="delete from tbl_course where course_id=".$idNo."";
		mysql_query($delQry);
		//echo $idNo ;
		echo "<script> alert ('Successfully Deleted') </script>" ;
		header('location:Course.php');
	}
	
	if($_GET['editId'])
	{
		$editValue="select * from tbl_course where  course_id=".$idNo."";
		$res=mysql_query($editValue,$connect) or die("its an error");
		$rowEdit=mysql_fetch_array($res);
	}
	
	if(isset($_POST['btnsubmit']))
	{
		$course = $_POST['txtcourse'];
		$deptid = $_POST['seldept'];
		
		if($idNo=="")
		{
			$insQuery = "insert into tbl_course(course_name,dept_id)value('".$course."','".$deptid."')";
			mysql_query($insQuery);
			echo "<script> alert ('Successfully Inserted') </script>" ;
		}
		else
		{
			$updateQuery = "update tbl_course set course_name = '".$course."',dept_id = '".$deptid."' where course_id = ".$idNo."";
			mysql_query($updateQuery);
			echo "<script> alert ('Successfully Updated') </script>" ;
		}
	
	}
	
	?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Course Details</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="200" >
    <tr>
      <td>Department</td>
      <td><label for="select"></label>
            <?php
				$selQuery = "select * from tbl_dept";
				$res=mysql_query($selQuery,$connect) or die('Cannot connect to table');
		?>
        <select name="seldept" id="seldept">
        <option>---Select---</option>
        <?php
					while($row=mysql_fetch_array($res))
						{
	 			  ?>
     <option value="<?php echo $row['dept_id'];?>"><?php echo $row['dept_name'];?></option>
      
      			 <?php
						}
				 ?>
      </select></td>
    </tr>
    <tr>
      <td>Course</td>
      <td><input type="text" name="txtcourse" id="txtcourse" value="<?php echo $rowEdit['course_name'];?>"/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="btnsubmit" id="btnsubmit" value="Submit" /></td>
    </tr>
  </table>
  <label for="txtcourse"></label>
</form>
<table width="50%" border="1">
  <tr>
    <th>Course ID</th>
    <th>Dept ID</th>
    <th>Course Name</th>
  </tr>
  <tr>
  <?php
  	$selectQuery = "select * from tbl_course ";
	$ExcecuteQuery = mysql_query($selectQuery,$connect) or die("Cannot connect to table");
	
	while($tb_row = mysql_fetch_array($ExcecuteQuery))
	{
  ?>
  <tr>
    <td><?php echo $tb_row['course_id']; ?></td>
    <td><?php echo $tb_row['dept_id']; ?></td>
    <td><?php echo $tb_row['course_name']; ?></td>
    <td><a href="Course.php?delId=1&amp;id=<?php echo $tb_row['course_id'] ?>">Delete</a></td>
    <td><a href="Course.php?editId=1&amp;id=<?php echo $tb_row['course_id'] ?>">Edit</a></td>
  </tr>  
    <?php
	}
	?>
    
  </tr>
</table>
</body>
</html>