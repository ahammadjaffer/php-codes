<?php
	$connect = mysql_connect("localhost","root","root");
	mysql_select_db("db_mywork",$connect);
	
	
	$idNo=$_REQUEST['id'];
	
	$state_id = $_POST['sel_state'];

	if($_GET['delId'])
	{
		$delQuery = "delete from tbl_district where district_id = ".$idNo."";
		mysql_query($delQuery);
		echo"<script>alert('Successfully deleted')</script>";
		header('location:DistrictDetails.php');
	}
	if($_GET['editId'])
	{
		$editQuery = "select * from tbl_district  where district_id = ".$idNo."";
		$res=mysql_query($editQuery,$connect) or die("its an error");
		$rowEdit=mysql_fetch_array($res) or die("error");
		$statename=$rowEdit['st_name'];
	}
	
	if(isset($_POST['btn_submit']))
	{
		$District_name = $_POST['txt_district'];
		
		if($idNo=="")
		{
			$insQuery = "insert into tbl_district(district_name,st_id)value('".$District_name."','".$state_id."')";
			mysql_query($insQuery);
		}
		else
		{
			$upQry="update tbl_district set district_name='".$District_name."',st_id='".$state_id."' where district_id=".$idNo."";
				mysql_query($upQry);
		}
		header('location:DistrictDetails.php');	
	}
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>District Details</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table align="center">
    <tr>
      <td>District Name</td>
      <td><label for="txt_district"></label>
      <input type="text" name="txt_district" id="txt_district" autofocus="autofocus" autocomplete="off" value="<?php echo $rowEdit['district_name'];?>"/></td>
    </tr>
    
    
    <tr>
      <td>State Name</td>
      
        <?php
				$selQuery = "select * from tbl_states";
				$res=mysql_query($selQuery,$connect) or die('Cannot connect to table');
		?>
      
      <td><label for="sel_state"></label>
        <select name="sel_state" id="sel_state">
        <option>---Select---</option>
        	      <?php
					while($row=mysql_fetch_array($res))
						{
	 			  ?>
     <option value="<?php echo $row['st_id'];?>"><?php echo $row['st_name'];?></option>
      
      			 <?php
						}
				 ?>
      </select></td>
    </tr>
    <tr>
	 <td>&nbsp;</td>
     <td ><input type="submit" name="btn_submit" id="btn_submit" value="Submit" /></td>
    </tr>
  </table>
</form>


<table width = "35%" border="1">
	<tr>
    	<th>ID</th>
        <th>State Name</th>
        <th>DistrictName</th>
    </tr>
    <?php
			$selQry="select * from tbl_district d inner join tbl_states s on s.st_id=d.st_id";
			$res=mysql_query($selQry,$connect) or die("its an error");
			while($row=mysql_fetch_array($res))
			{
				
	?>
    <tr>
           <td><?php echo $row['st_id'] ;?></td>
           <td><?php echo $row['st_name'] ;?></td>
           <td><?php echo $row['district_name'] ;?></td>
           <td><a href="DistrictDetails.php?delId=1&amp;id=<?php echo $row['district_id']?>">delete</a></td>
           <td><a href="DistrictDetails.php?editId=1&amp;id=<?php echo $row['district_id'] ?>">Edit</a></td>
          
  </tr>
           
     <?php
				}
	?>
</table>


</body>
</html>