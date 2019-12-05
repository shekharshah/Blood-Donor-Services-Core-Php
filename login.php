<!DOCTYPE html>
<?php
  session_start();
  include("config.php");
?>
<html lang="en">

<head>
  <?php include("head.php");?>


  <style>
    .message {
    	color: #FF0000;
    	font-weight: bold;
    	text-align: center;
    	width: 100%;
    }

  </style>
</head>
<body>
<?php include("top_nav.php"); ?>
    <!-- Navigation -->

    <!-- Page Content -->
<div class="container" style="margin-top:30px;">

      <!-- Page Heading/Breadcrumbs -->
	<div class="row well">
    <div class="col-lg-12 text-center ">
      <h1 class="page-header text-primary"><i class='fa fa-user'></i> Donor Login</h1>
    </div>
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
        <?php
        	error_reporting(E_ALL);
        	ini_set('display_errors', 1);

        	if(isset($_POST['submit']))
        	{
        		$email = $_POST['email'];
        		$pass = md5($_POST['pass']);
        		$checkLoginDetailQuery = "SELECT `donor_id`,`*` FROM `blood_donor_register` WHERE `email_id`='$email' AND `password`='$pass'";
            $excute  = mysqli_query($conn,$checkLoginDetailQuery);
            if(mysqli_num_rows($excute) > 0)
            {
              while ($row = mysqli_fetch_assoc($excute)) {
                $_SESSION['NAME'] = $row['donor_name'];
                $_SESSION['ID'] = $row['donor_id'];
                $id = $row['donor_id'];
                $blood = $row['blood_type'];
              }
              header('Location:donor_request_blood.php?donor_id='.$id.'blood_type='.$blood);
            }
            else
            {
              echo '<div class="alert alert-danger text-center" role="alert">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <b>Error</b> Username and Pasword Incorrect.
                    </div>';
            }
        	}
      	?>

				<form role="form" action="login.php" method="post">
			          <!--<div id="alert alert-danger"></div>
					<div class="form-group">
						<label for="user_name" class="text-primary">User Name</label>
						<input class="form-control" name="user"  id="user" type="text" required>
					</div>-->
					<div class="form-group">
						<label for="email_id" class="text-primary">Email ID</label>
						<input class="form-control" name="email"  id="email" type="email" required>
					</div>
					<div class="form-group">
						<label for="pass" class="text-primary">Password</label>
						<input class="form-control" id="pass" name="pass" type="password" value="" required>
					</div>

					<button class="btn btn-primary pull-right" name="submit" type="submit"><i class="fa fa-sign-in"></i> Login</button>

				</form>
			<p><a href="#" title="Click here">Forget Password?</a></p>
			</div>

			<div class="col-md-4"></div>
		</div>
		<h3 class="page-header text-primary"></h3>
    <h4><label class="col-lg-12 text-center">Want to become a donor?<a href="donor_register.php"> Register Here</a><label></h4>
	</div>
<!-- /.row -->
<!-- Footer -->
<?php include"footer.php";?>
</div>
</body>
</html>
