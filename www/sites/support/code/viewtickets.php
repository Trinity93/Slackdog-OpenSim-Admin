<?php
/*******************************************************************************
**	file:	viewtickets.php
********************************************************************************
**	author:	Luis Bernardo
**	date:	10 Dec 2003
********************************************************************************
**	$Revision: 1.8 $ on $Date: 2004/03/10 05:40:50 $ by $Author: lmpmbernardo $
*******************************************************************************/

$case = $_GET['case'];
$sort = $_GET['sort'];
$order = $_GET['order'];
$id = $_GET['id'];
$offset = isset($_GET['offset']) ? $_GET['offset'] : 0;

$supporter_id = getPersonID($cookie_name);

if(!isset($order) || $order == "down") {
	$order = "up";
} else {
	$order = "down";
}

switch($case) {
	case ("groups"):
		$header = $lang['my_groups_tickets'];
		break;
	case ("company"):
		$header = $lang['company_tickets'];
		// need company id instead of supporter id
		$supporter_id = $id;
		$extravar = "&id=$id";
		break;
	case ("person"):
		$header = $lang['contact_tickets'];
		// need company id instead of supporter id
		$supporter_id = $id;
		$extravar = "&id=$id";
		break;
	case ("all"):
		$header = $lang['all_tickets'];
		break;
	default:
		$header = $lang['my_tickets'];
		break;
}

$maxoffset = getNumberOfPossibleTickets($supporter_id, $case);
$headrow = array();
array_push($headrow, outputURL("viewtickets&case=$case$extravar&sort=id&order=$order", $lang['id']));
array_push($headrow, outputURL("viewtickets&case=$case$extravar&sort=title&order=$order", $lang['title']));
array_push($headrow, outputURL("viewtickets&case=$case$extravar&sort=client&order=$order", $lang['client']));
array_push($headrow, outputURL("viewtickets&case=$case$extravar&sort=contact&order=$order", $lang['contact']));
array_push($headrow, outputURL("viewtickets&case=$case$extravar&sort=priority&order=$order", $lang['priority']));
array_push($headrow, outputURL("viewtickets&case=$case$extravar&sort=updated&order=$order", $lang['updated']));
array_push($headrow, outputURL("viewtickets&case=$case$extravar&sort=status&order=$order", $lang['status']));
$align = array('center', 'left', 'left', 'left', 'center', 'center', 'center');
$rows = array();
$sql = buildQuery($supporter_id, $sort, $case, $offset, $order);
$result = execsql($sql);
while($row = mysql_fetch_row($result)) {
	$ticketid = $row[0];
	$displayid = str_pad($ticketid, 5, "0", STR_PAD_LEFT);
	$title = $row[9];
	$title = outputURL("detailticket&id=$ticketid", $title);
	$company = getCompanyInfo($row[3]);
	$client = $company['company_name'];
	$contact = getPersonName($row[4]);
	$priority = getPriority($row[5]);
	$status = getStatus($row[6]);
	$updated = date($dateformat, $row[15]);
	$row = array($displayid, $title, $client, $contact, $priority, $updated, $status);
	array_push($rows, $row);
}

// for the Previous and Next links need to revert the order to previous value
if(!isset($order) || $order == "down") {
	$order = "up";
} else {
	$order = "down";
}
//$link = "viewtickets&case=$case$extravar&sort=$sort&order=$order";
$link = "viewtickets&case=$case$extravar&sort=$sort&order=$order&offset=";

// start html output
outputSimpleTable($header, $headrow, $rows, $align);
outputNavigationLink($offset, $maxoffset, $tickets_limit, $link);
// end html output


function buildQuery($id, $sort, $case, $offset, $order) {
	$low = $offset;
	if($order == "up") {
		$order = "asc";
	} else {
		$order = "desc";
	}
	$query = "";
	switch($sort) {
		case ("title"):
			$query = listByTitle($id, $case, $low, $order);
			break;
		case ("client"):
			$query = listByClient($id, $case, $low, $order);
			break;
		case ("contact"):
			$query = listByContact($id, $case, $low, $order);
			break;
		case ("priority"):
			$query = listByPriority($id, $case, $low, $order);
			break;
		case ("updated"):
			$query = listByDateUpdated($id, $case, $low, $order);
			break;
		case ("status"):
			$query = listByStatus($id, $case, $low, $order);
			break;
		case ("id"):
			$query = listById($id, $case, $low, $order);
			break;
		default:
			$query = listByDefault($id, $case, $low);
			break;
	}
	return $query;
}

