<?php

	$conn=mysqli_connect("localhost","root","","blood_donor");
	if(mysqli_connect_error($conn))
	{
		echo "Database Connection Failed";
	}

?>
