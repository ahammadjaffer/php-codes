<?php

	$connect=mysql_connect("localhost","root","root");//DataBase Connect
	mysql_select_db("db_mywork",$connect);//DataBse Selection
	
	$idNo=$_REQUEST['id'];
	//echo $idNo;
	
	
	if($_GET['delId'])
	{
		$delQry="delete from tbl_category where cat_id=".$idNo."";
		//echo $delQry;
		mysql_query($delQry);
		echo"<script>alert('Successfully deleted')</script>";
		header('location:CategoryDetails.php');
	}
	
	if($_GET['editlId'])
	{
			$selQry="select * from tbl_category where cat_id=".$idNo."";
			$res=mysql_query($selQry,$connect) or die("its an error");
			$rowEdit=mysql_fetch_array($res) /*or die("error")*/;
	}
	
	
	if(isset($_POST['btn_submit']))
	{
		$cat=$_POST['txt_category'];
		if($idNo=="")
		{
				$ins="insert into tbl_category(cat_name)value('".$cat."')";
				mysql_query($ins);
				echo"<script>alert('Successfully Inserted')</script>";
		}
		else
		{
				$upQry="update tbl_category set cat_name='".$cat."' where cat_id=".$idNo."";
				mysql_query($upQry);
				echo"<script>alert('Successfully Updated')</script>";
				$idNo="";
		}
		header('location:CategoryDetails.php');	
	}
	
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table  align="center">
    <tr>
      <td width="16%">Category</td>
      <td width="84%"><label for="txt_category"></label>
      <input type="text" name="txt_category" id="txt_category" value="<?php echo $rowEdit['cat_name'];?>" /></td>
    </tr>
    <tr>
      <td></td>
      <td><input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
      <input type="reset" name="btn_cancel" id="btn_cancel" value="Cancel" /></td>
    </tr>
  </table>
</form>

<table align="center">
	<tr>
    	<th>ID</th>
        <th>CategoryName</th>
    </tr>
    <?php
			$selQry="select * from tbl_category";
			//echo $selQry;
			$res=mysql_query($selQry,$connect) or die("its an error");
			while($row=mysql_fetch_array($res)/* or die("error")*/)
			{
				
	?>
    <tr>
           <td><?php echo $row['cat_id'] ;?></td>
           <td><?php echo $row['cat_name'] ;?></td>
           <td><a href="CategoryDetails.php?delId=1&amp;id=<?php echo $row['cat_id'] ?>">delete</a></td>
           <td><a href="CategoryDetails.php?editlId=1&amp;id=<?php echo $row['cat_id'] ?>">Edit</a></td>
     </tr>
           
     <?php
				}
	?>
</table>

</body>
</html>