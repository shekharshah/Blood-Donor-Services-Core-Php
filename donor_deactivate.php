<?php
  session_start();
  include("config.php");
  if(!isset($_SESSION['NAME']))
  {
    header("location:login.php");
  }

  if(isset($_GET["id"])&&!empty($_GET["id"]))
  {
    $sql="UPDATE `blood_donor_register` SET `status`=0 WHERE `donor_id`=".$_GET["id"];
    mysqli_query($conn,$sql);
    header("location:donor_profile.php?id={$_GET["id"]}");
  }
  else
  {
    header("location:donor_profile.php");
  }

?>
