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
	<?php
		$dept_id = $_REQUEST ['id'];
		$selQueryCourse = "select * from tbl_course where dept_id = '".$dept_id."'";
		$resCourse=mysql_query($selQueryCourse,$connect) or die('Cannot connect to table');
	?>
    
        <select name="sel_course" id="sel_course">
        <option>---Select---</option>
        
    <?php
	
		while($rowCourse=mysql_fetch_array($resCourse))
		{
			
	?>
    
    	<option value="<?php echo $rowCourse['course_id'];?>"><?php echo $rowCourse['course_name'];?></option>
      
    <?php
	
		}
		
	?>
</body>
</html>