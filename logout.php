<?php
session_start();
unset($_SESSION["NAME"]);
session_destroy();
echo "<script>window.open('login.php','_self')</script>";
?>
