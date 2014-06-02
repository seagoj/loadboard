<?php
function ColHead($edit=false) {
	if(!$edit) {
		print "\t\t<tr class='loadB'>\n";
		iF($edit)
			print "<td class='colHead'>&nbsp;</td>";
		print "<td class='colHead'>Date</td>"
			."<td class='colHead'>Origin</td>"
			."<td class='colHead'>Dest.</span></td>"
			."<td class='colHead'>Equip.</span></td>"
			."<td class='colHead'>Weight</span></td>"
			."<td class='colHead'>Rate</span></td>"
			."</tr>";
	}
}

function startTable($edit) {
	if(!$edit)
		print "<div class='messagediv'>\n\t";
	print "<table>\n";
}

function endTable($edit) {
	print "</table>";
	if(!$edit) print "</div>";
}

function printLoadsXML($file, $edit=false) {
	$xml = simplexml_load_file($file);
	$count = 1;
	$total = 0;
	startTable($edit);
	colHead($edit);
  	
	foreach($xml->children() AS $load)
	{
		$origin = $load->origin->city.", ".$load->origin->state;
		$destination = $load->destination->city.", ".$load->destination->state;
		$equipment = $load->equipment;
		$date = $load->date;
		$weight = $load->weight;
		$rate = $load->rate;
		
		if($count<=LOADSPERPAGE) {
			if($count%2==1) {
				print "<tr class='loadB'>";
				if($edit) print "<td><input type='radio' value='".$total++."' name='selection' /></td>";
			} else {
				print "<tr class='loadA'>";
				if($edit) print "<td><input type='radio' value='".$total++."' name='selection' /></td>";
			}
			print "<td>".$date."</td>"
				."<td>".$origin."</td>"
				."<td>".$destination."</td>"
				."<td>".$equipment."</td>"
				."<td><span>".$weight."</span></td>"
				."<td><span>".$rate."</span></td>";
			$count++;
		} else {
			endTable($edit);
			startTable($edit);
			if(!$edit)
				ColHead();
			if($count%2==1) {
				print "<tr class='loadB'>";
				if($edit) print "<td><input type='radio' value='".$total++."' name='selection' /></td>";
			} else {
				print "<tr class='loadA'>";
			}
			print "<td>".$date."</td>"
				."<td>".$origin."</td>"
				."<td>".$destination."</td>"
				."<td>".$equipment."</td>"
				."<td><span>".$weight."</span></td>"
				."<td><span>".$rate."</span></td>";
			$count = 1;
		}
		
	}
	if($count<=10)
		endTable($edit);
}

function writeLoadsXML($file) {
	if(validate() ) {
		$xml = simplexml_load_file($file);
		$origState= $_REQUEST['origState'];
		$destState= $_REQUEST['destState'];
		$equipment= $_REQUEST['equipment'];
	
		$load = $xml->addChild("load");
		$origin = $load->addChild("origin");
		$origin->addChild("city", $_REQUEST['origCity']);
		$origin->addChild("state", $origState[0]);
		$destination = $load->addChild("destination");
		$destination->addChild("city", $_REQUEST['destCity']);
		$destination->addChild("state", $destState[0]);
		$load->addChild("equipment", $equipment[0]);
		$load->addChild("date", $_REQUEST['date']);
		$load->addChild("weight", $_REQUEST['weight']);
		$load->addChild("rate", $_REQUEST['rate']);
	
		$xml->asXML($file);
	}
}

function removeLoadXML($index, $file) {
	$xml = simplexml_load_file($file);
	//print $index;
	$count = 0;
	foreach($xml as $load) {
		if($count == $index)
			unset($xml->load[$count]);
		$count++;
	}
	$xml->asXML($file);
}

function validate() {
	if(isset($_REQUEST['submit'])) {
		$error = '';
		if( $_REQUEST['date']=='' ) { $error .= "<div class='err'>Date is missing.</div>"; }
		if( $_REQUEST['origCity']=='' ) { $error .= "<div class='err'>Origin City is missing.</div>"; }
		if( $_REQUEST['origState']=='') { $error .= "<div class='err'>Origin State is missing.</div>"; }
		if( $_REQUEST['destCity']=='') { $error .= "<div class='err'>Destination City is missing.</div>"; }
		if( $_REQUEST['destState']=='') { $error .= "<div class='err'>Destination State is missing.</div>"; }
		if( $_REQUEST['equipment']=='') { $error .= "<div class='err'>Equipment is missing.</div>"; }
		if( $_REQUEST['weight']=='') { $error .= "<div class='err'>Weight is missing.</div>"; }
		if( $_REQUEST['rate']=='') { $error .= "<div class='err'>Rate is missing.</div>"; }
		if( strlen($_REQUEST['origCity'])>8 ) { $error .= "<div class='err'>Origin City must be 8 characters or less.</div>"; }
		if( strlen($_REQUEST['destCity'])>8 ) { $error .= "<div class='err'>Destination City must be 8 characters or less.</div>"; }
	
		if($error != '') {
			print $error;
			return false;
		}
		else return true;
	} else return false;
}

function buildDropDown($array, $n, $selection){
        $string = '';
        foreach($array as $k => $v){
        	if($k == $selection)
        		$string .= '<option value="'.$k.'" SELECTED>'.$k.'</option>'."\n";
        	else
            	$string .= '<option value="'.$k.'">'.$k.'</option>'."\n";     
        }
        return $string;
}

function requestArrToStr() {
	if(isset($_REQUEST)) {
		$reqStr = '?';
		foreach( $_REQUEST AS $var => $val ) {
			if($reqStr=='?')
				$reqStr .= $var;
			else
				$reqStr .= "&$var";
			if($val != '')
				$reqStr .= "=$val";
		}
	}
	
	return $reqStr;
}

function getLoadXML($index, $file) {
	$xml = simplexml_load_file($file);
	$count = 0;
	
	foreach($xml->children() AS $load)
	{
		if($count == $index) {
			return array(
				"origCity" => $load->origin->city,
				"origState" => $load->origin->state,
				"destCity" => $load->destination->city,
				"destState" => $load->destination->state,
				"equipment" => $load->equipment,
				"date" => $load->date,
				"weight"  => $load->weight,
				"rate" => $load->rate
			);
		}
		$count++;
	}
}
?>