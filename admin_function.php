<?php
include 'config.php';
function load_donor($sql,$conn)
{
	echo '
		<table class="table table-striped">
		<tr>
		<th>S.No.</th>
		<th>Donor Name</th>
		<th>Gender</th>
		<th>Age</th>
		<th>Blood Type</th>
		<th>Weight</th>
		<th>Address</th>
		<th>City</th>
		<th>Contact 1</th>
		<th>Status</th>
		<th>View</th>
		<th>Delete</th>
		</tr>';

		$result=mysqli_query($conn,$sql);
		$n=0;
		if($row=mysqli_num_rows($result))
		{
			while($row=mysqli_fetch_assoc($result))
			{
				$n++;
				echo "<tr>";
				echo "<td>".$n."</td>";
				echo "<td>".$row['donor_name']."</td>";
				echo "<td>".$row['gender']."</td>";
				$dateOfBirth = $row['dob'];
				$today = date("Y-m-d");
				$age = date_diff(date_create($dateOfBirth), date_create($today));
				echo "<td>".$age->format('%y')."</td>";
				echo "<td>".$row['blood_type']."</td>";
				echo "<td>".$row['body_weight']."</td>";
				echo "<td>".substr($row['address'],0,30)."</td>";
				echo "<td>".$row['city']."</td>";
				echo "<td>".$row['contact_1']."</td>";

				if($row["status"]==0)
				{
					echo "<td><a href='#' class='btn btn-danger btn-xs'>Non Active</a></td>";
				}
				else
				{
					echo "<td><a href='#' class='btn btn-success btn-xs'>Active</a></td>";
				}
				echo "<td><a href='admin_view_donor.php?id=".$row['donor_id']."' class='btn btn-primary btn-xs'><i class='fa fa-edit'></i> View</a></td>";
				echo "<td><a href='admin_donor.php?id=".$row['donor_id']."' class='btn btn-danger btn-xs'><i class='fa fa-trash'></i> Delete</a></td>";
				echo "</tr>";
			}
		}
	echo'</table>';
}

function load_patient($sql,$conn)
{
	echo '
				<table class="table table-striped">
				<tr>
				<th>S.No.</th>
				<th>Name</th>
				<th>Requested Blood to</th>
				<th>Blood Group</th>
				<th>Gender</th>
				<th>Reason</th>
				<th>Required Date</th>
				<th>Required Time</th>
				<th>Status</th>
				<th>View</th>
				</tr>';

	$result=mysqli_query($conn,$sql);
	$n=0;
	if($row=mysqli_num_rows($result))
	{
		while($row=mysqli_fetch_assoc($result))
		{
			$n++;
			echo "<tr>";
			echo "<td>".$n."</td>";
			echo "<td>".$row['NAME']."</td>";
			echo "<td>".$row['donor_name']."</td>";
			echo "<td>".$row['BLOOD_TYPE']."</td>";
			echo "<td>".$row['GENDER']."</td>";
			// echo "<td>".substr($row['HOSP_ADDRESS'],0,30)."</td>";
			echo "<td>".substr($row['REASON'],0,30)."</td>";
			echo "<td>".$row['REQ_DATE']."</td>";
			echo "<td>".$row['REQ_TIME']."</td>";

			if($row["task_status"]==0)
			{
				echo "<td><a href='#' class='btn btn-danger btn-xs'><i class='fa fa-bed'></i> Pending</a></td>";
			}
			else if($row["task_status"]==2)
			{
				echo "<td><a href='#' class='btn btn-success btn-xs'><i class='fa fa-bed'></i> Completed</a></td>";
			}
			else if($row["task_status"]==1)
			{
				echo "<td><a href='#' class='btn btn-warning btn-xs'><i class='fa fa-bed'></i> Not Completed</a></td>";
			}
			echo "<td><a href='admin_view_request.php?id=".$row['id']."' class='btn btn-primary btn-xs'><i class='fa fa-edit'></i> View</a></td>";
			echo "</tr>";
		}
	}
	else
	{
		echo "<div >No Blood Request Yet</div>";
	}
	echo'</table>';
}

function load_campaign($sql,$conn)
{
	echo '<table class="table table-striped">
				<tr>
				<th>S.No.</th>
				<th>Date of Campaign</th>
				<th>Campaign Name</th>
				<th>Organizer Name</th>
				<th>Address</th>
				<th>Area</th>
				<th>Contact</th>
				<th>Edit</th>
				</tr>';

	$result=mysqli_query($conn,$sql);
	$n=0;
	if(mysqli_num_rows($result)>0)
	{
		while($row=mysqli_fetch_assoc($result))
		{
			$n++;
			echo "<tr>";
			echo "<td>".$n."</td>";
			echo "<td>".$row['camp_date']."</td>";
			echo "<td>".$row['camp_name']."</td>";
			echo "<td>".$row['camp_org_name']."</td>";
			echo "<td>".$row['camp_address']."</td>";
			echo "<td>".$row['camp_area']."</td>";
			echo "<td>".$row['camp_org_number']."</td>";
			echo "<td><a href='admin_edit_campaign.php?edit=".$row['id']."' class='btn btn-primary btn-xs'><i class='fa fa-edit'></i> Edit</a></td>";
			echo "</tr>";
		}
	}
	echo'</table>';

}
//
function load_campaign_fullpage($sql,$conn)
{
	echo '<table class="table table-striped">
				<tr>
				<th>S.No.</th>
				<th>Date of Campaign</th>
				<th>Campaign Name</th>
				<th>Organizer Name</th>
				<th>Address</th>
				<th>Area</th>
				<th>City</th>
				<th>Contact</th>
				<th>Time</th>
				<th>Description</th>
				<th>Edit</th>
				<th>Delete</th>
				</tr>';

	$result=mysqli_query($conn,$sql);
	$n=0;
	if(mysqli_num_rows($result)>0)
	{
		while($row=mysqli_fetch_assoc($result))
		{
			$n++;
			echo "<tr>";
			echo "<td>".$n."</td>";
			echo "<td>".$row['camp_date']."</td>";
			echo "<td>".$row['camp_name']."</td>";
			echo "<td>".$row['camp_org_name']."</td>";
			echo "<td>".$row['camp_address']."</td>";
			echo "<td>".$row['camp_area']."</td>";
			echo "<td>".$row['camp_city']."</td>";
			echo "<td>".$row['camp_org_number']."</td>";
			echo "<td>".$row['camp_time']."</td>";
			echo "<td>".$row['camp_desc']."</td>";
			echo "<td><a href='admin_edit_campaign.php?edit=".$row['id']."' class='btn btn-primary btn-xs'><i class='fa fa-edit'></i> Edit</a></td>";
			echo "<td><a href='admin_campaign.php?delete=".$row['id']."' class='btn btn-danger btn-xs'><i class='fa fa-trash'></i> Delete</a></td>";
			echo "</tr>";
		}
	}
	echo'</table>';
}

