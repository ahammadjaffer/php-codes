<?php
	$connect = mysql_connect("localhost","root","root");
	mysql_select_db("db_mywork",$connect);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Syllabus Details</title>
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
	
	function get_data(b)
	{
		$.ajax
		(
			{
				url:"ajax_semdata.php?id="+b,
				success:function(result)
				{
					$('#sem').html(result);
				}
			}
		);
	}
</script>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="200">
    <tr>
      <td>Department</td>
      <td> <?php
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
      <td><select name="sel_course" id="sel_course" onchange="get_data(this.value)">
      	<option>---Select---</option>
        <option value="<?php echo $rowCourse['course_id'];?>"><?php echo $rowCourse['course_name'];?></option>
        
      </select></td>
    </tr>
  </table>
   
    <p id="sem"></p>
   
 
</form>
</body>
</html>