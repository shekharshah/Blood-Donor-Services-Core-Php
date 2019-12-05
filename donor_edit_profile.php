<?php
	session_start();
	if(!isset($_SESSION['NAME']))
	{
		header("Location:login.php");
	}
	include"config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
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
		#image{
			display: block;
		 	margin-left: auto;
		 	margin-right: auto;
			border-radius: 200px;
			border: 1px solid lightgrey;
		}
		#table{
			text-align: left;
		}
		#th{
			padding-left: 50px;
			padding-right: 50px;
		}
		#donorname{
			font-weight: bold;
			font-size: 400%;
			/* color: green; */
		}
		#required{
			color: red;
		}
		.texthover{
      color: red;
      font-size: 16px;
    }
	</style>
</head>
<?php include"head.php";?>
<body>

<?php
	 include"donor_top_nav.php";
?>

<div class="container" style="margin-top:30px">
	<div class="row">
		<div class="col-sm-3">
			<?php include("donor_side_nav.php");?>
		</div>
		<div class="col-sm-9">
			<h3 class='text-primary'><i class='fa fa-edit'></i> Edit Profile</h3><hr>
			<a href="donor_profile.php" class="btn btn-primary btn-sm"><i class="fa fa-arrow-circle-left fa-lg" aria-hidden="true"></i> Back to Previous Page</a>
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<?php
					error_reporting(E_ALL);
        	ini_set('display_errors', 1);

					if(isset($_GET["editprofile"]))
					{
						$user=$_SESSION["NAME"];
						$sql= "SELECT * FROM `blood_donor_register` WHERE `donor_id`='{$_GET["editprofile"]}'";
						$result=mysqli_query($conn,$sql);
						if(!mysqli_query($conn,$sql)){
								echo "Error:: ".mysqli_error($conn);
						}
						else{
							if(mysqli_num_rows($result)>0){
								 while($row=mysqli_fetch_assoc($result))
									{
										$name = $row["donor_name"];
										$gender = $row["gender"];
										$dob = $row["dob"];
										$bloodtype = $row["blood_type"];
										$weight = $row["body_weight"];
										$email = $row["email_id"];
										$country = $row["country"];
										$state = $row["state"];
										$city = $row["city"];
										$area = $row["area"];
										$address = $row["address"];
										$pincode = $row["pincode"];
										$contact1 = $row["contact_1"];
										$contact2 = $row["contact_2"];
										// $image = $row['donor_pic'];
									}
							}
							else{
									header("Location:donor_profile.php");
							}
						}
					}

					if(isset($_POST["update"]))
					{
						$update_id = $_GET['editprofile'];
						$update_name = $_POST["NAME"];
						$update_gender = $_POST["GENDER"];
						$update_dob = $_POST["DOB"];
						$update_bloodtype = $_POST["BLOOD_TYPE"];
						$update_weight = $_POST["BODY_WEIGHT"];
						$update_email = $_POST["EMAILID"];
						$update_country = $_POST["COUNTRY"];
						$update_state = $_POST["STATE"];
						$update_city = $_POST["CITY"];
						$update_area = $_POST["AREA"];
						$update_address = $_POST["ADDRESS"];
						$update_pincode = $_POST["PINCODE"];
						$update_contact1 = $_POST["CONTACT_1"];
						$update_contact2 = $_POST["CONTACT_2"];

            $sql="UPDATE `blood_donor_register` SET `donor_name`='{$update_name}',`gender`='{$update_gender}',
	            `dob`='{$update_dob}',blood_type='{$update_bloodtype}',`body_weight`='{$update_weight}',
	            `email_id`='{$update_email}',`country`='{$update_country}',`state`='{$update_state}',
	            `city`='{$update_city}', `area`='{$update_area}', `address`='{$update_address}', `pincode`='{$update_pincode}',
						 	`contact_1`='{$update_contact1}', `contact_2`='{$update_contact2}' WHERE `donor_id`='{$update_id}'";

						$result =mysqli_query($conn,$sql);

            if(!$result)
            {
                echo '<div class="alert alert-danger text-center" role="alert">
                        Fail to Update Profile!
                      </div>';
            }
            else
            {
                echo '<br><div class="alert alert-success text-center role="alert">
      									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        Hello <b><u>'.$_POST["NAME"].'</u></b>, Your Profile was Updated Successfully!
                      </div>';
            }
					}
					?>
					<div class="panel-body">
						<form method="post" action="donor_edit_profile.php?editprofile=<?php echo $_GET['editprofile'];?>" autocomplete="off" role="form" enctype="multipart/form-data">
							<div class="form-group">
								<label class="control-label text-primary" for="part_name">Name</label><b id="required">*</b>
								<input type="text" placeholder="Full Name" id="NAME" name="NAME" value="<?php echo $name; ?>" required class="form-control input-md" pattern="[A-Za-z]{3,20}\s[A-z]{3,20}">
							</div>

							<div class="form-group">
								<label class="control-label text-primary"  for="gender">Gender</label><b id="required">*</b>
									<select id="gen" name="GENDER" required class="form-control input-md" value="<?php echo $gender; ?>" >
										<option value="">Select Gender</option>
										<option value="Male" <?php echo ($gender=="Male")? 'selected="selected"' : "" ?>>Male</option>
										<option value="Female" <?php echo ($gender=="Female")? 'selected="selected"' : "" ?>>Female</option>
										<option value="Other" <?php echo ($gender=="Other")? 'selected="selected"' : "" ?>>Other</option>
									</select>
							</div>
							<div class="form-group">
								<label class="control-label text-primary" for="dob">D.O.B</label><b id="required">*</b>
								<input type="date"  placeholder="YYYY/MM/DD" required id="DOB" name="DOB" value="<?php echo $dob;?>" class="form-control input-md DATES">
							</div>

							<div class="form-group">
								<label class="control-label text-primary" for="blood_type" >Blood Group</label><b id="required">*</b>
							<select id="BLOOD_TYPE" name="BLOOD_TYPE" value="<?php echo $bloodtype; ?>" required class="form-control input-md">
								<option value="">Select Blood</option>
								<option value="A+" <?php echo ($bloodtype=="A+")? 'selected="selected"' : "" ?>>A+</option>
								<option value="B+"  <?php echo ($bloodtype=="B+")? 'selected="selected"' : "" ?>>B+</option>
								<option value="O+"  <?php echo ($bloodtype=="O+")? 'selected="selected"' : "" ?>>O+</option>
								<option value="AB+" <?php echo ($bloodtype=="AB+")? 'selected="selected"' : "" ?>>AB+</option>
								<option value="A-" <?php echo ($bloodtype=="A-")? 'selected="selected"' : "" ?>>A-</option>
								<option value="B-" <?php echo ($bloodtype=="B-")? 'selected="selected"' : "" ?>>B-</option>
								<option value="O-" <?php echo ($bloodtype=="O-")? 'selected="selected"' : "" ?>>O-</option>
								<option value="AB-" <?php echo ($bloodtype=="AB-")? 'selected="selected"' : "" ?>>AB-</option>
								</select>
							</div>
							<div class="form-group">
								<label class="control-label text-primary" for="body_weight">Body Weight</label><b id="required">*</b>
								<input type="number" required placeholder="Weight In Kgs" name="BODY_WEIGHT" value="<?php echo $weight; ?>" min="50" max="150" id="BODY_WEIGHT" class="form-control input-md">
							</div>

							<div class="form-group">
								<label class="control-label text-primary" for="emailid">Email ID</label><b id="required">*</b>
								<input type="email" required name="EMAILID" id="EMAILID" value="<?php echo $email; ?>" class="form-control input-md" placeholder="Email Address">
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
													if($row['COUNTRY_NAME']==$country){
		                        $selected = "selected=selected";
		                      }
		                      else {
		                        $selected = "";
		                      }
													echo "<option ".$selected." value='{$row['COUNTRY_NAME']}'>{$row['COUNTRY_NAME']}	</option>";
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
													if($row['STATE_NAME']==$state){
		                        $selected = "selected=selected";
		                      }
		                      else {
		                        $selected = "";
		                      }
													echo "<option ".$selected." value='{$row['STATE_NAME']}'>{$row['STATE_NAME']}	</option>";
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
													if($row['CITY_NAME']==$city){
		                        $selected = "selected=selected";
		                      }
		                      else {
		                        $selected = "";
		                      }
													echo "<option ".$selected." value='{$row['CITY_NAME']}'>{$row['CITY_NAME']}	</option>";
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
													if($row['AREA_NAME']==$area){
														$selected = "selected=selected";
													}
													else {
														$selected = "";
													}
													echo "<option ".$selected." value='{$row['AREA_NAME']}'>{$row['AREA_NAME']}	</option>";
												}
											}
										?>
								</select>
							</div>

							<div class="form-group">
								<label class="control-label text-primary" for="address">Address (Maximum 250 Characters)</label><b id="required">*</b>
								<textarea required name="ADDRESS" id="ADDRESS" rows="5" maxlength="250" style="resize:none;"class="form-control" placeholder="Full Address"><?php echo $address; ?></textarea>
								<span class="pull-right">&nbsp;Character(s) Remaining</span>
								<span id="rchars" class="pull-right">250</span>
							</div>

							<div class="form-group">
								<label class="control-label text-primary" for="pincode">Pincode</label><b id="required">*</b>
								<input type="text" required pattern="[1-9][0-9]{5}" name="PINCODE" value="<?php echo $pincode; ?>" id="PINCODE" class="form-control" placeholder="Insert Pincode">
							</div>

							<div class="form-group">
								<label class="control-label text-primary" for="contact_1" >Contact-1</label><b id="required">*</b>
								<input type="text" required pattern="[6789][0-9]{9}" name="CONTACT_1" value="<?php echo $contact1; ?>" id="CONTACT_1" class="form-control" placeholder="Contact No-1">
							</div>

							<div class="form-group">
								<label class="control-label text-primary" for="contact_2" >Contact-2 (Alternate Number)</label>
								<input type="text" pattern="[6789][0-9]{9}" name="CONTACT_2" value="<?php echo $contact2; ?>" id="CONTACT_2" class="form-control" placeholder="Contact No-2">
							</div>

							<div class="form-group text-center">
								<button class="btn btn-primary btn-lg" type="submit" name="update" id="submitbtn">Register Now</button>
							</div>

				 		</form>
    			</div>
				</div>
			</div>
		</div>
	</div>
</div>
<a href='#top' id="scrollToTop" class="pull-right" title="Scroll Up"><i class="fa fa-arrow-circle-up fa-3x" style="color:black"></i></a>

<?php include("footer.php"); ?>
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

		var maxLength = 250;
		$('textarea').keyup(function() {
		  var textlen = maxLength - $(this).val().length;
		  $('#rchars').text(textlen);
		});

	});
</script>
</body>
</html>
