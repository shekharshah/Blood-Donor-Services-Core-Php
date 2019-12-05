<?php
  include 'config.php';
  session_start();
  if(!isset($_SESSION['NAME']))
  {
    header("location:login.php");
  }
  $user=$_SESSION['NAME'];
  $sql="SELECT t1.*,t2.donor_id FROM `request_blood` AS t1 LEFT JOIN `blood_donor_register` AS t2 ON t1.form_id = t2.donor_id WHERE donor_name='$user' ORDER BY t1.LOGS DESC";
  $result=mysqli_query($conn,$sql);
  $rows=mysqli_num_rows($result);
  $textline="Total Blood Requests : $rows";
?>
<!DOCTYPE html>

<html lang="en">
<head>
  <?php include("head.php"); ?>
  <style>
    .hover{
      background-color: lightgrey;
      color: black;
    }
    #req_date{
      color: red;
    }
  </style>
</head>
<body bgcolor="#000000">


<?php include"donor_top_nav.php";?>
<div class="container" style='margin-top:30px;'>
  <div class="row">
    <div class="col-sm-3">
      <?php include("donor_side_nav.php");?>
    </div>
    <div class="col-sm-9" >
      <h3 class="text-primary"><i class="fa fa-ambulance" style="color:#f90010"></i> Blood Requests

        <p class="btn btn-danger pull-right"><?php echo "<b>".$textline."</b>"; ?></p>
      </h3><hr>
      <?php
        $user = $_SESSION['NAME'];
        $sql="SELECT t1.*,t2.donor_id FROM `request_blood` AS t1 LEFT JOIN `blood_donor_register` AS t2 ON t1.form_id = t2.donor_id WHERE t2.donor_name='$user' ORDER BY t1.LOGS DESC";
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)>0)
        {

          echo '<ul class="list-group">';
            while($row=mysqli_fetch_assoc($result))
            {
              if($row['status']=='1')
              {
                echo $row["REQ_DATE"];
                echo '<li class="list-group-item active">
                        <span>
                          <b><i class="fa fa-envelope-square"></i> <u>'.$row["NAME"].'</u></b>: '.substr($row["REASON"],0,50).'....
                        </span>
                        <span class="pull-right">
                          <i><b>'.$row['LOGS'].'</b></i>&nbsp;
                          <a href="view_request_blood_details.php?id='.$row['id'].'" class="btn btn-primary  btn-xs">View</a>
                        </span>
                      </li>';
              }
              else
              {
                echo '<b>Required Date: </b><b id="req_date">'.$row["REQ_DATE"].'</b>';
                echo '<li class="list-group-item">
                        <span>
                          <b><i class="fa fa-envelope-square"></i> <u>'.$row["NAME"].'</u></b>: '.substr($row["REASON"],0,50).'....
                        </span>
                        <span class="pull-right">
                          <i><b>'.$row['LOGS'].'</b></i>&nbsp;
                          <a href="view_request_blood_details.php?id='.$row['id'].'" class="btn btn-primary btn-xs">View</a>
                        </span>
                      </li>';
              }
              echo"<br>";
            }
          echo'</ul>';
        }
        else
        {
          echo "<div class='alert alert-info mess'>No More Messages</div>";
        }
      ?>

    </div>
  </div>
</div>
<br><br><br><br><br><br><br><br><br><br>
<!-- Footer -->
<?php include"footer.php"; ?>
<script>
  $(document).ready(function(){
    $(".list-group-item").hover(function(){
      $(this).toggleClass("hover");
    });
  });
</script>
</body>
</html>
