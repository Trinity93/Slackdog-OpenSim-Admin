<?php
/*******************************************************************************
**	file:	contactsearch.php
********************************************************************************
**	author:	Luis Bernardo
**	date:	10 Dec 2003
********************************************************************************
**	$Revision: 1.6 $ on $Date: 2004/03/10 05:40:50 $ by $Author: lmpmbernardo $
*******************************************************************************/

$contact = $_POST['contact'];
$company = $_POST['company'];
$keyword = $_POST['keyword'];
$number = $_POST['number'];
$search = $_POST['search'];

if(isset($search)) {
//	$sql = "select t1.id, t1.contact_id, t1.company_id, t1.priority_id, t1.status_id, t1.title, t1.date_modified from $mysql_tickets_table as t1, $mysql_companies_table as t2, $mysql_people_table as t3 where t1.company_id=t2.id and t1.contact_id=t3.id and t2.company_name like '%$company%' and t3.last_name like '%$contact%' and t1.title like '%$keyword%' order by t1.id asc";
	if(isset($keyword) && $keyword !='') {
		$sql = "select t1.id, t1.contact_id, t1.company_id, t1.priority_id, t1.status_id, t1.title, t1.date_modified from $mysql_tickets_table as t1, $mysql_companies_table as t2, $mysql_people_table as t3 where match(t1.title, t1.description, t1.update_log) against('$keyword') and t1.company_id=t2.id and t1.contact_id=t3.id and t2.company_name like '%$company%' and t3.last_name like '%$contact%' order by t1.id asc";
	} else {
		$sql = "select t1.id, t1.contact_id, t1.company_id, t1.priority_id, t1.status_id, t1.title, t1.date_modified from $mysql_tickets_table as t1, $mysql_companies_table as t2, $mysql_people_table as t3 where t1.company_id=t2.id and t1.contact_id=t3.id and t2.company_name like '%$company%' and t3.last_name like '%$contact%' order by t1.id asc";
	}
	if(isset($number) && $number != '') {
		$sql = "select t1.id, t1.contact_id, t1.company_id, t1.priority_id, t1.status_id, t1.title, t1.date_modified from $mysql_tickets_table as t1 where t1.id='$number'";
	}
	$header = $lang[ticket_search];
	$headrow = array();
	array_push($headrow, $lang['id']);
	array_push($headrow, $lang['title']);
	array_push($headrow, $lang['client']);
	array_push($headrow, $lang['contact']);
	array_push($headrow, $lang['priority']);
	array_push($headrow, $lang['updated']);
	array_push($headrow, $lang['status']);
	$align = array('center', 'left', 'left', 'left', 'center', 'center', 'center');
	$rows = array();
	$result = execsql($sql);
	$counter = 0;
	while($row = mysql_fetch_row($result)) {
		$ticketid = $row[0];
		$displayid = str_pad($ticketid, 5, "0", STR_PAD_LEFT);
		$title = $row[5];
		$title = outputURL("detailticket&id=$ticketid", $title);
		$company = getCompanyInfo($row[2]);
		$client = $company['company_name'];
		$contact = getPersonName($row[1]);
		$priority = getPriority($row[3]);
		$status = getStatus($row[4]);
		$updated = date($dateformat, $row[6]);
		$row = array($displayid, $title, $client, $contact, $priority, $updated, $status);
		array_push($rows, $row);
		$counter++;
	}
	$msg = $lang[records_found] . "<b>$counter</b>";
	// start html output
	outputSimpleTable($header, $headrow, $rows, $align, $msg);
	// end html output
} else {
	echo '
	<form action=index.php?t=ticketsearch method=post>
	<table class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
		<tr>
			<td>
				<table cellSpacing=1 cellPadding=5 width="100%" border=0>
					<tr>
						<td class=info colspan=100% align=middle><b>'.$lang['ticket_search'].'</b></td>
					</tr>
					<tr>
						<td class=back colspan=100%>
							<table class=border cellSpacing=0 cellPadding=0 width=100% align=center border=0>
								<tr>
									<td>
										<table cellSpacing=1 cellPadding=5 width="100%" border=0>
					<tr>
						<td colspan=2 class=cat>
							'.$lang['text_ticket_search'].'
						</td>
					</tr>
					<tr>
						<td class=cat align=right width=20%><b> '.$lang['contact'].': </b></td><td class=back><input type=text name=contact></td>
					</tr>
					<tr>
						<td class=cat align=right width=20%><b> '.$lang['company'].': </b></td><td class=back><input type=text name=company></td>
					</tr>
					<tr>
						<td class=cat align=right width=20%><b> '.$lang['keyword'].': </b></td><td class=back><input type=text name=keyword></td>
					</tr>
					<tr>
						<td class=cat align=right width=20%><b> '.$lang['number'].': </b></td><td class=back><input type=text name=number></td>
					</tr>
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
	<center>
		<input type=submit name=search value="'.$lang['search'].'">
	</center>
	</form>';
}

?>