<?php
/*******************************************************************************
**	file:	viewcontacts.php
********************************************************************************
**	author:	Luis Bernardo
**	date: 2003/12/10
********************************************************************************
**	$Revision: 1.6 $ on $Date: 2004/03/01 06:06:04 $ by $Author: lmpmbernardo $
*******************************************************************************/

$action = $_GET['action'];
$id = $_GET['id'] ? $_GET['id'] : $_POST['id'];
$confirmdelete = $_POST['confirmdelete'];
$orderby = $_GET['orderby'] ? $_GET['orderby'] : $_POST['orderby'];
$offset = isset($_GET['offset']) ? $_GET['offset'] : 0;
if(isset($_GET['letter'])) {
	$letter = $_GET['letter'];
	$offset = getContactsAlphabeticIndex($letter);
}
if(isset($_GET['cletter'])) {
	$cletter = $_GET['cletter'];
	$offset = getContactsCompanyAlphabeticIndex($cletter);
}
if(!isset($orderby)) $orderby = "last_name";


if(isset($confirmdelete) && $id != '1') {
	// first find the company where the contact is
	$info = getPeopleInfo($id);
	$company_id = $info['company_id'];
	$name = $info['first_name'] . " " . $info['last_name'];
	if($company_id != 1) {
		// get id of logged in user (supporter)
		$supporter_id = getPersonID($cookie_name);
		// time contact modified
		$time = time();
		// then move contact to "Inactive Contacts" company
		$sql = "update $mysql_people_table set company_id='1', author_id='$supporter_id', date_modified='$time' where id='$id'";
		execsql($sql);
		// then make sure data in old company is consistent, and in the new company too (not necessary for Inactive Contacts though)
		contactMovedToCompany($id, '1', $supporter_id, $time);
		contactRemovedFromCompany($id, $company_id, $supporter_id, $time);
	}
	// then remove contact from people table
	$sql = "delete from $mysql_people_table where id=$id";
	execsql($sql);
	$success_message = "\"$name\" ".$lang['msg_deleted_successfully'];
	printSuccess($success_message);
} else if($action == 'delete' && $id != '1' && !isset($cancel)) {
	echo '
	<form action=index.php?t=viewcontacts method=post>
		<table class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
			<tr>
				<td>
					<table cellSpacing=1 cellPadding=5 width="100%" border=0>
						<tr>
							<td class=info colspan=100% align=middle>
								<b>'.$lang['confirmation'].'</b>
							</td>
						</tr>
	<tr>
		<td class=back colspan=100%>
			<table class=border cellSpacing=0 cellPadding=0 width=100% align=center border=0>
 				<tr>
					<td>
						<table cellSpacing=1 cellPadding=5 width="100%" border=0>
							<tr>
								<td class=back2>
									<br><center><b><font color=red>'.$lang['q_are_you_sure'].'</font><br/>
									'.$lang['msg_warning_del_contact'].'</b></center><br>
								</td>
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
		<input type=hidden name=id value='. $id .'><br>
		<center>
			<input type=submit name=confirmdelete value='.$lang['delete'].'>&nbsp;&nbsp;
			<input type=submit name=cancel value='.$lang['cancel'].'>
		</center>
	</form>';
} else {
	$actionlink = "viewcontacts";
	$label = $lang[sort_by];
	// build drop down menu
	$ddmenu = array();
	array_push($ddmenu, array('orderby', $orderby));
	array_push($ddmenu, array('id', $lang[id]));	
	array_push($ddmenu, array('last_name', $lang[last_name]));	
	array_push($ddmenu, array('company_name', $lang[company_name]));
	// build inner tables
	$innertables = getArrayOfContacts($orderby, $offset, $users_limit);
	// build navigation links	
	$maxoffset = getNumberOfContacts();
	$link = "viewcontacts&orderby=$orderby&offset=";
	if($orderby == 'last_name') {
		$midlink = "viewcontacts&orderby=$orderby&letter=";
	} else if($orderby == 'company_name') {
		$midlink = "viewcontacts&orderby=$orderby&cletter=";
	} else {
		$midlink = false;
	}
	// start html output
	outputSortByFormTable($actionlink, $label, &$ddmenu, $innertables);
	outputNavigationLink($offset, $maxoffset, $users_limit, $link, $midlink);
	// end html output	
}