function listByDefault($supporterid, $case, $low) {
	// order by status and then by priority
	global $mysql_tickets_table, $mysql_tstatus_table, $mysql_tpriorities_table, $tickets_limit;
	switch($case) {
		case ("groups"):
			$orsql = findGroups($supporterid);
			$sql = "select t1.*, t2.rank, t3.rank from $mysql_tickets_table as t1 left join $mysql_tstatus_table as t2 on t1.status_id=t2.id left join $mysql_tpriorities_table as t3 on t1.priority_id=t3.id where $orsql and t1.supporter_id!='$supporterid' order by t2.rank, t3.rank asc, t1.date_modified desc limit $low, $tickets_limit";
			break;
		case ("company"):
			$companyid = $supporterid;
			$sql = "select t1.*, t2.rank, t3.rank from $mysql_tickets_table as t1 left join $mysql_tstatus_table as t2 on t1.status_id=t2.id left join $mysql_tpriorities_table as t3 on t1.priority_id=t3.id where t1.company_id='$companyid' order by t2.rank, t3.rank asc, t1.date_modified desc limit $low, $tickets_limit";
			break;
		case ("person"):
			$contactid = $supporterid;
			$sql = "select t1.*, t2.rank, t3.rank from $mysql_tickets_table as t1 left join $mysql_tstatus_table as t2 on t1.status_id=t2.id left join $mysql_tpriorities_table as t3 on t1.priority_id=t3.id where t1.contact_id='$contactid' order by t2.rank, t3.rank asc, t1.date_modified desc limit $low, $tickets_limit";
			break;
		case ("all"):
			$sql = "select t1.*, t2.rank, t3.rank from $mysql_tickets_table as t1 left join $mysql_tstatus_table as t2 on t1.status_id=t2.id left join $mysql_tpriorities_table as t3 on t1.priority_id=t3.id order by t2.rank, t3.rank asc, t1.date_modified desc limit $low, $tickets_limit";
			break;
		default:
			$sql = "select t1.*, t2.rank, t3.rank from $mysql_tickets_table as t1 left join $mysql_tstatus_table as t2 on t1.status_id=t2.id left join $mysql_tpriorities_table as t3 on t1.priority_id=t3.id where t1.supporter_id='$supporterid' order by t2.rank, t3.rank asc, t1.date_modified desc limit $low, $tickets_limit";
	}
	return $sql;
}

function listById($supporterid, $case, $low, $order) {
	global $mysql_tickets_table, $tickets_limit;
	switch($case) {
		case ("groups"):
			$orsql = findGroups($supporterid);
			$sql = "select t1.* from $mysql_tickets_table as t1 where $orsql and supporter_id!='$supporterid' order by id $order limit $low, $tickets_limit";
			break;
		case ("company"):
			$companyid = $supporterid;
			$sql = "select * from $mysql_tickets_table where company_id='$companyid' order by id $order limit $low, $tickets_limit";
			break;
		case ("person"):
			$contactid = $supporterid;
			$sql = "select * from $mysql_tickets_table where contact_id='$contactid' order by id $order limit $low, $tickets_limit";
			break;
		case ("all"):
			$sql = "select * from $mysql_tickets_table order by id $order limit $low, $tickets_limit";
			break;
		default:
			$sql = "select * from $mysql_tickets_table where supporter_id='$supporterid' order by id $order limit $low, $tickets_limit";
	}
	return $sql;
}

function listByTitle($supporterid, $case, $low, $order) {
	global $mysql_tickets_table, $tickets_limit;
	switch($case) {
		case ("groups"):
			$orsql = findGroups($supporterid);
			$sql = "select t1.* from $mysql_tickets_table as t1 where $orsql and supporter_id!='$supporterid' order by title $order limit $low, $tickets_limit";
			break;
		case ("company"):
			$companyid = $supporterid;
			$sql = "select * from $mysql_tickets_table where company_id='$companyid' order by title $order limit $low, $tickets_limit";
			break;
		case ("person"):
			$contactid = $supporterid;
			$sql = "select * from $mysql_tickets_table where contact_id='$contactid' order by title $order limit $low, $tickets_limit";
			break;
		case ("all"):
			$sql = "select * from $mysql_tickets_table order by title $order limit $low, $tickets_limit";
			break;
		default:
			$sql = "select * from $mysql_tickets_table where supporter_id='$supporterid' order by title $order limit $low, $tickets_limit";
	}
	return $sql;
}

