<?php
	$connect = mysql_connect("localhost","root","root");
	mysql_select_db("db_mywork",$connect);
	
	$idNo=$_REQUEST['id'];
	
	$state_id = $_POST['sel_state'];
	$district_id = $_POST['sel_district'];
	
	if($_GET['delId'])
	{
		$delQuery = "delete from tbl_places where place_id = ".$idNo."";
		mysql_query($delQuery);
		echo"<script>alert('Successfully deleted')</script>";
		header('location:place_Details.php');
	}
	if($_GET['editId'])
	{
		$editQuery = "select * from tbl_places  where place_id = ".$idNo."";
		$res=mysql_query($editQuery,$connect) or die("its an error");
		$rowEdit=mysql_fetch_array($res);
		$place_name=$rowEdit['place_name'];
	}
	
	
	if(isset($_POST['btn_submit']))
	
	{
		$place = $_POST['txt_place'];
		
		if($idNo=="")
		{
			$insQuery = "insert into tbl_places(place_name,district_id,st_id)value('".$place."','".$district_id."','".$state_id."')";
			mysql_query($insQuery);
		}
		else
		{
			$upQry="update tbl_places set place_name='".$place."',district_id='".$district_id."',st_id='".$state_id."' where place_id=".$idNo."";
			mysql_query($upQry);
		}
		header('location:place_Details.php');	
	}
	
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PLACE DETAILS</title>
<script src="jQuery.js" type="text/javascript"></script>
<script>
	function getdis(a)
	{
		$.ajax 
		(
			{
				url:"ajax_distr.php?id="+a,
				success:function(result)
				{
					$("#sel_district").html(result);
				}
			}
		);
	}
</script>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="50%" align="center">
    <tr>
      <td>State</td>
      <td><label for="sel_state"></label>
      <?php
				$selQueryState = "select * from tbl_states";
				$resState=mysql_query($selQueryState,$connect) or die('Cannot connect to table');
		?>
        <select name="sel_state" id="sel_state" onchange="getdis(this.value)">
        	<option>---Select---</option>
            <?php
				while($rowState=mysql_fetch_array($resState))
				{
	 		?>
    	    <option value="<?php echo $rowState['st_id'];?>"><?php echo $rowState['st_name'];?></option>
      
      		 <?php
					}
			 ?>
      </select></td>
    </tr>
    <tr>
      <td>District</td>
      <td>
        <select name="sel_district" id="sel_district">
        <option>---Select---</option>
    	<option value="<?php echo $rowDistrict['district_id'];?>"><?php echo $rowDistrict['district_name'];?></option>
      </select></td>
    </tr>
    <tr>
      <td>Place</td>
      <td><label for="txt_place"></label>
      <input type="text" name="txt_place" id="txt_place" value="<?php echo $rowEdit['place_name'];?>"/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="btn_submit" id="btn_submit" value="Submit" /></td>
    </tr>
  </table>
</form>


<table width = "50%" >
	<tr>
    	<th>ID</th>
        <th>Place Name</th>
        <th>District Name</th>
        <th>State Name</th>
    </tr>
    <?php
			$selQry="select * from tbl_places p inner join tbl_district d on p.district_id=d.district_id join tbl_states s on s.st_id = p.st_id";
			$res=mysql_query($selQry,$connect) or die("its an error");
			while($row=mysql_fetch_array($res))
			{
				
	?>
    <tr align="center">
           <td><?php echo $row['place_id'] ;?></td>
           <td><?php echo $row['place_name'] ;?></td>
           <td><?php echo $row['district_name'] ;?></td>
           <td><?php echo $row['st_name'] ;?></td>
           <td><a href="place_Details.php?delId=1&amp;id=<?php echo $row['place_id']?>">Delete</a></td>
           <td><a href="place_Details.php?editId=1&amp;id=<?php echo $row['place_id'] ?>">Edit</a></td>
          
  </tr>
           
     <?php
				}
	?>
</table>
</body>
</html>