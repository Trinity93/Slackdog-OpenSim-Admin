<?php
/*******************************************************************************
**	file:	ticketstatisticsreport.php
********************************************************************************
**	author:	Luis Bernardo
**	date:	2003/12/10
********************************************************************************
**	$Revision: 1.6 $ on $Date: 2004/02/02 05:26:06 $ by $Author: lmpmbernardo $
*******************************************************************************/

// although this was originally planned to display both aggregate stats and individual stats I don't
// think it makes much sense for individual stats. so it won't be used.

$refresh = $_POST['refresh'];
$enddatelabel = $_POST['enddatelabel'];
$startdatelabel = $_POST['startdatelabel'];

if(isset($case) && $case == 'supporter') {
	$id = getPersonID($cookie_name);
}

if(!isset($refresh)) {
	$enddate = time();
	$startdate = $enddate - 86400*30; // 30 days ago by default
	$enddatelabel = date("m/d/y", $enddate);
	$startdatelabel = date("m/d/y", $startdate);
} else {
	$enddateelements = explode("/", $enddatelabel);
	$startdateelements = explode("/", $startdatelabel);
	$enddate = 	mktime(0, 0, 0, $enddateelements[0], $enddateelements[1], $enddateelements[2]) + 86399; // make it 11:59:59 pm
	$startdate = 	mktime(0, 0, 0, $startdateelements[0], $startdateelements[1], $startdateelements[2]);
	// if you try to be funny and enter enddate < startdate...
	if($enddate < $startdate) {
		$enddate = time();
		$startdate = $enddate - 86400*30; // 30 days ago by default
		$enddatelabel = date("m/d/y", $enddate);
		$startdatelabel = date("m/d/y", $startdate);
	}
}

if(!isset($id) || $id == '') {
	$header = $lang['ticket_statistics'].": " . $startdatelabel . " to " . $enddatelabel;
} else {
	$header = $lang['ticket_statistics_for']." ". getPersonName($id) . ": " . $startdatelabel . " to " . $enddatelabel;
}

echo '
	<form action=index.php?t=ticketstatisticsreport method=post>
		<table class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
			<tr>
				<td>
					<table cellSpacing=1 cellPadding=5 width="100%" border=0>
						<tr>
							<td class=info align=middle><b>'.$header.'</b></td>
						</tr>
						<tr>
							<td class=back>';
								showTicketStatisticsReport($id, $startdate, $enddate);
								echo '<br/>';
								showTicketLifetimesReport($id, $startdate, $enddate); echo '
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<br>
		<center>
			<b>'.$lang['from'].':</b>&nbsp;<input type=text size=9 name=startdatelabel value='. $startdatelabel .'>&nbsp;&nbsp;
			<b>'.$lang['to'].':</b>&nbsp;<input type=text size=9 name=enddatelabel value='. $enddatelabel .'>&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;<input type=submit name=refresh value="'.$lang['refresh'].'">
		</center>
	</form>';

