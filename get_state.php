<?php
include("config.php");

	if(isset($_POST['G_STATE_ID']))
	{
		$sql="Select STATE_ID,STATE_NAME FROM state WHERE COUNTRY_ID=".$_POST['G_STATE_ID'];
		$result=$mysqli_query($conn,$sql);

		if(mysqli_num_rows($result)>0)
		{
			echo '<option value="">Select State</option>';
			while($row=mysqli_fetch_assoc($result))
			{
				echo "<option value='{$row['STATE_ID']}'>{$row['STATE_NAME']}</option>";
			}
		}
	}
?>
