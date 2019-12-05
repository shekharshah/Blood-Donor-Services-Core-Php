<?php
session_start();
include("config.php");
 if(!isset($_SESSION['usertype']))
 {
	 header("location:admin.php");
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("admin_head.php");?>
</head>
<body>
<?php
	include("admin_topnav.php");
?>
<div class="container" style='margin-top:30px'>
  <div class="row">
    <div class="col-sm-3">
      <?php include("admin_side_nav.php");?>
    </div>

    <div class="col-sm-9" >
      <h3>
        <i class="fa fa-envelope"></i> Message

      </h3>
      <hr>
      <a href="admin_inbox.php" title="Back to Previous Page">
        <i class="fa fa-arrow-circle-left fa-2x"></i>
      </a>
      <a href="admin_inbox.php?id=<?php echo $_GET['id']; ?>" class="pull-right" title="Delete Message">
        <i class="fa fa-trash fa-2x" aria-hidden="true"></i>
      </a>
			<?php

				$sql="UPDATE messages SET STATUS=0 WHERE ID=$_GET[id]";
				$result=mysqli_query($conn,$sql);
				$sql="SELECT * FROM messages WHERE ID=$_GET[id]";
				$result=mysqli_query($conn,$sql);
				if(mysqli_num_rows($result)>0)
				{
					if($row=mysqli_fetch_assoc($result))
					{
						echo "<h4><b>".$row['NAME']."</b> <small>( ".$row['EMAIL']." )</small></h4>";
						echo "<p>".$row['MESSAGE']."</p>";echo"<b>Contact : ".$row['CONTACT']."</b>";
            			echo"<p class='text-info pull-right'>Message Received at ".$row['LOGS']."</p>";
					}
				}
			?>
		</div>
	</div>
</div>
 <?php include("admin_footer.php"); ?>
</body>
</html>
