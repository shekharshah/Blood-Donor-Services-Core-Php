<?php
session_start();
include("config.php");
include("admin_function.php");
 if(!isset($_SESSION['usertype']))
 {
	 header("location:admin.php");
 }
 $sql="SELECT * FROM `blood_donor_register` WHERE `status`=1";
 $result=mysqli_query($conn,$sql);
 $rows=mysqli_num_rows($result);
 $textline1="Total Active Donors : $rows";
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
      <h3><i class="fa fa-child fa-lg text-success"></i><i class="fa fa-child fa-lg text-success"></i> Active Donor Details
        <p class="btn btn-danger pull-right"><?php echo "<b>".$textline1."</b>"; ?></p>
      </h3><hr>
      <div class="row">
        <div class='col-md-12'>
          <div class='table-responsive' id="feedback">
            <?php
              $sql="SELECT * FROM `blood_donor_register` WHERE `status`=1";
              load_donor($sql,$conn);
            ?>
          <div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include("admin_footer.php"); ?>

</body>
</html>
