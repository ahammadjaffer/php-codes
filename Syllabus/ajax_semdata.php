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

<table width="30%" border=".1">
  <tr>
    <th>Semester</th>
    <th>Subject</th>
  </tr>
   <tr>
	<?php
		$course_id = $_REQUEST ['id'];
		$selQuerySem = "select * from tbl_syllabus p inner join tbl_semester d on p.sem_id=d.sem_id inner join tbl_subject s on s.subject_id = p.subject_id where p.course_id= '".$course_id."' order by p.sem_id ASC";
		
		//$selQuerySem = "select * from tbl_syllabus where course_id= '".$course_id."'";
		
		$resSem=mysql_query($selQuerySem,$connect) or die('Cannot connect to table');
		
		while($row=mysql_fetch_array($resSem))
		{
			
	?>
   
    <p id="sem"><td><?php echo $row['sem_name']; ?></td>
    <td ><?php echo $row['subject_name']; ?></td></p>
   </tr>
    <?php
		}
	?>
    
    
    
</table>
 
</body>
</html>