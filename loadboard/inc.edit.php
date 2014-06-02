<?php require_once('inc.config.php');	?>

<html>
<head>
<title><?php echo TITLE; ?></title>
</head>

<!--// script includes //-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
<script type="text/javascript" src="inc.richhtmlticker.js"></script>
<!--// CSS includes //-->
<?php if (isset($_REQUEST['debug'])) { print "<link href=\"http://".$_SERVER['SERVER_NAME']."/loadboard/inc.debug.css\" rel=\"stylesheet\" type=\"text/css\" media=\"screen\" />"; } ?>
<link href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/loadboard/inc.style.css" rel="stylesheet" type="text/css" media="screen" />

<body>
<div id='header' style='text-align:center'>
	<div class='logo'><a href='inc.edit.php'><img src ='images/logo_sunsetSub.png' /></a></div>
	Sunset Load Board
</div>

<?php
//$states_array = array('AL'=>"Alabama",'AK'=>"Alaska",'AZ'=>"Arizona",'AR'=>"Arkansas",'CA'=>"California",'CO'=>"Colorado",'CT'=>"Connecticut",'DE'=>"Delaware",'DC'=>"District Of Columbia",'FL'=>"Florida",'GA'=>"Georgia",'HI'=>"Hawaii",'ID'=>"Idaho",'IL'=>"Illinois", 'IN'=>"Indiana", 'IA'=>"Iowa",  'KS'=>"Kansas",'KY'=>"Kentucky",'LA'=>"Louisiana",'ME'=>"Maine",'MD'=>"Maryland", 'MA'=>"Massachusetts",'MI'=>"Michigan",'MN'=>"Minnesota",'MS'=>"Mississippi",'MO'=>"Missouri",'MT'=>"Montana",'NE'=>"Nebraska",'NV'=>"Nevada",'NH'=>"New Hampshire",'NJ'=>"New Jersey",'NM'=>"New Mexico",'NY'=>"New York",'NC'=>"North Carolina",'ND'=>"North Dakota",'OH'=>"Ohio",'OK'=>"Oklahoma", 'OR'=>"Oregon",'PA'=>"Pennsylvania",'RI'=>"Rhode Island",'SC'=>"South Carolina",'SD'=>"South Dakota",'TN'=>"Tennessee",'TX'=>"Texas",'UT'=>"Utah",'VT'=>"Vermont",'VA'=>"Virginia",'WA'=>"Washington",'WV'=>"West Virginia",'WI'=>"Wisconsin",'WY'=>"Wyoming");
$states_array = array(
	'AL'=>"Alabama",
	'AK'=>"Alaska",
	'AZ'=>"Arizona",
	'AR'=>"Arkansas",
	'CA'=>"California",
	'CO'=>"Colorado",
	'CT'=>"Connecticut",
	'DE'=>"Delaware",
	'DC'=>"District Of Columbia",
	'FL'=>"Florida",
	'GA'=>"Georgia",
	'HI'=>"Hawaii",
	'ID'=>"Idaho",
	'IL'=>"Illinois",
	'IN'=>"Indiana",
	'IA'=>"Iowa",
	'KS'=>"Kansas",
	'KY'=>"Kentucky",
	'LA'=>"Louisiana",
	'ME'=>"Maine",
	'MD'=>"Maryland",
	'MA'=>"Massachusetts",
	'MI'=>"Michigan",
	'MN'=>"Minnesota",
	'MS'=>"Mississippi",
	'MO'=>"Missouri",
	'MT'=>"Montana",
	'NE'=>"Nebraska",
	'NV'=>"Nevada",
	'NH'=>"New Hampshire",
	'NJ'=>"New Jersey",
	'NM'=>"New Mexico",
	'NY'=>"New York",
	'NC'=>"North Carolina",
	'ND'=>"North Dakota",
	'OH'=>"Ohio",
	'OK'=>"Oklahoma",
	'OR'=>"Oregon",
	'PA'=>"Pennsylvania",
	'RI'=>"Rhode Island",
	'SC'=>"South Carolina",
	'SD'=>"South Dakota",
	'TN'=>"Tennessee",
	'TX'=>"Texas",
	'UT'=>"Utah",
	'VT'=>"Vermont",
	'VA'=>"Virginia",
	'WA'=>"Washington",
	'WV'=>"West Virginia",
	'WI'=>"Wisconsin",
	'WY'=>"Wyoming",
	'AB'=>"Alberta",
	'BC'=>"British Columbia",
	'MB'=>"Manitoba",
	'NB'=>"New Brunswick",
	'NL'=>"Newfoundland and Labrador",
	'NT'=>"Northwest Territories",
	'NS'=>"Nova Scotia", 'NU'=>"Nunavut",
	'ON'=>"Ontario",
	'PE'=>"Prince Edward Island",
	'QC'=>"Quebec",
	'SK'=>"Saskatchewan",
	'YT'=>"Yukon",
	'MX'=>"Mexico"
);
$equip_array = array('R'=>'Refrigerated', 'F'=>'Flatbed');

	if(isset($_REQUEST['add']) || isset($_REQUEST['edit'])) {
		$load = array(
				"origCity" => '',
				"origState" => '',
				"destCity" => '',
				"destState" => '',
				"equipment" => '',
				"date" => '',
				"weight"  => '',
				"rate" => '');
		
		if(isset($_REQUEST['edit'])) {
			$load = getLoadXML($_REQUEST['selection'], 'inc.loads.xml');
			removeLoadXML($_REQUEST['selection'], 'inc.loads.xml');
		}
		
		print "<form action='".$_SERVER['PHP_SELF'].requestArrToStr()."'>"
			."<div class='spacer'>&nbsp;</div>"
			."<div><label>Date:</label><input type='text' name='date' size='4' value='".$load['date']."' /></div>"
			."<div><label>Origin:</label><input type='text' name='origCity' size='20' value='".$load['origCity']."' />"
			."<select name='origState[]'>";
		print buildDropDown($states_array, "origState", $load['origState'])."</select></div>"
			."<div><label>Destination:</label><input type='text' name='destCity' size='20' value='".$load['destCity']."' />"
			."<select name='destState[]'>";
		print buildDropDown($states_array, "destState", $load['destState'])."</select></div>"
			."<div><label>Equipment:</label><select name='equipment[]'>";
		print buildDropDown($equip_array, "equipment", $load['equipment'])."</select></div>"
			."<div><label>Weight:</label><input type='text' name='weight' size='20' value='".$load['weight']."' /></div>"
			."<div><label>Rate:</label><input type='text' name='rate' size='20' value='".$load['rate']."' /></div>"
			."<div><input type='submit' name='submit' value='submit' /></div>"
			."</form>";
	} 
	if (isset($_REQUEST['delete'])) {
		removeLoadXML($_REQUEST['selection'], 'inc.loads.xml');
	} 
	if (isset($_REQUEST['submit'])) {
		writeLoadsXML("inc.loads.xml");
	}  
	if (isset($_REQUEST['submit']) && isset($_REQUEST['edit'])) {
		removeLoadXML($_REQUEST['selection'], 'inc.loads.xml');
		writeLoadsXML("inc.loads.xml");
	} else {
		print "<form action='".$_SERVER['PHP_SELF'].requestArrToStr()."'>";
		printLoadsXML('inc.loads.xml', true);
		print "<div><input type='submit' name='add' value='Add' /><input type='submit' name='edit' value='Edit' /><input type='submit' name='delete' value='Delete' /></div></form>";
	}
?>

</body>
</html>