function showTicketStatisticsReport($id, $startdate, $enddate) {
	global $mysql_tpriorities_table, $mysql_tcategories_table, $mysql_people_table, $theme;
    // [15/12/2003 seh]
    global $lang;
    // [/seh]
	$openatstartdate = getNumberOfOpenTicketsOnDate($id, $startdate);
	$closedbetweendates = getNumberOfTicketsClosedBetweenDates($id, $startdate, $enddate);
	$openedbetweendates = getNumberOfTicketsOpenedBetweenDates($id, $startdate, $enddate);
	$openatenddate = getNumberOfOpenTicketsOnDate($id, $enddate);
	$total = max($openatstartdate, $closedbetweendates, $openedbetweendates, $openatenddate);
	echo '
		<table class=border cellSpacing=0 cellPadding=0 width=100% align=center border=0>
			<tr>
				<td>
					<table cellSpacing=1 cellPadding=5 width="100%" border=0>
						<tr>
							<td class=info colspan=5 align=center>
								<b>'.$lang['ticket_pipeline'].'</b>
							</td>
						</tr>
		<tr>
			<td class=cat width=20% align=center><b>'.$lang['case'].'</b></td>
			<td class=cat width=20% align=center><b>'.$lang['open'].' '. date("m/d/y", $startdate) .'</b></td>
			<td class=cat width=20% align=center><b>'.$lang['opened_during'].'</b></td>
			<td class=cat width=20% align=center><b>'.$lang['closed_during'].'</b></td>
			<td class=cat width=20% align=center><b>'.$lang['open'].' '. date("m/d/y", $enddate) .'</b></td>
		</tr>
		<tr>
			<td class=back>'.$lang['all'].'</td>
			<td class=back align=right>'; outputBar($openatstartdate, $total); echo '</td>
			<td class=back align=right>'; outputBar($openedbetweendates, $total); echo '</td>
			<td class=back align=right>'; outputBar($closedbetweendates, $total); echo '</td>
			<td class=back align=right>'; outputBar($openatenddate, $total); echo '</td>
		</tr>';
	echo '
		<tr>
			<td class=back2 colspan=5 align=center><b>'.$lang['priorities'].'</b></td>
		</tr>';
	$sql = "select id, priority from $mysql_tpriorities_table";
	$result = execsql($sql);
	while($row = mysql_fetch_row($result)) {
		echo '
		<tr>
			<td class=back>'. $row[1] .'</td>
			<td class=back align=right>'; outputBar(getNumberOfOpenTicketsOnDateByPriority($id, $startdate, $row[0]), $total); echo '</td>
			<td class=back align=right>'; outputBar(getNumberOfTicketsOpenedBetweenDatesByPriority($id, $startdate, $enddate, $row[0]), $total); echo '</td>
			<td class=back align=right>'; outputBar(getNumberOfTicketsClosedBetweenDatesByPriority($id, $startdate, $enddate, $row[0]), $total); echo '</td>
			<td class=back align=right>'; outputBar(getNumberOfOpenTicketsOnDateByPriority($id, $enddate, $row[0]), $total); echo '</td>
		</tr>';
	}
	echo '
		<tr>
			<td class=back2 colspan=5 align=center><b>'.$lang['categories'].'</b></td>
		</tr>';
	$sql = "select id, category from $mysql_tcategories_table";
	$result = execsql($sql);
	while($row = mysql_fetch_row($result)) {
		echo '
		<tr>
			<td class=back>'. $row[1] .'</td>
			<td class=back align=right>'; outputBar(getNumberOfOpenTicketsOnDateByCategory($id, $startdate, $row[0]), $total); echo '</td>
			<td class=back align=right>'; outputBar(getNumberOfTicketsOpenedBetweenDatesByCategory($id, $startdate, $enddate, $row[0]), $total); echo '</td>
			<td class=back align=right>'; outputBar(getNumberOfTicketsClosedBetweenDatesByCategory($id, $startdate, $enddate, $row[0]), $total); echo '</td>
			<td class=back align=right>'; outputBar(getNumberOfOpenTicketsOnDateByCategory($id, $enddate, $row[0]), $total); echo '</td>
		</tr>';
	}
	/**
	if(!isset($id) || $id == '') {
		echo '
			<tr>
				<td class=back2 colspan=100% align=center><b>Supporters</b></td>
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
	**/
	echo '
					</table>
				</td>
			</tr>
		</table>';
}

function showTicketLifetimesReport($id, $startdate, $enddate) {
	global $mysql_tpriorities_table, $mysql_tcategories_table, $mysql_people_table, $theme;
    // [15/12/2003 seh]
    global $lang;
    // [/seh]
	$closedbetweendates = getNumberOfTicketsClosedBetweenDates($id, $startdate, $enddate);
	$openatenddate = getNumberOfOpenTicketsOnDate($id, $enddate);
	$total = max($closedbetweendates, $openatenddate);
	echo '
		<table class=border cellSpacing=0 cellPadding=0 width=100% align=center border=0>
			<tr>
				<td>
					<table cellSpacing=1 cellPadding=5 width="100%" border=0>
						<tr>
							<td class=info colspan=6 align=center>
								<b>'.$lang['avg_ticket_lifetime_weeks'].'</b>
							</td>
						</tr>
		<tr>
			<td class=cat width=10% align=center><b>'.$lang['case'].'</b></td>
			<td class=cat width=18% align=center><b>'.$lang['less_1'].'</b></td>
			<td class=cat width=18% align=center><b>'.$lang['1_2'].'</b></td>
			<td class=cat width=18% align=center><b>'.$lang['2_3'].'</b></td>
			<td class=cat width=18% align=center><b>'.$lang['3_4'].'</b></td>
			<td class=cat width=18% align=center><b>'.$lang['more_4'].'</b></td>
		</tr>
		<tr>
			<td class=back>'.$lang['closed'].'</td>
			<td class=back align=right>'; outputBar(weekHistogramOfClosedTicketsBetweenDates(1, $startdate, $enddate, "<="), $total); echo '</td>
			<td class=back align=right>'; outputBar(weekHistogramOfClosedTicketsBetweenDates(2, $startdate, $enddate), $total); echo '</td>
			<td class=back align=right>'; outputBar(weekHistogramOfClosedTicketsBetweenDates(3, $startdate, $enddate), $total); echo '</td>
			<td class=back align=right>'; outputBar(weekHistogramOfClosedTicketsBetweenDates(4, $startdate, $enddate), $total); echo '</td>
			<td class=back align=right>'; outputBar(weekHistogramOfClosedTicketsBetweenDates(4, $startdate, $enddate, ">"), $total); echo '</td>
		</tr>
		<tr>
			<td class=back>'.$lang['open'].'</td>
			<td class=back align=right>'; outputBar(weekHistogramOfOpenTicketsOnDate(1, $enddate, "<="), $total); echo '</td>
			<td class=back align=right>'; outputBar(weekHistogramOfOpenTicketsOnDate(2, $enddate), $total); echo '</td>
			<td class=back align=right>'; outputBar(weekHistogramOfOpenTicketsOnDate(3, $enddate), $total); echo '</td>
			<td class=back align=right>'; outputBar(weekHistogramOfOpenTicketsOnDate(4, $enddate), $total); echo '</td>
			<td class=back align=right>'; outputBar(weekHistogramOfOpenTicketsOnDate(4, $enddate, ">"), $total); echo '</td>
		</tr>
					</table>
				</td>
			</tr>
		</table>';
}

