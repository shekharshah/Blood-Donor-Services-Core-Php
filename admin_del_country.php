<?php
include("config.php");
if(isset($_GET["id"]))
{
	$id=$_GET["id"];
	$sql="DELETE FROM country WHERE COUNTRY_ID=$id";
	mysqli_query($conn,$sql);
	echo "<script>

		window.open('admin_country.php','_self');
	</script>";
}
?>
