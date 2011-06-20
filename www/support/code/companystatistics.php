<?php
/*******************************************************************************
**	file:	companystatisticas.php
********************************************************************************
**	author:	Luis Bernardo
**	date:	31 Jan 2004
********************************************************************************
**	$Revision: 1.3 $ on $Date: 2004/03/01 06:06:04 $ by $Author: lmpmbernardo $
*******************************************************************************/

$offset = isset($_GET['offset']) ? $_GET['offset'] : 0;

$title = $lang[company_statistics];
$maxoffset = getNumberOfCompanies();
$link = "companystatistics&offset=";
$rows = array();
$headrow = array($lang[rank], $lang[company], $lang[tickets], $lang[first_ticket], $lang[last_ticket]);
$align = array('right', 'left', 'right', 'middle', 'middle');
// this query is too slow...
$sql = "select t1.id, t1.company_name as cname, count(t2.id) as totals, min(t2.date_created) as last, max(t2.date_created) as first from $mysql_companies_table as t1 left join $mysql_tickets_table as t2 on t1.id=t2.company_id where t1.id>'2' group by cname order by totals desc limit $offset, $tickets_limit";
$r = execsql($sql);
$counter = $offset;
while($newrow = mysql_fetch_row($r)) {
	$counter++;
	$firstticket = ($newrow[3] != 0 ? date($dateformat, $newrow[3]) : "--");
	$lastticket = ($newrow[4] != 0 ? date($dateformat, $newrow[4]) : "--");
	$row = array($counter, $newrow[1], $newrow[2], $firstticket, $lastticket);
	array_push($rows, $row);
}

// start html output
outputSimpleTable($title, $headrow, $rows, $align);
outputNavigationLink($offset, $maxoffset, $tickets_limit, $link);
// end html output

?>