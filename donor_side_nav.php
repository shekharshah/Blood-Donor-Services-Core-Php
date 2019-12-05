<?php

	$user=$_SESSION["NAME"];
	// $sql="SELECT * FROM `request_blood` WHERE `status`=1";
	$sql="SELECT t1.*,t2.donor_id FROM `request_blood` AS t1 LEFT JOIN `blood_donor_register` AS t2 ON t1.form_id = t2.donor_id WHERE t2.donor_name='$user' AND t1.status=1";
	$result=mysqli_query($conn,$sql);
	$n=mysqli_num_rows($result);
	if($n!=0)
	{
		$mes='<span class="badge pull-right">'.$n.' Unread</span>';
	}
	else
	{
		$mes="";
	}
?>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
<h3 class="text-primary"><i class="glyphicon glyphicon-dashboard"></i> Dashboard</h3>
<hr>
<ul class="nav nav-stacked">
	<li><a href="donor_request_blood.php"><i class="fa fa-ambulance fa-lg" style="color:#f90010"></i> Blood Requests <?php echo $mes;?> </a></li>
	<li><a href="donor_profile.php"><i class="fa fa-address-card fa-lg" style="color:#24b70b;"></i> Profile</a></li>
	<li><a href="donor_change_password.php"><i class="fa fa-key" style="color:#edc225;"></i> Change Password</a></li>
	<li><a href="donor_donated_blood.php"><i class="fa fa-check-circle" style="color:#8617d1;"></i> Donated Status</a></li>
</ul>
<hr>
