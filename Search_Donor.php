<!DOCTYPE html>
<html lang="en">
<head>
<?php include("head.php");
// session_start();
// if(!isset($_SESSION['username']))
// {
// 	header("location:login.php");
// }
?>
</head>
<body>


<?php
	include("top_nav.php");
?>

    <!-- Page Content -->
<div class="container" style='margin-top:30px;'>
	<!-- Marketing Icons Section -->
	<div class="row">
		<div class="col-lg-12">
			<h3 class=" text-primary">
				<i class='fa fa-search' style="color:#8617d1"></i>   Search Blood Donor Availability
			</h3>
			<hr>
		</div>
	</div>
		<?php  include("blood_bread.php"); ?>

	<div class="row centered-form">
		<div class="col-lg-12" id="feedback"></div>
	</div>

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title text-center" style="padding:5px;font-size:16px;font-weight:bold">
					<span class="fa fa-search"> </span>  Search Donor Availability</h3>
				</div>

				<div class="panel-body">
					<form  name="frm" id="frm">
						<div class="form-group">
							<label class="control-label text-primary">Required Blood Group</label>
							<select name="BLOOD_TYPE" id="BLOOD_TYPE" required  class="form-control input-sm">
								<option value="">Select Blood Group</option>
								<option value="A+">A+</option>
								<option value="B+">B+</option>
								<option value="O+">O+</option>
								<option value="AB+">AB+</option>
								<option value="A-">A-</option>
								<option value="B-">B-</option>
								<option value="O-">O-</option>
								<option value="AB-">AB-</option>
							</select>
						</div>

						<div class="form-group text-center">
							<button class="btn btn-primary" name="submit" type="button" id="submit"><i class='fa fa-search'></i> Search Donor</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>


 <?php include("footer.php"); ?>

 <script>
	$(document).ready(function(){
		$(document).on('click','#submit',function(){
			console.log("click");

			$.ajax({
				url:"search_don.php",
				method:"POST",
				data:$("#frm").serialize(),
				success:function(data)
				{
					console.log("click2");

					$("#feedback").html(data);
				}
			});
		});
	});
	// $(document).ready(function(){
  //   $(document).on("click","#submit",function(){
	// 		console.log("click");
  //     $.post("search_don.php",function(){
	// 			console.log("clickagain");
	//
	// 			$("#frm").serialize(function(data)
	// 			{
	// 				console.log("clickagainand again");
	// 				$("#feedback").html(data);
	// 			});
  //     });
  //   });
  // });
 </script>

</body>
</html>
