<?php
include("config.php");
if(isset($_GET["id"]))
{
	$id=$_GET["id"];
	$sql="DELETE FROM area WHERE AREA_ID=$id";
	mysqli_query($conn,$sql);
	echo "<script>
		window.open('admin_area.php','_self');
	</script>";
}
?>
