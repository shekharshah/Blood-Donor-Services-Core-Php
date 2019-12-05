<?php
  session_start();
  include("config.php");
  if(!isset($_SESSION['usertype']))
  {
   header("location:admin.php");
  }
  $id=$_POST["id"];
  $ldate=$_POST["last_donate_date"];
  echo $sql="UPDATE `blood_donor_register` SET last_donate_date='$ldate' WHERE `donor_id`='$id'";
  mysqli_query($conn,$sql);
  header("location:admin_view_donor.php?id=$id");
?>
