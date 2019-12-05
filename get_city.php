<?php
include("config.php");

	if(isset($_POST['G_STATE_ID']))
	{
		$sql="Select CITY_ID,CITY_NAME FROM city WHERE STATE_ID=".$_POST['G_STATE_ID'];
		$result=$mysqli_query($conn,$sql);

		if(mysqli_num_rows($result)>0)
		{
			echo '<option value="">Select City</option>';
			while($row=mysqli_fetch_assoc($result))
			{
				echo "<option value='{$row['CITY_NAME']}'>{$row['CITY_NAME']}</option>";
			}
		}
	}
?>
