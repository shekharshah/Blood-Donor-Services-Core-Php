<html>
<body>
<?php
	include 'config.php';
	include 'head.php';
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	session_start();



	if(isset($_POST['submit']))
	{

		$email = $_POST['email'];
		$pass = $_POST['pass'];
		$insert = mysqli_query($conn,"SELECT * FROM `signup` WHERE `email_id`='$email' AND `password`='$pass'");
		$num = mysqli_num_rows($insert);

		if($num==0)
		{
				echo "<script>alert('Error :: User Name and Password Incorrect.');window.location='login.php';</script>";

		}
		else
		{
				$_SESSION['email'] = $email;
				header('Location:mainpage.php');
		}
	}
	?>
</body>
</html>
