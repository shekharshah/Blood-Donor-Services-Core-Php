<?php

include('MPDF57/mpdf.php');

$name 	= $_POST['name'];
$email 	= $_POST['email'];
$msg 	= $_POST['message'];

$html .= "
<html>
<head>
<style>
body {font-family: sans-serif;
    font-size: 10pt;
}
td { vertical-align: top; 
    border-left: 0.6mm solid #000000;
    border-right: 0.6mm solid #000000;
	align: center;
}
table thead td { background-color: #EEEEEE;
    text-align: center;
    border: 0.6mm solid #000000;
}
td.lastrow {
    background-color: #FFFFFF;
    border: 0mm none #000000;
    border-bottom: 0.6mm solid #000000;
    border-left: 0.6mm solid #000000;
	border-right: 0.6mm solid #000000;
}

</style>
</head>
<body>

<!--mpdf
<htmlpagefooter name='myfooter'>
<div style='border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; '>
Page {PAGENO} of {nb}
</div>
</htmlpagefooter>

<sethtmlpageheader name='myheader' value='on' show-this-page='1' />
<sethtmlpagefooter name='myfooter' value='on' />
mpdf-->

<div style='text-align:center;'>HTML Form to PDF - Blog.theonlytutorials.com</div><br>
<table class='items' width='100%' style='font-size: 9pt; border-collapse: collapse;' cellpadding='8'>
<thead>
<tr>
<td width='15%'>FIELDS</td>
<td width='15%'>VALUES</td>
</tr>
</thead>
<tbody>
<tr><td>Name</td><td>$name</td></tr>
<tr><td>Email</td><td>$email</td></tr>
<tr><td class='lastrow'>Your Message</td><td class='lastrow'>$msg</td></tr>
</tbody>
</table>
</body>
</html>
";



$mpdf=new mPDF();
$mpdf->WriteHTML($html);
$mpdf->SetDisplayMode('fullpage');

$mpdf->Output();

?>