//
function load_participants($sql,$conn)
{
	echo '
				<table class="table table-striped">
				<tr>
				<th>S.No.</th>
				<th>Registered Campaign Name</th>
				<th>Participant Name</th>
				<th>Gender</th>
				<th>Blood Type</th>
				<th>Email ID</th>
				<th>Contact 1</th>
				<th>Delete</th>
				</tr>';


	$result=mysqli_query($conn,$sql);
	$n=0;
	if(mysqli_num_rows($result)>0)
	{
		while($row=mysqli_fetch_assoc($result))
		{
			$n++;
			echo "<tr>";
			echo "<td>".$n."</td>";
			echo "<td>".$row['camp_name']."</td>";
			echo "<td>".$row['part_name']."</td>";
			echo "<td>".$row['gender']."</td>";
			echo "<td>".$row['blood_type']."</td>";
			echo "<td>".$row['part_emailid']."</td>";
			echo "<td>".$row['contact_1']."</td>";
			echo "<td><a href='campaign_participants.php?delete=".$row['id']."' class='btn btn-danger btn-xs'><i class='fa fa-trash'></i> Delete</a></td>";
			echo "</tr>";
		}
	}
	echo'</table>';
}

//
function load_participants_fullpage($sql,$conn)
{
	echo '
				<table class="table table-striped">
				<tr>
				<th>S.No.</th>
				<th>Registered Campaign Name</th>
				<th>Participant Name</th>
				<th>Gender</th>
				<th>Date Of Birth</th>
				<th>Blood Type</th>
				<th>Weight</th>
				<th>Email ID</th>
				<th>Address</th>
				<th>Pincode</th>
				<th>Contact 1</th>
				<th>Contact 2</th>
				<th>Action</th>

				</tr>';


	$result=mysqli_query($conn,$sql);
	$n=0;
	if(mysqli_num_rows($result)>0)
	{
		while($row=mysqli_fetch_assoc($result))
		{
			$n++;
			echo "<tr>";
			echo "<td>".$n."</td>";
			echo "<td>".$row['camp_name']."</td>";
			echo "<td>".$row['part_name']."</td>";
			echo "<td>".$row['gender']."</td>";
			echo "<td>".$row['dob']."</td>";
			echo "<td>".$row['blood_type']."</td>";
			echo "<td>".$row['body_weight']."</td>";
			echo "<td>".$row['part_emailid']."</td>";
			echo "<td>".$row['part_address']."</td>";
			echo "<td>".$row['pincode']."</td>";
			echo "<td>".$row['contact_1']."</td>";
			echo "<td>".$row['contact_2']."</td>";
			//echo "<td>".$row['part_image']."</td>";
			//echo "<td><a href='admin_edit_campaign.php?edit=".$row['id']."' class='btn btn-primary btn-xs'><i class='fa fa-edit'></i> Edit</a></td>";
			echo "<td><a href='campaign_participants.php?delete=".$row['id']."' class='btn btn-danger btn-xs'><i class='fa fa-trash'></i> Delete</a></td>";
			echo "</tr>";
		}
	}
	echo'</table>';
}
//
function load_blood($sql,$con)
{
	echo '
				<table class="table table-striped">
				<tr>
				<th>S.No.</th>
				<th>Donor Name</th>
				<th>Blood Type</th>
				<th>Quantity(Pints)</th>
				<th>Date</th>
				<th>Campaign</th>
				<th>Doctor Info</th>
				<th>Status</th>
				<th>Edit</th>
				<th>Delete</th>
				</tr>';

		$result=mysqli_query($conn,$sql);
		$n=0;
		if($row=mysqli_num_rows($result))
		{
			while($row=mysqli_fetch_assoc($result))
			{
				$n++;
				echo "<tr>";
				echo "<td>".$n."</td>";
				echo "<td>".$row['donor_name']."</td>";
				echo "<td>".$row['blood_type']."</td>";
				echo "<td>".$row['quantity']."</td>";
				echo "<td>".$row['date']."</td>";
				echo "<td>".$row['blood_campaign']."</td>";
				echo "<td>".$row['doctor_info']."</td>";
				echo "<td>".$row['status']."</td>";
				echo "<td><a href='admin_edit_blood.php?edit=".$row['id']."' class='btn btn-primary btn-xs'><i class='fa fa-edit'></i> Edit</a></td>";
				echo "<td><a href='admin_blood_stock.php?delete=".$row['id']."' class='btn btn-danger btn-xs'><i class='fa fa-trash'></i> Delete</a></td>";
				echo "</tr>";
			}
		}
		echo'</table>';
}

?>
