<?php
session_start();
include("config.php");
include("admin_function.php");
 if(!isset($_SESSION['usertype']))
 {
	 header("location:admin.php");
 }

if(isset($_GET['delete'])){
    $sql = "DELETE FROM campaign WHERE id='{$_GET['delete']}'";
    $result=mysqli_query($conn,$sql);
    if(!$result){
        $message = '<div class="alert alert-danger text-center" role="alert">
                    Failed to Delete Campaign!
              </div>'.msqli_error($conn);
    }
    else{
        $message = '<div class="alert alert-success text-center role="alert">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  Campaign Deleted!
              </div>';
    }
}

 $sql="SELECT * FROM `campaign`";
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

 $sql="SELECT * FROM `campaign` ORDER BY `camp_date` $limit";

  $textline1="Total Campaigns : $rows";
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
			<h3 class="text-primary"><i class="fa fa-calendar-plus-o" style="color:#08a6e0"></i> Campaigns
      </h3>
      <hr>
  		<div class="row">
    		<div class="col-md-2 text-center" style="padding: 0px 15px;">
          <a href="admin_add_campaign.php" class="btn btn-success btn-md"><i class="fa fa-plus"></i> Add Campaign</a>
    		</div>

    		<div class="col-md-5">
    			<form role="form">
    				<div class="form-group text-primary">
              <input type="text" id="campaign" class="form-control" placeholder="Search Campaign">
    				</div>
    			</form>
    		</div>

        &nbsp;&nbsp;&nbsp;&nbsp;
        <a href="admin_campaign_fulldetails.php" class="btn btn-primary btn-md"><i class="fa fa-expand"></i> View Full Details</a>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <p class="btn btn-danger"><?php echo "<b>".$textline1."</b>"; ?></p>


    		<div class='col-md-12'>
    			<div class='table-responsive' id="feedback">
      			<?php
            
              if(isset($message)){
                  echo $message;
              }
            
      				$sql="SELECT * FROM `campaign` ORDER BY `camp_date`";
      				load_campaign($sql,$conn);
      			?>

            <p><?php echo $textline2; ?></p>
            <?php echo $paginationctrls; ?>
          </div>
            
        </div>
      </div>
    </div>
  </div>
</div>



	 <?php include("admin_footer.php"); ?>
  <script>
	$(document).ready(function()
	{
		$("#campaign").keyup(function(){
				var txt=$("#campaign").val();
				$.post('admin_ser.php',{c:txt},function(data){
					$("#feedback").html(data);
				});
		});
	});

  </script>

	</body>
</html>