function weekHistogramOfClosedTicketsBetweenDates($week, $startdate, $enddate, $mode = "=") {
	// mode can be =, < or >
	global $mysql_tickets_table, $mysql_tstatus_table;
	$higheststatus = getHighestRank($mysql_tstatus_table); // highest rank corresponds to closed tickets
	$sql = "select count(*) from $mysql_tickets_table where status_id='$higheststatus' and date_modified>'$startdate' and date_modified<'$enddate' and ceiling((date_modified-date_created)/86400/7)$mode'$week'";
	$result = execsql($sql);
	$row = mysql_fetch_row($result);
	return $row[0];
}

function weekHistogramOfOpenTicketsOnDate($week, $ondate, $mode = "=") {
	// mode can be =, < or >
	global $mysql_tickets_table, $mysql_tstatus_table;
	$higheststatus = getHighestRank($mysql_tstatus_table); // highest rank corresponds to closed tickets
	$sql = "select count(*) from $mysql_tickets_table where date_created<'$ondate' and (status_id!='$higheststatus' or date_modified>'$ondate') and ceiling((unix_timestamp()-date_created)/86400/7)$mode'$week'";
	$result = execsql($sql);
	$row = mysql_fetch_row($result);
	return $row[0];
}

function getNumberOfOpenTicketsOnDate($id, $date) {
	// choose tickets created before date and closed after date or still open
	global $mysql_tickets_table, $mysql_tstatus_table;
	$higheststatus = getHighestRank($mysql_tstatus_table); // highest rank corresponds to closed tickets
	if(!isset($id) || $id == '') {
		$sql = "select count(id) from $mysql_tickets_table where date_created<'$date' and (status_id!='$higheststatus' or date_modified>'$date')";
	} else {
		$sql = "select count(id) from $mysql_tickets_table where date_created<'$date' and (status_id!='$higheststatus' or date_modified>'$date') and supporter_id=$id";
	}
	$result = execsql($sql);
	$row = mysql_fetch_row($result);
	return $row[0];
}

function getNumberOfOpenTicketsOnDateByPriority($id, $date, $priorityid) {
	// choose tickets created before date and closed after date or still open
	global $mysql_tickets_table, $mysql_tstatus_table;
	$higheststatus = getHighestRank($mysql_tstatus_table); // highest rank corresponds to closed tickets
	if(!isset($id) || $id == '') {
		$sql = "select count(id) from $mysql_tickets_table where date_created<'$date' and (status_id!='$higheststatus' or date_modified>'$date') and priority_id='$priorityid'";
	} else {
		$sql = "select count(id) from $mysql_tickets_table where date_created<'$date' and (status_id!='$higheststatus' or date_modified>'$date') and priority_id='$priorityid' and supporter_id=$id";
	}
	$result = execsql($sql);
	$row = mysql_fetch_row($result);
	return $row[0];
}

function getNumberOfOpenTicketsOnDateByCategory($id, $date, $categoryid) {
	// choose tickets created before date and closed after date or still open
	global $mysql_tickets_table, $mysql_tstatus_table;
	$higheststatus = getHighestRank($mysql_tstatus_table); // highest rank corresponds to closed tickets
	if(!isset($id) || $id == '') {
		$sql = "select count(id) from $mysql_tickets_table where date_created<'$date' and (status_id!='$higheststatus' or date_modified>'$date') and category_id='$categoryid'";
	} else {
		$sql = "select count(id) from $mysql_tickets_table where date_created<'$date' and (status_id!='$higheststatus' or date_modified>'$date') and category_id='$categoryid' and supporter_id=$id";
	}
	$result = execsql($sql);
	$row = mysql_fetch_row($result);
	return $row[0];
}

