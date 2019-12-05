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
      <?php
        if(isset($_GET["edit"]))
        {
          $sql= "SELECT * FROM `campaign` WHERE id='{$_GET['edit']}'";
          $result=mysqli_query($conn,$sql);
          if(!mysqli_query($conn,$sql)){
              echo "Error:: ".mysqli_error($conn);
          }
          else
          {
            if(mysqli_num_rows($result)>0)
            {
              while($row=mysqli_fetch_assoc($result)){

                $camp_name = $row['camp_name'];
                $camp_org_name= $row['camp_org_name'];
                $camp_address= $row['camp_address'];
                $camp_area= $row['camp_area'];
                $camp_city= $row['camp_city'];
                $camp_org_number = $row['camp_org_number'];
                $camp_date = $row['camp_date'];
                $camp_time = $row['camp_time'];
                $camp_desc = $row['camp_desc'];
              }
            }
            else{
              header("Location:admin_campaign.php");
            }
          }
        }
      ?>
		</div>
		<div class="col-sm-9">
			<h3 class='text-primary text-center'><i class="fa fa-calendar-plus-o" style="color:#08a6e0"></i> Edit Campaign Details For <b><u><?php echo $camp_name; ?></u></b></h3><hr>
      <a href="admin_campaign.php" class="btn btn-primary btn-sm"><i class="fa fa-arrow-circle-left fa-lg" aria-hidden="true"></i> Back to Previous Page</a>

      <div class="row">
				<div class="col-md-10 col-md-offset-1">
  				<?php


    				if(isset($_POST["camp_submit"]))
    				{
                $update_id = $_GET['edit'];
                $update_camp_name = $_POST['camp_name'];
                $update_camp_org_name= $_POST['camp_org_name'];
                $update_camp_address= $_POST['camp_address'];
                $update_camp_area= $_POST['camp_area'];
                $update_camp_city= $_POST['camp_city'];
                $update_camp_org_number = $_POST['camp_org_number'];
                $update_camp_date = $_POST['camp_date'];
                $update_camp_time = $_POST['camp_time'];
                $update_camp_desc = $_POST['camp_desc'];

                $sql="UPDATE campaign SET camp_name='{$update_camp_name}',camp_org_name='{$update_camp_org_name}',
                camp_address='{$update_camp_address}',camp_area='{$update_camp_area}',camp_city='{$update_camp_city}',
                camp_org_number='{$update_camp_org_number}',camp_date='{$update_camp_date}',camp_time='{$update_camp_time}',
                camp_desc='{$update_camp_desc}' WHERE id='{$update_id}'";

                $result =mysqli_query($conn,$sql);

                if(!$result)
                {
                    echo '<div class="alert alert-danger text-center" role="alert">
                            Fail to Update campaign!
                          </div>';
                }
                else
                {
                    echo '<br><div class="alert alert-success text-center role="alert">
          									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            Campaign Details for <b><u>'.$_POST['camp_name'].'</u></b> Updated Successfully!
                          </div>';
                }
    				}
          ?>

					<form role="form" action="admin_edit_campaign.php?edit=<?php echo $_GET['edit'];?>" method="post">
					  <div class="form-group">
							<label class="control-label text-primary" for="camp_name">Campaign Name</label>
              <input type="text" required class="form-control" name="camp_name" value="<?php echo $camp_name; ?>">
            </div>

						<div class="form-group text-primary">
							<label for="camp_org_name">Organizer Name</label>
							<input required type="text" class="form-control" name="camp_org_name" value="<?php echo $camp_org_name; ?>">
						</div>

            <div class="form-group text-primary">
              <label for="camp_city">City</label>
              <select id="city" name="camp_city" value="" required class="form-control">
                <option>Select City</option>
                <?php

									$sql="SELECT CITY_NAME,CITY_ID FROM city ORDER BY CITY_NAME";
									$result=mysqli_query($conn,$sql);
									if(mysqli_num_rows($result)>0)
									{
										while($row=mysqli_fetch_assoc($result))
										{
                      if($row['CITY_NAME']==$camp_city){
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

            <div class="form-group text-primary">
							<label for="camp_area">Area</label>
              <select id="area" name="camp_area" value="" required class="form-control">
                <option value="">Select Area</option>
                <?php

									$sql="SELECT AREA_NAME,AREA_ID FROM area ORDER BY AREA_NAME";
									$result=mysqli_query($conn,$sql);
									if(mysqli_num_rows($result)>0)
									{
										while($row=mysqli_fetch_assoc($result))
										{
                      if($row['AREA_NAME']==$camp_area){
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
              <label class="control-label text-primary" for="address">Campaign Address (Maximum 250 Characters)</label><b id="required">*</b>
              <textarea required name="camp_address" id="camp_address" rows="5" maxlength="250" style="resize:none;"class="form-control" placeholder="Full Address"><?php echo $camp_address; ?></textarea>
              <span class="pull-right">&nbsp;Character(s) Remaining</span>
              <span id="rchars" class="pull-right">250</span>
            </div>

						<div class="form-group text-primary">
							<label for="camp_org_number">Phone Number</label>
							<input required type="number" class="form-control" name="camp_org_number" value="<?php echo $camp_org_number; ?>">
						</div>

						<div class="form-group text-primary">
							<label for="camp_date">Date</label>
							<input required type="date" class="form-control input DATES1" name="camp_date" value="<?php echo $camp_date; ?>">
						</div>

            <div class="form-group text-primary">
							<label for="camp_time">Time</label>
							<input type="time" class="form-control" name="camp_time" value="<?php echo $camp_time; ?>" required>
						</div>

						<div class="form-group text-primary">
							<label for="camp_desc">Description</label>
							<textarea name="camp_desc" required class="form-control" id="" cols="30" rows="5"><?php echo $camp_desc; ?></textarea>
						</div>

						<div class="form-group text-center">
							<button type="submit" class="btn btn-primary" name='camp_submit' value="Update"><i class="fa fa-send"></i> Update Campaign</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include("admin_footer.php"); ?>
<script>
   var maxLength = 250;
   $('textarea').keyup(function() {
     var textlen = maxLength - $(this).val().length;
     $('#rchars').text(textlen);
   });
</script>
</body>
</html>
