<?php
/*******************************************************************************
**	file:	processmap.php
********************************************************************************
**	author:	Luis Bernardo
**	date:	16 Feb 2004
********************************************************************************
**	$Revision: 1.2 $ on $Date: 2004/03/10 05:40:50 $ by $Author: lmpmbernardo $
*******************************************************************************/

// first find oldest ticket
$sql = "select min(date_created) from $mysql_tickets_table";
$r = execsql($sql);
$rr = mysql_fetch_row($r);
$firstticket = $rr[0];
// find month and year
$ftmonth = date("n", $firstticket);
$ftyear = date("Y", $firstticket);
// generate array of months since first ticket
$startmonth = mktime(0, 0, 0, $ftmonth, 1, $ftyear);
$now = time();
$arraymonths = array();
while($startmonth < $now) {
	$monthlabel = date("M-Y", $startmonth);
	array_push($arraymonths, $monthlabel);
	$ftmonth = date("n", $startmonth);
	$ftyear = date("Y", $startmonth);
	$ftmonth++; // increment by 1 to go to next month
	$startmonth = mktime(0, 0, 0, $ftmonth, 1, $ftyear);
} 
// find status id of closed tickets (have highest rank)
$statusid = getHighestRank($mysql_tstatus_table);
// get all creation times
$creationtimes = array();
$closingtimes = array();
$stillopentimes = array();
$lifetime = array();
$sql = "select date_created, date_modified, status_id from $mysql_tickets_table";
$r = execsql($sql);
while($rr = mysql_fetch_row($r)) {
	// generate M-Y label
	$monthlabel = date("M-Y", $rr[0]);
	array_push($creationtimes, $monthlabel);
	if($rr[2] == $statusid) {
		// this ticket was closed; find month when it was closed and lifetime
		$monthlabel = date("M-Y", $rr[1]);
		array_push($closingtimes, $monthlabel);
		$tlf = $rr[1] - $rr[0]; // lifetime of this closed ticket
		if(array_key_exists($monthlabel, $lifetime)) {
			$tlf = $tlf + $lifetime[$monthlabel];
		}
		$lifetime[$monthlabel] = $tlf;
	} else {
		// still open!!
		$monthlabel = date("M-Y", $rr[0]);
		array_push($stillopentimes, $monthlabel);
	}
}
// this gives the number (value) of created/closed/stillopen tickets per month (key)
$openhistogram = array_count_values($creationtimes);
$closehistogram = array_count_values($closingtimes);
$stillopenhistogram = array_count_values($stillopentimes);

$arraymonths = array_reverse($arraymonths);

$backlog = 0;
$title = "Process Map";
$rows = array();
$headrow = array("Month", "Created", "Closed", "Remaining", "Backlog", "Avg. Lifetime (Days)");
$align = array('center', 'right', 'right', 'right', 'right', 'right');
while(!is_null($label = array_pop($arraymonths))) {
	$value1 = array_key_exists($label, $openhistogram) ? $openhistogram[$label] : 0;
	$value2 = array_key_exists($label, $closehistogram) ? $closehistogram[$label] : 0;
	$value3 = array_key_exists($label, $stillopenhistogram) ? $stillopenhistogram[$label] : 0;
	$value4 = array_key_exists($label, $lifetime) ? $lifetime[$label] : 0;
	if($value2 != 0) {
		$value4 = round($value4/$value2/86400);
	} else {
		$value4 = "--";
	}
	$backlog = $backlog + $value1 - $value2;
	$row = array($label, $value1, $value2, $value3, $backlog, $value4);
	array_push($rows, $row);
}

// start html output
outputSimpleTable($title, $headrow, $rows, $align);
// end html output

?>