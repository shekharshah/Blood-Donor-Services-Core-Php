<?php
	include("config.php");
	session_start();
	if(!isset($_SESSION['usertype']))
	{
		header("Location:admin.php");
	}

  if(isset($_GET['delete'])){
      $sql = "DELETE FROM `image` WHERE `id`='{$_GET['delete']}'";
      $result=mysqli_query($conn,$sql);
      if(!$result){
          $message = '<div class="alert alert-danger text-center" role="alert">
                      Failed to Delete Image!
                </div>'.msqli_error($conn);
      }
      else{
          $message = '<div class="alert alert-success text-center role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    Image Deleted.
                </div>';
      }
  }

	$sql="SELECT * FROM `image`";
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

	$sql="SELECT * FROM `image` ORDER BY `id` $limit";

	//$textline1="Total Users : $rows";
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

	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	$list='';
	$result = mysqli_query($conn,$sql);
	if(mysqli_num_rows($result) > 0)
	{
		$list.= "<table class='table table-striped'>";
		$list.= "<tr>
							<th>ID</th>
							<th>Image</th>
							<th>Image Name</th>
							<th>Image Location</th>
							<th>Delete</th>
						</tr>";
		$i=0;
		$n=0;
		while ($row = mysqli_fetch_assoc($result)) {
			$i++;
			$n++;
			$list.= "<tr>";
			$list.= "<td>".$n."</td>";
			$list.= "<td><img src=".$row["IMAGE"]." class='image-rounded' height='30px' width='60px'></td>";
			$list.= "<td>".$row['IMAGE_NAME']."</td>";
			$list.= "<td>".$row['IMAGE']."</td>";
			$list.= "<td><a href='admin_view_image.php?delete=".$row['ID']."' class='btn btn-danger'><i class='fa fa-trash fa-lg'></i></a></td>";
			$list.= "</tr>";
		}
		$list.= "</table>";
	}

?>
<!DOCTYPE html>
<html lang="en">
<?php include"head.php";?>
<body>

<?php
	 include"admin_topnav.php";
?>
    <!-- Page Content -->

<div class="container" style='margin-top:30px'>
	<h3 class="text-primary">
	<center><i class='fa fa-image'></i> Images</center></h3>
	<hr>
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<a href="admin_add_image.php" class="btn btn-success"><i class="fa fa-plus"></i> Add Image</a>

			<center>
			<!--<p class="btn btn-danger"><?php echo "<b>".$textline1."</b>"; ?></p>-->
			<p><?php echo $textline2; ?></p>
			<?php
				echo $list;
				echo $paginationctrls;
		  	if(isset($message))
				{
		      echo $message;
		    }
		  ?></center>
		</div>
	</div>
</div>


<?php include("admin_footer.php"); ?>
<!-- jQuery -->
<script src="js/jquery.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>
