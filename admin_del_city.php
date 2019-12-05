<?php
include("config.php");
if(isset($_GET["id"]))
{
	$id=$_GET["id"];
	$sql="DELETE FROM city WHERE CITY_ID=$id";
	mysqli_query($conn,$sql);
	echo "<script>
		window.open('admin_city.php','_self');
	</script>";
}
?>
