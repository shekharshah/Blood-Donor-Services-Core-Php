<?php
	include("config.php");
	// session_start();
	// if(!isset($_SESSION['username']))
	// {
	// 	header("location:login.php");
	// }
?>
<!DOCTYPE html>
<html lang="en">
<head>

	<?php
		include("head.php");
	?>

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
		#blankimage{
			border: 1px solid lightgrey;
		}
	</style>
</head>

<body>
<?php
	include("top_nav.php");
?>

<div class="container"  style='margin-top:30px;'>
	<div class="row">
  	<div class="col-lg-12">
			<h3 class=" text-primary">
				<i class='fa fa-bed' style="color:#f90010"></i>
				<?php
				if(isset($_GET["donor_id"]))
				{
					$sql = "SELECT `donor_name` FROM `blood_donor_register` WHERE `donor_id`=".$_GET["donor_id"];
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
								echo "Request <b><u>".$row['donor_name']."</u></b> for Blood";
							}
						}
					}
				}
				?>
		  </h3><hr>
	  </div>
	</div>

	<a href="Search_Donor.php" class="btn btn-primary btn-sm"><i class="fa fa-arrow-circle-left fa-lg" aria-hidden="true"></i>
		Back To Previous Page</a>

	<div class="row centered-form">
		<div class="col-xs-12 col-sm-8 col-md-8 col-sm-offset-2 col-md-offset-2">
      <div class="panel panel-primary">
        <div class="panel-heading">
			<?php
				if(isset($_GET["donor_id"]))
				{
					$sql = "SELECT `donor_id`,`donor_name`,`blood_type` FROM `blood_donor_register` WHERE `donor_id`=".$_GET["donor_id"];
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
											<span class='fa fa-calendar'> </span> Register a form to request <font color='red'>".$row['donor_name']."</font> for Blood Type = <font color='red'>".$row['blood_type']."</font></h3>";
								$form_id = $row['donor_id'];
								$blood_type = $row['blood_type'];
							}
						}
					}
				}
			?>
        </div>

        <div class="panel-body">

					<p id="errorBox"></p>
					<?php
					error_reporting(E_ALL);
					ini_set('display_errors', 1);
						if(isset($_POST["submit"]))
						{
							$target_dir = "patient_image/";
							$img="patient_image/noimage.jpg";
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

							$form_id=$_POST['DONOR_NAME_FORM'];
							$name = $_POST['NAME'];
							$gender = $_POST['GENDER'];
							$age = $_POST['AGE'];
							$blood_type = $_POST['BLOOD_TYPE'];
							$unit = $_POST['BUNIT'];
							$hosp_address = $_POST['HOSPITAL'];
							$city = $_POST['CITY'];
							$pincode = $_POST['PINCODE'];
							$doc_name = $_POST['DOC'];
							$req_date = $_POST['RDATE'];
							$req_time = $_POST['RTIME'];
							$con_name = $_POST['CNAME'];
							$email = $_POST['EMAIL'];
							$contact1 = $_POST['CON1'];
							$contact2 = $_POST['CON2'];
							$reason = $_POST['REASON'];
							//$patient_image = $_POST['IMAGE'];
							if($img!=null)
							{
								$image;
							}
							else {
								$image="No Image";
							}

						 	$insert="INSERT INTO `request_blood`(`form_id`, `NAME`,`GENDER`,`AGE`,`BLOOD_TYPE`,`REQ_BLOOD`,`HOSP_ADDRESS`,
											`CITY`,`PINCODE`,`DOC_NAME`,`REQ_DATE`,`REQ_TIME`,`CONTACT_NAME`,`EMAIL_ID`,`CONTACT_1`,
											`CONTACT_2`,`REASON`,`PATIENT_IMAGE`,`status`,`task_status`,`LOGS`)
						 					VALUES('$form_id','$name','$gender','$age','$blood_type','$unit','$hosp_address','$city','$pincode',
											'$doc_name','$req_date','$req_time','$con_name','$email','$contact1','$contact2','$reason','$img',1,0,CURTIME())";

							if(mysqli_query($conn,$insert))
							{
								echo '<div class="alert alert-success">
														 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														 Hello <strong><u>'.$_POST["NAME"].'</u></strong> Your Blood request is sent to donor. <b><u></u></b>Donor will contact you soon.
													 </div>';
							}
							else
							{
								echo '<div class="alert alert-danger text-center role="alert">
				                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				                  <strong>Error : </strong>Registration Failed for Blood Request.
				              </div>'.mysqli_error($conn);
							}
						}
					?>

					<form autocomplete="off" method="post" action="request_blood.php" enctype="multipart/form-data">
						<input type='hidden' name='DONOR_NAME_FORM' value="<?php echo $form_id; ?>">
						<div class="form-group">
							<label class="control-label text-primary">Patient Name</label><b id="required">*</b>
							<input type="text" placeholder="Patient Name" name="NAME"  required id="NAME" class="form-control input-md">
						</div>

						<div class="form-group">
							<label class="control-label text-primary"  for="GENDER">Gender</label><b id="required">*</b>
							<select id="gen" name="GENDER" required class="form-control input-md">
								<option value="">Select Gender</option>
								<option value="Male">Male</option>
								<option value="Female">Female</option>
							</select>
						</div>

						<div class="form-group">
							<label class="control-label text-primary"  for="Age">Age</label><b id="required">*</b>
							<input type="number" required name="AGE" id="AGE" class="form-control input-md" placeholder="Insert your Age">
						</div>

						<div class="form-group">
							<input type='hidden' name='BLOOD_TYPE' value="<?php echo $blood_type; ?>">
						</div>

						<div class="form-group">
							<label class="control-label text-primary">Need Unit Of Blood (Max 1 Unit can be donated by Donor)</label><b id="required">*</b>
							<input readonly="readonly" value="1" type="number" required name="BUNIT" id="BUNIT" class="form-control input-md" placeholder="Insert No Of Unit">
						</div>

						<div class="form-group">
							<label class="control-label text-primary">Hospital Name &amp; Address (Maximum 250 Characters)</label><b id="required">*</b>
							<textarea required name="HOSPITAL" id="HOSPITAL" rows="5" maxlength="250" style="resize:none;"class="form-control input-md" placeholder="Hospital Full Address"></textarea>
							<span class="pull-right">&nbsp;Character(s) Remaining</span>
							<span id="hospitaladdr" class="pull-right">250</span>
						</div>

						<div class="form-group">
							<label class="control-label text-primary">Doctor Name</label><b id="required">*</b>
							<input type="text" placeholder="Doctor Name" class="form-control input-md" name="DOC" id="DOC">
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
							<label class="control-label text-primary" for="pincode">Pincode</label><b id="required">*</b>
							<input type="text" required pattern="[1-9][0-9]{5}" name="PINCODE" id="PINCODE" class="form-control input-md" placeholder="Insert Pincode">
						</div>

						<div class="form-group">
							<label class="control-label text-primary">When Required</label><b id="required">*</b>
							<input type="date" placeholder="MM/DD/YYYY" class="form-control input-md DATES1" name="RDATE" id="RDATE">
						</div>

						<div class="form-group">
							<label class="control-label text-primary">At What Time</label><b id="required">*</b>
							<input type="time" placeholder="" class="form-control input-md" name="RTIME" id="RTIME">
						</div>

						<div class="form-group">
							<label class="control-label text-primary">Reason For Blood (Maximum 500 Characters)</label><b id="required">*</b>
	            <textarea required name="REASON" id="REASON" rows="7" maxlength="500" style="resize:none;"class="form-control input-md" placeholder="Reason For Blood" name="REASON"></textarea>
							<span class="pull-right">&nbsp;Character(s) Remaining</span>
							<span id="res" class="pull-right">500</span>
						</div>

						<hr>
						<h4><u>Contact Person Details</u></h4>
						<div class="form-group">
							<label class="control-label text-primary">Contact Name</label><b id="required">*</b>
							<input type="text" placeholder="Contact Name" class="form-control input-md" name="CNAME" id="CNAME">
						</div>

						<div class="form-group">
							<label class="control-label text-primary">Email ID</label><b id="required">*</b>
							<input type="text" placeholder="Contact Email" class="form-control input-md" name="EMAIL" id="EMAIL">
						</div>

						<div class="form-group">
							<label class="control-label text-primary">Contact No-1</label><b id="required">*</b>
							<input type="text" placeholder="Contact Number" class="form-control input-md" name="CON1" id="CON1" required pattern="[6789][0-9]{9}">
						</div>

						<div class="form-group">
							<label class="control-label text-primary">Contact No-2 (Alternate Number)</label>
							<input type="text" placeholder="Contact Number" class="form-control input-md" name="CON2" id="CON2" pattern="[6789][0-9]{9}">
						</div>

						<div class="col-md-8">
				  			<div class="form-group">
								<label class="control-label text-primary">Upload Photo</label>
								<input type="file" onChange="validate(this.value); previewFile()" name="IMAGE" id="IMAGE" class="form-control input-md">
						  	</div>
						</div>
						<label class="control-label text-primary">Your Selected Image</label>
						<img class="thumbnail" src="" title="" alt="Your Image" height="120px" id="blankimage" width="auto" required>

					  	<div class="col-md-8">
		 					<div class="form-group text-center">
								<button class="btn btn-primary btn-lg" id="BTN" name="submit"><i class="fa fa-send"></i> Request Now</button>
							</div>
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
<script>
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

	$(document).ready(function(){
		//scroll to top
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
		$("#scrollToTop").mouseenter(function() {
			$("#scrollmessage").show();
		});
		$("#scrollToTop").mouseleave(function() {
			$("#scrollmessage").hide();
		});
	});

	$(document).ready(function(){
		//only number can be written
		$('#PINCODE').keyup(function () {
			this.value = this.value.replace(/[^0-9\.]/g,'');
		});
		$('#CON1').keyup(function () {
			this.value = this.value.replace(/[^0-9\.]/g,'');
		});
		$('#CON2').keyup(function () {
			this.value = this.value.replace(/[^0-9\.]/g,'');
		});

		//address text area max length
		var maxLength = 250;
		$('#HOSPITAL').keyup(function() {
			var textlen = maxLength - $(this).val().length;
			$('#hospitaladdr').text(textlen);
		});
		//blood reason text area max length
		var maxLength1 = 500;
		$('#REASON').keyup(function() {
			var textlen = maxLength1 - $(this).val().length;
			$('#res').text(textlen);
		});

		//uploaded image preview
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

	  	//null validations
		$("#BTN").click(function(){
			var NAME=$("#NAME").val();
			var BLOOD=$("#BLOOD").val();
			var BUNIT=$("#BUNIT").val();
			var HOSPITAL=$("#HOSPITAL").val();
			var CITY=$("#CITY").val();
			var PINCODE=$("#PINCODE").val();
			var DOC=$("#DOC").val();
			var RDATE=$("#RDATE").val();
			var RTIME=$("#RTIME").val();
			var CNAME=$("#CNAME").val();
			var EMAIL=$("#EMAIL").val();
			var CON1=$("#CON1").val();
			var CON2=$("#CON2").val();
			var REASON=$("#REASON").val();
			var IMAGE=$("#IMAGE").val();

				if($("#NAME").val() == "" )
				{
					$("#NAME").focus();
					$("#errorBox").html("<div class='alert alert-danger fade in' ><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Warning : </strong> Please Enter Full Name.</div>").fadeOut(8000);
					return false;
				}

				if($("#BLOOD").val() == "" )
				{
					$("#BLOOD").focus();
					$("#errorBox").html("<div class='alert alert-danger fade in' ><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Warning : </strong> Please Select Blood.</div>").fadeOut(8000);
					return false;
				}

				if($("#GENDER").val() == "" )
				{
					$("#GENDER").focus();
					$("#errorBox").html("<div class='alert alert-danger fade in' ><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Warning : </strong> Please Select Gender.</div>").fadeOut(8000);
					return false;
				}
				
				if($("#AGE").val() == "" )
				{
					$("#AGE").focus();
					$("#errorBox").html("<div class='alert alert-danger fade in' ><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Warning : </strong> Please Enter your Age.</div>").fadeOut(8000);
					return false;
				}

				if($("#BUNIT").val() == "")
				{
					$("#BUNIT").focus();
					$("#errorBox").html("<div class='alert alert-danger fade in' ><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Warning : </strong> Please Enter No Of Units.</div>").fadeOut(8000);
					return false;
				}

				if(isNaN($("#BUNIT").val()))
				{
					$("#BUNIT").focus();
					$("#errorBox").html("<div class='alert alert-danger fade in' ><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Warning : </strong> Unit should be numeric.</div>").fadeOut(8000);
					return false;
				}

				if($("#HOSPITAL").val() == "")
				{
					$("#HOSPITAL").focus();
					$("#errorBox").html("<div class='alert alert-danger fade in' ><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Warning : </strong> Please Enter Hospital Name and full address.</div>").fadeOut(8000);
					return false;
				}

				if($("#CITY").val() == "")
				{
					$("#CITY").focus();
					$("#errorBox").html("<div class='alert alert-danger fade in' ><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Warning : </strong> Please Enter Your city name correctly.</div>").fadeOut(8000);
					return false;
				}

				if($("#PINCODE").val() == "")
				{
					$("#PINCODE").focus();
					$("#errorBox").html("<div class='alert alert-danger fade in' ><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Warning : </strong> Please Enter your city pincode.</div>").fadeOut(8000);
					return false;
				}
					if(isNaN($("#PINCODE").val()))
				{
					$("#PINCODE").focus();
					$("#errorBox").html("<div class='alert alert-danger fade in' ><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Warning : </strong> Pincode should be numeric.</div>").fadeOut(8000);
					return false;
				}
				if($("#DOC").val() == "")
				{
					$("#DOC").focus();
					$("#errorBox").html("<div class='alert alert-danger fade in' ><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Warning : </strong> Please Enter Docter Name.</div>").fadeOut(8000);
					return false;
				}

				if($("#RDATE").val() == "")
				{
					$("#RDATE").focus();
					$("#errorBox").html("<div class='alert alert-danger fade in' ><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Warning : </strong> Please Select the Blood Requiered Date .</div>").fadeOut(8000);
					return false;
				}

				if($("#RTIME").val() == "")
				{
					$("#RTIME").focus();
					$("#errorBox").html("<div class='alert alert-danger fade in' ><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Warning : </strong> Please Select the Blood Requiered Time .</div>").fadeOut(8000);
					return false;
				}

				if($("#CNAME").val() == "")
				{
					$("#CNAME").focus();
					$("#errorBox").html("<div class='alert alert-danger fade in' ><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Warning : </strong> Please Enter Contact Person Name.</div>").fadeOut(8000);
					return false;
				}

				if($("#CADDRESS").val() == "")
				{
					$("#CADDRESS").focus();
					$("#errorBox").html("<div class='alert alert-danger fade in' ><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Warning : </strong> Please Fill Full Address.</div>").fadeOut(8000);
					return false;
				}
				if($("#CON1").val() == "")
				{
					$("#CON1").focus();
					$("#errorBox").html("<div class='alert alert-danger fade in' ><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Warning : </strong> Please Enter your Mobile Number.</div>").fadeOut(8000);
					return false;
				}

				if(isNaN($("#CON1").val()))
				{
					$("#CON1").focus();
					$("#errorBox").html("<div class='alert alert-danger fade in' ><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Warning : </strong> Mobile Number should be Numeric.</div>").fadeOut(8000);
					return false;
				}

				if($("#REASON").val() == "")
				{
					$("#REASON").focus();
					$("#errorBox").html("<div class='alert alert-danger fade in' ><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Warning : </strong> Please Enter the correct Reason for Blood.</div>").fadeOut(8000);
					return false;
				}
		});
	});

	function validate(file) {
	    var ext = file.split(".");
	    ext = ext[ext.length-1].toLowerCase();
	    var arrayExtensions = ["jpg" , "jpeg", "png"];
	    if (arrayExtensions.lastIndexOf(ext) == -1) {
	        alert("Please upload image file only. Files with .jpg, .jpeg, .png extension are allowed");
	        $("#IMAGE").val("");
	    }
	}
</script>

</body>
</html>
