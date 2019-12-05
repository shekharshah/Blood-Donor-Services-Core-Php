<?php
include 'config.php';
session_start();
function load_donor($sql,$con)
{
	echo '<table class="table table-striped">
			<tr>
				<th>S.No.</th>
				<th>Name</th>
				<th>Gender</th>
				<th>Blood</th>
				<th>City</th>
				<th>State</th>
				<th>Contact-1</th>
				<th>Contact-2</th>
				<th>View</th>
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
			echo "<td>".$row['NAME']."</td>";
			echo "<td>".$row['GENDER']."</td>";
			echo "<td>".$row['BLOOD']."</td>";
			echo "<td>".$row['CITY']."</td>";
			echo "<td>".$row['STATE']."</td>";
			echo "<td>".$row['CONTACT_1']."</td>";
			echo "<td>".$row['CONTACT_2']."</td>";
			echo "<td><a href='admin_view_donor.php?id=".$row['DONOR_ID']."' class='btn btn-primary btn-xs'><i class='fa fa-edit'></i> View</a></td>";
			echo "<td><a href='admin_delete_donor.php?id=".$row['DONOR_ID']."' class='btn btn-danger btn-xs'><i class='fa fa-trash'></i> Delete</a></td>";
			echo "</tr>";
		}
	}

		echo'</table>';
}

function load_campaign($sql,$conn)
{
	echo '<table class="table table-striped">
				<tr>
				<th>S.No.</th>
				<th>Campaign Name</th>
				<th>Organizer Name</th>
				<th>Address</th>
				<th>Area</th>
				<th>City</th>
				<th>Contact</th>
				<th>Date</th>
				<th>Time</th>
				<th>Description</th>
				<th>Want to Donate Blood?</th>
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
			echo "<td>".$row['camp_org_name']."</td>";
			echo "<td>".$row['camp_address']."</td>";
			echo "<td>".$row['camp_area']."</td>";
			echo "<td>".$row['camp_city']."</td>";
			echo "<td>".$row['camp_org_number']."</td>";
			echo "<td>".$row['camp_date']."</td>";
			echo "<td>".$row['camp_time']."</td>";
			echo "<td>".$row['camp_desc']."</td>";
			echo "<td><a href='register_campaign.php?id=".$row['id']."' class='btn btn-primary btn-sm' name='register' value=''><i class='fa fa-sign-in' style='color:green'></i> Register</a></td>";
			echo "</tr>";
		}
	}
	echo'</table>';

}
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
	if(mysqli_num_rows($result)>0)
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
