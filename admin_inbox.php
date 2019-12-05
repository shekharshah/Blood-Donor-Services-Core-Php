<?php
  include("config.php");
  session_start();
  if(!isset($_SESSION['usertype']))
  {
    header("location:admin.php");
  }

  if(isset($_GET["id"]))
  {
    $id=$_GET["id"];
    $sql="DELETE FROM `messages` WHERE `ID`=$id";
    if(mysqli_query($conn,$sql))
    {
      $message = '<div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong> Message has been Deleted.
                  </div>';
    }
    else {
      $message = '<div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Error!</strong> Cannnot Delete Message.
                  </div>';
    }
  }

  $sql="SELECT * FROM `messages`";
  $result=mysqli_query($conn,$sql);
  $rows=mysqli_num_rows($result);
  $textline1="Total Messages : $rows";

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include("admin_head.php");?>
    <style>
      .hover{
        background-color: lightgrey;
        color: black;
      }
    </style>
	</head>
<body>

<?php include("admin_topnav.php"); ?>
<div class="container" style='margin-top:30px;'>
	<div class="row">
		<div class="col-sm-3">
			<?php include("admin_side_nav.php");?>
		</div>
		<div class="col-sm-9" >
			<h3 class="text-primary"><i class="fa fa-envelope" style="color:#edc225"></i> Inbox
        <p class="btn btn-danger pull-right"><?php echo "<b>".$textline1."</b>"; ?></p>
      </h3><hr>
      <?php
      $sql="SELECT * FROM `messages` ORDER BY `ID` DESC";
      $result=mysqli_query($conn,$sql);
      if(mysqli_num_rows($result)>0)
      {
      	echo '<ul class="list-group">';
      		while($row=mysqli_fetch_assoc($result))
      		{
      			if($row['STATUS']=='1')
      			{
      				echo '<li class="list-group-item active">
      						<span>
      							<b><i class="fa fa-envelope-square"> </i> '.$row["NAME"].'</b>: '.substr($row["MESSAGE"],0,50).'....
      						</span>
      						<span class="pull-right">
      							<i>'.$row['LOGS'].'</i>&nbsp;
      							<a href="admin_view_message.php?id='.$row['ID'].'" class="btn btn-primary  btn-xs">View</a>
      							<a href="admin_inbox.php?id='.$row['ID'].'"  class="btn btn-danger btn-xs">Delete</a>
      						</span>

      					</li>';
      			}
      			else
      			{
      				echo '<li class="list-group-item">
      						<span>
      							<b><i class="fa fa-envelope-square"></i> '.$row["NAME"].'</b>: '.substr($row["MESSAGE"],0,50).'....
      						</span>
      						<span   class="pull-right">
      							<i>'.$row['LOGS'].'</i>&nbsp;
      							<a href="admin_view_message.php?id='.$row['ID'].'" class="btn btn-primary btn-xs">View</a>
      							<a href="admin_inbox.php?id='.$row['ID'].'"  class="btn btn-danger btn-xs">Delete</a>
      						</span>
      				</li>';
      			}
      			echo"<br>";
      		}
      	echo'</ul>';

      }
      else
      {
      	echo "<div class='alert alert-info mess'>No More Messages</div>";
      }
      ?>
		</div>
	</div>
</div>
<?php include("admin_footer.php"); ?>
<script>
  $(document).ready(function(){
    $(".list-group-item").hover(function(){
      $(this).toggleClass("hover");
    });
  });
</script>
</body>
</html>
