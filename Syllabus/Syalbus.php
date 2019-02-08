<?php
	$connect = mysql_connect("localhost","root","root");
	mysql_select_db("db_mywork",$connect);
	
	if(isset($_POST['btn_submit']))
	{
		$department = $_POST['sel_dept'];
		$course = $_POST['sel_course'];
		$semester = $_POST['sel_semester'];
		//$subject = $_POST['chk_subject'];
		if(!empty($_POST['chk_subject']))
		{
			foreach($_POST['chk_subject'] as $Chk_sub)
		{
		$ins = "insert into tbl_syllabus(dept_id,course_id,sem_id,subject_id) value('".$department."','".$course."','".$semester."','".$Chk_sub."')";
		mysql_query($ins);
		
		}
		}
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Syllabus</title>
<script src="jQuery.js" type="text/javascript"></script>
<script>
	function getcourse(a)
	{
		$.ajax
		(
			{
				url:"ajax_course.php?id="+a,
				success:function(result)
				{
					$('#sel_course').html(result);
				}
			}
		);
	}
</script>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="50%" >
    <tr>
      <td>Department</td>
      <td>
      <?php
	  	$selQueryDept = "select * from tbl_dept";
		$res = mysql_query($selQueryDept,$connect);
		
	  ?>
      <label for="sel_dept"></label>
        <select name="sel_dept" id="sel_dept" onchange="getcourse(this.value)">
        <option>---Select---</option>
        <?php
        	while($row = mysql_fetch_array($res))
			{
		?>
        <option value="<?php echo $row['dept_id']; ?>"><?php echo $row['dept_name']; ?></option>
        <?php
			}
		?>
      </select></td>
    </tr>
    <tr>
      <td>Course</td>
      <td>
      <select name="sel_course" id="sel_course">
      	<option>---Select---</option>
        <option value="<?php echo $rowCourse['course_id'];?>"><?php echo $rowCourse['course_name'];?></option>
        
      </select></td>
    </tr>
    <tr>
      <td>Semester</td>
      <td>
      <?php
	  	$selQuerySem = "select * from tbl_semester";
		$resSem = mysql_query($selQuerySem,$connect);
		
	  ?>
      <select name="sel_semester" id="sel_semester">
      <option>---Select---</option>
      
      <?php
	
		while($rowSem=mysql_fetch_array($resSem))
		{
			
	?>
    
    	<option value="<?php echo $rowSem['sem_id'];?>"><?php echo $rowSem['sem_name'];?></option>
      
    <?php
	
		}
		
	?>
      </select></td>
    </tr>
    <tr>
      <td>Subject</td>
      
      <?php
	  	$selQuerySub = "select * from tbl_subject";
		$resSub = mysql_query($selQuerySub,$connect);
		
		while($rowSub = mysql_fetch_array($resSub))
		{
		
	  ?>
      <td>
      <input type="checkbox" name="chk_subject[]" id="chk_subject" value="<?php echo $rowSub['subject_id'];?>">
      <?php echo $rowSub['subject_name'];?></input>
      </td>
      <?php
		}
	  ?>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="btn_submit" id="btn_submit" value="Submit"/>
      <input type="reset" name="btn_cancel" id="btn_cancel" value="Cancel" /></td>
    </tr>
  </table>
</form>
</body>
</html>