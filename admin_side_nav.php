<?php
	$sql="SELECT * FROM messages WHERE STATUS=1";
	$result=mysqli_query($conn,$sql);
	$n=mysqli_num_rows($result);

	$count_messages="SELECT * FROM messages";
	$result1=mysqli_query($conn,$count_messages);
	$n2=mysqli_num_rows($result1);

	if($n!=0)
	{
		$mes='<span class="badge">'.$n2.'</span><span class="badge pull-right">'.$n.' Unread</span>';
	}
	else
	{
		$mes='<span class="badge">'.$n2.'</span>';
	}
?>
<h3 class="text-primary"><i class="glyphicon glyphicon-dashboard"></i> Dashboard</h3>
<hr>

<ul class="nav nav-stacked">
	<li><a href="admin_inbox.php"><i class="fa fa-envelope fa-lg" style="color:#edc225;"></i> Inbox <?php echo $mes;?></a></li>
	<li><a href="admin_campaign.php"><i class="fa fa-calendar-plus-o fa-lg" style="color:#08a6e0"></i> Campaign</a></li>
	<li><a href="campaign_participants.php"><i class="fa fa-users fa-lg" style="color:#24b70b"></i> Campaign Participants</a></li>
	<li><a href="admin_donor.php"><i class="fa fa-search fa-lg" style="color:#8617d1"></i> Search Donors</a></li>
	<li><a href="admin_active_donor.php"><i class="fa fa-child fa-lg text-success"></i><i class="fa fa-child fa-lg text-success"></i> Active Donors</a></li>
	<li><a href="admin_nonactive_donor.php"><i class="fa fa-child fa-lg text-danger"></i><i class="fa fa-child fa-lg text-danger"></i> Non Active Donors</a></li>
	<li><a href="admin_need_blood.php"><i class="fa fa-bed fa-lg" style="color:#f90010"></i> Need Blood</a></li>
	<hr>
	<li><a href="#add" data-toggle="collapse"><i class="fa fa-cogs fa-lg"></i> Settings</a></li>
	<ul class="nav collapse" id="add">
		<li><a href="admin_country.php"><i class="fa fa-plus fa-lg" style="color:#f90010"></i> Add Country</a></li>
		<li><a href="admin_state.php"><i class="fa fa-plus fa-lg" style="color:#24b70b"></i> Add State</a></li>
		<li><a href="admin_city.php"><i class="fa fa-plus fa-lg" style="color:#8617d1"></i> Add City</a></li>
		<li><a href="admin_area.php"><i class="fa fa-plus fa-lg" style="color:#08a6e0"></i> Add Area</a></li>
	</ul>
</ul>
<hr>
