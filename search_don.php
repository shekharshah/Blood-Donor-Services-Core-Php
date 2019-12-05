<?php
			include "config.php";

			// echo "hello";exit;
			if(!empty($_POST["BLOOD_TYPE"]))
			{
				$sql="SELECT * FROM `blood_donor_register` WHERE (`blood_type`='{$_POST["BLOOD_TYPE"]}' AND status=1)";
				$result=mysqli_query($conn,$sql);
				if(mysqli_num_rows($result)>0)
				{
					$i=0;
					echo "<h3><i class='fa fa-list-alt'></i> Lists of Available Donors</h3>";
					echo "<div class='table-responsive'><table class='table table-striped'>
								<tr class='text-primary'>
									<th>Sno</th>
									<th>Donor Image</th>
									<th>Name</th>
									<th>Gender</th>
									<th>Blood Group</th>
									<th>Age</th>
									<th>Adderss</th>
									<th>Area</th>
									<th>City</th>
									<th>State</th>
									<th>Mobile No.</th>
									<th>Request for Blood</th>
								</tr>
							";

					while($row=mysqli_fetch_assoc($result))
					{
						if(strtotime($row['last_donate_blood']) < strtotime('-90 day'))
						{
							$i++;
							echo"<tr>";
							echo"<td>$i</td>";
							echo"<td><img src='{$row["donor_pic"]}' class='don_img' height='50px' width='50px'></td>";
							echo "<td>".$row['donor_name']."</td>";
							echo "<td>".$row['gender']."</td>";
							echo "<td>".$row['blood_type']."</td>";
							//for calculating age
							$dateOfBirth = $row['dob'];
							$today = date("Y-m-d");
							$age = date_diff(date_create($dateOfBirth), date_create($today));
							echo '<td>'.$age->format('%y')."</td>";
							echo "<td>".$row['address']."</td>";
							echo "<td>".$row['area']."</td>";
							echo "<td>".$row['city']."</td>";
							echo "<td>".$row['state']."</td>";
							echo "<td>".$row['contact_1']."</td>";

							// if($row['status']==1)
							// {
							// 	echo "<td><a href='#' class='btn btn-success btn-xs'>Available</a></td>";
							// }
							// else {
							// 	echo "<td><a href='#' class='btn btn-danger btn-xs'>Non-Active</a></td>";
							// }
							echo "<td><a href='request_blood.php?donor_id=".$row['donor_id']."' class='btn btn-primary btn-sm'><i class='fa fa-share' style='color:#24b70b'></i> Request</a></td>";
							echo "</tr>";
						}
						else {
							echo "<div class='alert alert-danger'><i class='fa fa-users'></i> Not available for short time</div>";
						}

					}
					echo "</table></div>";
				}
				else
				{
					echo "<div class='alert alert-danger'><i class='fa fa-users'></i> No Donors Found</div>";
				}
			}
			else
			{
				echo "<script>alert('Please Select Blood Group..');</script>";
			}
?>
<div class="modal fade" id="Mymodal" style="padding-top:100px;">
	<center><img src='' id="md_img" height="400px" width=auto></center>
</div>

<script>

	$(document).ready(function(){
		$(".don_img").click(function(){
			var a=$(this).attr("src");
			$("#md_img").attr("src",a);
			$("#Mymodal").modal();
		});
	});
</script>
