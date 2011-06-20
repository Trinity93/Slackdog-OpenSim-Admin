<?php
/*******************************************************************************
**	file:	contactsearch.php
********************************************************************************
**	author:	Luis Bernardo
**	date:	10 Dec 2003
********************************************************************************
**	$Revision: 1.4 $ on $Date: 2004/02/12 04:34:04 $ by $Author: lmpmbernardo $
*******************************************************************************/

$search = $_POST['search'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$company = $_POST['company'];
$phone = $_POST['phone'];

if(isset($search)) {
	$sql = "select t1.id, t2.id, t1.last_name, t1.first_name, t2.company_name, t1.email, t1.phone from $mysql_people_table as t1, $mysql_companies_table as t2 where t1.company_id=t2.id and t1.first_name like '%$first_name%' and t1.last_name like '%$last_name%' and t1.email like '%$email%' and t1.phone like '%$phone%' and t2.company_name like '%$company%' and t1.user='1' and t1.id!='1' order by t1.last_name asc";
	$title = $lang[contact_search];
	$rows = array();
	$headrow = array($lang[last_first_name], $lang[company], $lang[email], $lang[phone]);
	$align = array('left', 'left', 'left', 'left');
	// choose only contacts (user = 1), avoid default contact
	$r = execsql($sql);
	$counter = 0;
	while($newrow = mysql_fetch_row($r)) {
		$name = $newrow[2] . ", " . $newrow[3];
		$name = outputURL("detailcontact&id=$newrow[0]", $name);
		$company = $newrow[4];
		$company = outputURL("detailcompany&id=$newrow[1]", $company);
		$email = $newrow[5];
		$email = "<a href=mailto:$email>$email</a>";
		$row = array($name, $company, $email, $newrow[6]);
		array_push($rows, $row);
		$counter++;
	}
	$msg = $lang[records_found] . "<b>$counter</b>";
	// start html output
	outputSimpleTable($title, $headrow, $rows, $align, $msg);
	// end html output
} else {
	echo '
	<form action=index.php?t=contactsearch method=post>
	<table class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
		<tr>
			<td>
				<table cellSpacing=1 cellPadding=5 width="100%" border=0>
					<tr>
						<td class=info colspan=100% align=middle><b>'.$lang['contact_search'].'</b></td>
					</tr>
					<tr>
						<td class=back colspan=100%>
							<table class=border cellSpacing=0 cellPadding=0 width=100% align=center border=0>
								<tr>
									<td>
										<table cellSpacing=1 cellPadding=5 width="100%" border=0>
					<tr>
						<td colspan=2 class=cat>
							'.$lang['text_contact_search'].'
						</td>
					</tr>
					<tr>
						<td class=cat align=right width=20%><b> '.$lang['first_name'].': </b></td><td class=back><input type=text name=first_name></td>
					</tr>
					<tr>
						<td class=cat align=right width=20%><b> '.$lang['last_name'].': </b></td><td class=back><input type=text name=last_name></td>
					</tr>
					<tr>
						<td class=cat align=right width=20%><b> '.$lang['email'].': </b></td><td class=back><input type=text name=email></td>
					</tr>
					<tr>
						<td class=cat align=right width=20%><b> '.$lang['company'].': </b></td><td class=back><input type=text name=company></td>
					</tr>
					<tr>
						<td class=cat align=right width=20%><b> '.$lang['phone'].': </b></td><td class=back><input type=text name=phone></td>
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