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
		 	margin-left: 60px;
		 	margin-right: auto;
			border-radius: 200px;
			border: 1px solid lightgrey;
		}
		#table{
			text-align: left;
      border: 1px solid lightgrey;
		}
		#th{
			padding-left: 50px;
			padding-right: 50px;
		}
		#b{
			font-weight: bold;
			font-size: 200%;
			/* color: green; */
		}
    .texthover{
      color: green;
      font-size: 16px;
    }
    .zoom{
      height: 300px;
      width: auto;
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
			<h3 class='text-primary'><i class="fa fa-bed" style="color:Red;"></i> Blood Request Details of Patient</h3><hr>
      <?php
				$sql="UPDATE `request_blood` SET `status`='0' WHERE `id`=".$_GET["id"];
				$result=mysqli_query($conn,$sql);
				if(isset($_GET["id"]))
				{
					$sql="SELECT * FROM `request_blood` WHERE `id`=".$_GET["id"];
					$result=mysqli_query($conn,$sql);

					if(mysqli_num_rows($result)>0)
					{
						while($row=mysqli_fetch_assoc($result))
						{
	            echo "<tr>";
        ?>
        <div class="col-md-12">
          <a href="donor_request_blood.php" class="btn btn-primary btn-sm"><i class="fa fa-arrow-circle-left fa-lg" aria-hidden="true"></i> Back to Previous Page</a>
          <p class="text-info pull-right">Message Received at&nbsp;&nbsp;<u style="color:#f90010;font-weight:bold"><?php echo $row["LOGS"]; ?></u></p>
    			<table class="table table-striped" id="table">
    				<thead>
              <tr>
      					<th><img src="<?php echo $row["PATIENT_IMAGE"]; ?>" class="image-rounded" height="130px" width="auto" id="image"></th>
      					<td style="padding-top:50px;padding-left:80px">
      						<b id="b">Patient Name: <?php echo $row["NAME"];?></b></td>
      				</tr>
            </thead>
            <tbody>
      			  <tr>
      					<th id="th">Gender</th>
      					<td><?php echo $row["GENDER"];?></td>
      				</tr>
      				<tr>
      					<th id="th">Blood Group</th>
      					<td><?php echo $row["BLOOD_TYPE"];?></td>
      				</tr>
      				<tr>
      					<th id="th">Age</th>
      					<td><?php echo $row["AGE"];?></td>
      				</tr>
      				<tr>
      					<th id="th">Hospital Address</th>
      					<td><?php echo $row["HOSP_ADDRESS"];?></td>
      				</tr>
      				<tr>
      					<th id="th">City</th>
      					<td><?php echo $row["CITY"];?></td>
      				</tr>
      				<tr>
      					<th id="th">Pincode</th>
      					<td><?php echo $row["PINCODE"];?></td>
      				</tr>
							<tr>
      					<th id="th">Required Blood Units</th>
      					<td><?php echo $row["REQ_BLOOD"];?></td>
      				</tr>
							<tr>
      					<th id="th">Doctor Name</th>
      					<td><?php echo $row["DOC_NAME"];?></td>
      				</tr>
              <tr>
      					<th id="th">Required Date</th>
      					<td><?php echo $row["REQ_DATE"];?></td>
      				</tr>
							<tr>
      					<th id="th">Required Time</th>
      					<td><?php echo $row["REQ_TIME"];?></td>
      				</tr>
							<tr>
								<th id="th">Reason for Blood Requirement</th>
								<td><?php echo $row["REASON"];?></td>
							</tr>
              <tr>
      					<th id="th">Contact Person Name</th>
      					<td><?php echo $row["CONTACT_NAME"];?></td>
      				</tr>
              <tr>
      					<th id="th">Contact Person Email-ID</th>
      					<td><?php echo $row["EMAIL_ID"];?></td>
      				</tr>
      				<tr>
      					<th id="th">Contact Person Contact-1</th>
      					<td><?php echo $row["CONTACT_1"];?></td>
      				</tr>
      				<tr>
      					<th id="th">Contact Person Contact-2</th>
      					<td>
									<?php
										if(!empty($row["CONTACT_2"])){
											echo $row["CONTACT_2"];
										}
										else {
											echo "-";
										}
									?>
								</td>
      				</tr>
							<tr>
								<th id="th">Status</th>
								<td><?php
											if($row["task_status"]==0)
											{
												echo "<a href='#' class='btn btn-danger btn-xs'><i class='fa fa-bed'></i> Pending</a>";
											}
											else if($row["task_status"]==1)
											{
												echo "<a href='#' class='btn btn-warning btn-xs'><i class='fa fa-bed'></i> Not Completed</a>";
											}
											else if($row["task_status"]==2)
											{
												echo "<a href='#' class='btn btn-success btn-xs'><i class='fa fa-bed'></i> Completed</a>";
											}
										?>
								</td>
							</tr>
            </tbody>
    			</table>
    		</div>

        <?php
    					}
    				}
					}
    		?>
				<div class="col-md-6">
          <h3 class='text-primary'>Any Updation</h3>
          <hr>
          <form method='post' action="view_request_blood_details.php?id=<?php echo $_GET["id"];?>">
            <div class="form-group">
              <label for="task_status">Status</label>
              <select name="task_status" required  id="task_status" class="form-control">
                <option value="">Select Status</option>
                <option value="0">Pending</option>
                <option value="1">Not Completed</option>
                <option value="2">Completed</option>
              </select>
            </div>
            <button type='submit' class='btn btn-primary' name='submit'><i class='fa fa-edit'></i> Update Now</button>
          </form>
					<?php
						if(isset($_POST["submit"]))
						{
							$id=$_GET['id'];
							$task_status=$_POST["task_status"];
							$sql="UPDATE `request_blood` SET `task_status`='$task_status' WHERE `id`='$id'";
							if(mysqli_query($conn,$sql))
							{
								$s= "<div class='alert alert-success fade in'>
											<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
											<strong>Success : </strong> Status Updated Success.
										</div>";
							}
							else
							{
								$e= "<div class='alert alert-danger fade in'>
											<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
											<strong>Error : </strong> Status Update Failed.
										</div>";
							}
						}
					?>
        </div>
		</div>
	</div>
</div>

<?php include("footer.php"); ?>

    <!-- jQuery -->
    <!-- <script src="js/jquery.js"></script> -->

    <!-- Bootstrap Core JavaScript -->
    <!-- <script src="js/bootstrap.min.js"></script> -->
    <script>

      $(document).ready(function(){
        $("tbody td").hover(function(){
          $(this).toggleClass("texthover");
        });
        $("#image").hover(function(){
          $(this).toggleClass("zoom");
        });
      });
    </script>

</body>
</html>
