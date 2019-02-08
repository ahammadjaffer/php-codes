<?php
	$connect = mysql_connect("localhost","root","");
	mysql_select_db("bstudio",$connect);	
?>	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
		<?php

				$ExamId = $_REQUEST ['id'];
				$selQueryQuestions = "select * from tbl_questions where testId = '".$ExamId."'";
				$resExam=mysql_query($selQueryQuestions,$connect) or die('Cannot connect to table Questions');
		?>
        <select name="selQuestionType" id="selQuestionType"  class="btn btn-success">
        <option class="list-group-item">---Select---</option>
         <?php
				while($rowQuestion=mysql_fetch_array($resExam))
				{
	 	?>
    	<option class="list-group-item" value="<?php echo $rowQuestion['qId'];?>"><?php echo $rowQuestion['qQuestion'];?></option>
      
      	<?php
				}
		?>
</body>
</html>