function listByClient($supporterid, $case, $low, $order) {
	global $mysql_tickets_table, $mysql_companies_table, $tickets_limit;
	switch($case) {
		case ("groups"):
			$orsql = findGroups($supporterid);
			$sql = "select t1.*, t2.company_name from $mysql_tickets_table as t1 left join $mysql_companies_table as t2 on t1.company_id=t2.id where $orsql and t1.supporter_id!='$supporterid' order by t2.company_name $order limit $low, $tickets_limit";
			break;
		case ("company"):
			$companyid = $supporterid;
			$sql = "select t1.*, t2.company_name from $mysql_tickets_table as t1 left join $mysql_companies_table as t2 on t1.company_id=t2.id where t1.company_id='$companyid' order by t2.company_name $order limit $low, $tickets_limit";
			break;
		case ("person"):
			$contactid = $supporterid;
			$sql = "select t1.*, t2.company_name from $mysql_tickets_table as t1 left join $mysql_companies_table as t2 on t1.company_id=t2.id where t1.contact_id='$contactid' order by t2.company_name $order limit $low, $tickets_limit";
			break;
		case ("all"):
			$sql = "select t1.*, t2.company_name from $mysql_tickets_table as t1 left join $mysql_companies_table as t2 on t1.company_id=t2.id order by t2.company_name $order limit $low, $tickets_limit";
			break;
		default:
			$sql = "select t1.*, t2.company_name from $mysql_tickets_table as t1 left join $mysql_companies_table as t2 on t1.company_id=t2.id where t1.supporter_id='$supporterid' order by t2.company_name $order limit $low, $tickets_limit";
	}
	return $sql;
}

function listByContact($supporterid, $case, $low, $order) {
	global $mysql_tickets_table, $mysql_people_table, $tickets_limit;
	switch($case) {
		case ("groups"):
			$orsql = findGroups($supporterid);
			$sql = "select t1.*, t2.last_name from $mysql_tickets_table as t1 left join $mysql_people_table as t2 on t1.contact_id=t2.id where $orsql and t1.supporter_id!='$supporterid' order by t2.last_name $order limit $low, $tickets_limit";
			break;
		case ("company"):
			$companyid = $supporterid;
			$sql = "select t1.*, t2.last_name from $mysql_tickets_table as t1 left join $mysql_people_table as t2 on t1.contact_id=t2.id where t1.company_id='$companyid' order by t2.last_name $order limit $low, $tickets_limit";
			break;
		case ("person"):
			$contactid = $supporterid;
			$sql = "select t1.*, t2.last_name from $mysql_tickets_table as t1 left join $mysql_people_table as t2 on t1.contact_id=t2.id where t1.contact_id='$contactid' order by t2.last_name $order limit $low, $tickets_limit";
			break;
		case ("all"):
			$sql = "select t1.*, t2.last_name from $mysql_tickets_table as t1 left join $mysql_people_table as t2 on t1.contact_id=t2.id order by t2.last_name $order limit $low, $tickets_limit";
			break;
		default:
			$sql = "select t1.*, t2.last_name from $mysql_tickets_table as t1 left join $mysql_people_table as t2 on t1.contact_id=t2.id where t1.supporter_id='$supporterid' order by t2.last_name $order limit $low, $tickets_limit";
	}
	return $sql;
}

function listByPriority($supporterid, $case, $low, $order) {
	global $mysql_tickets_table, $mysql_tpriorities_table, $tickets_limit;
	switch($case) {
		case ("groups"):
			$orsql = findGroups($supporterid);
			$sql = "select t1.*, t2.rank from $mysql_tickets_table as t1 left join $mysql_tpriorities_table as t2 on t1.priority_id=t2.id where $orsql and t1.supporter_id!='$supporterid' order by t2.rank $order limit $low, $tickets_limit";
			break;
		case ("company"):
			$companyid = $supporterid;
			$sql = "select t1.*, t2.rank from $mysql_tickets_table as t1 left join $mysql_tpriorities_table as t2 on t1.priority_id=t2.id where t1.company_id='$companyid' order by t2.rank $order limit $low, $tickets_limit";
			break;
		case ("person"):
			$contactid = $supporterid;
			$sql = "select t1.*, t2.rank from $mysql_tickets_table as t1 left join $mysql_tpriorities_table as t2 on t1.priority_id=t2.id where t1.contact_id='$contactid' order by t2.rank $order limit $low, $tickets_limit";
			break;
		case ("all"):
			$sql = "select t1.*, t2.rank from $mysql_tickets_table as t1 left join $mysql_tpriorities_table as t2 on t1.priority_id=t2.id order by t2.rank $order limit $low, $tickets_limit";
			break;
		default:
			$sql = "select t1.*, t2.rank from $mysql_tickets_table as t1 left join $mysql_tpriorities_table as t2 on t1.priority_id=t2.id where t1.supporter_id='$supporterid' order by t2.rank $order limit $low, $tickets_limit";
	}
	return $sql;
}

