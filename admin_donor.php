<?php
session_start();
include("config.php");
include("admin_function.php");
 if(!isset($_SESSION['usertype']))
 {
	 header("location:admin.php");
 }

 if(isset($_GET["id"]))
 {
	 $id=$_GET["id"];
	 $sql="DELETE FROM `blood_donor_register` WHERE `donor_id`=$id";
	 $result=mysqli_query($conn,$sql);
   if(!$result){
       $message = '<div class="alert alert-danger text-center" role="alert">
                   Failed to Delete Donor!
             </div>'.msqli_error($conn);
   }
   else
   {
       $message = '<div class="alert alert-success text-center role="alert">
                 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                 Donor Deleted!
             </div>';
   }
 }


 $sql="SELECT * FROM `blood_donor_register`";
 $result=mysqli_query($conn,$sql);
 $rows=mysqli_num_rows($result);
 $page_rows=5;
 $last=ceil($rows/$page_rows);

 if($last<1)
 {
   $last=1;
 }
 $pagenum=1;
 if(isset($_GET['pn']))
 {
   $pagenum=preg_replace('#[^0-9]#','',$_GET['pn']);
 }

 if($pagenum<1){
   $pagenum=1;
 }
 elseif($pagenum>$last)
 {
   $pagenum=$last;
 }
 $limit='LIMIT '.($pagenum-1)*$page_rows.','.$page_rows;

 $sql="SELECT * FROM `blood_donor_register` ORDER BY `donor_name` $limit";

  $textline1="Total Donors : $rows";
  $textline2="Page  <b>$pagenum</b> Of <b>$last</b>";
  $paginationctrls='<ul class="pagination">';


  if($last!=1)
  {
    if($pagenum>1)
    {
      $previous=$pagenum-1;
      $paginationctrls.=' <li><a href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'">Previous</a></li>';
      for($i=$pagenum-4;$i<$pagenum;$i++)
      {
        if($i>0)
      {
        $paginationctrls.='<li><a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a></li>';
      }
    }
  }


  $paginationctrls.='<li class="active"><a href="#"  >'.$pagenum.'</a></li> ';

  for($i=$pagenum+1;$i<=$last;$i++)
  {
    $paginationctrls.='<li><a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a> </li>';
    if($i>=$pagenum+4)
    {
      break;
    }
  }

  if($pagenum!=$last)
  {
    $next=$pagenum+1;
    $paginationctrls.='<li><a href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'">Next</a></li></ul>';
  }

}
/* for pagination
$list='';
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0)
{
   $list.= '<table class="table table-striped">';
   $list.= "<tr>
			<th>S.No.</th>
			<th>Name</th>
			<th>Gender</th>
			<th>Blood Type</th>
			<th>Weight</th>
			<th>Email ID</th>
			<th>City</th>
			<th>Contact-1</th>
			<th>View</th>
			</tr>";

    $n=0;
    while($row=mysqli_fetch_assoc($result))
    {
       $n++;
       $list.="<tr>";
       $list.="<td>$n</td>";
       $list.="<td>".$row['donor_name']."</td>";
       $list.="<td>".$row['gender']."</td>";
       $list.="<td>".$row['blood_type']."</td>";
       $list.="<td>".$row['body_weight']."</td>";
       $list.="<td>".$row['email_id']."</td>";
       $list.="<td>".$row['city']."</td>";
       $list.="<td>".$row['contact_1']."</td>";
       $list.="<td><a href='admin_view_donor.php?id=".$row['donor_id']."' class='btn btn-primary btn-xs'><i class='fa fa-edit'></i> View</a></td>";
       $list.="</tr>";
    }
    $list.= "</table>";
}*/


?>

<!DOCTYPE html>
<html lang="en">
	<head>
			<?php include("admin_head.php");?>
	</head>
<body>

<?php include("admin_topnav.php"); ?>
<div class="container" style='margin-top:30px'>
	<div class="row">
   <div class="col-sm-3">
			<?php include("admin_side_nav.php");?>
   </div>

   <div class="col-sm-9">
   <h3 class="text-primary"><i class="fa fa-search" style="color:#8617d1"></i> Search Donor Details </h3><hr>

    <div class="row">
  		<div class="col-md-6">
  			<form role="form">
  				<div class="form-group text-primary">
              <input type="text" id="q" class="form-control" placeholder="Search Donor">
            </select>
  				</div>
  			</form>
		  </div>

      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <p class="btn btn-danger"><?php echo "<b>".$textline1."</b>"; ?></p>

  		<div class='col-md-12'>
  			<div class='table-responsive' id="feedback">
    			<?php
    				$sql="SELECT * FROM `blood_donor_register` ORDER BY `donor_name`";
    				load_donor($sql,$conn);
    			?>
  			</div>
        <p><?php echo $textline2; ?></p>
        <?php echo $paginationctrls; ?>
      </div>
    </div>
    <?php
      if(isset($message)){
          echo $message;
      }
    ?>
   </div>
  </div>
</div>


 <?php include("admin_footer.php"); ?>
  <script>
	$(document).ready(function()
	{
		$("#q").keyup(function(){
				var txt=$("#q").val();
				$.post('admin_ser.php',{q:txt},function(data){
					$("#feedback").html(data);
				});

		});

	});
  </script>

	</body>
</html>
