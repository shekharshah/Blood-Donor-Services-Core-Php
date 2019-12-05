<?php
session_start();
include("config.php");
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
<div class="container"  style='margin-top:30px'>
	<div class="row">
		<div class="col-sm-3">
			<?php include("admin_side_nav.php");?>
		</div>
		<div class="col-sm-9" >
			<h3 class='text-primary'><i class="fa fa-user"></i> Donor Details </h3><hr>
		<div class="row">
		<?php
		if(isset($_GET["id"]))
		{
			$sql="SELECT * FROM blood_donor_register WHERE donor_id=".$_GET["id"];
			$result=mysqli_query($conn,$sql);
			if(mysqli_num_rows($result)>0)
			{
				$row=mysqli_fetch_assoc($result);

		?>
		<div class="col-md-4">
      <div class="panel">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <a href="admin_donor.php" class="btn btn-primary btn-sm"><i class="fa fa-arrow-circle-left fa-lg" aria-hidden="true"></i> Back to Previous Page</a>
        <div class="panel-body">
          <img src="<?php echo $row["donor_pic"];?>" class="image-rounded" height="300px" width="100%">
        </div>
	    </div>
		</div>
		<div class="col-md-8">
		<table class="table table-striped">
			<tr>
				<th>Name</th>
				<td><?php echo $row["donor_name"];?></td>
			</tr>
			<tr>
				<th>Gender</th>
				<td><?php echo $row["gender"];?></td>
			</tr>
			<tr>
				<th>D.O.B</th>
				<td><?php echo $row["dob"];?></td>
			</tr>
			<tr>
				<th>Blood Group</th>
				<td><?php echo $row["blood_type"];?></td>
			</tr>
			<tr>
				<th>Body Weight</th>
				<td><?php echo $row["body_weight"];?></td>
			</tr>
			<tr>
				<th>Email</th>
				<td><?php echo $row["email_id"];?></td>
			</tr>
			<tr>
				<th>Address</th>
				<td><?php echo $row["address"];?></td>
			</tr>
			<tr>
				<th>City</th>
				<td><?php echo $row["city"];?></td>
			</tr>
			<tr>
				<th>Pincode</th>
				<td><?php echo $row["pincode"];?></td>
			</tr>
			<tr>
				<th>State</th>
				<td><?php echo $row["state"];?></td>
			</tr>

			<tr>
				<th>Contact-1</th>
				<td><?php echo $row["contact_1"];?></td>
			</tr>
			<tr>
				<th>Contact-2</th>
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
				<th>Last Donoted Date</th>
				<td>
          <?php
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
				<th>Status</th>
				<td><?php
              if($row["status"]==0)
              {
                echo "<a href='#' class='btn btn-danger btn-xs'>Non Active</a>";
              }
              else
              {
                echo "<a href='#' class='btn btn-success btn-xs'>Active</a>";
              }
            ?>
        </td>
			</tr>
		</table>
		</div>


		<?php
			}
		}
		else
		{
		echo "<script>window.open('admin_donor.php','_self');</script>";
		}

		?>
<!--
		<form class="col-md-6" method="post" action="update_last.php">
			<div class="form-group">
				<label class="control-label text-primary" for="last_donate_date">Last Donate Date</label>
				<input type="date"  placeholder="YYYY/MM/DD" required id="last_donate_date" name="last_donate_date"  class="form-control input-sm DATES">
			</div>
			<input type="hidden" name="id" value="<?php echo $_GET["id"];?>">
			<button class="btn btn-primary"><i class="fa fa-save"></i> Save Changes</button>

		</form> -->

		</div>
		</div>
	</div>
</div>


	 <?php include("footer.php"); ?>
  <script>
  </script>

	</body>
</html>