function listByDateUpdated($supporterid, $case, $low, $order) {
	global $mysql_tickets_table, $tickets_limit;
	switch($case) {
		case ("groups"):
			$orsql = findGroups($supporterid);
			$sql = "select t1.* from $mysql_tickets_table as t1 where $orsql and supporter_id!='$supporterid' order by date_modified $order limit $low, $tickets_limit";
			break;
		case ("company"):
			$companyid = $supporterid;
			$sql = "select * from $mysql_tickets_table where company_id='$companyid' order by date_modified $order limit $low, $tickets_limit";
			break;
		case ("person"):
			$contactid = $supporterid;
			$sql = "select * from $mysql_tickets_table where contact_id='$contactid' order by date_modified $order limit $low, $tickets_limit";
			break;
		case ("all"):
			$sql = "select * from $mysql_tickets_table order by date_modified $order limit $low, $tickets_limit";
			break;
		default:
			$sql = "select * from $mysql_tickets_table where supporter_id='$supporterid' order by date_modified $order limit $low, $tickets_limit";
	}
	return $sql;
}

function listByStatus($supporterid, $case, $low, $order) {
	global $mysql_tickets_table, $mysql_tstatus_table, $tickets_limit;
	switch($case) {
		case ("groups"):
			$orsql = findGroups($supporterid);
			$sql = "select t1.*, t2.rank from $mysql_tickets_table as t1 left join $mysql_tstatus_table as t2 on t1.status_id=t2.id where $orsql and t1.supporter_id!='$supporterid' order by t2.rank $order limit $low, $tickets_limit";
			break;
		case ("company"):
			$companyid = $supporterid;
			$sql = "select t1.*, t2.rank from $mysql_tickets_table as t1 left join $mysql_tstatus_table as t2 on t1.status_id=t2.id where t1.company_id='$companyid' order by t2.rank $order limit $low, $tickets_limit";
			break;
		case ("person"):
			$contactid = $supporterid;
			$sql = "select t1.*, t2.rank from $mysql_tickets_table as t1 left join $mysql_tstatus_table as t2 on t1.status_id=t2.id where t1.contact_id='$contactid' order by t2.rank $order limit $low, $tickets_limit";
			break;
		case ("all"):
			$sql = "select t1.*, t2.rank from $mysql_tickets_table as t1 left join $mysql_tstatus_table as t2 on t1.status_id=t2.id order by t2.rank $order limit $low, $tickets_limit";
			break;
		default:
			$sql = "select t1.*, t2.rank from $mysql_tickets_table as t1 left join $mysql_tstatus_table as t2 on t1.status_id=t2.id where t1.supporter_id='$supporterid' order by t2.rank $order limit $low, $tickets_limit";
	}
	return $sql;
}

function findGroups($id) {
	global $mysql_supporters_table;
	// find the groups the supporter is a member of
	$sql = "select group_id from $mysql_supporters_table where supporter_id='$id'";
	$result = execsql($sql);
	$groupsql = "(";
	$counter = 0;
	while($row = mysql_fetch_row($result)) {
		if($counter > 0) $groupsql .= " or ";
		$gid = $row[0];
		$groupsql .= "t1.group_id='".$gid."'";
		$counter++;
	}
	$groupsql .= ")";
	// if the supporter does not belong to a group yet this does not make sense; in that case one wants
	// to show an empty list. the easy solution is to say the supporter belongs to a group that does not exist
	// and so there are no tickets for that group; a group with negative id does not exist, so choose that
	if($groupsql == "()") $groupsql = "(t1.group_id='-1')";
	return $groupsql;
}

function getNumberOfPossibleTickets($id, $case) {
	global $mysql_tickets_table;
	switch($case) {
		case ("groups"):
			$orsql = findGroups($id);
			$sql = "select t1.* from $mysql_tickets_table as t1 where $orsql and supporter_id!='$id'";
			break;
		case ("company"):
			$sql = "select * from $mysql_tickets_table where company_id='$id'";
			break;
		case ("person"):
			$sql = "select * from $mysql_tickets_table where contact_id='$id'";
			break;
		case ("all"):
			$sql = "select * from $mysql_tickets_table";
			break;
		default:
			$sql = "select * from $mysql_tickets_table where supporter_id='$id'";
			break;
	}
	$result = execsql($sql);
	$num_rows = mysql_num_rows($result);
	return $num_rows;
}

?>