<?php
/*******************************************************************************
**	file:	ticketstatistics.php
********************************************************************************
**	author:	Luis Bernardo
**	date:	2003/12/10
********************************************************************************
**	$Revision: 1.4 $ on $Date: 2003/12/19 06:05:17 $ by $Author: lmpmbernardo $
*******************************************************************************/

$id = $_GET['id'];
$case = $_GET['case'];

if(isset($case) && $case == 'supporter') {
	$id = getPersonID($cookie_name);
}

if(!isset($id) || $id == '') {
	$header = $lang['ticket_statistics'];
} else {
	$header = $lang['ticket_statistics_for'] . getPersonName($id);
}
echo '
	<table class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
		<tr>
			<td>
				<table cellSpacing=1 cellPadding=5 width="100%" border=0>
					<tr>
						<td class=info align=middle><b>'.$header.'</b></td>
					</tr>
					<tr>
						<td class=back>';
							showTicketStatistics($id); echo '
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>';

function showTicketStatistics($id) {
	global $mysql_tpriorities_table, $mysql_tcategories_table, $mysql_people_table, $theme;
    // [15/12/2003 seh]
    global $lang;
    // [/seh]
	$total = getNumberOfTickets($id);
	$open = getNumberOfOpenTickets($id);
	$closed = getNumberOfClosedTickets($id);
	echo '
		<table class=border cellSpacing=0 cellPadding=0 width=100% align=center border=0>
			<tr>
				<td>
					<table cellSpacing=1 cellPadding=5 width="100%" border=0>';
	echo '
		<tr>
			<td class=cat width=19% align=center><b>'.$lang['case'].'</b></td>
			<td class=cat width=27% align=center><b>'.$lang['open'].'</b></td>
			<td class=cat width=27% align=center><b>'.$lang['closed'].'</b></td>
			<td class=cat width=27% align=center><b>'.$lang['total'].'</b></td>
		</tr>
		<tr>
			<td class=back>'.$lang['all'].'</td>
			<td class=back align=right>'; outputBar($open, $total); echo '</td>
			<td class=back align=right>'; outputBar($closed, $total); echo '</td>
			<td class=back align=right>'; outputBar($total, $total); echo '</td>
		</tr>';
	echo '
		<tr>
			<td class=back2 colspan=4 align=center><b>'.$lang['priorities'].'</b></td>
		</tr>';
	$sql = "select id, priority from $mysql_tpriorities_table";
	$result = execsql($sql);
	while($row = mysql_fetch_row($result)) {
		echo '
		<tr>
			<td class=back>'. $row[1] .'</td>
			<td class=back align=right>'; outputBar(getNumberOfTicketsByPriority($id, $row[0], "open"), $open); echo '</td>
			<td class=back align=right>'; outputBar(getNumberOfTicketsByPriority($id, $row[0], "closed"), $closed); echo '</td>
			<td class=back align=right>'; outputBar(getNumberOfTicketsByPriority($id, $row[0], "total"), $total); echo '</td>
		</tr>';
	}
	echo '
		<tr>
			<td class=back2 colspan=4 align=center><b>'.$lang['categories'].'</b></td>
		</tr>';
	$sql = "select id, category from $mysql_tcategories_table";
	$result = execsql($sql);
	while($row = mysql_fetch_row($result)) {
		echo '
		<tr>
			<td class=back>'. $row[1] .'</td>
			<td class=back align=right>'; outputBar(getNumberOfTicketsByCategory($id, $row[0], "open"), $open); echo '</td>
			<td class=back align=right>'; outputBar(getNumberOfTicketsByCategory($id, $row[0], "closed"), $closed); echo '</td>
			<td class=back align=right>'; outputBar(getNumberOfTicketsByCategory($id, $row[0], "total"), $total); echo '</td>
		</tr>';
	}
	if(!isset($id) || $id == '') {
		echo '
			<tr>
				<td class=back2 colspan=4 align=center><b>'.$lang['supporters'].'</b></td>
			</tr>';
		$sql = "select id, first_name, last_name from $mysql_people_table where supporter='1'";
		$result = execsql($sql);
		while($row = mysql_fetch_row($result)) {
			echo '
			<tr>
				<td class=back><a href=index.php?t=ticketstatistics&id='. $row[0] .'>'. $row[1] . " " . $row[2] .'</td>
				<td class=back align=right>'; outputBar(getNumberOfOpenTickets($row[0]), $open); echo '</td>
				<td class=back align=right>'; outputBar(getNumberOfClosedTickets($row[0]), $closed); echo '</td>
				<td class=back align=right>'; outputBar(getNumberOfTickets($row[0]), $total); echo '</td>
			</tr>';
		}
	}
	echo '
					</table>
				</td>
			</tr>
		</table>';
}

function getNumberOfTicketsByPriority($id, $priorityid, $case) {
	global $mysql_tickets_table, $mysql_tstatus_table, $mysql_tpriorities_table;
	$higheststatus = getHighestRank($mysql_tstatus_table); // highest rank corresponds to closed tickets
	if(!isset($id) || $id == '') {
		$extra = "";
	} else {
		$extra = " and supporter_id='$id'";
	}
	switch($case) {
		case ("open"):
			$sql = "select count(priority_id) from $mysql_tickets_table where priority_id='$priorityid'" . $extra . " and status_id!='$higheststatus'";
			break;
		case ("closed"):
			$sql = "select count(priority_id) from $mysql_tickets_table where priority_id='$priorityid'" . $extra . " and status_id='$higheststatus'";
			break;
		default:
			$sql = "select count(priority_id) from $mysql_tickets_table where priority_id='$priorityid'" . $extra;
			break;
	}
	$result = execsql($sql);
	$row = mysql_fetch_row($result);
	return $row[0];
}

function getNumberOfTicketsByCategory($id, $categoryid, $case) {
	global $mysql_tickets_table, $mysql_tstatus_table, $mysql_tcategories_table;
	$higheststatus = getHighestRank($mysql_tstatus_table); // highest rank corresponds to closed tickets
	if(!isset($id) || $id == '') {
		$extra = "";
	} else {
		$extra = " and supporter_id='$id'";
	}
	switch($case) {
		case ("open"):
			$sql = "select count(category_id) from $mysql_tickets_table where category_id='$categoryid'" . $extra . " and status_id!='$higheststatus'";
			break;
		case ("closed"):
			$sql = "select count(category_id) from $mysql_tickets_table where category_id='$categoryid'" . $extra . " and status_id='$higheststatus'";
			break;
		default:
			$sql = "select count(category_id) from $mysql_tickets_table where category_id='$categoryid'" . $extra;
			break;
	}
	$result = execsql($sql);
	$row = mysql_fetch_row($result);
	return $row[0];
}
?>