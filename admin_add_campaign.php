<?php
session_start();
include("config.php");
include("admin_function.php");
 if(!isset($_SESSION['usertype']))
 {
	 header("location:admin.php");
 }
?>
<!DOCTYPE html>
<html lang="en">
	<head>
			<?php include("admin_head.php");?>
	</head>
	<body>

<?php include("admin_topnav.php"); ?>
<div class="container"  style='margin-top:30px;'>
	<div class="row">
		<div class="col-sm-3">
			<?php include("admin_side_nav.php");?>
		</div>
		<div class="col-sm-9">
			<h3 class='text-primary text-center'><i class="fa fa-calendar-plus-o" style="color:#08a6e0"></i> Add Campaign </h3><hr>
      <a href="admin_campaign.php" class="btn btn-primary btn-sm"><i class="fa fa-arrow-circle-left fa-lg" aria-hidden="true"></i> Back to Previous Page</a>
      <div class="row">
				<div class="col-md-8 col-md-offset-2">
				<?php
				if(isset($_POST["camp_submit"]))
				{
          $camp_name = $_POST['camp_name'];
          $camp_org_name = $_POST['camp_org_name'];
          $camp_addr = $_POST['camp_address'];
          $camp_area = $_POST['camp_area'];
          $camp_city = $_POST['camp_city'];
          $camp_org_number = $_POST['camp_org_number'];
          $camp_date = $_POST['camp_date'];
          $camp_time = $_POST['camp_time'];
          $camp_desc = $_POST['camp_desc'];
          $sql="INSERT INTO `campaign`(`camp_name`,`camp_org_name`,`camp_address`,`camp_area`,`camp_city`,`camp_org_number`,`camp_date`,`camp_time`,`camp_desc`) VALUES('$camp_name','$camp_org_name','$camp_addr','$camp_area','$camp_city','$camp_org_number','$camp_date','$camp_time','$camp_desc')";

          if(!mysqli_query($conn,$sql)){
            echo '<div class="alert alert-danger text-center" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    Failed to Add Campaign!
                  </div>'.msqli_error($conn);
          }
          else{
            echo '<br>
                  <div class="alert alert-success text-center role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    Campaign Added Successfully!
                  </div>';
          }
				}
				?>

					<p id='out' class='text-success'></p>
					<form role="form" action="admin_add_campaign.php" method="post">
					  <div class="form-group">
							<label class="control-label text-primary" for="camp_name">Campaign Name</label>
                  <input type="text" required class="form-control" name="camp_name" placeholder="eg.. Basil Blood Campaign" pattern="[A-Za-z\s]{3,40}">
            </div>

						<div class="form-group text-primary">
							<label for="camp_org_name">Organizer Name</label>
							<input type="text" class="form-control" name="camp_org_name" placeholder="eg..Simon Parker" required pattern="[A-Za-z\s]{3,30}">
						</div>

            <div class="form-group text-primary">
              <label for="camp_city">City</label>
              <select id="city" name="camp_city" required class="form-control">
                <option>Select City</option>
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

						<div class="form-group text-primary">
							<label for="camp_area">Area</label>
              <select id="area" name="camp_area" required class="form-control">
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

            <div class="form-group text-primary">
              <label for="camp_address">Campaign Address</label>
              <!-- <input type="text" class="form-control" name="camp_address" placeholder="eg..Ahmedabad Haat, Vastrapur" required> -->
              <textarea required name="camp_address" id="camp_address" rows="5" maxlength="250" style="resize:none;"class="form-control" placeholder="eg..Ahmedabad Haat, Vastrapur"></textarea>
            </div>

            <div class="form-group text-primary">
							<label for="camp_org_number">Phone Number</label>
							<input type="text" class="form-control" name="camp_org_number" placeholder="+91-9898788090"  required pattern="[6789][0-9]{9}" title="Please Enter Valid Mobile no">
						</div>

            <div class="form-group text-primary">
							<label for="camp_date">Date</label>
							<input type="text" placeholder="YYYY/MM/DD" class="form-control input-md DATES1" name="camp_date" required>
						</div>

            <div class="form-group text-primary">
							<label for="camp_time">Time</label>
							<input type="time" class="form-control" name="camp_time" required>
						</div>

            <div class="form-group text-primary">
							<label for="camp_desc">Description</label>
							<textarea name="camp_desc" class="form-control" id="" cols="30" rows="5" required></textarea>
						</div>

						<div class="form-group text-center">
							<input type="submit" class="btn btn-primary" name='camp_submit' value="Add Campaign">
						</div>

					</form>
				</div>

			</div>


		</div>
	</div>
</div>


	 <?php include("admin_footer.php"); ?>
	</body>
</html>
