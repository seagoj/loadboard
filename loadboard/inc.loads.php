<META HTTP-EQUIV=Refresh CONTENT='20; URL=index.php'>

<?php
require_once('inc.config.php');

printLoadsXML(XMLFILE);
if(isset($_REQUEST['submit']) && validate()) {
	writeLoadsXML(XMLFILE);
	print "WRITING";
}
?>

<div class='messagediv'>
	<img class='mapLeft' src='http://image.weather.com/images/sat/ussat_600x405.jpg' />
	<img class='mapRight' src='http://image.weather.com/images/sat/canadasat_600x405.jpg' />
	<img class='mapLeft' src='http://image.weather.com/images/maps/current/curwx_600x405.jpg' />
	<img class='mapRight' src='http://i.imwx.com/images/maps/special/severe_us_600x405.jpg' />
</div>