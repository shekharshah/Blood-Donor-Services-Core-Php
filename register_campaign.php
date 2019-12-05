<?php
include("config.php");
// session_start();
// if(!isset($_SESSION['username']))
// {
// 	header("Location:login.php");
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("head.php");?>
	<style>
		#scrollToTop{
			padding:10px;
			text-align:center;
			text-decoration: none;
			position:fixed;
			bottom:75px;
			right:40px;
			display:none;
		}
		#scrollToTop:hover{
			text-decoration:none;
		}
		#required{
			color: red;
		}
	</style>
</head>
<body>

<?php
include("top_nav.php");
?>
<div class="container" style='margin-top:20px;'>
	<div class="row">
    <div class="col-md-12">
			<h3 class=" text-primary">
						 <i class='fa fa-calendar'></i>
						 <?php
							 if(isset($_GET["id"]))
							 {
								 $sql = "SELECT `camp_name` FROM `campaign` WHERE `id`=".$_GET["id"];
								 if(!mysqli_query($conn,$sql))
								 {
									 echo "Error".mysqli_error($con);
								 }
								 else
								 {
									 $result=mysqli_query($conn,$sql);
									 $n=0;
									 if(mysqli_num_rows($result)>0)
									 {
										 while($row=mysqli_fetch_assoc($result))
										 {
											 echo "Register for <b><u>".$row['camp_name']."</u></b> Campaign";
										 }
									 }
								 }
							 }
						 ?>
			</h3><hr>
      <a href="upcoming_campaign.php" class="btn btn-primary btn-sm"><i class="fa fa-arrow-circle-left fa-lg" aria-hidden="true"></i>
	      Back To Previous Page</a>
		</div>
  </div>

  <div class="row centered-form">
    <div class="col-xs-12 col-sm-8 col-md-8 col-sm-offset-2 col-md-offset-2">
      <?php

        if(isset($_POST["register"]))
        {
					$formid = $_POST['campaign_form_name'];
					$name = $_POST['part_name'];
					$gender = $_POST['gender'];
					$dob = $_POST['dob'];
					$bloodtype = $_POST['blood_type'];
					$weight = $_POST['body_weight'];
					$emailid = $_POST['part_emailid'];
					$address = $_POST['part_address'];
					$pincode = $_POST['pincode'];
					$contact1 = $_POST['contact_1'];
					$contact2 = $_POST['contact_2'];
					//$image = $_POST['part_image'];


		     	$insert = "INSERT INTO `participants`(`form_id`, `part_name`, `gender`, `dob`, `blood_type`, `body_weight`, `part_emailid`,
					`part_address`, `pincode`, `contact_1`, `contact_2`) VALUES('$formid', '$name', '$gender', '$dob',
					'$bloodtype', '$weight', '$emailid', '$address', '$pincode', '$contact1', '$contact2')";

					if(mysqli_query($conn,$insert))
					{
						echo '<script> alert("You have Successfully Registered. Thank You!");window.location="upcoming_campaign.php";</script>';
					}
					else {
						echo "ERROR:: ".mysqli_error($conn);
					}

				}
      ?>
      <div class="panel panel-primary">
        <div class="panel-heading">
					<?php
						if(isset($_GET["id"]))
						{
							$sql = "SELECT `id`,`camp_name` FROM `campaign` WHERE `id`=".$_GET["id"];
							if(!mysqli_query($conn,$sql))
							{
								echo "Error".mysqli_error($con);
							}
							else
							{
								$result=mysqli_query($conn,$sql);
								$n=0;
								if(mysqli_num_rows($result)>0)
								{
									while($row=mysqli_fetch_assoc($result))
									{
										echo "<h3 class='panel-title text-center' style='padding:5px;font-size:16px;font-weight:bold'>
													<span class='fa fa-calendar'> </span> Register for <font color='red'>".$row['camp_name']."</font> Campaign</h3>";
										$form_id = $row['id'];
									}
								}
							}
						}
					?>

      	</div>

	      <div class="panel-body">
					<form method="post" action="register_campaign.php" autocomplete="off" role="form" enctype="multipart/form-data">
						<input type='hidden' name='campaign_form_name' value="<?php echo $form_id; ?>">
						<div class="form-group">
							<label class="control-label text-primary" for="part_name" >Name</label><b id="required">*</b>
							<input type="text" placeholder="Full Name" id="NAME" name="part_name"  required class="form-control input-md">
						</div>

						<div class="form-group">
							<label class="control-label text-primary"  for="gender">Gender</label><b id="required">*</b>
							<select id="gen" name="gender" required class="form-control input-md">
								<option value="">Select Gender</option>
								<option value="Male">Male</option>
								<option value="Female">Female</option>
								<option value="Other">Other</option>
							</select>
						</div>

						<div class="form-group">
							<label class="control-label text-primary" for="dob">D.O.B</label><b id="required">*</b>
							<input type="date"  placeholder="YYYY/MM/DD" required id="DOB" name="dob"  class="form-control input-md DATES">
						</div>

						<div class="form-group">
							<label class="control-label text-primary" for="blood_type" >Blood Group</label><b id="required">*</b>
							<select id="blood" name="blood_type" required class="form-control input-md">
								<option value="">Select Blood</option>
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

						<div class="form-group">
							<label class="control-label text-primary" for="body_weight" >Body Weight</label><b id="required">*</b>
							<input type="number" required placeholder="Weight In Kgs"  name="body_weight" id="BODY_WEIGHT" class="form-control input-md" required pattern="[1-9][0-9]{2}">
						</div>

						<div class="form-group">
							<label class="control-label text-primary" for="part_emailid" >Email ID</label><b id="required">*</b>
		          <input type="email"  required name="part_emailid" id="EMAIL" class="form-control input-md" placeholder="Email Address">
		        </div>

						  <div class="form-group">
		          <label class="control-label text-primary" for="part_address">Address</label><b id="required">*</b>
		          <textarea required name="part_address" id="ADDRESS" rows="5" maxlength="250" style="resize:none;"class="form-control input-md" placeholder="Full Address"></textarea>
						</div>

					  <div class="form-group">
							<label class="control-label text-primary" for="pincode">Pincode</label><b id="required">*</b>
		          <input type="text" required name="pincode" id="PINCODE" class="form-control input-md" placeholder="Insert Pincode">
		        </div>

		        <div class="form-group">
		          <label class="control-label text-primary" for="contact_1" >Contact-1</label><b id="required">*</b>
		          <input type="text" required name="contact_1" id="CONTACT_1" class="form-control input-md" placeholder="Contact No-1">
		        </div>

		        <div class="form-group">
		          <label class="control-label text-primary" for="contact_2" >Contact-2 (Alternate Number)</label>
		          <input type="text" name="contact_2" id="CONTACT_2" class="form-control input-md" placeholder="Contact No-2">
		        </div>

						<div class="form-group">
							<label class="control-label text-success"><input type="checkbox" unchecked id="accept">&nbsp; I have read the eligibility criteria and confirm that I am atleast 17 years old or above and eligible to donate blood.
								I agree to the Terms and Conditions and consent to have my contact and donor information published to the potential blood recipients.</label>
						</div>

					  <div class="form-group text-center">
							<button class="btn btn-primary btn-lg" type="submit" id="submitbtn" disabled="disabled" name="register" >Register Now</button>
					  </div>
      		</form>
    		</div>
  		</div>
		</div>
	</div>
