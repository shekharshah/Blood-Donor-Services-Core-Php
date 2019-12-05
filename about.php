<?php
// session_start();
// if(!isset($_SESSION['username']))
// {
// 	header("location:login.php");
// }
include"config.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
	<script src="js/w3slider.js"></script>
	<?php include"head.php";?>
</head>
<body>

<?php
	 include"top_nav.php";
?>

<!-- Page Content -->
<div class="container" style="margin-top:30px;">
<!-- Page Heading/Breadcrumbs -->
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header text-primary"><i class="fa fa-info-circle">About</i>
				<small>Blood Donor Services</small>
			</h1>
		</div>
	</div>

  <div class="row">
    <div class="col-md-6">

	  	<?php
			$sql = "SELECT * FROM `image` WHERE `id`>'2'";
			if(!mysqli_query($conn,$sql))
			{
				echo "Error".mysqli_error($conn);
			}
			else
			{
				$result=mysqli_query($conn,$sql);
				while($row=mysqli_fetch_assoc($result))
				{
		?>
		<img class="img-responsive" src="<?php echo $row['IMAGE']; ?>"/>
		<?php
				}
			}
		?>
	</div>
    <div class="col-md-6">
			<ul>
				<li>Blood Donor Services was started to provide the facilities for finding blood donors with particular blood type and city.</li>
				<li>We believe in the following terms and conditions and eligible criteria for donotating blood:</li>
				<ul>
					<li>Person whose Age is between 17 to 65 are eligilbe to donate blood.</li>
					<li>We expect healthy persons to become donor & donate blood so they must weight more than 50 and less than 150.</li>
					<li>Hemloglobin is important thing to note while donating blood and for that the Females must have a minimum hemoglobin of 12.5g/dL & Males must have a minimum level of 13.0g/dL.</li>
					<li>We need time punctual donors who can donate blood to patient on time.</li>
					<li>Only 1 unit of blood can be donated by donor.</li>
				</ul>
				<li>NOTE : HIV Infected persons cannot donate blood.</li>
			</ul>
		</div>
  </div>
  <hr>
	<?php include"footer.php"; ?>
</div>
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script>
		w3.slideshow(".img-responsive", 3000);
	</script>
</body>
</html>
