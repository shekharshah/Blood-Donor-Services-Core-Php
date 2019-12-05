<?php
include("config.php");
// session_start();
// if(!isset($_SESSION['username']))
// {
// 	header("location:login.php");
// }
error_reporting(0);?>
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
		.note{
			font-size: 100%;
		}
	</style>
</head>
<body>

<?php
	include("top_nav.php");
?>
<div class="container" style='margin-top:30px;'>
	<div class="row">
		<div class="col-md-12">
			<h3 class=" text-primary">
			<i class='fa fa-users' style="color:#24b70b"></i> New Blood Donor Registration
			</h3><hr>
			<?php  include("blood_bread.php"); ?>
		</div>
	</div>

	<div class="well">
		<div class="row">
				<center><i class="fa fa-sticky-note"></i><strong><u><font style="color:red"> Important Note::</font></center>
				<i class="fa fa-star"></i> The Donor must match the following criteria for becoming a donor::</strong></u><br>
				<i class="fa fa-arrow-right"></i> The donor must be atleast 17 years old or above but less than 65.<br>
				<i class="fa fa-arrow-right"></i> The Donor must be having weight of more than 50 and less than 150.<br>
				<i class="fa fa-arrow-right"></i> The "Females must have a minimum hemoglobin of 12.5g/dL" and "Males must have a minimum level of 13.0g/dL".<br>
				<i class="fa fa-arrow-right"></i> Once the donor donates blood then he/she cannot donate blood for 90 days after the completion of 90 days they can donate blood.<br>
				<i class="fa fa-arrow-right"></i> The Donor must not be infected with HIV+(Positive).<br>
				<i class="fa fa-arrow-right"></i> The Donor must not have tattoo on his body.<br>
		</div>
	</div>

	<div class="row centered-form">
		<div class="col-xs-12 col-sm-8 col-md-8 col-sm-offset-2 col-md-offset-2">
			<?php

				if(isset($_POST["Register"]))
				{
					$target_dir = "donor_images/";
					$img="donor_images/donorimage.jpg";
					$target_file = $target_dir.basename($_FILES["IMAGE"]["name"]);
					$uploadOk = 1;
					$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
					// Check if image file is a actual image or fake image

					$check = getimagesize($_FILES["IMAGE"]["tmp_name"]);
					if($check !== false) {
						echo "";
						$uploadOk = 1;
					} else {
						//  echo "File is not an image.";
						$uploadOk = 0;
					}

					// Check if file already exists
					if (file_exists($target_file)) {
						// echo "Sorry, file already exists.";
						$uploadOk = 0;
					}
					// Check file size
					if ($_FILES["IMAGE"]["size"] > 5000000000) {
						// echo "Sorry, your file is too large.";
						$uploadOk = 0;
					}
					// Allow certain file formats
					if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
					&& $imageFileType != "gif" ) {
						// echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
						$uploadOk = 0;
					}
					// Check if $uploadOk is set to 0 by an error
					if ($uploadOk == 0) {
						// echo "Sorry, your file was not uploaded.";
						// if everything is ok, try to upload file
					} else {
						if (move_uploaded_file($_FILES["IMAGE"]["tmp_name"], $target_file)) {
							$img=$target_file;
						} else {
							//   echo "Sorry, there was an error uploading your file.";
						}
					}

					$name = $_POST["NAME"];
					$gender = $_POST["GENDER"];
					$dob = $_POST["DOB"];
					$bloodtype = $_POST["BLOOD_TYPE"];
					$weight = $_POST["BODY_WEIGHT"];
					$email = $_POST["EMAILID"];
					$pass = md5($_POST["PASSWORD"]);
					$confirmpass = md5($_POST["CONFIRM_PASSWORD"]);
					$country = $_POST["COUNTRY"];
					$state = $_POST["STATE"];
					$city = $_POST["CITY"];
					$area = $_POST["AREA"];
					$address = $_POST["ADDRESS"];
					$pincode = $_POST["PINCODE"];
					$contact1 = $_POST["CONTACT_1"];
					$contact2 = $_POST["CONTACT_2"];

			//	$img = $_POST['IMAGE'];

					$insert = "INSERT INTO `blood_donor_register`(`donor_name`, `gender`, `dob`,
			 				`blood_type`, `body_weight`, `email_id`, `password`, `confirm_pass`,
			 				`country`, `state`, `city` , `area`, `address`, `pincode`, `contact_1`, `contact_2`, `donor_pic`, `status`)
							VALUES('$name', '$gender', '$dob', '$bloodtype', '$weight', '$email', '	$pass', '$confirmpass',	'$country', '$state', '$city', '$address', '$pincode', '$contact1', '$contact2','$img',1)";

					if(mysqli_query($conn,$insert))
					{
						echo '<div class="alert alert-success">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									<strong>Success!</strong> Thank you <b><u>'.$_POST['NAME'].	'</u></b> for registering as Donor.
								</div>
								<script>window.location.href = "login.php";</script>';
					}
					else
					{
						echo '<div class="alert alert-danger text-center role="alert">
			                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			                  <strong>Registration Failed!</strong> Please Try Again.
	              			</div>'.mysqli_error($conn);
					}
				}
			?>
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title text-center" style="padding:5px;font-size:16px;font-weight:bold"><span class="fa fa-user"> </span> JOIN AS BLOOD DONOR</h3>
      	</div>

        <div class="panel-body">
					<form method="post" action="donor_register.php" autocomplete="off" role="form" enctype="multipart/form-data">

						<div class="form-group">
							<label class="control-label text-primary" for="part_name">Name</label><b id="required">*</b>
							<input type="text" placeholder="Full Name" id="NAME" name="NAME"  required class="form-control input-md" pattern="[A-Za-z]{3,20}\s[A-z]{3,20}">
						</div>

						<div class="form-group">
							<label class="control-label text-primary"  for="gender">Gender</label><b id="required">*</b>
								<select id="gen" name="GENDER" required class="form-control input-md">
									<option value="">Select Gender</option>
									<option value="Male">Male</option>
									<option value="Female">Female</option>
									<option value="Other">Other</option>
								</select>
						</div>
						<div class="form-group">
							<label class="control-label text-primary" for="dob">D.O.B</label><b id="required">*</b>
							<input type="date"  placeholder="YYYY/MM/DD" required id="DOB" name="DOB"  class="form-control input-md DATES">
						</div>

						<div class="form-group">
							<label class="control-label text-primary" for="blood_type" >Blood Group</label><b id="required">*</b>
						<select id="BLOOD_TYPE" name="BLOOD_TYPE" required class="form-control input-md">
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
							<label class="control-label text-primary" for="body_weight">Body Weight (Your weight must be between 50 to 150)</label><b id="required">*</b>
							<input type="number" required placeholder="Weight In Kgs" min="50" max="150" name="BODY_WEIGHT" id="BODY_WEIGHT" class="form-control input-md" required>
						</div>

						<div class="form-group">
							<label class="control-label text-primary" for="emailid">Email ID</label><b id="required">*</b>
							<input type="email" required name="EMAILID" id="EMAILID" class="form-control input-md" placeholder="Email Address">
						</div>

						<div class="form-group">
							<label for="password" class="text-primary">Password</label><b id="required">*</b>
							<input class="form-control" placeholder="********" id="password" name="PASSWORD" type="password" value="" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}$"
							title="Must contain at least one number and one uppercase and lowercase letter and one special character and at least 8 or more characters"/>
							<input type="checkbox" onclick="showpass()"> Show Password
						</div>

						<div class="form-group">
							<label for="confirm_password" class="text-primary">Confirm Password</label><b id="required">*</b>
							<input class="form-control" placeholder="********" id="confirm_password" name="CONFIRM_PASSWORD" type="password"
							 value="" onkeyup="checkpass(); return false;" required title="Must match password"/>
							 <span class="pull-right" id="confirmMessage"></span>
						</div>

						<div class="form-group">
							<label class="control-label text-primary" for="COUNTRY">Country</label><b id="required">*</b>
							<select name="COUNTRY" id="COUNTRY" required class="form-control input-md">
								<option value="">Select Country</option>
									<?php
										$sql="SELECT COUNTRY_ID,COUNTRY_NAME FROM country ORDER BY COUNTRY_NAME ASC";
										$result=mysqli_query($conn,$sql);
										if(mysqli_num_rows($result)>0)
										{
											while($row=mysqli_fetch_assoc($result))
											{
												echo "<option value='{$row['COUNTRY_NAME']}'>{$row['COUNTRY_NAME']}	</option>";
											}
										}
									?>
							</select>
						</div>

						<div class="form-group">
							<label class="control-label text-primary" for="STATE">State</label><b id="required">*</b>
							<select name="STATE" id="STATE" required class="form-control input-md">
								<option value="">Select State</option>
									<?php
										$sql="SELECT STATE_ID,STATE_NAME FROM state ORDER BY STATE_NAME ASC";
										$result=mysqli_query($conn,$sql);
										if(mysqli_num_rows($result)>0)
										{
											while($row=mysqli_fetch_assoc($result))
											{
												echo "<option value='{$row['STATE_NAME']}'>{$row['STATE_NAME']}	</option>";
											}
										}
									?>
							</select>
						</div>

						<div class="form-group">
							<label class="control-label text-primary" for="CITY" >City</label><b id="required">*</b>
							<select name="CITY" id="CITY" required class="form-control input-md">
								<option value="">Select City</option>
									<?php
										$sql="SELECT CITY_NAME,CITY_ID FROM city ORDER BY CITY_NAME";
										$result=mysqli_query($conn,$sql);
										if(mysqli_num_rows($result)>0)
										{
											while($row=mysqli_fetch_assoc($result))
											{
											echo "<option value='{$row['CITY_NAME']}'>{$row['CITY_NAME']}	</option>";
											}
										}
									?>
							</select>
						</div>

						<div class="form-group">
							<label class="control-label text-primary" for="AREA" >Area</label><b id="required">*</b>
							<select name="AREA" id="AREA" required class="form-control input-md">
								<option value="">Select Area</option>
									<?php
										$sql="SELECT AREA_NAME,AREA_ID FROM area ORDER BY AREA_NAME";
										$result=mysqli_query($conn,$sql);
										if(mysqli_num_rows($result)>0)
										{
											while($row=mysqli_fetch_assoc($result))
											{
											echo "<option value='{$row['AREA_NAME']}'>{$row['AREA_NAME']}	</option>";
											}
										}
									?>
							</select>
						</div>

						<div class="form-group">
							<label class="control-label text-primary" for="address">Address (Maximum 250 Characters)</label><b id="required">*</b>
							<textarea required name="ADDRESS" id="ADDRESS" rows="5" maxlength="250" style="resize:none;"class="form-control" placeholder="Full Address"></textarea>
							<span class="pull-right">&nbsp;Character(s) Remaining</span>
							<span id="rchars" class="pull-right">250</span>
						</div>

						<div class="form-group">
							<label class="control-label text-primary" for="pincode">Pincode</label><b id="required">*</b>
							<input type="text" required pattern="[1-9][0-9]{5}" name="PINCODE" id="PINCODE" class="form-control" placeholder="Insert Pincode">
						</div>

						<div class="form-group">
							<label class="control-label text-primary" for="contact_1" >Contact-1</label><b id="required">*</b>
							<input type="text" required pattern="[6789][0-9]{9}" name="CONTACT_1" id="CONTACT_1" class="form-control" placeholder="Contact No-1">
						</div>

						<div class="form-group">
							<label class="control-label text-primary" for="contact_2" >Contact-2 (Alternate Number)</label>
							<input type="text" pattern="[6789][0-9]{9}" name="CONTACT_2" id="CONTACT_2" class="form-control" placeholder="Contact No-2">
						</div>

						<div class="col-md-8">
							<div class="form-group">
								<label class="control-label" for="fileToUpload" >Upload Photo</label><b id="required">*</b>
								<input type="file" name="IMAGE" class="form-control input-md" onChange="validate(this.value); previewFile()">
					  	</div>
				  	</div>

				  	<label class="control-label text-primary">Your Selected Image</label>
						<img class="thumbnail" src="" title="" alt="Your Image" height="120px" id="blankimage" width="auto">

				  	<div class="form-group">
							<label class="control-label text-success"><input type="checkbox" unchecked id="accept">&nbsp; I have read the eligibility criteria and I agree to the Terms and Conditions and consent to have my contact and donor information published to the potential blood recipients.</label>
				  	</div>

						<div class="form-group text-center">
							<button class="btn btn-primary btn-lg" type="submit" name="Register" id="submitbtn" disabled="disabled">Register Now</button>
						</div>


			 		</form>
  			</div>
			</div>
		</div>
	</div>
