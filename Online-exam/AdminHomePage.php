<?php
	$connect = mysql_connect("localhost","root","");
	mysql_select_db('bstudio',$connect);
	
	//Add Exam Type
	$testName = $_POST['txtExamType'];
	if(isset($_POST['btnExamType']))
	{
		$insertExamType = "insert into tbl_testtype(testName) value('".$testName."')";
		mysql_query($insertExamType);
	}
	
	//To select from table test type
	$selTestTypeQuery = "select * from tbl_testtype";
	$testTypeRes=mysql_query($selTestTypeQuery);
	
	//To add questions to table questions
	$questionName = $_POST['txtqst'];
	$testId = $_POST['selTestType'];
	if(isset($_POST['btnQuestion']))
	{
		$insertQuestionsQuery = "insert into tbl_questions(qQuestion,testId) value('".$questionName."','".$testId."')";
		mysql_query($insertQuestionsQuery);
	}
	
	//To select from table ExamType
	$selETypeQuery = "select * from tbl_testtype";
	$ETypeRes=mysql_query($selETypeQuery);
	
	//To add options to table options
	if(isset($_POST['btnOption']))
	{
		$option = $_POST['txtoption'];
		$optionState = $_POST['customRadio'];
		$QId = $_POST['selQuestionType'];
		$insertOptionsQuery = "insert into tbl_option(optionName,qId,optionAnswer) value('".$option."','".$QId."','".$optionState."')";
		mysql_query($insertOptionsQuery);
	}
	
	//To add Schedule to table schedule
	if(isset($_POST['btnSchedule']))
	{
		$Date = $_POST['txtDate'];
		$Time = $_POST['txtTime'];
		$insertSchedule = "insert into tbl_AdminShedule(schDate,schTime) value('".$Date."','".$Time."')";
		mysql_query($insertSchedule);
	}
	
	//To view exam results
	if(isset($_POST['btnResults']))
	{
		header('location:ExamResults.php');
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>ADMIN HOME</title>
<link rel="stylesheet" type="text/css" href="styleMain.css"/>
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="jQuery.js" type="text/javascript"></script>
<script>
	function getQuestions(a)
	{
		$.ajax 
		(
			{
				url:"ajax_Questions.php?id="+a,
				success:function(result)
				{
					$("#selQuestionType").html(result);
				}
			}
		);
	}
</script>
</head>

<body>
<div class="container">
<!--NAVIGATION-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#"><span class="heading">BExam</span></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="#1">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="MenuPages/ExamTypes.php">Exam Types</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="MenuPages/Questions.php">Questions</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="MenuPages/Schedules.php">Schedules</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="MenuPages/Registrations.php">Registratons</a>
      </li>
      <li class="nav-item">
		<a class="nav-link" href="MenuPages/Registered.php">Registered</a>
      </li>
    </ul>
  </div>
</nav>
<!--ADD EXAM TYPE-->
<div class="card" id="1">
<img class="card-img-top" src="images/cardImg.jpg" alt="Card image cap">
  <div class="card-body">
<h3 class="contentHeading">Add Exam Type</h3>
  <form id="form1" name="form1" method="post" action="">
    <label for="txtExamType"></label>
    <input type="text" name="txtExamType" id="txtExamType" class="form-control"/>
    <input type="submit" name="btnExamType" id="btnExamType" value="Submit" class="btn btn-warning"/>
  </form>
 </div>
</div>

<!--ADD QUESTIONS-->
<div class="card" id="2">
<img class="card-img-top" src="images/cardImg.jpg" alt="Card image cap">
  <div class="card-body">
    <h3 class="contentHeading">Add Questions</h3>
    <form id="form2" name="form2" method="post" action="">
      <label for="txtqst"></label>
      <input type="text" name="txtqst" id="txtqst" class="form-control"/>
      <label for="selTestType"></label>
      <select name="selTestType" id="selTestType" class="btn btn-success">
      <option class="list-group-item">---Select---</option>
      <?php
	  	while($row=mysql_fetch_array($testTypeRes))
		{
	  	?>
      <option class="list-group-item" value="<?php echo $row['testId'];?>"><?php echo $row['testName'];?></option>
      <?php
		}
		?>
      </select>
      <input type="submit" name="btnQuestion" id="btnQuestion" value="Submit" class="btn btn-warning"/>
    </form>
	</div>
</div>

<!--ADD OPTION-->
<div class="card" id="3">
<img class="card-img-top" src="images/cardImg.jpg" alt="Card image cap">
  <div class="card-body">
<h3 class="contentHeading">Add Options</h3>
  <form id="form1" name="form1" method="post" action="">
    <label for="txtoption"></label>
    <input type="text" name="txtoption" id="txtoption" class="form-control"/>
    <select name="selTestType" id="selTestType" class="btn btn-success" onchange="getQuestions(this.value)">
      <option class="list-group-item">---Select---</option>
      <?php
	  	while($rowExam=mysql_fetch_array($ETypeRes))
		{
	  	?>
      <option class="list-group-item" value="<?php echo $rowExam['testId'];?>"><?php echo $rowExam['testName'];?></option>
      <?php
		}
		?>
      </select>
      
      <select name="selQuestionType" id="selQuestionType" class="btn btn-success  selQ">
      <option class="list-group-item">---Select---</option>
      
      <option class="list-group-item" value="<?php echo $rowQuestion['qId'];?>"><?php echo $rowQuestion['qQuestion'];?></option>
      
      </select>
      
      <div class="custom-control custom-radio">
          <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input" value="T">
          <label class="custom-control-label" for="customRadio1">T</label>
      </div>
      <div class="custom-control custom-radio">
          <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input" value="F">
          <label class="custom-control-label" for="customRadio2">F</label>
      </div>
<input type="submit" name="btnOption" id="btnOption" value="Submit" class="btn btn-warning"/>
  </form>
 </div>
</div>

<!--ADD SCHEDULE-->
<div class="card">
<img class="card-img-top" src="images/cardImg.jpg" alt="Card image cap">
  <div class="card-body">
    <h3 class="contentHeading">Add Schedule</h3>
    <form id="form2" name="form2" method="post" action="">
      <label for="txtDate"></label>
      <input type="date" name="txtDate" id="txtDate" class="form-control" placeholder="Enter Date"/>
      <input type="time" name="txtTime" id="txtTime" class="form-control" placeholder="Enter Time"/>
      <input type="submit" name="btnSchedule" id="btnSchedule" value="Submit" class="btn btn-warning"/>
    </form>
	</div>
</div>

<!--ADD SCHEDULE-->
<div class="card">
<img class="card-img-top" src="images/cardImg.jpg" alt="Card image cap">
  <div class="card-body">
    <h3 class="contentHeading">View Exam Results</h3>
    <form id="form2" name="form2" method="post" action="">
      <input type="submit" name="btnResults" id="btnResults" value="View Results" class="btn btn-warning"/>
    </form>
	</div>
</div>
</div>
</body>
</html>