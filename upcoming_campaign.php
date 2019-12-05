<?php
// session_start();
// if(!isset($_SESSION['username']))
// {
// 	header("location:login.php");
// }
include("config.php");
include("user_function.php");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
			<?php include("head.php");?>
	</head>
	<body>

<?php include("top_nav.php"); ?>
<div class="container" style='margin-top:30px'>
	<div class="row">
		    <h3 class="text-primary"><i class="fa fa-calendar" style="color:#08a6e0"></i> Upcoming Blood Campaigns </h3><hr>
        <?php  include("blood_bread.php"); ?>
		<div class="row">
			<div class="col-md-6 pull-left">
				<h3><i class="fa fa-list"></i> Lists of Upcoming Blood Campaigns</h3>
			</div>
			<div class="col-md-6">
				<form role="form">
					<div class="form-group text-primary">
						<input placeholder="Search Blood Campaigns" type="text" id="campaign" class="form-control">
					</div>
				</form>
			</div>
			<div class='col-md-12'>
				<div class='table-responsive' id="feedback">
					<?php
						$sql="SELECT * FROM campaign ORDER BY `camp_date`";
						load_campaign($sql,$conn);
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
</div>

 	<?php include("footer.php"); ?>
  <script>
	$(document).ready(function()
	{
		$("#campaign").keyup(function(){
				var txt=$("#campaign").val().toLowerCase();
				$.post('user_ser.php',{c:txt},function(data){
					$("#feedback").html(data);
				});
		});
	});

  </script>

	</body>
</html>
