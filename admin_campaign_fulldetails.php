<?php
  session_start();
  include("config.php");
  include("admin_function.php");
   if(!isset($_SESSION['usertype']))
   {
  	 header("location:admin.php");
   }
  if(isset($_GET['delete'])){
      $sql = "DELETE FROM campaign WHERE id='{$_GET['delete']}'";
      $result=mysqli_query($conn,$sql);
      if(!$result){
          $message = '<div class="alert alert-danger text-center" role="alert">
                      Failed to Delete Campaign!
                </div>'.msqli_error($conn);
      }
      else{
          $message = '<div class="alert alert-success text-center role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    Campaign Deleted!
                </div>';
      }
  }

  $sql="SELECT * FROM `campaign`";
  $result=mysqli_query($conn,$sql);
  $rows=mysqli_num_rows($result);
  $textline1="Total Campaigns : $rows";
?>
<!DOCTYPE html>
<html lang="en">
	<head>
			<?php include("admin_head.php");?>

	</head>
	<body>

<?php include("admin_topnav.php"); ?>
<div class="container" style='margin-top:30px'>
  <h3 class="text-primary">
    <center>
      <i class="fa fa-calendar-plus-o" style="color:#08a6e0"></i> Campaign Full Detailed Lists
    </center>
  </h3><hr>

  <div class="row">
    <div class="col-md-2 text-center" style="padding: 0px 15px;">
      <a href="admin_campaign.php" class="btn btn-primary btn-md">
        <i class="fa fa-arrow-circle-left fa-lg"></i> Back to Previous Page
      </a>
    </div>

    <div class="col-md-2">
      <form role="form">
        <div class="form-group text-primary">
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="admin_add_campaign.php" class="btn btn-success btn-md"><i class="fa fa-plus"></i> Add Campaign</a>
        </div>
      </form>
    </div>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <div class="col-md-6">
      <form role="form">
        <div class="form-group text-primary">
          <input type="text" id="campaign" class="form-control" placeholder="Search Campaign">
        </div>
      </form>
    </div>
    <p class="btn btn-danger"><?php echo "<b>".$textline1."</b>"; ?></p>

    <div class='col-md-12'>
	    <div class='table-responsive' id="feedback">
  			<?php
  				$sql="SELECT * FROM `campaign` ORDER BY `camp_date`";
  				load_campaign_fullpage($sql,$conn);
  			?>
      </div>
      <?php
        if(isset($message)){
            echo $message;
        }
      ?>
		</div>
	</div>
</div>

<?php include("admin_footer.php"); ?>
<script>
  $(document).ready(function()
  {
  	$("#campaign").keyup(function(){
			var txt=$("#campaign").val();
			$.post('admin_ser.php',{c:txt},function(data){
				$("#feedback").html(data);
			});
  	});
  });
</script>

</body>
</html>
