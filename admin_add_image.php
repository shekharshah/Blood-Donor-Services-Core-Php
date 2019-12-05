<?php
	include("config.php");
	session_start();
	if(!isset($_SESSION['usertype']))
	{
		header("Location:admin.php");
	}

	error_reporting(E_ALL);
	ini_set('display_errors', 1);

?>
<!DOCTYPE html>
<html lang="en">
<?php include"head.php";?>
<body>

<?php
	 include"admin_topnav.php";
?>
    <!-- Page Content -->

<div class="container" style='margin-top:30px'>

	<h3 class="text-primary">
	<center><i class='fa fa-image'></i> Add Images</center></h3>
	<hr>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<a href="admin_view_image.php" class="btn btn-success pull-right"><i class="fa fa-image"></i> View Images</a><br>
			<?php


				if(isset($_POST["submit"]))
				{
					$target_dir = "dynamicimages/";
					$img="dynamicimages/s1.jpg";
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
					$name=$_POST["IMAGE_NAME"];


					$insert = "INSERT INTO `image`(`IMAGE_NAME`,`IMAGE`)VALUES('$name','$img')";
					if(mysqli_query($conn,$insert))
					{
						echo '<div class="alert alert-success">
										<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
										<strong>Success!</strong> Image Added to Database.
										<script>window.location.href="admin_view_image.php";</script>
									</div>';
					}
					else
					{
						echo '<div class="alert alert-danger text-center role="alert">
											<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
											Failed
									</div>'.mysqli_error($conn);
					}
				}

			?>
			<form autocomplete="off" method="post" action="admin_add_image.php" enctype="multipart/form-data">
				<div class="form-group">
					<label class="control-label text-primary">Image Name</label>
					<input type="text" placeholder="Image Name" name="IMAGE_NAME" required class="form-control input-md" required/>
				</div>

				<div class="form-group">
					<label class="control-label text-primary">Choose Image</label>
					<input type="file" name="IMAGE" class="form-control input-md" required/>
				</div>

				<div class="form-group text-center">
					<button class="btn btn-primary btn-lg" name="submit"><i class="fa fa-send"></i> Upload</button>
				</div>

			</form>
		</div>
	</div>
</div>

<br><br><br><br><br><br>
<?php include("admin_footer.php"); ?>
<!-- jQuery -->
<script src="js/jquery.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>