</div>

	<a href='#top' id="scrollToTop" class="pull-right" title="Scroll Up"><i class="fa fa-arrow-circle-up fa-3x" style="color:black"></i></a>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>
		$(document).ready(function(){
			$(window).scroll(function(){
				if ($(this).scrollTop() > 100) {
					$('#scrollToTop').fadeIn();
				} else {
					$('#scrollToTop').fadeOut();
				}
			});
			$("#scrollToTop").click(function() {
				$("html, body").animate({ scrollTop: 0 }, "slow");
				return false;
			});

			$('#BODY_WEIGHT').keyup(function () {
    		this.value = this.value.replace(/[^0-9\.]/g,'');
			});
			$('#PINCODE').keyup(function () {
    		this.value = this.value.replace(/[^0-9\.]/g,'');
			});
			$('#CONTACT_1').keyup(function () {
    		this.value = this.value.replace(/[^0-9\.]/g,'');
			});
			$('#CONTACT_2').keyup(function () {
    		this.value = this.value.replace(/[^0-9\.]/g,'');
			});

			$('#accept').click(function() {
				if($('#submitbtn').is(':disabled'))
				{
			  	$('#submitbtn').removeAttr('disabled');
			  }
				else
				{
			  	$('#submitbtn').attr('disabled', 'disabled');
			  }
			});
		});
	</script>
 <?php include("footer.php"); ?>
</body>
</html>
