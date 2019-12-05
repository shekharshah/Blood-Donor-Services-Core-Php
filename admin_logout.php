<?php
session_start();
unset($_SESSION["usertype"]);
session_destroy();
echo "<script>window.open('admin.php','_self')</script>";
?>
