<?php
session_start();
include 'config.php';
if(!isset($_SESSION['username']))
{
	header("Location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
			<?php include("head.php");?>
	</head>
	<body>

<?php include("top_nav.php"); ?>
<div class="container"  style='margin-top:30px'>
	<h3 class=" text-primary">
	<i class='fa fa-key'></i> Change Password</h3>
	<hr>
	<div class="row centered">
		<div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
			<a href="user_profile.php" class="btn btn-primary btn-sm"><i class="fa fa-arrow-circle-left fa-lg" aria-hidden="true"></i> Back to Previous Page</a>
			<br>
			<br>
			<?php

				error_reporting(E_ALL);
				ini_set('display_errors', 1);
				if(isset($_POST["update"]))
				{
						$id=$_SESSION['email'];
						$oldpwd=$_POST['oldpass'];
						$newpwd=md5($_POST['newpass']);
						$confirmnewpwd=md5($_POST['confirmnewpass']);

						$sql="UPDATE `signup` SET `password`='{$newpwd}',`confirm_pass`='{$confirmnewpwd}' WHERE `email_id`='{$id}'";
						$result=mysqli_query($conn,$sql);

						if(!$result)
						{
								echo '<div class="alert alert-danger text-center" role="alert">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														Fail to Change Password!
												</div>';
						}
						else
						{
								echo '<br><div class="alert alert-success text-center role="alert">
													<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
													Password Changed!
												</div>';
						}
				}
			?>
			<form role="form" action="change_password.php" method="post">
			<div class="form-group">
				  <label for="old_password" class="text-primary">Old Password</label>
				  <input class="form-control" placeholder="********" name="oldpass" id="oldpass" type="password" required/>
			</div>

			<div class="form-group">
				<label for="password" class="text-primary">New Password</label>
				<input class="form-control" placeholder="********" id="password" name="newpass" type="password" value="" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}$"
				title="Must contain at least one number and one uppercase and lowercase letter and one special character and at least 8 or more characters"/>
				<input type="checkbox" onclick="showpass()"> Show Password

			</div>

			<div class="form-group">
				<label for="confirm_password" class="text-primary">Confirm New Password</label>
				<span class="pull-right" id="confirmMessage"></span>
				<input class="form-control" placeholder="********" id="confirm_password" name="confirmnewpass" type="password"
				 value="" onkeyup="checkpass(); return false;" required title="Must match password"/>
			</div>


			<button class="btn btn-primary pull-right" name="update" type="submit"><i class="fa fa-check-square-o"></i> Update</button>
			<button class="btn btn-primary pull-left" name="reset" type="reset"> Reset All</button>
			</form>
		</div>
	</div>
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

</script>
<br>
<?php include 'footer.php';?>
</body>
</html>
