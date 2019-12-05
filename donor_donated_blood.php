<?php
  include 'config.php';
  session_start();
  if(!isset($_SESSION['NAME']))
  {
    header("location:login.php");
  }

?>
<!DOCTYPE html>

<html lang="en">
<head>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <?php include("head.php"); ?>
  <style>
    .hover{
      background-color: lightgrey;
      color: black;
    }
    #sender_name{
      color: red;
    }
    .tabshover{
      border-color: black;
      font-weight: bold;
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


    <div class="col-sm-9">
      <h3 class="text-primary"><i class="fa fa-check-circle" style="color:#8617d1;"></i> Donated Status
      </h3><hr>

      <div class="w3-bar pull">
        <button class="btn btn btn-md tablink button w3-black" onclick="openCity(event,'Completed')"><i class="fa fa-check-circle" style="color:green"></i> Completed</button>
        <button class="btn btn btn-md tablink button" onclick="openCity(event,'NotCompleted')"><i class="fa fa-times-circle" style="color:#3366ff"></i> Not Completed</button>
        <button class="btn btn btn-md tablink button" onclick="openCity(event,'Pending')"><i class="fa fa-clock" style="color:red"></i> Pending</button>
      </div><br>

      <div id="Completed" class="w3-container tabs">
        <?php
          $user = $_SESSION['NAME'];
          $sql="SELECT t1.*,t2.donor_id FROM `request_blood` AS t1 LEFT JOIN `blood_donor_register` AS t2 ON t1.form_id = t2.donor_id WHERE t1.task_status=2 AND t2.donor_name='$user' ORDER BY t1.LOGS DESC";
          $result=mysqli_query($conn,$sql);
          if(mysqli_num_rows($result)>0)
          {

            echo '<ul class="list-group">';
              while($row=mysqli_fetch_assoc($result))
              {

                  echo '<li class="list-group-item">
                          <span>
                            <b><i class="fa fa-envelope-square"></i> <u>'.$row["NAME"].'</u></b>: '.substr($row["REASON"],0,50).'....
                          </span>
                          <span class="pull-right">
                            <i><b>'.$row['LOGS'].'</b></i>&nbsp;
                            <a href="view_request_blood_details.php?id='.$row['id'].'" class="btn btn-primary btn-xs">View</a>
                          </span>
                        </li>';
                echo"<br>";
              }
            echo'</ul>';
          }
          else
          {
            echo "<div class='alert alert-info mess'>No More Completed Tasks</div>";
          }
        ?>
      </div>

      <div id="NotCompleted" class="w3-container tabs" style="display:none">
        <?php
          $user = $_SESSION['NAME'];
          $sql="SELECT t1.*,t2.donor_id FROM `request_blood` AS t1 LEFT JOIN `blood_donor_register` AS t2 ON t1.form_id = t2.donor_id WHERE t1.task_status=1 AND t2.donor_name='$user' ORDER BY t1.LOGS DESC";
          $result=mysqli_query($conn,$sql);
          if(mysqli_num_rows($result)>0)
          {

            echo '<ul class="list-group">';
              while($row=mysqli_fetch_assoc($result))
              {
                  echo '<li class="list-group-item">
                          <span>
                            <b><i class="fa fa-envelope-square"></i> <u>'.$row["NAME"].'</u></b>: '.substr($row["REASON"],0,50).'....
                          </span>
                          <span class="pull-right">
                            <i><b>'.$row['LOGS'].'</b></i>&nbsp;
                            <a href="view_request_blood_details.php?id='.$row['id'].'" class="btn btn-primary btn-xs">View</a>
                          </span>
                        </li>';

                echo"<br>";
              }
            echo'</ul>';
          }
          else
          {
            echo "<div class='alert alert-info mess'>No More Incomplete Tasks</div>";
          }
        ?>
      </div>

      <div id="Pending" class="w3-container tabs" style="display:none">
        <?php
          $user = $_SESSION['NAME'];
          $sql="SELECT t1.*,t2.donor_id FROM `request_blood` AS t1 LEFT JOIN `blood_donor_register` AS t2 ON t1.form_id = t2.donor_id WHERE t1.task_status=0 AND t2.donor_name='$user' ORDER BY t1.LOGS DESC";
          $result=mysqli_query($conn,$sql);
          if(mysqli_num_rows($result)>0)
          {

            echo '<ul class="list-group">';
            while($row=mysqli_fetch_assoc($result))
            {
                echo '<li class="list-group-item">
                        <span>
                          <b><i class="fa fa-envelope-square"></i> <u>'.$row["NAME"].'</u></b>: '.substr($row["REASON"],0,50).'....
                        </span>
                        <span class="pull-right">
                          <i><b>'.$row['LOGS'].'</b></i>&nbsp;
                          <a href="view_request_blood_details.php?id='.$row['id'].'" class="btn btn-primary btn-xs">View</a>
                        </span>
                      </li>';
              echo"<br>";
            }
            echo'</ul>';
          }
          else
          {
            echo "<div class='alert alert-info mess'>No More Pending Tasks</div>";
          }
        ?>
      </div>
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

  function openCity(evt, cityName) {
    var i, x, tablinks;
    x = document.getElementsByClassName("tabs");
    for (i = 0; i < x.length; i++) {
      x[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < x.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" w3-black", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " w3-black";

  }
  $(document).ready(function(){
    $(".button").hover(function(){
      $(this).toggleClass("tabshover");
    });
  });
</script>
</body>
</html>
