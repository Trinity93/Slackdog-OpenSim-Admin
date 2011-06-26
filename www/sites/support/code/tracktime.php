<?php
/*******************************************************************************
**	file:	tracktime.php
********************************************************************************
**	author:	Luis Bernardo
**	date: 2003/12/10
********************************************************************************
**	$Revision: 1.6 $ on $Date: 2004/01/16 22:18:52 $ by $Author: lmpmbernardo $
*******************************************************************************/

$case = $_GET['case'];
$edit = $_GET['edit'];
$offset = $_GET['offset'] ? $_GET['offset'] : $_POST['offset'];
$sort = $_GET['sort'];
$order = $_GET['order'] ? $_GET['order'] : $_POST['order'];
$cancel = $_POST['cancel'];
$id = $_GET['id'];
$updatetime= $_POST['updatetime'];

$supporter_id = getPersonID($cookie_name);

if(isset($updatetime)) {
	$edit = null;
	$time = time();
	for($i = 0; $i <= $tickets_limit; $i++) {
		$ticketid = "ticket_id" . $i;
		$minutesworked = "minutes_worked" . $i;
		$ticketid = $_POST[$ticketid];
		$minutesworked = $_POST[$minutesworked];
		if($ticketid != '' && $minutesworked != '') {
			$sql = "insert into $mysql_tracktime_table values('$ticketid', '$supporter_id', '$minutesworked', '$time')";
			execsql($sql);
		}
	}

}
if(isset($cancel)) {
	$edit = null;
}
if(!isset($offset)) {
	$offset = 0;
}
if(!isset($order) || $order == "down") {
	$order = "up";
} else {
	$order = "down";
}

// this can be used for both supporters or admins
switch($case) {
	case ("administrator"):
		$header = $lang['ticket_time_sheets'];;
		$supporter_id = null;
		break;
	case ("supporter"):
		$header = $lang['time_sheet_for']." " . getPersonName($id);
		$supporter_id = $id;
		$extravar = "&id=$id";
		break;
	default:
		$header = $lang['my_time_sheet'];
		break;
}

$colspan = 5;
if(isset($edit)) {
	$colspan = 6;
	echo '
	<form action=index.php?t=tracktime method=post>';
}
echo '
	<table class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
		<tr>
			<td class=info>
				<table cellSpacing=1 cellPadding=5 width="100%" border=0>
					<tr>
						<td class=info width=10% align=center>&nbsp;</td>
						<td class=info width=80% align=center><b>'. $header .'</b></td>';
if(!isset($edit) && (!isset($case) || $case =='')) {
	echo '
						<td class=info width=10% align=right><a class=info href=index.php?t=tracktime&edit=true&offset='. $offset .'>'.$lang['edit'].'</a></td>';
} else {
	echo '
						<td class=info width=10% align=center>&nbsp;</td>';
}
echo '
					</tr>';
if(isset($edit)) {
	echo '
					<tr>
						<td colspan='.$colspan.' class=cat>
							'.$lang['text_num_mins_worked'].'
						</td>
					</tr>';
}
echo '
					<tr>
						<td class=back colspan='.$colspan.'>
							<table class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
								<tr>
									<td>
										<table cellSpacing=1 cellPadding=5 width="100%" border=0>
											<tr>';
if(!isset($edit)) {
	echo '
												<td class=cat align=center><b>
													<a href="index.php?t=tracktime&case='. $case . $extravar .'&sort=id&order='. $order .'"> '.$lang['ticket_id'].' </a></b></td>
												<td class=cat align=center><b>
													<a href="index.php?t=tracktime&case='. $case . $extravar .'&sort=title&order='. $order .'"> '.$lang['title'].' </a></b></td>
												<td class=cat align=center><b>
													<a href="index.php?t=tracktime&case='. $case . $extravar .'&sort=status&order='. $order .'"> '.$lang['status'].' </a></b></td>
												<td class=cat align=center><b>
													<a href="index.php?t=tracktime&case='. $case . $extravar .'&sort=worked&order='. $order .'"> '.$lang['hours_worked'].' </a></b></td>
												<td class=cat align=center><b>
													<a href="index.php?t=tracktime&case='. $case . $extravar .'&sort=updated&order='. $order .'"> '.$lang['last_updated'].' </a></b></td>';
} else {
	echo '
												<td class=cat align=center><b> '.$lang['ticket_id'].' </b></td>
												<td class=cat align=center><b> '.$lang['title'].' </b></td>
												<td class=cat align=center><b> '.$lang['status'].' </b></td>
												<td class=cat align=center><b> '.$lang['hours_worked'].' </b></td>
												<td class=cat align=center><b> '.$lang['last_updated'].' </b></td>
												<td class=cat align=center><b> '.$lang['minutes_worked'].' </b></td>';
}
echo '
											</tr>';
											listTicketsTime($supporter_id, $sort, $case, $offset, $edit, $order); echo '
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<br>
	<center>';

// for the Previous and Next links need to revert the order to previous value
if(!isset($order) || $order == "down") {
	$order = "up";
} else {
	$order = "down";
}

