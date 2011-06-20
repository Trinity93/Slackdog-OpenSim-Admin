<?php
/*******************************************************************************
**	file:	tickettime.php
********************************************************************************
**	author:	Luis Bernardo
**	date:	2003/12/10
********************************************************************************
**	$Revision: 1.4 $ on $Date: 2004/02/02 05:26:06 $ by $Author: lmpmbernardo $
*******************************************************************************/

$id = $_GET['id'];

$header = $lang['track_time_ticket_id'] . str_pad($id, 5, "0", STR_PAD_LEFT);

echo '
	<table class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
		<tr>
			<td class=info>
				<table cellSpacing=1 cellPadding=5 width="100%" border=0>
					<tr>
						<td class=info align=center><b>'. $header .'</b></td>
					</tr>
					<tr>
						<td class=back>
							<table class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
								<tr>
									<td>
										<table cellSpacing=1 cellPadding=5 width="100%" border=0>
											<tr>
												<td class=cat align=center><b> '.$lang['supporter'].' </b></td>
												<td class=cat align=center><b> '.$lang['hours_worked'].' </b></td>
												<td class=cat align=center><b> '.$lang['last_updated'].' </b></td>
											</tr>'; listSupportersTime($id); echo '
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>';

function listSupportersTime($id) {
	global $mysql_tracktime_table;
	$sql = "select supporter_id, sum(minutes) as time_worked, max(date_logged) as last_updated from $mysql_tracktime_table where ticket_id='$id' group by supporter_id order by last_updated desc";
	displaySupportersTime($sql);
}

function displaySupportersTime($sql) {
	$result = execsql($sql);
	while($row = mysql_fetch_row($result)) {
		$supporterid = $row[0];
		$supportername = getPersonName($supporterid);
		$lastupdated = date($datetimeformat, $row[2]);
		$timeworked = round($row[1]/60,2);
		displaySupporterTimeLine($supportername, $timeworked, $lastupdated);
	}
}

function displaySupporterTimeLine($supportername, $timeworked, $lastupdated) {
	echo '
		<tr>
			<td class=back2 align=left>'. $supportername .'</td>
			<td class=back align=right>'; printf("%.2f", $timeworked); echo '</td>
			<td class=back2 align=center>'. $lastupdated .'</td>
		</tr>';
}

?>