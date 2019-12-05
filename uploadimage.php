<?php
	if(isset($_POST["upload"]) 
	{
		$image_title=$_POST["image_title"];
		$img_description=$_POST["img_description"];
		
		$image_name=$_FILES["uploaded_file"]["name"];
		if ($_FILES["uploaded_file"]["type"]=="image/gif"
		|| $_FILES["uploaded_file"]["type"]=="image/jpeg"
		|| $_FILES["uploaded_file"]["type"]=="image/pjpeg"
		|| $_FILES["uploaded_file"]["type"]=="image/png"
		&& $_FILES["uploaded_file"]["size"]<20000) 
		{ 
			if ($_FILES["uploaded_file"]["error"]>0) 
			{
				echo "Return Code:".$_FILES["uploaded_file"]["error"]."";
			} 
			else 
			{
				$i=1;
				$success = false;
				$new_image_name=$image_name;
				while(!$success) 
				{
					if (file_exists("uploads/".$new_image_name)) 
					{
						$i++;
						$new_image_name="$i".$image_name;
					} 
					else 
					{
						$success=true;
					}
				}
				move_uploaded_file($_FILES["uploaded_file"]["tmp_name"],"uploads/".$new_image_name);
				// image details into database table
				$insert_sql = "INSERT INTO user_gallery(id, user_id, image_title, image_description, image_name) VALUES('', '". $_SESSION["userid"]."', '".$image_title."', '".$img_description."', '".$image_name."')";
				mysqli_query($conn, $insert_sql) or die("database error: ". mysqli_error($conn));
			}
		} 
		else 
		{
			echo "Invalid file";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<div class="container">
	<div class="row">

			<form role="form" enctype='multipart/form-data' action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				<fieldset>
				<legend>Upload Images</legend>
				<div class="form-group">
					<label for="name">Image Title</label>
					<input type="text" name="image_title" placeholder="Image Title" class="form-control" />
				</div>
				<div class="form-group">
					<label for="name">Image Description:</label>
					<input type="text" name="img_description" placeholder="Image Description" class="form-control" />
				</div>
				<div class="form-group">
					<label class="control-label text-success" for="fileToUpload" >Upload Photo to main page slideshow
					</label>
					<input type="file" class="form-control"  name="fileToUpload">
				</div>
				<div class="form-group">
					<input type="submit" name="upload" value="upload" class="btn btn-primary" />
				</div>
				</fieldset>
			</form>
		</div>
	</div>
</div>
</body>
</html>

