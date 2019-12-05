<?php
	// session_start();
	// if(!isset($_SESSION['username']))
	// {
	// 	header("location:login.php");
	// }
	include "config.php";
?>
<!DOCTYPE html>
<html lang="en">
<?php include"head.php";?>

<body>

<?php
	 include"top_nav.php";
?>

<!-- Page Content -->
<div class="container" style="margin-top:30px;">
	<div class="row">
		<div class="col-md-8">
			<?php
				if(isset($_POST["submit"]))
				{
					error_reporting(E_ALL);
					ini_set('display_errors', 1);
					$name=$_POST['name'];
					$contact=$_POST['phone'];
					$email=$_POST['email'];
					$msg=$_POST['message'];

					$sql="INSERT INTO `messages` (`NAME`, `CONTACT`, `EMAIL`, `MESSAGE`, `Status`, `LOGS`) VALUES ('$name', '$contact', '$email', '$msg', 1, CURTIME());";
					if(mysqli_query($conn,$sql))
					{
						echo '<div class="alert alert-success">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>Success!</strong> Your message has been Successfully sent.
						</div>';
					}
					else {
						echo '<div class="alert alert-danger">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>Error!</strong> Email ID already exists.
						</div>';
					}
				}
			?>

			<h3 class='text-primary'><u>Send us a Message</u>:</h3>
        <form method="post" action="contact.php" role="form">
            <div class="control-group form-group">
                <div class="controls">
										<label for="user_name" class="text-primary">Full Name:</label>
									  <input class="form-control" placeholder="Eg.: Shekhar Shah" name="name" id="name" type="text" required pattern="[A-Za-z]{3,20}\s[A-z]{3,20}" title="Please enter Valid Name atleast 3 Characters are required & only Characters are allowed"/>
										<!-- <p class="help-block"></p> -->
                </div>
            </div>
            <div class="control-group form-group">
                <div class="controls">
										<label class="control-label text-primary" for="phone" >Phone Number:</label>
										<input type="text" required pattern="[6789][0-9]{9}" name="phone" id="phone" class="form-control" placeholder="Eg: 9898250520">
                </div>
            </div>
            <div class="control-group form-group">
                <div class="controls">
										<label for="email" class="text-primary">EmaiID</label>
										<input class="form-control" placeholder="Eg.: shahshekhar@yahoo.com" id="email" name="email" type="email" value="" required pattern="[a-zA-Z0-9.-_]{1,}@[a-zA-Z.-]{2,}[.]{1}[a-zA-Z]{2,}" title="Please Enter Valid EmailID"/>
                </div>
            </div>
            <div class="control-group form-group">
                <div class="controls">
                    <label>Message:</label>
                    <textarea rows="5" cols="100" class="form-control" name="message" required maxlength="999" style="resize:none"></textarea>
                    <span class="pull-right">&nbsp;Character(s) Remaining</span>
					<span id="rchars" class="pull-right">999</span>
                </div>
            </div>
            <div id="success"></div>
            <!-- For success/fail messages -->
            <button type="submit" class="btn btn-primary" name="submit"><i class='fa fa-send'></i> Send Message</button>
        </form>
			</div>

		  <div class="col-md-4 pull-right">
      	<h3 class='text-primary'><u>Contact Details</u></h3>
	      <p>
	        <b>Blood Donor Services</b><br>
							101-Abhishree Adroit, <br>
							Near Swaminarayan Temple, <br>
							Mansi Cross Road,<br>
							Vastrapur,<br>
							Ahmedabad - 380015<br>
	      </p>
	      <p><i class="fa fa-phone"></i>
	          <abbr title="Phone">Phone</abbr>: 9878685848</p>
	      <p><i class="fa fa-envelope-o"></i>
	          <abbr title="Email">Email</abbr>: <a href="#" >bloodbank@gmail.com</a>
	      </p>
	      <p><i class="fa fa-clock-o"></i>
	          <abbr title="Hours">Open Hours</abbr>: 24*7</p>
						<p><i class="fa fa-globe"></i>
	          <abbr title="Website">Website</abbr>: <a href="index.php">www.bloodbank.com</a></p>

				<ul class="list-unstyled list-inline list-social-icons">
	          <li>
	              <a href="#"><i class="fa fa-facebook-square fa-3x" style="color:#0656ce"></i></a>
	          </li>
	          <li>
	              <a href="#"><i class="fa fa-linkedin-square fa-3x" style="color:#0077B5"></i></a>
	          </li>
	          <li>
	              <a href="#"><i class="fa fa-twitter-square fa-3x" style="color:#1DA1F2"></i></a>
	          </li>
	          <li>
	              <a href="#"><i class="fa fa-google-plus-square fa-3x" style="color:#DD4B39"></i></a>
	          </li>
	      </ul>
		  </div>
		</div>
		<hr>
	<?php include"footer.php"; ?>
</div>
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
		<script>
			$(document).ready(function(){
				$('#phone').keyup(function () {
					this.value = this.value.replace(/[^0-9\.]/g,'');
				});
			});

			var maxLength = 999;
			$('textarea').keyup(function() {
			  var textlen = maxLength - $(this).val().length;
			  $('#rchars').text(textlen);
			});
		</script>
</body>

</html>
