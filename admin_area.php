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
<div class="container"  style='margin-top:30px' >
	<div class="row">
		<div class="col-sm-3">
			<?php include("admin_side_nav.php");?>
		</div>
		<div class="col-sm-9" >
			<h3 class='text-primary'><i class="fa fa-bank"></i> Add Area </h3><hr>
			<div class="row">
				<div class="col-md-6">
				<?php
				if(isset($_POST["area_submit"]))
				{
          $sql="INSERT INTO area(CITY_ID,STATE_ID,AREA_NAME) VALUES ('".$_POST["statename"]."','".$_POST["cityname"]."','".$_POST["areaname"]."')";
          mysqli_query($conn,$sql);
				}

				?>

					<p id='out' class='text-success'></p>
					<form role="form" action="admin_area.php" method="post">

            <div class="form-group text-primary">
              <label for="state">Select Country</label>
              <select name="countryname" required class="form-control">
                <option value="">Select Country</option>
                <?php
                  $sql="SELECT COUNTRY_ID,COUNTRY_NAME FROM country ORDER BY COUNTRY_NAME ASC";
                  $result=mysqli_query($conn,$sql);
                  if(mysqli_num_rows($result)>0)
                  {
                    while($row=mysqli_fetch_assoc($result))
                    {
                    echo "<option value='{$row['COUNTRY_ID']}'>{$row['COUNTRY_NAME']}	</option>";
                    }
                  }
                ?>
              </select>
            </div>
            <div class="form-group text-primary">
						  <label for="STATE">Select State</label>
							<select name="statename" id="STATE" required class="form-control">
								<option value="">Select State</option>
								<?php
									$sql="SELECT STATE_ID,STATE_NAME FROM state ORDER BY STATE_NAME ASC";
									$result=mysqli_query($conn,$sql);
									if(mysqli_num_rows($result)>0)
									{
										while($row=mysqli_fetch_assoc($result))
										{
										echo "<option value='{$row['STATE_ID']}'>{$row['STATE_NAME']}	</option>";
										}
									}
								?>
							</select>
						</div>

            <div class="form-group text-primary">
  							<label for="CITY">Select City</label>
  							<select name="cityname" id="CITY" required class="form-control">
  								<option value="">Select City</option>
                  <?php
  									$sql="SELECT CITY_ID,CITY_NAME FROM city ORDER BY CITY_NAME ASC";
  									$result=mysqli_query($conn,$sql);
  									if(mysqli_num_rows($result)>0)
  									{
  										while($row=mysqli_fetch_assoc($result))
  										{
  										echo "<option value='{$row['CITY_ID']}'>{$row['CITY_NAME']}	</option>";
  										}
  									}
  								?>
  							</select>
  						</div>

              <div class="form-group">
                <span id="city_feed"></span>
              </div>

						  <div class="form-group text-primary">
							<label for="area">Area Name</label>
							<input id="area" required type="text" class="form-control" name="areaname">
						</div>

						<div class="form-group">
							<input type="submit" class="btn btn-primary" name='area_submit' value="Add Area">
						</div>

					</form>
				</div>
				<div class="col-md-6">
					<?php
						$sql="Select area.AREA_ID, area.AREA_NAME,city.CITY_NAME, state.STATE_NAME,country.COUNTRY_NAME
            From country,state,city Inner Join
            area On area.CITY_ID = city.CITY_ID  ORDER BY area.AREA_NAME LIMIT 0,5";

						$result=mysqli_query($conn,$sql);
						if(mysqli_num_rows($result)>0)
						{
								echo "<table class='table table-striped' >";
									echo "<tr>
											<th>Sno</th>
											<th>Area Name</th>
                      <th>City Name</th>
                      <th>State Name</th>
                      <th>Country Name</th>
											<th>Delete</th>
										</tr>";
										$i=0;
										while($row=mysqli_fetch_assoc($result))
										{
											$i++;
											echo"<tr>";
												echo "<td>$i</td>";
                        echo "<td>".$row["AREA_NAME"]."</td>";
												echo "<td>".$row["CITY_NAME"]."</td>";
                        echo "<td>".$row["STATE_NAME"]."</td>";
                        echo "<td>".$row["COUNTRY_NAME"]."</td>";
												echo "<td><a href='admin_del_area.php?id=".$row["AREA_ID"]."' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i></a></td>";
											echo"</tr>";
										}
								echo "</table>";
						}

					?>
					<a href='admin_view_area.php' class='btn btn-primary'><i class='fa fa-edit'></i> View All</a>
				</div>
			</div>


		</div>
	</div>
</div>


	 <?php include("admin_footer.php"); ?>
  <script>
  $(document).ready(function(){

	  $("#STATE").change(function(){
		  var id= $("#STATE").val();
		  $.post('load_city.php',{sid:id},function(data){
			 // alert(data);
			  $("#city_feed").html(data);
		  });
	  });
  });
  </script>
	</body>
</html>
