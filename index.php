<?php
require_once('inc.config.php');
//print countXMLLoads("inc.loads.php");
//header( "refresh:21;index.php" );
header("refresh:40;index.php");
?>

<html>
<head>
<title><?php echo TITLE; ?></title>
</head>

<!--// script includes //-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
<script type="text/javascript" src="inc.richhtmlticker.js"></script>
<!--// CSS includes //-->
<?php if (isset($_REQUEST['debug'])) { print "<link href=\"http://".$_SERVER['SERVER_NAME']."/inc.debug.css\" rel=\"stylesheet\" type=\"text/css\" media=\"screen\" />"; } ?>
<link href="inc.style.css" rel="stylesheet" type="text/css" media="screen" />

<body>
<div id='header' style='text-align:center'>
	<div class='logo'><a href='inc.edit.php'><img src ='images/logo_sunsetSub.png' alt='Sunset LoadBoard' /></a></div>
	Sunset Load Board
</div>

<?php
print "<div id='content'><!--// Ajax Call returns here //--></div>";
?>
</body>
</html>