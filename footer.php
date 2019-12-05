<footer>
	<p class='text-center'>Copyright &copy; Blood Donor Services By<a href="#"> Shekhar Shah</a></p>
</footer>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script>
	$(document).ready(function()
	{
		$(".DATES").datepicker({
			"dateFormat": "yy-mm-dd",
			"changeMonth": true,
			"changeYear": true,
			"maxDate": new Date(2001,12,31),
			"yearRange": '1960:'
	 	}).val();

		$(".DATES1").datepicker({
	    "dateFormat": "yy-mm-dd",
	    "changeMonth": false,
	    "changeYear": false,
	    "minDate": 0,
	    "yearRange": '2019:' + new Date().getFullYear()
		}).val();

		$(".DATES2").datepicker({
	    "dateFormat": "yy-mm-dd",
	    "changeMonth": true,
	    "changeYear": true,
	    "maxDate": 0,
	    "yearRange": '2018:' + new Date().getFullYear()
		}).val();
	});
</script>
