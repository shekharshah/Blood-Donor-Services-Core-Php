<?php
include("config.php");
if(isset($_GET["id"]))
{
	$id=$_GET["id"];
	$sql="DELETE FROM state WHERE STATE_ID=$id";
	mysqli_query($conn,$sql);
	echo "<script>
		window.open('admin_state.php','_self');
	</script>";
}
?>
