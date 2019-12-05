<!DOCTYPE html>

<html lang="en">
<?php
  include 'config.php';
  include("admin_head.php");
  include("admin_function.php");
  session_start();
  if(!isset($_SESSION['usertype']))
  {
    header("location:admin.php");
  }
  include"head.php";
  $sql="SELECT * FROM `request_blood`";
  $result=mysqli_query($conn,$sql);
  $rows=mysqli_num_rows($result);
  $textline1="Total Blood Requests : $rows";
?>
<body bgcolor="#000000">


<?php include"admin_topnav.php";?>
<div class="container" style='margin-top:30px;'>
  <div class="row">
    <div class="col-sm-3">
      <?php include("admin_side_nav.php");?>
    </div>
    <div class="col-sm-9" >
      <h3 class="text-primary"><i class="fa fa-bed" style="color:#f90010"></i> Need Blood

        <p class="btn btn-danger pull-right"><?php echo "<b>".$textline1."</b>"; ?></p>
      </h3><hr>
      <div class="row">
  		<div class="col-md-6">
  			<form role="form">
  				<div class="form-group text-primary">
            <select id="blood" name="blood_campaign" required class="form-control">

              <option value="">Select Blood Type</option>

              <?php
                $sql = "SELECT DISTINCT `blood_type` FROM `request_blood`";
                if(!mysqli_query($conn,$sql))
                {
                  echo "Error".mysqli_error($con);
                }
                else
                {
                  $result=mysqli_query($conn,$sql);
                  while($row=mysqli_fetch_assoc($result))
                  {
                    echo '<option value="'.$row['blood_type'].'">'.$row['blood_type'].'</option>';
                  }
                }
              ?>
            </select>
  				</div>
  			</form>
  		</div>
      <button class="btn btn-success" name="Search" id="Search">Search</button>
      <div class='col-md-12'>
  			<div class='table-responsive'>
          <?php
            $sql='SELECT t1.*,t2.donor_id,t2.donor_name FROM `request_blood` AS t1 LEFT JOIN `blood_donor_register` AS t2 ON t1.form_id = t2.donor_id ORDER BY t1.REQ_DATE DESC, t1.REQ_TIME DESC';
            load_patient($sql,$conn);
          ?>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<hr>

<!-- Footer -->
<?php include"footer.php"; ?>

</div>
<!-- /.container -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Script to Activate the Carousel -->
<script>
  $('.carousel').carousel({
    interval: 5000 //changes the speed
  })

  $(".img-portfolio").click(function(){
    var a=$(this).attr("src");
    $("#ModalImg").attr("src",a);
    $('#myModal').modal();
  });
</script>

</body>

</html>
