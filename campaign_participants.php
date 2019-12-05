<?php
session_start();
include("config.php");
include("admin_function.php");
 if(!isset($_SESSION['usertype']))
 {
	 header("location:admin.php");
 }
if(isset($_GET['delete'])){
    $sql = "DELETE FROM `participants` WHERE `id`='{$_GET['delete']}'";
    $result=mysqli_query($conn,$sql);
    if(!$result)
    {
        $message = '<div class="alert alert-danger text-center" role="alert">
                    Failed to Delete Participant!
                </div>';
    }
    else
    {
        $message = '<div class="alert alert-success text-center role="alert">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  Registered Participant for Blood Campaign Deleted!
                </div>';
    }
}


$sql="SELECT * FROM `participants`";
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

 $sql="SELECT t1.*,t2.camp_name FROM `participants` AS t1 LEFT JOIN `campaign` AS t2 ON t1.form_id = t2.id ORDER BY t1.id DESC $limit";

$textline1="Total Registration : $rows";
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


  $paginationctrls.='<li class="active" 	><a href="#"  >'.$pagenum.'</a></li> ';

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
		<div class="col-sm-9" >
			<h3 class="text-primary"><i class="fa fa-users fa-lg" style="color:#24b70b"></i> Campaign Participants </h3><hr>
		<div class="row">
		<div class="col-md-6">
			<form  name="frm" id="frm">
				<div class="form-group text-primary">
          <select id="blood" name="blood_campaign" required class="form-control">

            <option value="">Select Campaign</option>

            <?php
              $sql = "SELECT DISTINCT `camp_name` FROM `campaign`";
              if(!mysqli_query($conn,$sql))
              {
                echo "Error".mysqli_error($con);
              }
              else
              {
                $result=mysqli_query($conn,$sql);
                while($row=mysqli_fetch_assoc($result))
                {
                  echo '<option value="'.$row['camp_name'].'">'.$row['camp_name'].'</option>';
                }
              }
            ?>
          </select>
				</div>
	    </div>
      <button class="btn btn-success" name="Search" id="Search">Search</button>
    </form>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a href='campaign_participants_fulldetails.php' class='btn btn-primary'><i class="fa fa-expand" aria-hidden="true"></i> View Full Details</a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <p class="btn btn-danger"><?php echo "<b>".$textline1."</b>"; ?></p>
    <div class='col-md-12'>
      <?php
        if(isset($message))
        {
          echo $message;
        }
      ?>
			<div class='table-responsive'>

  			<?php
  			   $sql="SELECT t1.*,t2.camp_name FROM `participants` AS t1 LEFT JOIN `campaign` AS t2 ON t1.form_id = t2.id ORDER BY t1.id DESC";
			     load_participants($sql,$conn);
  			?>

        <p><?php echo $textline2; ?></p>
        <?php echo $paginationctrls; ?>
      </div>
        
	    </div>

  </div>
</div>



	 <?php include("admin_footer.php"); ?>
  <script>
	$(document).ready(function(){
		$("#campaign").keyup(function(){
			var txt=$("#campaign").val();
			$.post('admin_ser.php',{c:txt},function(data){
				$("#feedback").html(data);
			});
		});

 		$(document).on('click','#Search',function(){
 			console.log("click");

 			$.ajax({
 				url:"search_don.php",
 				method:"POST",
 				data:$("#frm").serialize(),
 				success:function(data)
 				{
 					console.log("click2");

 					$("#feedback").html(data);
 				}
 			});
 		});
 	});
  </script>

	</body>
</html>
