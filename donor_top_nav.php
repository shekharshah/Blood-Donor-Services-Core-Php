<!-- Navigation -->
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="donor_request_blood.php">
        <i class="fa fa-heartbeat fa-lg fa-2x" style="color:red;"></i>
        <font size="5px"> Blood Donor Panel</font>
      </a>
    </div>
<!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="" title="Click here to View your Profile"><i class="fa fa-user"></i> Welcome <?php echo $_SESSION['NAME']; ?></a></li>
        <li><a href="donor_request_blood.php" title="Click here to go to Dashboard"><i class="fa fa-tachometer-alt"></i> Dashboard</a></li>
        <li><a href="logout.php" title="Click here to Logout"><i class="fa fa-power-off" aria-hidden="true"></i> Logout</a></li>
      </ul>
      <!-- /.navbar-collapse -->
  </div>
    <!-- /.container -->
</nav>
