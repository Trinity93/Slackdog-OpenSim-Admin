<?php
/*******************************************************************************
**	file:	addressbook.php
********************************************************************************
**	author:	Luis Bernardo
**	date:	07 Feb 2004
********************************************************************************
**	$Revision: 1.2 $ on $Date: 2004/03/01 06:06:04 $ by $Author: lmpmbernardo $
*******************************************************************************/

$offset = isset($_GET['offset']) ? $_GET['offset'] : 0;
if(isset($_GET['letter'])) {
	$letter = $_GET['letter'];
	$offset = getContactsAlphabeticIndex($letter);
}

$title = $lang[address_book];
$maxoffset = getNumberOfContacts();
$link = "addressbook&offset=";
$midlink = "addressbook&letter=";
$rows = array();
$headrow = array($lang[last_first_name], $lang[company], $lang[email], $lang[phone]);
$align = array('left', 'left', 'left', 'left');
// choose only contacts (user = 1), avoid default contact
$sql = "select t1.id, t2.id, t1.last_name, t1.first_name, t2.company_name, t1.email, t1.phone from $mysql_people_table as t1, $mysql_companies_table as t2 where t1.company_id=t2.id and t1.user='1' and t1.id!='1' order by t1.last_name limit $offset, $tickets_limit";
$r = execsql($sql);
while($newrow = mysql_fetch_row($r)) {
	$name = $newrow[2] . ", " . $newrow[3];
	$name = outputURL("detailcontact&id=$newrow[0]", $name);
	$company = $newrow[4];
	$company = outputURL("detailcompany&id=$newrow[1]", $company);
	$email = $newrow[5];
	$email = "<a href=mailto:$email>$email</a>";
	$row = array($name, $company, $email, $newrow[6]);
	array_push($rows, $row);
}

// start html output
outputSimpleTable($title, $headrow, $rows, $align);
outputNavigationLink($offset, $maxoffset, $tickets_limit, $link, $midlink);
// end html output

?>