if(!isset($edit)) {
	$offset = $offset - $tickets_limit;
	if($offset < 0){
		echo '
			&nbsp;'.$lang['previous'];
	} else {
		echo '
			&nbsp;<a href=index.php?t=tracktime&case='. $case .'&sort='. $sort .'&order='. $order .'&offset='. $offset .'&id='. $supporter_id .'>'.$lang['previous'].'</a>';
	}
	echo '
		&nbsp; | &nbsp;';
	$offset = $offset + $tickets_limit + $tickets_limit;
	if($offset < getNumberOfPossibleTickets($supporter_id, $case)) {
		echo '
			&nbsp;<a href=index.php?t=tracktime&case='. $case .'&sort='. $sort .'&order='. $order .'&offset='. $offset .'&id='. $supporter_id.'>'.$lang['next'].'</a>';
	} else {
		echo '
			&nbsp;'.$lang['next'];
	}
} else {
	echo '
		<input type=submit name=updatetime value="'.$lang['update'].'">&nbsp;&nbsp;&nbsp;
		<input type=submit name=cancel value="'.$lang['cancel'].'">
		<input type=hidden name=offset value='. $offset .'>
		<input type=hidden name=order value='. $order .'>
	</form>';
}

function listTicketsTime($id, $sort, $case, $offset, $edit, $order) {
	$low = $offset;
	if($order == "up") {
		$order = "asc";
	} else {
		$order = "desc";
	}
	switch($sort) {
		case ("title"):
			listByTitle($id, $case, $low, $edit, $order);
			break;
		case ("updated"):
			listByDateUpdated($id, $case, $low, $edit, $order);
			break;
		case ("status"):
			listByStatus($id, $case, $low, $edit, $order);
			break;
		case ("id"):
			listById($id, $case, $low, $edit, $order);
			break;
		case ("worked"):
			listByHoursWorked($id, $case, $low, $edit, $order);
			break;
		default:
			listByDefault($id, $case, $low, $edit);
			break;
	}
}

function listByDefault($supporterid, $case, $low, $edit) {
	global $mysql_tickets_table, $mysql_tracktime_table, $tickets_limit;
	switch($case) {
		case ("administrator"):
			$sql = "select t1.ticket_id, t2.title, max(t1.date_logged) as last_updated, sum(t1.minutes) as time_worked, t2.status_id from $mysql_tracktime_table as t1 left join $mysql_tickets_table as t2 on t1.ticket_id=t2.id group by t1.ticket_id order by last_updated desc limit $low, $tickets_limit";
			break;
		default:
			$sql = "select t1.ticket_id, t2.title, max(t1.date_logged) as last_updated, sum(t1.minutes) as time_worked, t2.status_id from $mysql_tracktime_table as t1 left join $mysql_tickets_table as t2 on t1.ticket_id=t2.id where t1.supporter_id='$supporterid' group by t1.ticket_id order by last_updated desc limit $low, $tickets_limit";
	}
	displayTicketsTime($sql, $edit);
}

function listById($supporterid, $case, $low, $edit, $order) {
	global $mysql_tickets_table, $mysql_tracktime_table, $tickets_limit;
	switch($case) {
		case ("administrator"):
			$sql = "select t1.ticket_id, t2.title, max(t1.date_logged) as last_updated, sum(t1.minutes) as time_worked, t2.status_id from $mysql_tracktime_table as t1 left join $mysql_tickets_table as t2 on t1.ticket_id=t2.id group by t1.ticket_id order by t1.ticket_id $order limit $low, $tickets_limit";
			break;
		default:
			$sql = "select t1.ticket_id, t2.title, max(t1.date_logged) as last_updated, sum(t1.minutes) as time_worked, t2.status_id from $mysql_tracktime_table as t1 left join $mysql_tickets_table as t2 on t1.ticket_id=t2.id where t1.supporter_id='$supporterid' group by t1.ticket_id order by t1.ticket_id $order limit $low, $tickets_limit";
	}
	displayTicketsTime($sql, $edit);
}

function listByTitle($supporterid, $case, $low, $edit, $order) {
	global $mysql_tickets_table, $mysql_tracktime_table, $tickets_limit;
	switch($case) {
		case ("administrator"):
			$sql = "select t1.ticket_id, t2.title, max(t1.date_logged) as last_updated, sum(t1.minutes) as time_worked, t2.status_id from $mysql_tracktime_table as t1 left join $mysql_tickets_table as t2 on t1.ticket_id=t2.id group by t1.ticket_id order by t2.title $order limit $low, $tickets_limit";
			break;
		default:
			$sql = "select t1.ticket_id, t2.title, max(t1.date_logged) as last_updated, sum(t1.minutes) as time_worked, t2.status_id from $mysql_tracktime_table as t1 left join $mysql_tickets_table as t2 on t1.ticket_id=t2.id where t1.supporter_id='$supporterid' group by t1.ticket_id order by t2.title $order limit $low, $tickets_limit";
	}
	displayTicketsTime($sql, $edit);
}

