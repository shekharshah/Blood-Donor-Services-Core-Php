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


<div class="container"  style='margin-top:30px'>
	<div class="row">
		<div class="col-sm-3">
			<?php include("donor_side_nav.php");?>
		</div>
		<div class="col-sm-9" >
			<h3 class='text-primary'><i class="fa fa-key" style="color:#edc225;"></i> Change Password</h3><hr>
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<?php
						error_reporting(E_ALL);
						ini_set('display_errors', 1);

						if(isset($_POST["update"]))
						{
							$user = $_SESSION['NAME'];
							$oldpwd=md5($_POST['oldpassword']);
							$newpwd=md5($_POST['newpassword']);
							$confirmnewpwd=md5($_POST['confirmnewpassword']);
							$select="SELECT `password` FROM `blood_donor_register` WHERE `donor_name`='$user' AND `password`='$oldpwd'";
							$result=mysqli_query($conn,$select);
							$row=mysqli_fetch_array($result);
							$fetchedpass = $row['password'];

							if($oldpwd == $fetchedpass)
	            {
								$sql="UPDATE `blood_donor_register` SET `password`='{$newpwd}',`confirm_pass`='{$confirmnewpwd}' WHERE `donor_name`='{$user}'";
								$result1=mysqli_query($conn,$sql);

								if(!$result1)
								{
									echo '<div class="alert alert-danger text-center" role="alert">
													<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
													Fail to Change Password!
												</div>';
								}
								else
								{
									echo '<div class="alert alert-success text-center role="alert">
													<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
													Password Changed!
												</div>';
								}
							}
							else
							{
								echo '<div class="alert alert-danger text-center role="alert">
												<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
												Old password doesnot matched
											</div>';
							}
						}
					?>

					<form role="form" action="donor_change_password.php" method="post">
						<div id="alert alert-danger"></div>

						<div class="form-group">
							<label for="password" class="text-primary">Old Password</label>
							<input type="password" placeholder="********" class="form-control" id="password" name="oldpassword" required/>
							<input type="checkbox" onclick="showpass()"> Show Password
						</div>

						<div class="form-group">
							<label for="password" class="text-primary">New Password</label>
							<input class="form-control" placeholder="********" id="newpassword" name="newpassword" type="password" value="" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}$"
							title="Must contain at least one number and one uppercase and lowercase letter and one special character and at least 8 or more characters"/>
							<input type="checkbox" onclick="shownewpass()"> Show Password
						</div>

						<div class="form-group">
							<label for="confirm_password" class="text-primary">Confirm New Password</label>
							<input class="form-control" placeholder="********" id="confirm_newpassword" name="confirmnewpassword" type="password"
							 value="" onkeyup="checkpass(); return false;" required title="Must match password"/>
							 <span class="pull-right" id="confirmMessage"></span>
						</div><br>
						<div class="form-group">
							<button class="btn btn-primary pull-left" name="reset" type="reset">Reset All</button>
							<button class="btn btn-primary pull-right" name="update" type="submit"><i class="fa fa-save"></i> Change Password</button>
						</div>
					</form>
			</div>
		</div>
	</div>
</div>

<?php include("footer.php"); ?>
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
	function shownewpass()
	{
		var x = document.getElementById("newpassword");
		if (x.type === "password")
		{
			x.type = "text";
		} else {
			x.type = "password";
		}
	}

	function checkpass()
	{
		var cpass=document.getElementById("confirm_newpassword");
		var message=document.getElementById("confirmMessage");
		var goodColor = "green";
		var badColor = "red";

		if(newpassword.value==confirm_newpassword.value)
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
</body>
</html>
