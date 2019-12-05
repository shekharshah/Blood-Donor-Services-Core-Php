<?php
session_start();
include("config.php");
include("admin_function.php");
 if(!isset($_SESSION['usertype']))
 {
	 header("location:admin.php");
 }

 $sql="SELECT * FROM area";
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

  $sql="Select area.AREA_ID, area.AREA_NAME,city.CITY_NAME, state.STATE_NAME,country.COUNTRY_NAME
  From country,state,city Inner Join
  area On area.CITY_ID = city.CITY_ID ORDER BY area.AREA_NAME $limit";

  $textline1="<br>Total Areas : $rows";
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


  $list='';
  $result=mysqli_query($conn,$sql);
  if(mysqli_num_rows($result)>0)
  {
  		$list.= "<table class='table table-striped' >";
  			$list.= "<tr>
  					<th>Sno</th>
            <th>Area Name</th>
  					<th>City Name</th>
            <th>State Name</th>
            <th>Country Name</th>
  					<th>Delete</th>
  				</tr>";
  				$i=0;
  				while($row=mysqli_fetch_assoc($result))
  				{
  					$i++;
  					$list.="<tr>";
  						$list.= "<td>$i</td>";
              $list.= "<td>".$row["AREA_NAME"]."</td>";
  						$list.= "<td>".$row["CITY_NAME"]."</td>";
              $list.= "<td>".$row["STATE_NAME"]."</td>";
              $list.= "<td>".$row["COUNTRY_NAME"]."</td>";
  						$list.= "<td><a href='admin_del_area.php?id=".$row["AREA_ID"]."' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i></a></td>";
  					$list.="</tr>";
  				}
  		$list.= "</table>";
  }
?>
<!DOCTYPE html>
<html lang="en">
	<head>
			<?php include("admin_head.php");?>
	</head>
	<body>

<?php include("admin_topnav.php"); ?>
<div class="container">
	<div class="row">
		<div class="col-sm-3">
			<?php include("admin_side_nav.php");?>
		</div>
		<div class="col-sm-9" >
			<h3><i class="fa fa-bank"></i> View Area Details </h3><hr>

				<div class="col-md-12">
          <a href="admin_area.php" class="btn btn-primary btn-sm"><i class="fa fa-arrow-circle-left fa-lg" aria-hidden="true"></i> Back to Previous Page</a>
		      <p><?php echo $textline1; ?></p>
  				<p><?php echo $textline2; ?></p>
  				<?php
            echo $list;
  				  echo $paginationctrls;
          ?>
				</div>
			</div>


		</div>
	</div>
</div>


	 <?php include("admin_footer.php"); ?>

	</body>
</html>
