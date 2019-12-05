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
	<link src="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
	<link src="https://cdnjs.cloudflare.com/ajax/libs/foundation/5.5.3/css/foundation.min.css">
	<style>
		#scrollToTop{
			padding:10px;
			text-align:center;
			text-decoration: none;
			position:fixed;
			bottom:75px;
			right:40px;
			display:none;
		}
		#scrollToTop:hover{
			text-decoration:none;
		}
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
		.upload-button {
		  font-size: 1.2em;
		}
		.upload-button:hover {
		  transition: all .3s cubic-bezier(.175, .885, .32, 1.275);
		  color: #999;
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
			<h3 class='text-primary'><i class="fa fa-address-card" style="color:#24b70b;"></i> Profile</h3><hr>
			<div class="row">
				<?php

					$user = $_SESSION['NAME'];
					$fetch_data = "SELECT * FROM `blood_donor_register` WHERE `donor_name`='$user'";
					$result = mysqli_query($conn,$fetch_data);
					if(mysqli_num_rows($result) > 0){
						while ($row = mysqli_fetch_assoc($result)) {
							echo '<tr>';
				?>
			<div class="col-md-12">
				<a href='donor_edit_profile.php?editprofile=<?php echo $row["donor_id"]; ?>' class='btn btn-primary pull-right btn-xs'><i class='fa fa-edit'></i> Edit Profile</a>
				<i class='fa fa-camera upload-button fa-2x'></i><input class="file-upload" type="file" accept="image/*" style="display:none"/>
				<table class="table table-striped" id="table">
					<thead>
						<tr>
							<th>
								<img src="<?php echo $row["donor_pic"];?>" class="image-rounded" height="130px" width="100px" id="image">
							</th>
							<td style="text-align:left;padding-top:20px;padding-left:60px">
								<b id="donorname"><?php echo $row["donor_name"];?></b>
							</td>
						</tr>
					</thead>

					<tbody>
					  <tr>
							<th id="th">Gender</th>
							<td><?php echo $row["gender"];?></td>
						</tr>
						<tr>
							<th id="th">D.O.B</th>
							<td><?php echo $row["dob"];?></td>
						</tr>
						<tr>
							<th id="th">Age</th>
							<!-- <td><?php echo $row["dob"];?></td> -->
							<td>
								<?php 
									$dateOfBirth = $row['dob'];
									$today = date("Y-m-d");
									$age = date_diff(date_create($dateOfBirth), date_create($today));
									echo $age->format('%y'); 
								?>
							</td>
						</tr>
						<tr>
							<th id="th">Blood Group</th>
							<td><?php echo $row["blood_type"];?></td>
						</tr>
						<tr>
							<th id="th">Body Weight</th>
							<td><?php echo $row["body_weight"];?></td>
						</tr>
						<tr>
							<th id="th">Email</th>
							<td><?php echo $row["email_id"];?></td>
						</tr>
						<tr>
							<th id="th">Address</th>
							<td><?php echo $row["address"];?></td>
						</tr>
						<tr>
							<th id="th">Area</th>
							<td><?php echo $row["area"];?></td>
						</tr>
						<tr>
							<th id="th">Pincode</th>
							<td><?php echo $row["pincode"];?></td>
						</tr>
						<tr>
							<th id="th">City</th>
							<td><?php echo $row["city"];?></td>
						</tr>
						<tr>
							<th id="th">State</th>
							<td><?php echo $row["state"];?></td>
						</tr>
						<tr>
							<th id="th">Contact-1</th>
							<td><?php echo $row["contact_1"];?></td>
						</tr>
						<tr>
							<th id="th">Contact-2</th>
							<td>
								<?php
									if(!empty($row["contact_2"])){
										echo $row["contact_2"];
									}
									else {
										echo "-";
									}
								?>
							</td>
						</tr>
						<tr>
							<th id="th">Last Donoted Date</th>
							<td><?php
										if(!empty($row["last_donate_blood"])){
											echo $row["last_donate_blood"];
										}
										else {
											echo "Not Updated Yet";
										}
									?>
							</td>
						</tr>
						<tr>
							<th id="th">Status</th>
							<td><?php

								$status=$row["status"];
								if($status==0)
								{
									echo '<a href="donor_activate.php?id='.$row["donor_id"].'" class="btn btn-sm btn-danger" title="Click here to Active your status">Activate Now</a>';
								}
								else
								{
									echo '<a href="donor_deactivate.php?id='.$row["donor_id"].'" class="btn btn-sm btn-success" title="Click here to Deactive your status">Deactivate Now</a>';
								}

							?>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<?php }} ?>

			<form class="col-md-6" method="post" action="donor_profile.php">
				<div class="form-group">
					<label class="control-label text-primary" for="last_donate_date">Last Donate Date</label>
					<input type="date" placeholder="YYYY/MM/DD" required id="last_donate_date" name="last_donate_date"  class="form-control input-sm DATES2">
				</div>
				<!-- <input type="hidden" name="id" value="<?php echo $_GET["id"];?>"> -->
				<button type='submit' class='btn btn-primary' name='submit'><i class='fa fa-save'></i> Save Changes</button>
			</form>
			<?php
				if(isset($_POST["submit"]))
				{
					$user = $_SESSION['NAME'];
					$ldate=$_POST["last_donate_date"];
					$sql="UPDATE `blood_donor_register` SET `last_donate_blood`='$ldate' WHERE `donor_name`='$user'";
					if(mysqli_query($conn,$sql))
					{
						echo "<div class='alert alert-success fade in'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Success : </strong> Last Donate Date Updated.
								</div>";
					}
					else
					{
						echo "<div class='alert alert-danger fade in'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Error : </strong> Failed to update Last Donate Date.
								</div>";
					}
				}
			?>
		</div>
	</div>
</div>
</div>
<a href='#top' id="scrollToTop" class="pull-right" title="Scroll Up"><i class="fa fa-arrow-circle-up fa-3x" style="color:black"></i></a>

<?php include("footer.php"); ?>
<script>
	$(document).ready(function(){
		$("tbody td").hover(function(){
			$(this).toggleClass("texthover");
		});

		$(window).scroll(function(){
			if ($(this).scrollTop() > 100) {
				$('#scrollToTop').fadeIn();
			} else {
				$('#scrollToTop').fadeOut();
			}
		});
		$("#scrollToTop").click(function() {
			$("html, body").animate({ scrollTop: 0 }, "slow");
			return false;
		});

		$(".upload-button").on('click', function() {
       $(".file-upload").click();
    });
	});
</script>
</body>
</html>
