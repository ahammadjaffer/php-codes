<?php
	$connect = mysql_connect("localhost","root","root");
	mysql_select_db("db_mywork",$connect);
	
	$idNo=$_REQUEST['id'];
	
	if($_GET['delId'])
	{
		$delQry="delete from tbl_states where st_id=".$idNo."";
		//echo $delQry;
		mysql_query($delQry);
		echo"<script>alert('Successfully deleted')</script>";
		header('location:StateDetails.php');
	}
	
	if($_GET['editId'])
	{
		$editValue="select * from tbl_states where  st_id=".$idNo."";
		$res=mysql_query($editValue,$connect) or die("it an error");
		$rowEdit=mysql_fetch_array($res) or die("error");
	}
	
	if(isset($_POST['btn_submit']))
	{
		$state = $_POST['txt_state'];
		if($idNo=="")
		{
			//INSERT
			$ins = "insert into tbl_states (st_name) values('".$state."')";
			mysql_query($ins);
		}
		else
		{
			//UPDATE
			$upQry="update tbl_states set st_name='".$state."' where st_id=".$idNo."";
			mysql_query($upQry);
			echo"<script>alert('Successfully Updated')</script>";
			$idNo="";
			header('location:StateDetails.php');
		}
	} 
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>STATES | HOME</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="200">
    <tr>
      <td>State</td>
      <td><label for="txt_state"></label>
      <input type="text" name="txt_state" id="txt_state" value="<?php echo $rowEdit['st_name'];?>" /></td>
    </tr>
    <tr>
      <td><input type="submit" name="btn_submit" id="btn_submit" value="Submit" /></td>
      <td><input type="reset" name="btn_cancel" id="btn_cancel" value="Cancel" /></td>
    </tr>
  </table>
</form>
 
<table width = "35%" border="1">
	<tr>
    	<th>ID</th>
        <th>State Name</th>
    </tr>
    <?php
			$selQry="select * from tbl_states";
			$res=mysql_query($selQry,$connect) or die("its an error");
			while($row=mysql_fetch_array($res) or die("error"))
			{
				
	?>
    <tr>
           <td align="center"><?php echo $row['st_id'] ;?></td>
           <td><?php echo $row['st_name'] ;?></td>
           <td><a href="StateDetails.php?delId=1&amp;id=<?php echo $row['st_id'] ?>">Delete</a></td>
           <td><a href="StateDetails.php?editId=1&amp;id=<?php echo $row['st_id'] ?>">Edit</a></td>
  </tr>
           
     <?php
				}
	?>
</table>



</body>
</html>