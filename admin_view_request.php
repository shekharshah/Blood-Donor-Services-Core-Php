<?php
	session_start();
	if(!isset($_SESSION['usertype']))
	{
		header("Location:admin.php");
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
      height: 400px;
      width: auto;
    }
	</style>
</head>
<?php include "admin_head.php";?>
<body>

<?php
	 include"admin_topnav.php";
?>


<div class="container"  style='margin-top:30px'>
	<div class="row">
		<div class="col-sm-3">
			<?php include("admin_side_nav.php");?>
		</div>
		<div class="col-sm-9" >
			<h3 class='text-primary'><i class="fa fa-bed" style="color:Red;"></i> Blood Request Details of Patient</h3><hr>
      <?php
        $sql='SELECT t1.*,t2.donor_id,t2.donor_name FROM `request_blood` AS t1 LEFT JOIN `blood_donor_register` AS t2 ON t1.form_id = t2.donor_id WHERE `id`='.$_GET["id"];
				$result=mysqli_query($conn,$sql);

				if(mysqli_num_rows($result)>0)
				{
					while($row=mysqli_fetch_assoc($result))
					{
            echo "<tr>";

        ?>
        <div class="col-md-12">
          <a href="admin_need_blood.php" class="btn btn-primary btn-sm"><i class="fa fa-arrow-circle-left fa-lg" aria-hidden="true"></i> Back to Previous Page</a>
          <p class="text-info pull-right">Message Received at&nbsp;&nbsp;<u style="color:#f90010;font-weight:bold"><?php echo $row["LOGS"]; ?></u></p>
    			<table class="table table-striped" id="table">
    				<thead>
              <tr>
      					<th><img src="<?php echo $row["PATIENT_IMAGE"];?>" class="image-rounded" height="130px" width="auto" id="image"></th>
      					<td style="padding-top:50px;padding-left:80px">
      						<b id="b">Patient Name: <?php echo $row["NAME"];?></b></td>
      				</tr>
            </thead>
            <tbody>
              <tr>
      					<th id="th">Requested Blood to</th>
      					<td><?php echo $row["donor_name"];?></td>
      				</tr>
              <tr>
      					<th id="th">Gender</th>
      					<td><?php echo $row["GENDER"];?></td>
      				</tr>
      				<tr>
      					<th id="th">Blood Group</th>
      					<td><?php echo $row["BLOOD_TYPE"];?></td>
      				</tr>
              <tr>
                <th id="th">Required Blood Units</th>
                <td><?php echo $row["REQ_BLOOD"];?></td>
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
      					<th id="th">Doctor Name</th>
      					<td><?php echo $row["DOC_NAME"];?></td>
      				</tr>
              <tr>
                <th id="th">Reason for Blood Requirement</th>
                <td><?php echo $row["REASON"];?></td>
              </tr>
              <tr>
                <th id="th">Task Status</th>
                <td><?php
											if($row["task_status"]==0)
											{
												echo "<a href='#' class='btn btn-danger btn-xs'><i class='fa fa-bed'></i> Pending</a>";
											}
											else if($row["task_status"]==2)
											{
												echo "<a href='#' class='btn btn-success btn-xs'><i class='fa fa-bed'></i> Completed</a>";
											}
											else if($row["task_status"]==1)
											{
												echo "<a href='#' class='btn btn-warning btn-xs'><i class='fa fa-bed'></i> Not Completed</a>";
											}
										?>
								</td>
              </tr>
              <tr>
      					<th id="th">Contact Person Name</th>
      					<td><?php echo $row["CONTACT_NAME"]; ?></td>
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
                    else{
                      echo "-";
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
  			?>
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