function getNumberOfTicketsOpenedBetweenDates($id, $startdate, $enddate) {
	// choose tickets created between two dates
	global $mysql_tickets_table;
	if(!isset($id) || $id == '') {
		$sql = "select count(id) from $mysql_tickets_table where date_created>'$startdate' and date_created<'$enddate'";
	} else {
		$sql = "select count(id) from $mysql_tickets_table where date_created>'$startdate' and date_created<'$enddate' and supporter_id=$id";
	}
	$result = execsql($sql);
	$row = mysql_fetch_row($result);
	return $row[0];
}

function getNumberOfTicketsOpenedBetweenDatesByPriority($id, $startdate, $enddate, $priorityid) {
	// choose tickets created between two dates
	global $mysql_tickets_table;
	if(!isset($id) || $id == '') {
		$sql = "select count(id) from $mysql_tickets_table where date_created>'$startdate' and date_created<'$enddate' and priority_id='$priorityid'";
	} else {
		$sql = "select count(id) from $mysql_tickets_table where date_created>'$startdate' and date_created<'$enddate' and priority_id='$priorityid' and supporter_id=$id";
	}
	$result = execsql($sql);
	$row = mysql_fetch_row($result);
	return $row[0];
}

function getNumberOfTicketsOpenedBetweenDatesByCategory($id, $startdate, $enddate, $categoryid) {
	// choose tickets created between two dates
	global $mysql_tickets_table;
	if(!isset($id) || $id == '') {
		$sql = "select count(id) from $mysql_tickets_table where date_created>'$startdate' and date_created<'$enddate' and category_id='$categoryid'";
	} else {
		$sql = "select count(id) from $mysql_tickets_table where date_created>'$startdate' and date_created<'$enddate' and category_id='$categoryid' and supporter_id=$id";
	}
	$result = execsql($sql);
	$row = mysql_fetch_row($result);
	return $row[0];
}

function getNumberOfTicketsClosedBetweenDates($id, $startdate, $enddate) {
	// choose tickets closed and with last updated between two dates
	global $mysql_tickets_table, $mysql_tstatus_table;
	$higheststatus = getHighestRank($mysql_tstatus_table); // highest rank corresponds to closed tickets
	if(!isset($id) || $id == '') {
		$sql = "select count(id) from $mysql_tickets_table where status_id='$higheststatus' and date_modified>'$startdate' and date_modified<'$enddate'";
	} else {
		$sql = "select count(id) from $mysql_tickets_table where  status_id='$higheststatus' and date_modified>'$startdate' and date_modified<'$enddate' and supporter_id=$id";
	}
	$result = execsql($sql);
	$row = mysql_fetch_row($result);
	return $row[0];
}

function getNumberOfTicketsClosedBetweenDatesByPriority($id, $startdate, $enddate, $priorityid) {
	// choose tickets closed and with last updated between two dates
	global $mysql_tickets_table, $mysql_tstatus_table;
	$higheststatus = getHighestRank($mysql_tstatus_table); // highest rank corresponds to closed tickets
	if(!isset($id) || $id == '') {
		$sql = "select count(id) from $mysql_tickets_table where status_id='$higheststatus' and date_modified>'$startdate' and date_modified<'$enddate' and priority_id='$priorityid'";
	} else {
		$sql = "select count(id) from $mysql_tickets_table where  status_id='$higheststatus' and date_modified>'$startdate' and date_modified<'$enddate' and priority_id='$priorityid' and supporter_id=$id";
	}
	$result = execsql($sql);
	$row = mysql_fetch_row($result);
	return $row[0];
}

function getNumberOfTicketsClosedBetweenDatesByCategory($id, $startdate, $enddate, $categoryid) {
	// choose tickets closed and with last updated between two dates
	global $mysql_tickets_table, $mysql_tstatus_table;
	$higheststatus = getHighestRank($mysql_tstatus_table); // highest rank corresponds to closed tickets
	if(!isset($id) || $id == '') {
		$sql = "select count(id) from $mysql_tickets_table where status_id='$higheststatus' and date_modified>'$startdate' and date_modified<'$enddate' and category_id='$categoryid'";
	} else {
		$sql = "select count(id) from $mysql_tickets_table where  status_id='$higheststatus' and date_modified>'$startdate' and date_modified<'$enddate' and category_id='$categoryid' and supporter_id=$id";
	}
	$result = execsql($sql);
	$row = mysql_fetch_row($result);
	return $row[0];
}

function getNumberOfClosedTicketsOnDate($id) {
	global $mysql_tickets_table, $mysql_tstatus_table;
	$higheststatus = getHighestRank($mysql_tstatus_table); // highest rank corresponds to closed tickets
	if(!isset($id) || $id == ''){
		$sql = "select count(id) from $mysql_tickets_table where status_id='$higheststatus'";
	} else {
		$sql = "select count(id) from $mysql_tickets_table where status_id='$higheststatus' and supporter_id=$id";
	}
	$result = execsql($sql);
	$row = mysql_fetch_row($result);
	return $row[0];
}

?>