</div>
<a href='#top' id="scrollToTop" class="pull-right" title="Scroll Up"><i class="fa fa-arrow-circle-up fa-3x" style="color:black"></i></a>

 <?php include("footer.php"); ?>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>
	//image file validation
	function validate(file) {
	    var ext = file.split(".");
	    ext = ext[ext.length-1].toLowerCase();
	    var arrayExtensions = ["jpg" , "jpeg", "png"];
	    if (arrayExtensions.lastIndexOf(ext) == -1) {
	        alert("Please upload image file only. Files with .jpg, .jpeg, .png extension are allowed");
	        $("#IMAGE").val("");
	    }
    }
    //image preview
	function previewFile() {
	    var preview = document.querySelector('img');
	    var file = document.querySelector('input[type=file]').files[0];
	    var reader = new FileReader();
	    reader.addEventListener("load", function() {
	      console.log('before preview');
	      preview.src = reader.result;
	      console.log('after preview');
	    }, false);

	    if (file) {
	      console.log('inside if');
	      reader.readAsDataURL(file);
	      $("img").show();
	    } else {
	      console.log('inside else');
	    }
  	}
  	//scroll to top
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
	});

	function showpass()
	{
 		var x = document.getElementById("password");
		if (x.type === "password")
		{
			x.type = "text";
		} else {
			x.type = "password";
		}
	}

	function checkpass()
	{
		var cpass=document.getElementById("confirm_password");
		var message=document.getElementById("confirmMessage");
		var goodColor = "green";
		var badColor = "red";

		if(password.value==confirm_password.value)
		{
			cpass.style.background=goodColor;
			message.style.color=goodColor;
			message.innerHTML="Password Matched";
		}
		else
		{
			cpass.style.background=badColor;
			message.style.color=badColor;
			message.innerHTML="Password Not Matched";
		}
	}

	$(document).ready(function(){

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

		var maxLength = 250;
		$('textarea').keyup(function() {
		  var textlen = maxLength - $(this).val().length;
		  $('#rchars').text(textlen);
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
</body>
</html>
