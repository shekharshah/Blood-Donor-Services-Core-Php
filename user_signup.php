<!DOCTYPE html>
<?php
	include("config.php");
?>
<html lang="en">
<head>
	<?php include("head.php");?>
</head>

<body>
<?php include("userlogsign_nav.php"); ?>
    <!-- Navigation -->

<div class="container" style="margin-top:30px;">

      <!-- Page Heading/Breadcrumbs -->
	<div class="row well">
    <div class="col-lg-12 text-center ">
      <h1 class="page-header text-primary"><i class='fa fa-user'></i> Signup</h1>
    </div>
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">

				<?php
				error_reporting(E_ALL);
				ini_set('display_errors', 1);

				if(isset($_POST['submit']))
				{
					$user = $_POST['user'];
					$email = $_POST['email'];
					$pass = md5($_POST['pass']);
					$repass = md5($_POST['confirm_password']);
					$mobno = $_POST['mobno'];

					$insert = "INSERT INTO `signup`(`user_name`, `email_id`, `password`, `confirm_pass`, `mob_no`) VALUES ('$user','$email','$pass','$repass','$mobno')";

					if(mysqli_query($conn,$insert)){
						echo '<div class="alert alert-success text-center" role="alert">
										<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
											<b>Success</b>Signup Successfully.
									</div>';
									
						//set_time_limit(2);
						//header('Location:login.php');
					}
					else
					{
						echo '<div class="alert alert-danger text-center" role="alert">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
											<b>Error</b>Signup Failed.
								</div>';
						 //header('Location:user_signup.php');
						//echo "fail";
						//echo "<script>window.location='user_signup.php';</script>"
					}
				}
				?>
				<form role="form" action="user_signup.php" method="post" id="loginForm">

					<div class="form-group">
						<label for="user_name" class="text-primary">User Name</label>
					  <input class="form-control" placeholder="Eg.: Shekhar" name="user" id="user" type="text" required pattern="[A-Za-z]{3,20}" title="Please enter Valid Name atleast 3 Characters are required & only Characters are allowed"/>
					</div>

					<div class="form-group">
						<label for="email" class="text-primary">EmaiID</label>
						<input class="form-control" placeholder="Eg.: shahshekhar@yahoo.com" id="email" name="email" type="email" value="" required pattern="[a-zA-Z0-9.-_]{1,}@[a-zA-Z.-]{2,}[.]{1}[a-zA-Z]{2,}" title="Please Enter Valid EmailID"/>
						<span class="pull-right" id="confirmEmail"></span>
					</div>

					<div class="form-group">
						<label for="password" class="text-primary">Password</label>
						<input class="form-control" placeholder="********" id="password" name="pass" type="password" value="" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}$"
						title="Must contain at least one number and one uppercase and lowercase letter and one special character and at least 8 or more characters"/>
						<input type="checkbox" onclick="showpass()"> Show Password
					</div>

					<div class="form-group">
						<label for="confirm_password" class="text-primary">Confirm Password</label>
						<input class="form-control" placeholder="********" id="confirm_password" name="confirm_password" type="password"
						 value="" onkeyup="checkpass(); return false;" required title="Must match password"/>
						 <span class="pull-right" id="confirmMessage"></span>
					</div>

					<div class="form-group">
						<label for="phone" class="text-primary">Mobile No</label>
						<input class="form-control" placeholder="Eg.: 9898786070" id="mobno" name="mobno" type="text" value="" required pattern="[6789][0-9]{9}" title="Please Enter Valid Mobile no">
					</div>

					<button class="btn btn-primary pull-right" id="submit" name="submit" type="submit"><i class="fa fa-sign-in"></i> Signup</button>
					<button class="btn btn-primary pull-left" name="reset" type="reset"> Reset All</button>


				</form>
			</div>
		</div>
		<h3 class="page-header text-primary"></h3>
		<h3><label class="col-lg-12 text-center">Already have an Account?<a href="login.php"> Login</a><label></h3>
	</div>

<!-- Footer -->
<?php include"footer.php";?>
</div>

<div id="fill">
</div>
<div id="not">
</div>
<div id="not1">
</div>

<script>
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

	function Submit()
	{
		if(password.value==0 && confirm_password.value==0){
			document.getElementById("fill").innerHTML="Fill up the details";
		}
		else
		{
			if(password.value==confirm_password.value)
			{
			  var username=document.getElementById("user").value;
			  var email=document.getElementById("email").value;
			  document.getElementById("fill").innerHTML="";
			  document.getElementById("not").innerHTML="";
			}
			else
			{
			  document.getElementById("not").innerHTML="Password are not matching";
			  document.getElementById("not1").innerHTML="Password must be 8 characters long";
			}
	  }
	}
</script>
</body>

</html>