/***********************************************************************************************************
**	function getArrayOfContacts():
************************************************************************************************************/
function &getArrayOfContacts($order, $offset, $limit) {
	global $mysql_people_table, $mysql_companies_table, $lang;
	$low = $offset;
	$arraytables = array();
	// company id = 2 is supporters company and we don't want to list its contacts...., neither default contact with id = 1
	switch($order) {
		case ("last_name"):
			$sql = "select t1.*, t2.company_name from $mysql_people_table as t1, $mysql_companies_table as t2 where t1.company_id != '2' and t1.id != '1' and t1.company_id=t2.id order by t1.last_name asc limit $low, $limit";
			break;
		case ("company_name"):
			$sql = "select t1.*, t2.company_name from $mysql_people_table as t1, $mysql_companies_table as t2 where t1.company_id != '2' and t1.id != '1' and t1.company_id=t2.id order by t2.company_name asc limit $low, $limit";
			break;
		default:
			$sql = "select t1.*, t2.company_name from $mysql_people_table as t1, $mysql_companies_table as t2 where t1.company_id != '2' and t1.id != '1' and t1.company_id=t2.id order by t1.id asc limit $low, $limit";
			break;
	}
	$r = execsql($sql);
	//get all of the data into readable variables.
	while($row = mysql_fetch_array($r)) {
		$id = $row['id'];
		$first = ucwords($row['first_name']);
		$last = ucwords($row['last_name']);
		$user_name = $row['user_name'];
		$email = $row['email'];
		$email = "<a href=mailto:$email>$email</a>";
		$phone = $row['phone'];
		$company = $row['company_name'];
		$company_id = $row['company_id'];
		// store data in array
		$innertable = array();
		$arraylinks = array();
		array_push($arraylinks, outputURL("detailcontact&id=$id", $lang[detail], "info"));
		array_push($arraylinks, outputURL("editcontact&id=$id", $lang[edit], "info"));
		array_push($arraylinks, outputURL("viewcontacts&action=delete&id=$id", $lang[delete], "info"));
		array_push($arraylinks, outputURL("createticket&client_id=$company_id&contact_id=$id", $lang[create_ticket], "info"));
		array_push($arraylinks, outputURL("viewtickets&case=person&id=$id", $lang[view_tickets], "info"));
		$links = outputArrayOfLinks($arraylinks);
		$row = array($lang[contact_id].": $id", $links);
		array_push($innertable, $row);
		$row = array($lang[name], "$first $last");
		array_push($innertable, $row);
		$row = array($lang[email], $email);
		array_push($innertable, $row);
		$row = array($lang[phone], $phone);
		array_push($innertable, $row);
		$row = array($lang[company], outputURL("detailcompany&id=$company_id", $company));
		array_push($innertable, $row);
		// store this table in the tables array
		array_push($arraytables, $innertable);
	}	//end while
	return $arraytables;
}

/***********************************************************************************************************
**	function getContactsCompanyAlphabeticIndex():
************************************************************************************************************/
function getContactsCompanyAlphabeticIndex($letter) {
	global $mysql_people_table, $mysql_companies_table;
	// need to filter out company_id = 2 (supporters) and default contact with id = 1
	$sql = "select count(t1.id) from $mysql_people_table as t1, $mysql_companies_table as t2 where t2.company_name < '$letter' and t1.company_id=t2.id and t1.user='1'";
	$result = execsql($sql);
	$row = mysql_fetch_array($result);
	return $row[0];
}

?>