<footer>
  <div class=" container-fluid">
    <div class="row">
      <div class="col-sm-12">
		    <p align="center">Copyright &copy; Blood Donor Services - Admin Panel By<a href="#"> Shekhar Shah</a></p>
      </div><!-- col-sm-6 -->
    </div><!-- row -->
  </div><!-- content container -->
</footer>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script>
	$(function() {
  	$(".DATES").datepicker({
      dateFormat: "yy-mm-dd",
      changeMonth: true,
      changeYear: true,
      maxDate: 0,
      yearRange: '1900:' + new Date().getFullYear()
    }).val();
  });

  $(function(){
    $(".DATES1").datepicker({
      dateFormat: "yy-mm-dd",
      changeMonth: true,
      changeYear: true,
      minDate: 0,
      yearRange: '2019:' + new Date().getFullYear()
    }).val();
  });

</script>
