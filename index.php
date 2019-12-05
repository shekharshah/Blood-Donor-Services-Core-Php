<?php
  include "config.php";
  include "head.php";
  include "top_nav.php";
?>
<!DOCTYPE html>
<html lang="en">
<?php include"head.php";?>
<head>
  <script src="js/w3slider.js"></script>
  <style>
    #camp_msg{
      background-color: gold;
    }
  </style>
</head>
<body bgcolor="#000000">
  <!-- Header Carousel -->
  <header id="myCarousel" class="carousel slide">
      <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
      <li data-target="#myCarousel" data-slide-to="3"></li>
      <li data-target="#myCarousel" data-slide-to="4"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
  		<div class="item active">
        <div class="fill" style="background-image:url('images/blood8.jpeg');"></div>
        <div class="carousel-caption"></div>
  		</div>

  		<div class="item">
        <div class="fill" style="background-image:url('images/s3.jpg');"></div>
        <div class="carousel-caption"></div>
  		</div>

  		<div class="item">
        <div class="fill" style="background-image:url('images/blood2.jpg');"></div>
        <div class="carousel-caption"></div>
  		</div>

  		<div class="item">
        <div class="fill" style="background-image:url('images/blood3.png');"></div>
        <div class="carousel-caption"></div>
  		</div>

  		<div class="item">
        <div class="fill" style="background-image:url('images/blood5.jpg');"></div>
        <div class="carousel-caption"></div>
  		</div>
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="icon-prev"></span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="icon-next"></span>
    </a>
  </header>

<div id="camp_msg">
  <marquee><p><u>Hurry Up!!</u> Registration for<b> Khoon Doo!!!</b> Blood Campaign is closing down. Last day to Register. <a href="register_campaign.php?id=27">Click here</a> and participate for campaign before it closes.<p></marquee>
</div>
  <!-- Page Content -->
<div class="container">
  <!-- Features Section -->
  <div class="row">
    <div class="col-lg-12">
      <h2 class="page-header  text-primary">Welcome to Blood Donor Services</h2>
    </div>
    <div class="col-md-6">
      <ul>
        <li>Giving blood saves lives. The blood you give is a lifeline in an emergency and for people who need long-term treatments.</li>
        <li>Many people would not be alive today if donors had not generously given their blood.</li>
        <li>We need over 6,000 blood donations every day to treat patients in need across india. Which is why there’s always a need for people to give blood.</li>
        <li>Each year we need approximately 200,000 new donors, as some donors can no longer give blood.</li>
        <li>Most people between the ages of 17-65 are donate blood.</li>
        <li>Around half our current donors are over 45. That's why we need more young people (over the age of 17) to start giving blood, so we can make sure we have enough blood donors in the future.</li>
      </ul>
    </div>
    <div class="col-md-6">
      <?php 
        $sql = "SELECT * FROM `image` WHERE `id`>'2'";
        if(!mysqli_query($conn,$sql))
        {
          echo "Error".mysqli_error($conn);
        }
        else
        {
          $result=mysqli_query($conn,$sql);
          while($row=mysqli_fetch_assoc($result))
          {
      ?>
      <img class="img-responsive" src="<?php echo $row['IMAGE']; ?>"/>
      <?php
          }
        }
      ?>
    </div>
</div>
<hr>
<!-- Footer -->
<?php include"footer.php"; ?>

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Script to Activate the Carousel -->
<script>
  w3.slideshow(".img-responsive", 3000);

  function blink_text() {
    $('.blink').fadeOut(500);
    $('.blink').fadeIn(500);
  }
  setInterval(blink_text, 1000);

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