function listByDateUpdated($supporterid, $case, $low, $edit, $order) {
	global $mysql_tickets_table, $mysql_tracktime_table, $tickets_limit;
	switch($case) {
		case ("administrator"):
			$sql = "select t1.ticket_id, t2.title, max(t1.date_logged) as last_updated, sum(t1.minutes) as time_worked, t2.status_id from $mysql_tracktime_table as t1 left join $mysql_tickets_table as t2 on t1.ticket_id=t2.id group by t1.ticket_id order by last_updated $order limit $low, $tickets_limit";
			break;
		default:
			$sql = "select t1.ticket_id, t2.title, max(t1.date_logged) as last_updated, sum(t1.minutes) as time_worked, t2.status_id from $mysql_tracktime_table as t1 left join $mysql_tickets_table as t2 on t1.ticket_id=t2.id where t1.supporter_id='$supporterid' group by t1.ticket_id order by last_updated $order limit $low, $tickets_limit";
	}
	displayTicketsTime($sql, $edit);
}

function listByHoursWorked($supporterid, $case, $low, $edit, $order) {
	global $mysql_tickets_table, $mysql_tracktime_table, $tickets_limit;
	switch($case) {
		case ("administrator"):
			$sql = "select t1.ticket_id, t2.title, max(t1.date_logged) as last_updated, sum(t1.minutes) as time_worked, t2.status_id from $mysql_tracktime_table as t1 left join $mysql_tickets_table as t2 on t1.ticket_id=t2.id group by t1.ticket_id order by time_worked $order limit $low, $tickets_limit";
			break;
		default:
			$sql = "select t1.ticket_id, t2.title, max(t1.date_logged) as last_updated, sum(t1.minutes) as time_worked, t2.status_id from $mysql_tracktime_table as t1 left join $mysql_tickets_table as t2 on t1.ticket_id=t2.id where t1.supporter_id='$supporterid' group by t1.ticket_id order by time_worked $order limit $low, $tickets_limit";
	}
	displayTicketsTime($sql, $edit);
}

function listByStatus($supporterid, $case, $low, $edit, $order) {
	global $mysql_tickets_table, $mysql_tracktime_table, $tickets_limit;
	switch($case) {
		case ("administrator"):
			$sql = "select t1.ticket_id, t2.title, max(t1.date_logged) as last_updated, sum(t1.minutes) as time_worked, t2.status_id from $mysql_tracktime_table as t1 left join $mysql_tickets_table as t2 on t1.ticket_id=t2.id group by t1.ticket_id order by t2.status_id $order limit $low, $tickets_limit";
			break;
		default:
			$sql = "select t1.ticket_id, t2.title, max(t1.date_logged) as last_updated, sum(t1.minutes) as time_worked, t2.status_id from $mysql_tracktime_table as t1 left join $mysql_tickets_table as t2 on t1.ticket_id=t2.id where t1.supporter_id='$supporterid' group by t1.ticket_id order by t2.status_id $order limit $low, $tickets_limit";
	}
	displayTicketsTime($sql, $edit);
}

function displayTicketsTime($sql, $edit) {
	$result = execsql($sql);
	$counter = 0;
	while($row = mysql_fetch_row($result)) {
		$ticketid = $row[0];
		$title = $row[1];
		$lastupdated = date("m/d/y \a\\t g:ia",$row[2]);
		$timeworked = round($row[3]/60,2);
		$status = getStatus($row[4]);
		displayTicketTimeLine($ticketid, $title, $status, $timeworked, $lastupdated, $edit, $counter);
		$counter++;
	}
}

function getNumberOfPossibleTickets($id, $case) {
	global $mysql_tracktime_table;
	switch($case) {
		case ("administrator"):
			$sql = "select distinct ticket_id from $mysql_tracktime_table";
			break;
		default:
			$sql = "select distinct ticket_id from $mysql_tracktime_table where supporter_id='$id'";
			break;
	}
	$result = execsql($sql);
	$num_rows = mysql_num_rows($result);
	return $num_rows;
}

/***********************************************************************************************************
**	function displayTicketTimeLine():
************************************************************************************************************/
function displayTicketTimeLine($id, $title, $status, $timeworked, $lastupdated, $edit, $counter) {
	echo '
		<tr>
			<td class=back2 align=center>'. str_pad($id, 5, "0", STR_PAD_LEFT) .'</td>
			<td class=back>
				<a href=index.php?t=tickettime&id='. $id .'>'. $title .'</a>
			</td>
			<td class=back2 align=center>'. $status .'</td>
			<td class=back align=right>'; printf("%.2f", $timeworked); echo '</td>
			<td class=back2 align=center>'. $lastupdated .'</td>';
	if(isset($edit)) {
		echo '
			<td class=back align=center><input type=hidden name=ticket_id'. $counter .' value='. $id .'><input type=text size=5 name=minutes_worked'. $counter .'></td>';
	}
	echo '
		</tr>';
}


?>