<html>
<body>
<?php
	session_start();
	include 'config.php';
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	if(isset($_POST['submit']))
	{
		$user = $_POST['user'];
		$email = $_POST['email'];
		$pass = md5($_POST['pass']);
		$repass = md5($_POST['confirm_password']);
		$mobno = $_POST['mobno'];

		$insert = "INSERT INTO `signup`(`user_name`, `email_id`, `password`, `confirm_pass`, `mob_no`) VALUES ('$user','$email','$pass','$repass','$mobno')";

		if(mysqli_query($conn,$insert)){
			header('Location:login.php');
		}
		else
		{
			 //header('Location:user_signup.php');
			echo "fail";
			//echo "<script>window.location='user_signup.php';</script>"
		}
	}
?>
</body>
</html>
