<?php
/*******************************************************************************
**	file:	common.php
********************************************************************************
**	author:	Luis Bernardo
**	date:	2003/12/10
********************************************************************************
**	$Revision: 1.13 $ on $Date: 2004/03/10 05:40:50 $ by $Author: lmpmbernardo $
*******************************************************************************/

/**********************************************************************************************************/
/****************************	Other Variables	***********************************************************/

//set the variables from the database if not running the install
$var = getVariables();

$announcements_limit = $var['announcements_limit'];	// number of announcements to display on the main page.
$users_limit = $var['people_per_page'];				// number of supporters/contacts to list per page
$groups_limit = $var['sets_per_page'];				// number of groups/companies to list per page
$tickets_limit = $var['tickets_per_page'];			// number of tickets to list per page
$helpdesk_name = $var['name'];						// name of the helpdesk
$admin_email = $var['admin_email'];					// email address of the helpdesk administrator
$enable_stats = $var['stats'];						// processed time statistics on or off
$enable_smtp = $var['smtp'];						// smtp server on or off variable
$sendmail_path = $var['sendmail_path'];				// path to sendmail on a *nix machine
$enable_helpdesk = $var['on_off'];					// helpdesk on or off variable
$on_off_reason = $var['reason'];					// reason for helpdesk being off
$enable_whosonline = $var['whosonline'];			// enable whos online display
$enable_products = $var['products_status'];			// enable products option
$enable_time_tracking = $var['time_tracking'];		// enable time tracking per ticket/supporter
$default_theme = $var['default_theme'];				// the name of the default theme that is set by the admin
$enable_automatic = $var['automatic_notification'];	// whether supporters should be notified bny email
$delimiter = "--//--";								// this is the string that is inserted after the user name
													// and again after the message in the update log.  This can't
													// be the same as anything that a user would type.  If changed
													// this will mess up the update log...so don't change it.

/***********************************************************************************************************
**	Function Definitions
***********************************************************************************************************/

/***********************************************************************************************************
**	function execsql():
************************************************************************************************************/
function execsql($query) {
	global $mysql_user, $mysql_pwd, $mysql_db, $mysql_host, $queries, $debug;
	$connection = mysql_connect($mysql_host, $mysql_user, $mysql_pwd);
	mysql_select_db($mysql_db);
	if($debug == 1) {
		echo $query . "<br>";
	}
	if(!$result = mysql_query($query, $connection)) {
		echo mysql_errno() . " " . mysql_error();
		exit;
	}
	return $result;
}

/***********************************************************************************************************
**	function getVariables():
************************************************************************************************************/
function getVariables() {
	global $mysql_settings_table;
	$sql = "select * from $mysql_settings_table";
	$result = execsql($sql);
	$row = mysql_fetch_array($result);
	return $row;
}

/***********************************************************************************************************
**	function isEmpty():
************************************************************************************************************/
function isEmpty($table) {
	$sql = "select * from $table";
	$result = execsql($sql);
	$num_rows = mysql_num_rows($result);

	if($num_rows > 0) {
		return false;
	} else {
		return true;
	}
}

/***********************************************************************************************************
**	function checkPassword():
************************************************************************************************************/
function checkPwd($pwd1, $pwd2) {
	if($pwd1 == $pwd2)
		return true;
	else
		return false;
}

/***********************************************************************************************************
**	function getPriority():
**		Takes an integer as an argument.  Takes the integer and returns the value of that id in the priority
**	table in the database.
************************************************************************************************************/
function getPriority($id) {
	global $mysql_tpriorities_table;
	$sql = "select priority from $mysql_tpriorities_table where id='$id'";
	$result = execsql($sql);
	$row = mysql_fetch_row($result);
	return $row[0];
}

/***********************************************************************************************************
**	function getStatus():
**		Takes an integer as an argument.  Takes the integer and returns the value of that id in the status
**	table in the database.
************************************************************************************************************/
function getStatus($id) {
	global $mysql_tstatus_table;
	$sql = "select status from $mysql_tstatus_table where id='$id'";
	$result = execsql($sql);
	$row = mysql_fetch_row($result);
	return $row[0];
}

/***********************************************************************************************************
**	function printError():
**		Takes a string as input.  Outputs the error message in a nice table format.
************************************************************************************************************/
function printError($error) {
	echo '
		<table class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
			<tr>
				<td>
					<table cellSpacing=1 cellPadding=5 width="100%" border=0>
						<tr>
							<td class=info align=middle><b>Error</b></td>
						</tr>
						<tr>
							<td class=error align=middle>
								<b><font color=red>'. $error . '</font></b><br>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>';
}

/***********************************************************************************************************
**	function printSuccess():
**		Takes a string as input.  Outputs the message in a nice table format.
************************************************************************************************************/
function printSuccess($msg) {
    // [15/12/2003 seh]
    global $lang;
    // [/seh]
	echo '
		<table class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
			<tr>
				<td>
					<table cellSpacing=1 cellPadding=5 width="100%" border=0>
						<tr>
							<td class=info align=middle><b>'.$lang['success'].'</b></td>
						</tr>
						<tr>
							<td class=error align=middle>
								<b><font color=green>'. $msg . '</font></b><br>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>';
}

/***********************************************************************************************************
**	function getRank():
**		Takes a two strings as input.  Second string is the table to query.  First string is the text to
**	query the table for.  Returns the rank value of the given text.
************************************************************************************************************/
function getRank($string, $table) {
	global $mysql_tpriorities_table, $mysql_tstatus_table;
	switch($table) {
		case ($mysql_tpriorities_table):
			$sql = "select rank from $table where priority=\"$string\"";
			break;
		case ($mysql_tstatus_table):
			$sql = "select rank from $table where status=\"$string\"";
			break;
		default:
			printError("Table does not exist . . . you screwed up.");
			exit;
	}
	$result = execsql($sql);
	$row = mysql_fetch_row($result);
	return $row[0];
}

/***********************************************************************************************************
**	function getRPriority():
**		Takes an integer as input.  The integer value is the rank.  Select the name of the priority based on
**	the rank and return the string.
************************************************************************************************************/
function getRPriority($rank) {
	global $mysql_tpriorities_table;
	$sql = "select priority from $mysql_tpriorities_table where id=$rank";
	$result = execsql($sql);
	$row = mysql_fetch_row($result);
	return $row[0];
}

/***********************************************************************************************************
**	function getRStatus():
**		Takes an integer as input.  The integer value is the rank.  Select the name of the status based on
**	the rank and return the string.
************************************************************************************************************/
function getRStatus($rank) {
	global $mysql_tstatus_table;
	$sql = "select status from $mysql_tstatus_table where id=$rank";
	$result = execsql($sql);
	$row = mysql_fetch_row($result);
	return $row[0];
}


/***********************************************************************************************************
**	function getHighestRank():
**		Takes one argument.  If the table is the ticket status table, the ranking is reversed so there is a
**	different sql statement.  Selects the item in the table that has the highest rank and returns the id.
************************************************************************************************************/
function getHighestRank($table) {
	global $mysql_tstatus_table;
	if($table == $mysql_tstatus_table) {
		$sql = "select id from $table order by rank desc";
	} else {
		$sql = "select id from $table order by rank asc";
	}
	$result = execsql($sql);
	$row = mysql_fetch_row($result);
	return $row[0];
}


/***********************************************************************************************************
**	function getLowestRank():
**		Takes one argument.  If the table is the ticket status table, the ranking is reversed so there is a
**	different sql statement.  Selects the item in the table that has the highest rank and returns the id.
************************************************************************************************************/
function getLowestRank($table) {
	global $mysql_tstatus_table;
	if($table == $mysql_tstatus_table) {
		$sql = "select id from $table order by rank asc";
	} else {
		$sql = "select id from $table order by rank desc";
	}
	$result = execsql($sql);
	$row = mysql_fetch_row($result);
	return $row[0];
}

/***********************************************************************************************************
**	function getPriorityList():
**		Takes no arguments.  Queries the ticket priority table and returns an array containing each element
**	in the table orderd by rank.
************************************************************************************************************/
function getPriorityList() {
	global $mysql_tpriorities_table;
	$sql = "select priority from $mysql_tpriorities_table order by rank asc";
	$result = execsql($sql);
	$i = 0;
	while ($row = mysql_fetch_row($result)) {
		$list[$i] = $row[0];
		$i++;
	}
	return $list;
}


/***********************************************************************************************************
**	function getCategoryList():
**		Takes no arguments.  Queries the ticket categories table and returns an array containing each element
**	in the table orderd by rank.
************************************************************************************************************/
function getCategoryList() {
	global $mysql_tcategories_table;
	$sql = "select category from $mysql_tcategories_table order by rank asc";
	$result = execsql($sql);
	$i = 0;
	while ($row = mysql_fetch_row($result)) {
		$list[$i] = $row[0];
		$i++;
	}
	return $list;
}

/***********************************************************************************************************
**	function getStatusList():
**		Takes no arguments.  Queries the ticket status table and returns an array containing each element
**	in the table orderd by rank.
************************************************************************************************************/
function getStatusList() {
	global $mysql_tstatus_table;
	$sql = "select status from $mysql_tstatus_table order by rank asc";
	$result = execsql($sql);
	$i = 0;
	while ($row = mysql_fetch_row($result)) {
		$list[$i] = $row[0];
		$i++;
	}
	return $list;
}

/***********************************************************************************************************
**	function validEmail():
************************************************************************************************************/
function validEmail($address) {
	if (ereg('^[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+'. '@'. '[-!#$%&\'*+\\/0-9=?A-Z^_`a-z{|}~]+\.' . '[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+$', $address))
		return true;
	else
		return false;
}

/***********************************************************************************************************
**	function isAdministrator():
************************************************************************************************************/
function isAdministrator($name) {
	global $mysql_people_table;
	$sql = "select admin from $mysql_people_table where user_name='$name'";
	$result = execsql($sql);
	$row = mysql_fetch_row($result);
	if($row[0] == 1) {
		return true;
	} else {
		return false;
	}
}

/***********************************************************************************************************
**	function isSupporter():
************************************************************************************************************/
function isSupporter($name) {
	global $mysql_people_table;
	$sql = "select supporter from $mysql_people_table where user_name='$name'";
	$result = execsql($sql);
	$row = mysql_fetch_array($result);
	if($row['supporter'] == 1) {
		return true;
	} else {
		return false;
	}
}

/***********************************************************************************************************
**	function companyExists():
************************************************************************************************************/
function companyExists($name) {
	global $mysql_companies_table;
	$sql = "select company_name from $mysql_companies_table where company_name='$name'";
	$result = execsql($sql);
	$num_rows = mysql_num_rows($result);
	if($num_rows != 0) {
		return true;
	} else {
		return false;
	}
}

/***********************************************************************************************************
**	function personExists():
************************************************************************************************************/
function personExists($name) {
	global $mysql_people_table;
	$sql = "select user_name from $mysql_people_table where user_name='$name'";
	$result = execsql($sql);
	$num_rows = mysql_num_rows($result);
	if($num_rows != 0) {
		return true;
	} else {
		return false;
	}
}

/***********************************************************************************************************
**	function groupExists():
************************************************************************************************************/
function groupExists($name) {
	global $mysql_groups_table;
	$sql = "select group_name from $mysql_groups_table where group_name='$name'";
	$result = execsql($sql);
	$num_rows = mysql_num_rows($result);
	if($num_rows != 0) {
		return true;
	} else {
		return false;
	}
}

/***********************************************************************************************************
**	function getPersonId():
************************************************************************************************************/
function getPersonID($name) {
	global $mysql_people_table;
	$sql = "select id from $mysql_people_table where user_name='$name'";
	$result = execsql($sql);
	$row = mysql_fetch_row($result);
	return $row[0];
}

/***********************************************************************************************************
**	function getPeopleInfo():
************************************************************************************************************/
function getPeopleInfo($id) {
	global $mysql_people_table;
	$sql = "select * from $mysql_people_table where id=$id";
	$result = execsql($sql);
	$row = mysql_fetch_array($result);
	return $row;
}

/***********************************************************************************************************
**	function getPersonName():
************************************************************************************************************/
function getPersonName($id) {
	global $mysql_people_table;
	$sql = "select first_name, last_name from $mysql_people_table where id=$id";
	$result = execsql($sql);
	if($row = mysql_fetch_array($result)) {
		return $row[0] . " " . $row[1];
	} else {
		return "<i>unknown</i>";
	}
}

/***********************************************************************************************************
**	function getCompanyInfo():
************************************************************************************************************/
function getCompanyInfo($id) {
	global $mysql_companies_table;
	$sql = "select * from $mysql_companies_table where id=$id";
	$result = execsql($sql);
	$row = mysql_fetch_array($result);
	return $row;
}


/***********************************************************************************************************
**	function getGroupInfo():
************************************************************************************************************/
function getGroupInfo($id) {
	global $mysql_groups_table;
	$sql = "select * from $mysql_groups_table where id=$id";
	$result = execsql($sql);
	$row = mysql_fetch_array($result);
	return $row;
}

/***********************************************************************************************************
**	function displayPersonInfo():
************************************************************************************************************/
function displayPersonInfo($id, $first, $last, $email, $phone, $company, $company_id) {
	global $lang;
	echo '
		<table class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
			<tr>
				<td>
					<table cellSpacing=1 cellPadding=5 width="100%" border=0>
						<tr>
							<td class=info align=left align=middle><b>'.$lang['contact_id'].': ' . $id . '</b></td>
							<td class=info align=left align=middle>
								<a class=info href=index.php?t=detailcontact&id='.$id.'>'.$lang['detail'].'</a>,
								<a class=info href=index.php?t=editcontact&id='.$id.'>'.$lang['edit'].'</a>,
								<a class=info href=index.php?t=viewcontacts&action=delete&id='.$id.'>'.$lang['delete'].'</a>,
								<a class=info href=index.php?t=createticket&client_id='.$company_id.'&contact_id='.$id.'>'.$lang['create_ticket'].'</a>,
								<a class=info href=index.php?t=viewtickets&case=person&id='.$id.'>'.$lang['view_tickets'].'</a>
							</td>
						</tr>
						<tr>
							<td width=27% class=back2 align=right>'.$lang['name'].':</td><td class=back>'. $first .' '. $last .'</td>
						</tr>
						<tr>
							<td width=27% class=back2 align=right>'.$lang['email'].'</td><td class=back><a href=mailto:'. $email .'>'.$email.'</td>
						</tr>
						<tr>
							<td width=27% class=back2 align=right>'.$lang['phone'].':</td><td class=back>'. $phone .'</td>
						</tr>
						<tr>
							<td width=27% class=back2 align=right>'.$lang['company'].':</td><td class=back><a href=index.php?t=detailcompany&id='.$company_id.'>'. $company .'</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>';
}

/***********************************************************************************************************
**	function displayContactDetail():
************************************************************************************************************/
function displayContactDetail($id) {
	global $lang, $dateformat;
	$info = getPeopleInfo($id);
	$first = $info['first_name'];
	$last = $info['last_name'];
	$email = $info['email'];
	$phone = $info['phone'];
	$fax = $info['fax'];
	$companyid = $info['company_id'];
	$authorid = $info['author_id'];
	$modifiedon = date($dateformat, $info['date_modified']);
	$comments = ereg_replace("\r\n","<br>",$info['comments']);
	$companyinfo = getCompanyInfo($companyid);
	$company = $companyinfo['company_name'];
	$authorinfo = getPeopleInfo($authorid);
	$authorfirst = $authorinfo['first_name'];
	$authorlast = $authorinfo['last_name'];
	if ($authorfirst == '' && $authorlast == '') $authorfirst = "<i>unknown</i>";

	echo '
		<table class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
			<tr>
				<td>
					<table cellSpacing=1 cellPadding=5 width="100%" border=0>
						<tr>
							<td class=info colspan=2 align=middle><b>'.$lang['contact_info'].'</b></td>
						</tr>
						<tr>
							<td class=back>
								<table cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
									<tr>
										<td>
											<table class=border cellSpacing=1 cellPadding=5 width="100%" border=0>
												<tr>
													<td class=info align=left align=middle><b>'.$lang['contact_id'].': ' . $id . '</b></td>
													<td class=info align=right align=middle>
														<a class=info href=index.php?t=editcontact&id='.$id.'>'.$lang['edit'].'</a>,
														<a class=info href=index.php?t=viewtickets&case=person&id='.$id.'>'.$lang['view_tickets'].'</a>,
														<a class=info href=index.php?t=createticket&client_id='.$companyid.'&contact_id='.$id.'>'.$lang['create_ticket'].'</a>
													</td>
												</tr>
												<tr>
													<td width=27% class=back2 align=right>'.$lang['name'].':</td><td class=back>'. $first .' '. $last .'</td>
												</tr>
												<tr>
													<td width=27% class=back2 align=right>'.$lang['email'].':</td><td class=back><a href=mailto:'. $email .'>'.$email.'</td>
												</tr>
												<tr>
													<td width=27% class=back2 align=right>'.$lang['phone'].':</td><td class=back>'. $phone .'</td>
												</tr>
												<tr>
													<td width=27% class=back2 align=right>'.$lang['fax'].':</td><td class=back>'. $fax .'</td>
												</tr>
												<tr>
													<td width=27% class=back2 align=right>'.$lang['company'].':</td><td class=back><a href=index.php?t=detailcompany&id='.$companyid.'>'. $company .'</td>
												</tr>
												<tr>
													<td width=27% class=back2 align=right>'.$lang['comments'].':</td><td class=back>'. $comments .'</td>
												</tr>
												<tr>
													<td width=27% class=back2 align=right>'.$lang['modified_by'].':</td><td class=back>'. $authorfirst .' '. $authorlast .'</td>
												</tr>
												<tr>
													<td width=27% class=back2 align=right>'.$lang['last_modified'].':</td><td class=back>'. $modifiedon .'</td>
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
		</table>';
}

/***********************************************************************************************************
**	function displayCompanyInfo():
************************************************************************************************************/
function displayCompanyInfo($id, $company, $address, $first, $last) {
	global $lang;
	echo '
		<table class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
			<tr>
				<td>
					<table cellSpacing=1 cellPadding=5 width="100%" border=0>
						<tr>
							<td class=info align=left align=middle><b>'.$lang['company_id'].': ' . $id . '</b></td>
							<td class=info align=left align=middle>
								<a class=info href=index.php?t=detailcompany&id='.$id.'>'.$lang['detail'].'</a>,
								<a class=info href=index.php?t=editcompany&id='.$id.'>'.$lang['edit'].'</a>,
								<a class=info href=index.php?t=viewcompanies&action=delete&id='.$id.'>'.$lang['delete'].'</a>,
								<a class=info href=index.php?t=viewtickets&case=company&id='.$id.'>'.$lang['view_tickets'].'</a>
							</td>
						</tr>
						<tr>
							<td width=27% class=back2 align=right>'.$lang['name'].':</td><td class=back>'. $company .'</td>
						</tr>
						<tr>
							<td width=27% class=back2 align=right>'.$lang['address'].':</td><td class=back>'. $address .'</td>
						</tr>
						<tr>
							<td width=27% class=back2 align=right>'.$lang['main_contact'].':</td><td class=back>'. $first .' '. $last .'</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>';
}

/***********************************************************************************************************
**	function displayCompanyDetail():
************************************************************************************************************/
function displayCompanyDetail($id) {
	global $mysql_people_table, $lang, $dateformat;
	//$info is an array that contains the user information for that id number.
	$info = getCompanyInfo($id);
	$name = $info['company_name'];
	$contactid = $info['main_contact_id'];
	$authorid = $info['author_id'];
	$modifiedon = date($dateformat, $info['date_modified']);
	$address = ereg_replace("\r\n","<br>",$info['address']);
	$comments = ereg_replace("\r\n","<br>",$info['comments']);
	$contactinfo = getPeopleInfo($contactid);
	$authorinfo = getPeopleInfo($authorid);
	$contactfirst = $contactinfo['first_name'];
	$contactlast = $contactinfo['last_name'];
	$authorfirst = $authorinfo['first_name'];
	$authorlast = $authorinfo['last_name'];
	if ($authorfirst == '' && $authorlast == '') $authorfirst = "<i>unknown</i>";
	if ($contactfirst == '' && $contactlast == '') $contactfirst = "<i>unknown</i>";

	$contacts = "";
	$sql = "select id, first_name, last_name from $mysql_people_table where company_id='$id'";
	$result = execsql($sql);
	while($row = mysql_fetch_array($result)) {
		$contacts .= "<a href=index.php?t=detailcontact&id=" . $row[0] . ">" . $row[1] . " " . $row[2] . "<br>";
	}

	echo '
		<table class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
			<tr>
				<td>
					<table cellSpacing=1 cellPadding=5 width="100%" border=0>
						<tr>
							<td class=info colspan=2 align=middle><b>'.$lang['company_info'].'</b></td>
						</tr>
						<tr>
							<td class=back>
								<table cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
									<tr>
										<td>
											<table class=border cellSpacing=1 cellPadding=5 width="100%" border=0>
												<tr>
													<td class=info align=left align=middle><b>'.$lang['company_id'].': ' . $id . '</b></td>
													<td class=info align=right align=middle>
														<a class=info href=index.php?t=editcompany&id='.$id.'>'.$lang['edit'].'</a>,
														<a class=info href=index.php?t=viewtickets&case=company&id='.$id.'>'.$lang['view_tickets'].'</a>,
														<a class=info href=index.php?t=addcontact&company_id='.$id.'>'.$lang['add_contact'].'</a>
													</td>
												</tr>
												<tr>
													<td width=27% class=back2 align=right>'.$lang['name'].':</td><td class=back>'. $name .'</td>
												</tr>
												<tr>
													<td width=27% class=back2 align=right>'.$lang['address'].':</td><td class=back>'. $address .'</td>
												</tr>
												<tr>
													<td width=27% class=back2 align=right>'.$lang['main_contact'].':</td><td class=back>'. $contactfirst .' '. $contactlast .'</td>
												</tr>
												<tr>
													<td width=27% class=back2 align=right>'.$lang['contacts'].':</td><td class=back>'. $contacts .'</td>
												</tr>
												<tr>
													<td width=27% class=back2 align=right>'.$lang['comments'].':</td><td class=back>'. $comments .'</td>
												</tr>
												<tr>
													<td width=27% class=back2 align=right>'.$lang['modified_by'].':</td><td class=back>'. $authorfirst .' '. $authorlast .'</td>
												</tr>
												<tr>
													<td width=27% class=back2 align=right>'.$lang['last_modified'].':</td><td class=back>'. $modifiedon .'</td>
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
		</table>';
}

/***********************************************************************************************************
**	function displayGroupDetail():
************************************************************************************************************/
function displayGroupDetail($id) {
	global $mysql_people_table, $mysql_supporters_table, $lang;
	//$info is an array that contains the user information for that id number.
	$info = getGroupInfo($id);
	$name = $info['group_name'];
	$authorid = $info['author_id'];
	$modifiedon = date("m/d/y",$info['date_modified']);
	$comments = ereg_replace("\r\n","<br>",$info['comments']);
	$authorinfo = getPeopleInfo($authorid);
	$authorfirst = $authorinfo['first_name'];
	$authorlast = $authorinfo['last_name'];
	if ($authorfirst == '' && $authorlast == '') $authorfirst = "<i>unknown</i>";
	if ($contactfirst == '' && $contactlast == '') $contactfirst = "<i>unknown</i>";

	$supporters = "";
	$sql = "select t1.id, t1.first_name, t1.last_name from $mysql_people_table as t1, $mysql_supporters_table as t2 where t1.id=t2.supporter_id and t2.group_id='$id'";
	$result = execsql($sql);
	while($row = mysql_fetch_array($result)) {
		$supporters .= "<a href=index.php?t=detailsupporter&id=" . $row[0] . ">" . $row[1] . " " . $row[2] . "<br>";
	}

	echo '
		<table class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
			<tr>
				<td>
					<table cellSpacing=1 cellPadding=5 width="100%" border=0>
						<tr>
							<td class=info align=middle><b>'.$lang['group_info'].'</b></td>
						</tr>
						<tr>
							<td class=back>
								<table cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
									<tr>
										<td>
											<table class=border cellSpacing=1 cellPadding=5 width="100%" border=0>
												<tr>
													<td class=info align=left align=middle><b>'.$lang['group_id'].': ' . $id . '</b></td>
													<td class=info align=right align=middle><a class=info href=index.php?t=editgroup&id='.$id.'>'.$lang['edit'].'</a></td>
												</tr>
												<tr>
													<td width=27% class=back2 align=right>'.$lang['name'].':</td><td class=back>'. $name .'</td>
												</tr>
												<tr>
													<td width=27% class=back2 align=right>'.$lang['supporters'].':</td><td class=back>'. $supporters .'</td>
												</tr>
												<tr>
													<td width=27% class=back2 align=right>'.$lang['comments'].':</td><td class=back>'. $comments .'</td>
												</tr>
												<tr>
													<td width=27% class=back2 align=right>'.$lang['modified_by'].':</td><td class=back>'. $authorfirst .' '. $authorlast .'</td>
												</tr>
												<tr>
													<td width=27% class=back2 align=right>'.$lang['last_modified'].':</td><td class=back>'. $modifiedon .'</td>
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
		</table>';
}

/***********************************************************************************************************
**	function displaySupporterDetail():
************************************************************************************************************/
function displaySupporterDetail($id) {
	global $mysql_groups_table, $mysql_supporters_table;
    // [12/12/2003 seh]
    global $lang;
    // [/seh]
	$info = getPeopleInfo($id);
	$first = $info['first_name'];
	$last = $info['last_name'];
	$email = $info['email'];
	$phone = $info['phone'];
	$fax = $info['fax'];
	$companyid = $info['company_id'];
	$authorid = $info['author_id'];
	$type = $info['admin'];
	$modifiedon = date("m/d/y",$info['date_modified']);
	$comments = ereg_replace("\r\n","<br>",$info['comments']);
	$companyinfo = getCompanyInfo($companyid);
	$company = $companyinfo['company_name'];
	$authorinfo = getPeopleInfo($authorid);
	$authorfirst = $authorinfo['first_name'];
	$authorlast = $authorinfo['last_name'];
	if ($authorfirst == '' && $authorlast == '') $authorfirst = "<i>unknown</i>";
	if ($type == '1') {
		$type = "Administrator";
	} else {
		$type = "Supporter";
	}
	$groups = "";
	$sql = "select t1.id, t1.group_name from $mysql_groups_table as t1, $mysql_supporters_table as t2 where t1.id=t2.group_id and t2.supporter_id='$id'";
	$result = execsql($sql);
	while($row = mysql_fetch_array($result)) {
		$groups .= "<a href=index.php?t=detailgroup&id=" . $row[0] . ">" . $row[1] . "<br>";
	}

	echo '
		<table class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
			<tr>
				<td>
					<table cellSpacing=1 cellPadding=5 width="100%" border=0>
						<tr>
							<td class=info align=middle><b>'.$lang['supporter_info'].'</b></td>
						</tr>
						<tr>
							<td class=back>
								<table cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
									<tr>
										<td>
											<table class=border cellSpacing=1 cellPadding=5 width="100%" border=0>
												<tr>
													<td class=info align=left align=middle><b>'.$lang['supporter_id'].': ' . $id . '</b></td>
													<td class=info align=right align=middle>
														<a class=info href=index.php?t=editsupporter&id='.$id.'>'.$lang['edit'].'</a>
													</td>
												</tr>
												<tr>
													<td width=27% class=back2 align=right>'.$lang['name'].':</td><td class=back>'. $first .' '. $last .'</td>
												</tr>
												<tr>
													<td width=27% class=back2 align=right>'.$lang['email'].':</td><td class=back><a href=mailto:'. $email .'>'.$email.'</td>
												</tr>
												<tr>
													<td width=27% class=back2 align=right>'.$lang['phone'].':</td><td class=back>'. $phone .'</td>
												</tr>
												<tr>
													<td width=27% class=back2 align=right>'.$lang['fax'].':</td><td class=back>'. $fax .'</td>
												</tr>
												<tr>
													<td width=27% class=back2 align=right>'.$lang['type'].':</td><td class=back>'. $type .'</td>
												</tr>
												<tr>
													<td width=27% class=back2 align=right>'.$lang['groups'].':</td><td class=back>'. $groups .'</td>
												</tr>
												<tr>
													<td width=27% class=back2 align=right>'.$lang['comments'].':</td><td class=back>'. $comments .'</td>
												</tr>
												<tr>
													<td width=27% class=back2 align=right>'.$lang['modified_by'].':</td><td class=back>'. $authorfirst .' '. $authorlast .'</td>
												</tr>
												<tr>
													<td width=27% class=back2 align=right>'.$lang['last_modified'].':</td><td class=back>'. $modifiedon .'</td>
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
		</table>';
}

/***********************************************************************************************************
**	function createCompaniesMenu():
**		Takes one argument. Creates the companies drop down menu based on the data in the companies table.  If
**	the flag is set to 0, or not set, no company is selected. If the flag is set, the company with the respective
**	id is selected.
************************************************************************************************************/
function createCompaniesMenu($selected) {
	global $mysql_companies_table;
	// leave out the supporters company, with id = 2
	$sql = "select id, company_name from $mysql_companies_table where id != '2' order by company_name asc";
	$result = execsql($sql);
	if (!isset($selected)) {
		while($row = mysql_fetch_row($result)) {
			echo "<option value=\"$row[0]\"> $row[1] </option>";
		}
	} else {
		while($row = mysql_fetch_row($result)) {
			echo "<option value=\"$row[0]\"";
				if ($row[0] == $selected) {
					echo " selected";
				}
			echo "> $row[1] </option>";
		}
	}
}

/***********************************************************************************************************
**	function getNumberOfContacts():
************************************************************************************************************/
function getNumberOfContacts() {
	global $mysql_people_table;
	// exclude default contact with id = 1
	$sql = "select count(user_name) from $mysql_people_table where user='1' and id!='1' and company_id!='2'";
	$result = execsql($sql);
	$row = mysql_fetch_row($result);
	return $row[0];
}

/***********************************************************************************************************
**	function getNumberOfCompanies():
************************************************************************************************************/
function getNumberOfCompanies() {
	global $mysql_companies_table;
	// do not count inactive contacts company and admin's company -- should we count the admin's company?
	$sql = "select count(*) from $mysql_companies_table where id>'2'";
	$result = execsql($sql);
	$row = mysql_fetch_row($result);
	return $row[0];
}

/***********************************************************************************************************
**	function outputTicketForm():
************************************************************************************************************/
function outputTicketForm($groupid, $supporterid, $clientid, $contactid, $ticketid, $detail, $priorityid, $statusid, $platformid, $categoryid, $title, $description) {
	global $enable_smtp, $enable_products, $enable_time_tracking, $lang;
	// $ticketid is only known when doing an update to the ticket. when creating a ticket $ticketid is not known and
	// should be set to zero ('0').
	$isupdate = false;
	if(isset($ticketid) && $ticketid > 0) $isupdate = true;
	if($enable_products == 'on') {
		if(!isset($detail) || $detail=='') {
			$detailflag = false;
			$newdetailvalue = $lang['more_detail'];
		}
		if(ticketHasMoreDetail($ticketid)) {
			$detailflag = true;
			$newdetailvalue = $lang['less_detail'];
		}
		if($detail == $lang['more_detail']) {
			$detailflag = true;
			$newdetailvalue = $lang['less_detail'];
		}
		if($detail == $lang['less_detail']) {
			$detailflag = false;
			$newdetailvalue = $lang['more_detail'];
		}
	} else {
		$detailflag = false;
	}
	if($isupdate && $detailflag) {
		// if non empty set $detail to 1 (to some value)
		$ticketinfo = getTicketInfo($ticketid);
		$versionid = $ticketinfo['version_id'];
		$diskid = getDiskId($ticketid);
	}

	$header = $lang['create_ticket'];
	$submitname = "create";
	$submitvalue = $lang['create_ticket'];
	if($isupdate) {
		$header = $lang['update_ticket'];
		$submitname = "update";
		$submitvalue = $lang['update_ticket'];
	}
	echo '
		<table class=border cellSpacing=0 cellPadding=0 width=100% align=center border=0>
			<tr>
				<td>
					<table cellSpacing=1 cellPadding=5 width=100% border=0>
						<tr>
							<td class=info align=middle>
								<b>'.$header.'</b>
							</td>
						</tr>
						<tr>
							<td class=back>
		<table class=border cellSpacing=0 cellPadding=0 width=100% align=center border=0>
			<tr>
				<td>
					<table cellSpacing=1 cellPadding=5 width=100% border=0>
		<tr>
			<td width=20% class=cat align=right><b>'.$lang['group'].':</b></td>
			<td class=back>
			<select name=group_id onChange="submit()">';
				createGroupMenu($groupid); echo '
			</select>
			</td>
			<td width=20% class=cat align=right><b>'.$lang['supporter'].':</b></td>
			<td class=back align=left>
			<select name=supporter_id>';
				createSupporterMenu($groupid, $supporterid); echo '
			</select>
			</td>
		</tr>
		<tr>
			<td width=20% class=cat align=right><b>'.$lang['client'].':</b></td>
			<td class=back>
			<select name=client_id onChange="submit()">';
				createClientMenu($clientid); echo '
			</select>
			</td>
			<td class=cat align=right width=20%><b>'.$lang['contact'].':</b></td>
			<td class=back align=left>
			<select name=contact_id>';
				createContactMenu($clientid, $contactid); echo '
			</select>
			</td>
		</tr>
		<tr>
			<td width=20% class=cat align=right><b>'.$lang['priority'].':</b></td>
			<td class=back>
			<select name=priority_id>';
				createPriorityMenu($priorityid); echo '
			</select>
			</td>
			<td class=cat align=right width=20%><b>'.$lang['status'].':</b></td>
			<td class=back>
			<select name=status_id>';
				createStatusMenu($statusid); echo '
			</select>
			</td>
		</tr>
		<tr>
			<td class=cat width=20% align=right><b>'.$lang['platform'].':</b></td>
			<td class=back>
			<select name=platform_id>';
				createPlatformMenu($platformid); echo '
			</select>
			</td>
			<td class=cat width=20% align=right><b>'.$lang['category'].':</b></td>
			<td class=back>
			<select name=category_id>';
				createCategoryMenu($categoryid); echo '
			</select>
			</td>
		</tr>
		<tr>
			<td width=20% class=cat align=right><b>'.$lang['title'].':</b></td>
			<td class=back colspan=3><input type=text size=72 name=title value="'.stripslashes($title).'"></td>
		</tr>
		<tr>
			<td class=cat align=right valign=top width=20%><b>'.$lang['description'].':</b></td>
			<td class=back colspan=3><textarea name=description rows=5 cols=72>'.stripslashes($description).'</textarea></td>
		</tr>';
	// check whether there are non empty fields in the "more detail" case
	if($detailflag) {
		echo '
		<tr>
			<td class=cat width=20% align=right><b>'.$lang['version'].':</b></td>
			<td width=20% class=back>
			<select name=version_id>';
			createVersionMenu($versionid);
		echo '
			</select>
			</td>';
		echo '
			<td class=cat width=20% align=right><b>'.$lang['product_id'].':</b></td>
			<td class=back>
				<input type=text name=diskid value='. $diskid .'>
			</td>';
		/** decided to use a multiple choice checkbox instead of a drop down menu
		echo '
			<td class=back2 width=100 align=right>Module:</td>
			<td class=back>
			<select name=module>';
			createModuleMenu($module);
		echo '
			</select></td>';
		**/
		echo '
		</tr>';
		echo '
		<tr>
			<td class=cat width=20% align=right><b>'.$lang['ticket_modules'].':</b></td>
			<td class=back colspan=3>
				<table class=border cellSpacing=1 cellPadding=1 width="100%" border=0>';
					createModuleCheckBoxes($ticketid); echo '
				</table>
			</td>
		</tr>';
	}
	if($isupdate) {
		if($enable_smtp == "on") {
			echo '
			<tr>
				<td width=20% class=cat align=right valign=top><b>'.$lang['email_contact'].':</b></td>
				<td class=back colspan=3 valign=bottom><textarea name=email_msg rows=5 cols=72></textarea></td>
			</tr>';
		}
		echo '
		<tr>
			<td width=20% class=cat align=right valign=top><b>'.$lang['update'].':</b></td>
			<td class=back colspan=3 valign=bottom>
				<textarea name=update_log rows=5 cols=72></textarea>
				<a href="code/updateticketlog.php?id='.$ticketid.'&pop=true" target="myWindow" onClick="window.open(\'code/updateticketlog.php?id='.$ticketid.'&pop=true\', \'myWindow\',
					\'location=no, status=yes, scrollbars=yes, height=500, width=600, menubar=no, toolbar=no, resizable=yes\')">
					<img border=0 src="./images/log_button.jpg"></a>
			</td>
		</tr>';
	}
	if($isupdate && $enable_time_tracking == 'on') {
		echo '
		<tr>
			<td width=20% class=cat align=right><b>'.$lang['time_spent'].':</b></td>
			<td class=back colspan=3>
				<input type=text size=6 name=time_spent><font size=1> ('.$lang['text_minutes_spent'].')</font>
			</td>
		</tr>';
	}
	echo '
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
	if($enable_products == 'on') {
		echo '<input type=submit name=detail value="'.$newdetailvalue.'">&nbsp;&nbsp;&nbsp;';
	}
	echo '
			<input type=submit name='.$submitname.' value="'.$submitvalue.'">
			&nbsp;&nbsp;&nbsp;
			<input type=reset name=reset value='.$lang['reset'].'>
		</center>';
}

/***********************************************************************************************************
**	function createGroupMenu():
************************************************************************************************************/
function createGroupMenu($groupid) {
	global $mysql_groups_table;
	$sql = "select id, group_name from $mysql_groups_table order by rank asc";
	$result = execsql($sql);
	$num_rows = mysql_num_rows($result);

	if(!isset($groupid) || $groupid == '')
		echo "<option></option>";
	while($row = mysql_fetch_row($result)) {
			echo "<option value=$row[0]";
				if($groupid == $row[0]) {
					echo " selected";
				}
			echo ">".$row[1]."</option>";
	}
}

/***********************************************************************************************************
**	function createSupporterMenu():
************************************************************************************************************/
function createSupporterMenu($group_id, $supporter_id) {
	global $mysql_people_table, $mysql_supporters_table;
	if($group_id == '' || !isset($group_id)) {
		$sql = "select id, first_name, last_name from $mysql_people_table where supporter = '1' order by last_name asc";
		$table = $mysql_users_table;
	} else {
		$sql = "select t1.id, t1.first_name, t1.last_name, t2.supporter_id from $mysql_people_table as t1, $mysql_supporters_table as t2 where t1.id = t2.supporter_id and t2.group_id = $group_id order by t1.last_name asc";
	}
	if($group_id == '' || !isset($group_id)) {
		echo "<option></option>";
		echo "<option>Choose Group</option>";
	} else {
		$result = execsql($sql);
		while($row = mysql_fetch_row($result)) {
			echo "<option value=\"$row[0]\"";
			if($supporter_id == $row[0]) {
				echo " selected";
			}
			echo "> $row[2], $row[1] </option>";
		}
	}
}

/***********************************************************************************************************
**	function createClientMenu():
************************************************************************************************************/
function createClientMenu($clientid) {
	global $mysql_companies_table, $info, $id;
	//we do have the information for info here.  In the case of creating a ticket, info array is empty.
	//in the case of updating a ticket, info array is full of stuff.
	$sql = "select id, company_name from $mysql_companies_table order by company_name asc";
	$result = execsql($sql);

	if(!isset($clientid) || $clientid == '')
		echo '<option></option>';
	while($row = mysql_fetch_row($result)) {
		// skip supporter's company with id = 2 and inactive contacts with id = 1
		if($row[0] != 2 && $row[0] != 1) {
			echo "<option value=$row[0]";
			if($clientid == $row[0]) {
					echo " selected";
				}
			echo ">".$row[1]."</option>";
		}
	}
}

/***********************************************************************************************************
**	function createContactMenu():
************************************************************************************************************/
function createContactMenu($company_id, $person_id) {
	global $mysql_people_table;
	if($company_id == '' || !isset($company_id) || $company_id == 1) {
		$sql = "select id, first_name, last_name from $mysql_people_table where company_id='1' order by last_name asc";
	} else {
		$sql = "select id, first_name, last_name from $mysql_people_table where company_id='$company_id' order by last_name asc";
	}
	if($company_id == '' || !isset($company_id) || $company_id == 1) {
		echo "<option></option>";
		echo "<option>Choose Client</option>";
	} else {
		$result = execsql($sql);
		while($row = mysql_fetch_row($result)) {
			echo "<option value=\"$row[0]\"";
			if($person_id == $row[0]) {
				echo " selected";
			}
			echo "> $row[2], $row[1] </option>";
		}
	}
}

/***********************************************************************************************************
**	function getTicketInfo():
************************************************************************************************************/
function getTicketInfo($id) {
	global $mysql_tickets_table;
	$sql = "select * from $mysql_tickets_table where id=$id";
	$result = execsql($sql);
	$row = mysql_fetch_array($result);
	return $row;
}

/***********************************************************************************************************
**	function displayTicketDetail():
************************************************************************************************************/
function displayTicketDetail($id) {
	global $enable_time_tracking, $lang, $dateformat;
	//$info is an array that contains the ticket information for that id number.
	$ticketinfo = getTicketInfo($id);
	$group_id = $ticketinfo['group_id'];
	$supporter_id = $ticketinfo['supporter_id'];
	$client_id = $ticketinfo['company_id'];
	$contact_id = $ticketinfo['contact_id'];
	$author_id = $ticketinfo['author_id'];
	$priority_id = $ticketinfo['priority_id'];
	$status_id = $ticketinfo['status_id'];
	$platform_id = $ticketinfo['platform_id'];
	$category_id = $ticketinfo['category_id'];
	$title = $ticketinfo['title'];
	$description = ereg_replace("\r\n","<br>",$ticketinfo['description']);
	$description = eregi_replace("  ", "&nbsp;&nbsp;", $description);
	$clientinfo = getCompanyInfo($client_id);
	$clientname = $clientinfo['company_name'];
	$groupinfo = getGroupInfo($group_id);
	$groupname = $groupinfo['group_name'];
	$modifiedon = date($dateformat, $ticketinfo['date_modified']);
	$createdon = date($dateformat, $ticketinfo['date_created']);
	$contactinfo = getPeopleInfo($contact_id);
	$authorinfo = getPeopleInfo($author_id);
	$supporterinfo = getPeopleInfo($supporter_id);
	$contactfirst = $contactinfo['first_name'];
	$contactlast = $contactinfo['last_name'];
	$authorfirst = $authorinfo['first_name'];
	$authorlast = $authorinfo['last_name'];
	$supporterfirst = $supporterinfo['first_name'];
	$supporterlast = $supporterinfo['last_name'];
	if ($authorfirst == '' && $authorlast == '') $authorfirst = "<i>unknown</i>";
	if ($contactfirst == '' && $contactlast == '') $contactfirst = "<i>unknown</i>";
	if ($supporterfirst == '' && $supporterlast == '') $supporterfirst = "<i>unknown</i>";
	$priority = getPriority($priority_id);
	$status = getStatus($status_id);
	// prepare arrays to generate table
	$tabletitle = $lang[ticket_information];
	$arraylinks = array();
	if($enable_time_tracking == 'on') {
		array_push($arraylinks, outputURL("tickettime&id=$id", $lang[track_time], "info"));
	}
	array_push($arraylinks, outputURL("ticketfiles&id=$id", $lang[files], "info"));
	array_push($arraylinks, outputURL("updateticketlog&id=$id", $lang[history], "info"));
	array_push($arraylinks, outputURL("editticket&id=$id", $lang[edit], "info"));
	$links = outputArrayOfLinks($arraylinks);
	$innertable = array();
	$row = array($lang[ticket_id].": $id", $links);
	array_push($innertable, $row);
	$row = array($lang[title], $title);
	array_push($innertable, $row);
	$row = array($lang[description], $description);
	array_push($innertable, $row);
	$row = array($lang[contact], outputURL("detailcontact&id=$contact_id", "$contactlast, $contactfirst"));
	array_push($innertable, $row);
	$row = array($lang[company], outputURL("detailcompany&id=$client_id", $clientname));
	array_push($innertable, $row);
	$row = array($lang[priority], $priority);
	array_push($innertable, $row);
	$row = array($lang[status], $status);
	array_push($innertable, $row);
	$row = array($lang[supporter], "$supporterlast, $supporterfirst");
	array_push($innertable, $row);
	$row = array($lang[group], $groupname);
	array_push($innertable, $row);
	$row = array($lang[modified_by], "$authorlast, $authorfirst");
	array_push($innertable, $row);
	$row = array($lang[last_modified], $modifiedon);
	array_push($innertable, $row);
	$row = array($lang[date_created], $createdon);
	array_push($innertable, $row);

	// start html output
	outputFrameTable($tabletitle, $innertable);
	// end html output
}

/***********************************************************************************************************
**	function displayTicketHistory():
************************************************************************************************************/
function displayTicketHistory($id, $pop, $sort) {
	// $pop is used to determine whether the window is poping out or not
	global $mysql_tickets_table, $delimiter, $lang;
	$sql = "select update_log from $mysql_tickets_table where id=$id";
	$result = execsql($sql);
	$log = mysql_fetch_row($result);
	//put the contents of the update log in an array
	$log = explode($delimiter, $log[0]);
	$header = $lang['ticket_history_log'] . str_pad($id, 5, "0", STR_PAD_LEFT);

	echo '<html><head><title>'.$header.'</title></head><body>';

	echo '
		<table class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
			<tr>
				<td>
					<table cellSpacing=1 cellPadding=5 width="100%" border=0>
						<tr>
							<td class=info>
								<table border=0 cellpadding=0 cellspacing=0 width=100%>
									<tr>
										<td width=20% class=info align=left><font size=1>';
	if(!isset($sort)) {
		if(!isset($pop)) {
			echo '
											<a href=index.php?t=updateticketlog&id='.$id.'&sort=rev>'.$lang['reverse'].'</a></font></td>';
		} else {
			echo '
											<a href=?id='.$id.'&sort=rev&pop=true>'.$lang['reverse'].'</a></font></td>';
		}
	} else {
		if(!isset($pop)) {
			echo '
											<a href=index.php?t=updateticketlog&id='.$id.'>'.$lang['reverse'].'</a></font></td>';
		} else {
			echo '
											<a href=?id='.$id.'&pop=true>'.$lang['reverse'].'</a></font></td>';
		}
	}
	echo '
										<td class=info align=middle><b>'. $header .'</b></td>
										<td width=20% class=info align=right align=middle>';
	if(!isset($pop)) {
		echo '
											<a class=info href=index.php?t=detailticket&id='.$id.'>'.$lang['detail'].'</a>,
											<a class=info href=index.php?t=editticket&id='.$id.'>'.$lang['edit'].'</a>';
	} else {
		echo '
											&nbsp;';
	}
	echo '
										</td>
									</tr>
								</table>
							</td>
						</tr>';
	if($sort == "rev") {
		for($i=0; $i<sizeof($log)-1; $i++) {
			$log[$i] = eregi_replace("\n", "<br>", $log[$i]);
			$log[$i] = eregi_replace("  ", "&nbsp;&nbsp;", $log[$i]);
			$log[$i] = stripslashes($log[$i]);
			if($i%2 == 0) {
				echo "
						<tr><td colspan=3 class=cat align=left><font size=1><b>". $log[$i] ."</b></font></td></tr>";
			} else {
				echo "
						<tr><td colspan=3 class=back2 align=left>". $log[$i] ."<br></td></tr>";
			}
		}
	} else {
		for($i=sizeof($log)-2; $i>=0; $i--) {
			$log[$i] = eregi_replace("\n", "<br>", $log[$i]);
			$log[$i] = eregi_replace("  ", "&nbsp;&nbsp;", $log[$i]);
			$log[$i] = stripslashes($log[$i]);
			if($i%2 != 0) {
				echo "
						<tr><td colspan=3 class=cat align=left><font size=1><b>". $log[$i-1] ."</b></font></td></tr>";
			} else {
				echo "
						<tr><td colspan=3 class=back2 align=left>". $log[$i+1] ."<br></td></tr>";
			}
		}
	}
	echo '
					</table>
				</td>
			</tr>
		</table>';
	echo '</body></html>';
}

/***********************************************************************************************************
**	function getDiskId():
************************************************************************************************************/
function getDiskId($id) {
	global $mysql_ticketdiskid_table;
	$sql = "select diskid from $mysql_ticketdiskid_table where ticket_id=$id";
	$result = execsql($sql);
	if($row = mysql_fetch_array($result)) {
		return $row[0];
	} else {
		return '';
	}
}

/***********************************************************************************************************
**	function ticketHasMoreDetail():
************************************************************************************************************/
function ticketHasMoreDetail($ticketid) {
	global $mysql_ticketmodules_table, $mysql_tickets_table;

	$ticketinfo = getTicketInfo($ticketid);
	$versionid = $ticketinfo['version_id'];
	$diskid = getDiskId($ticketid);
	if(isset($versionid) && $versionid != '0') {
		return true;
	} else if(isset($diskid) && $diskid != '') {
		return true;
	} else {
		$sql = "select * from $mysql_ticketmodules_table where ticket_id='$ticketid'";
		$result	= execsql($sql);
		$numrows = mysql_num_rows($result);
		if($numrows == 0) {
			return false;
		} else {
			return true;
		}
	}
}

/***********************************************************************************************************
**	function createPlatformMenu():
************************************************************************************************************/
function createPlatformMenu($platform) {
	global $mysql_platforms_table;
	$sql = "select id, platform from $mysql_platforms_table order by platform asc";
	$result = execsql($sql);
	if(!isset($platform) || $platform == '')
		echo "<option></option>";
	while($row = mysql_fetch_row($result)) {
		echo "<option value=\"$row[0]\" ";
			if($platform == $row[0]) echo "selected";
			echo "> $row[1] </option>";
	}
}

/***********************************************************************************************************
**	function createCategoryMenu():
************************************************************************************************************/
function createCategoryMenu($category) {
	global $mysql_tcategories_table;
	$sql = "select id, category from $mysql_tcategories_table order by category asc";
	$result = execsql($sql);
	if(!isset($category) || $category == '')
		echo "<option></option>";
	while($row = mysql_fetch_row($result)) {
		echo "<option value=\"$row[0]\" ";
			if($category == $row[0]) echo "selected";
			echo "> $row[1] </option>";
	}
}

/***********************************************************************************************************
**	function createPriorityMenu():
************************************************************************************************************/
function createPriorityMenu($priority) {
	global $mysql_tpriorities_table;
	$sql = "select id, priority from $mysql_tpriorities_table order by rank desc";
	$result = execsql($sql, $mysql_tpriorities_table);
	if(!isset($priority) || $priority == '')
		echo "<option></option>";
	while($row = mysql_fetch_row($result)) {
		echo "<option value=\"$row[0]\" ";
			if($priority == $row[0]) echo "selected";
			echo "> $row[1] </option>";
	}
}

/***********************************************************************************************************
**	function createStatusMenu():
************************************************************************************************************/
function createStatusMenu($status) {
	global $mysql_tstatus_table;
	$sql = "select id, status from $mysql_tstatus_table order by rank asc";
	$result = execsql($sql, $mysql_tstatus_table);
	if(!isset($status) || $status == '')
		echo "<option></option>";
	while($row = mysql_fetch_row($result)) {
		echo "<option value=\"$row[0]\" ";
			if($status == $row[0]) echo "selected";
			echo "> $row[1] </option>";
	}
}

/***********************************************************************************************************
**	function createVersionMenu():
************************************************************************************************************/
function createVersionMenu($versionselected) {
	global $mysql_versions_table;
	$sql = "select id, version_name from $mysql_versions_table order by version_name asc";
	$result = execsql($sql);
	if(!isset($versionselected) || $versionselected == '' || $versionselected == 0)
		echo "<option></option>";
	while($row = mysql_fetch_row($result)) {
		echo "<option value=\"$row[0]\" ";
			if($versionselected == $row[0]) echo "selected";
			echo "> $row[1] </option>";
	}
}

/***********************************************************************************************************
**	function createModuleMenu():
************************************************************************************************************/
function createModuleMenu($module) {
	global $mysql_modules_table;
	$sql = "select module_name from $mysql_modules_table order by module_name asc";
	$result = execsql($sql);
	if(!isset($module) || $module == '')
		echo "<option></option>";
	while($row = mysql_fetch_row($result)) {
		echo "<option value=\"$row[0]\" ";
			if($module == $row[0]) echo "selected";
			echo "> $row[0] </option>";
	}
}

/***********************************************************************************************************
**	function createModuleCheckBoxes():
************************************************************************************************************/
function createModuleCheckBoxes($ticketid) {
	global $mysql_modules_table;
	$sql = "select id, module_name from $mysql_modules_table order by module_name asc";
	$result = execsql($sql);
	$numcolumns = 5;
	$width = 100/$numcolumns;
	$i=1;
	while($row = mysql_fetch_array($result)) {
		if($i%$numcolumns == 1) {
			echo '<tr>';
		}
		echo '<td class=back3 width='.$width.'%>';
		$checked = "";
		if (moduleIsInTicket($row['id'], $ticketid)) {
			$checked = " checked";
			echo "<input type=hidden name=check".$i." value=true><input type=hidden name=checkid".$i." value=".$row['id'].">";
		} else {
			echo "<input type=hidden name=check".$i." value=false>";
		}
		echo "<b><input class=box type=checkbox name=modbox".$i." value=".$row['id'].$checked.">&nbsp;&nbsp;".$row['module_name']."</b><br></td>";
		if($i%$numcolumns == 0) {
			echo '</tr>';
		}
		$i++;
	}
	$num_boxes = $i - 1;
	if($i%$numcolumns != 1) {
		while($i%$numcolumns != 1) {
			echo "
				<td class=back>&nbsp;</td>";
			$i++;
		}
		echo '
			</tr>';
	}
	echo "<input type=hidden name=num_boxes value=$num_boxes>";
}

/***********************************************************************************************************
**	function moduleIsInTicket():
************************************************************************************************************/
function moduleIsInTicket($moduleid, $ticketid) {
	global $mysql_ticketmodules_table;
	$sql = "select * from $mysql_ticketmodules_table where ticket_id = '$ticketid' and module_id = '$moduleid'";
	$result = execsql($sql);
	$numrows = mysql_num_rows($result);
	if($numrows == 0) {
		return false;
	} else {
		return true;
	}
}

/***********************************************************************************************************
**	function getNumberOfGroups():
************************************************************************************************************/
function getNumberOfGroups() {
	global $mysql_groups_table;
	$sql = "select count(group_name) from $mysql_groups_table";
	$result = execsql($sql);
	$row = mysql_fetch_row($result);
	return $row[0];
}

/***********************************************************************************************************
**	function getNumberOfSupporters():
************************************************************************************************************/
function getNumberOfSupporters() {
	global $mysql_people_table;
	$sql = "select count(user_name) from $mysql_people_table where supporter='1'";
	$result = execsql($sql);
	$row = mysql_fetch_row($result);
	return $row[0];
}

/***********************************************************************************************************
**	function getCompanyMaintaned():
**		Takes one argument, the contact id.  Queries the companies table and returns the company id where
**	the contact is main contact, if applicable, as an integer value.
************************************************************************************************************/
function getCompanyWhereMainContactIs($userid) {
	global $mysql_companies_table;
	$sql = "select id from $mysql_companies_table where main_contact_id='$userid'";
	$result = execsql($sql);
	if($row = mysql_fetch_row($result)) {
		return $row[0];
	} else {
		return '';
	}
}


/***********************************************************************************************************
**	function contactMovedToCompany(): when moving a contact to a company the contact should be made the main
**	contact if the company has no main contact. this usually happens when adding first contact.
************************************************************************************************************/
function contactMovedToCompany($contact_id, $company_id, $supporter_id, $time) {
	global $mysql_companies_table;
	// check whether the company already has a main contact and if not make this contact
	// the main contact for company
	$sql = "select main_contact_id from $mysql_companies_table where id='$company_id'";
	$result = execsql($sql);
	$row = mysql_fetch_array($result);
	if($row[0] == '0') {
		$sql = "update $mysql_companies_table set main_contact_id='$contact_id', author_id='$supporter_id', date_modified='$time' where id='$company_id'";
		execsql($sql);
	}
}


/***********************************************************************************************************
**	function contactRemovedFromCompany(): when removing a contact from a company, check whether the contact
**	is the main contact and if so assign main contact status to someone else, if possible.
************************************************************************************************************/
function contactRemovedFromCompany($contact_id, $company_id, $supporter_id, $time) {
	global $mysql_companies_table, $mysql_people_table;
	// check whether the contact was main contact of previous company
	$main_contact_for_companyid = getCompanyWhereMainContactIs($contact_id);
	if ($main_contact_for_companyid != '' && $main_contact_for_companyid == $company_id) {
		// find contacts for previous company
		$oldcompany = $main_contact_for_companyid;
		$sql = "select id from $mysql_people_table where company_id='$oldcompany'";
		$result = execsql($sql);
		if($row = mysql_fetch_array($result)) {
			// there are contacts in the group; make the first one the main contact
			$new_contact_id = $row[0];
			$sql = "update $mysql_companies_table set main_contact_id='$new_contact_id', author_id='$supporter_id', date_modified='$time' where id='$oldcompany'";
			execsql($sql);
		} else {
			// there are no contacts left in the company...
			$sql = "update $mysql_companies_table set main_contact_id='0', author_id='$supporter_id', date_modified='$time' where id='$oldcompany'";
			execsql($sql);
		}
	}
}

/***********************************************************************************************************
**	function updateTicketLog():
**		Takes an integer and a string as input.  The integer value is the ticket id number.  The string is
**	the message to append to the update log along with a timestamp.
************************************************************************************************************/
function updateTicketLog($ticket_id, $msg, $author_name) {
	global $mysql_tickets_table, $delimiter;
	$time = time();		//get the current time to put in the message

	//grab the current update log from the tickets table.
	$log = getCurrentTicketLog($ticket_id);

	$log .= date("F j, Y, g:i a", $time) . " by " . $author_name . "$delimiter" . addslashes($msg) . "$delimiter";
	return $log;
}

/***********************************************************************************************************
**	function getCurrentTicketLog():
**		Takes one argument.  Gets the current update log string of the ticket given the id and returns it.
************************************************************************************************************/
function getCurrentTicketLog($id) {
	global $mysql_tickets_table;
	$sql = "select update_log from $mysql_tickets_table where id=$id";
	$result = execsql($sql);
	$row = mysql_fetch_row($result);
	//returns the entire contents of the update log as a string.
	return addslashes($row[0]);
}

/***********************************************************************************************************
**	function createFAQCategoriesMenu():
************************************************************************************************************/
function createFAQCategoriesMenu($faqid) {
	global $mysql_faqcategories_table;
	$sql = "select id, category_name from $mysql_faqcategories_table order by category_name asc";
	$result = execsql($sql);
	if(!isset($faqid) || $faqid == '')
		echo "<option></option>";
	while($row = mysql_fetch_row($result)) {
		echo "<option value=\"$row[0]\"";
			if ($row[0] == $faqid) {
				echo " selected";
			}
		echo "> $row[1] </option>";
	}
}

/***********************************************************************************************************
**	function getFAQInfo():
************************************************************************************************************/
function getFAQInfo($id) {
	global $mysql_faqs_table;
	$sql = "select * from $mysql_faqs_table where id=$id";
	$result = execsql($sql);
	$row = mysql_fetch_array($result);
	return $row;
}

/***********************************************************************************************************
**	function getFAQCategory():
************************************************************************************************************/
function getFAQCategory($id) {
	global $mysql_faqcategories_table;
	$sql = "select category_name from $mysql_faqcategories_table where id='$id'";
	$result = execsql($sql);
	$row = mysql_fetch_row($result);
	return $row[0];
}

/***********************************************************************************************************
**	function displayFAQDetail():
************************************************************************************************************/
function displayFAQDetail($id) {
    // [15/12/2003 seh]
    global $lang;
    // [/seh]
	$info = getFAQInfo($id);
	$question = $info['question'];
	$authorid = $info['author_id'];
	$categoryid = $info['category_id'];
	$modifiedon = date("m/d/y",$info['date_modified']);
	$answer = ereg_replace("\r\n","<br>",$info['answer']);
	$comments = ereg_replace("\r\n","<br>",$info['comments']);
	$authorname = getPersonName($authorid);
	if ($authorname == '') $authorname = "<i>unknown</i>";
	$category = getFAQCategory($categoryid);

	echo '
		<table class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
			<tr>
				<td>
					<table cellSpacing=1 cellPadding=5 width="100%" border=0>
						<tr>
							<td class=info align=middle><b>'.$lang['faq_detail'].'</b></td>
						</tr>
						<tr>
							<td class=back>
								<table cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
									<tr>
										<td>
											<table class=border cellSpacing=1 cellPadding=5 width="100%" border=0>
												<tr>
													<td class=info align=left align=middle><b>'.$lang['faq_id'].': ' . $id . '</b></td>
													<td class=info align=right align=middle><a class=info href=index.php?t=editfaq&id='.$id.'>'.$lang['edit'].'</a></td>
												</tr>
												<tr>
													<td width=20% class=back2 align=right>'.$lang['question'].':</td><td class=back>'. $question .'</td>
												</tr>
												<tr>
													<td width=20% class=back2 align=right>'.$lang['answer'].':</td><td class=back>'. $answer .'</td>
												</tr>
												<tr>
													<td width=20% class=back2 align=right>'.$lang['category'].':</td><td class=back>'. $category .'</td>
												</tr>
												<tr>
													<td width=20% class=back2 align=right>'.$lang['comments'].':</td><td class=back>'. $comments .'</td>
												</tr>
												<tr>
													<td width=20% class=back2 align=right>'.$lang['modified_by'].':</td><td class=back>'. $authorname .'</td>
												</tr>
												<tr>
													<td width=20% class=back2 align=right>'.$lang['last_modified'].':</td><td class=back>'. $modifiedon .'</td>
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
		</table>';
}

/***********************************************************************************************************
**	function getNumberOfOpenTickets():
**		Takes one argument.  If the id is not set, this returns the total number of open tickets in the
**	database.  If the id is set, it returns the total number of tickets that are open and assigned to the
**	user with the given id.
************************************************************************************************************/
function getNumberOfOpenTickets($id) {
	global $mysql_tickets_table, $mysql_tstatus_table;
	$higheststatus = getHighestRank($mysql_tstatus_table); // highest rank corresponds to closed tickets
	if(!isset($id) || $id == '') {
		$sql = "select count(id) from $mysql_tickets_table where status_id!='$higheststatus'";
	} else {
		$sql = "select count(id) from $mysql_tickets_table where status_id!='$higheststatus' and supporter_id=$id";
	}
	$result = execsql($sql);
	$row = mysql_fetch_row($result);
	return $row[0];
}

/***********************************************************************************************************
**	function getNumberOfClosedTickets():
**		Takes one argument.  If the id is not set, this returns the total number of closed tickets in the
**	database.  If the id is set, it returns the total number of tickets that are closed and assigned to the
**	user with the given id.
************************************************************************************************************/
function getNumberOfClosedTickets($id) {
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

/***********************************************************************************************************
**	function getNumberOfTickets():
************************************************************************************************************/
function getNumberOfTickets($id) {
	global $mysql_tickets_table;
	if(!isset($id) || $id == '') {
		$sql = "select count(id) from $mysql_tickets_table";
	} else {
		$sql = "select count(id) from $mysql_tickets_table where supporter_id=$id";
	}
	$result = execsql($sql);
	$row = mysql_fetch_row($result);
	return $row[0];
}

/***********************************************************************************************************
**	function accessError():
************************************************************************************************************/
function accessError($error, $message) {
	echo '
	<br>
	<table class=install cellSpacing=0 cellPadding=0 width="80%" align=center border=0>
		<tr>
			<td colspan=100%>
				<table cellSpacing=1 cellPadding=5 width="100%" border=0>
					<tr>
						<td class=head colspan=100% align=center>
							<b>MyHelpdesk Access Error</b>
						</td>
					</tr>
					<tr>
						<td bgcolor=white colspan=100%>
							<br>
							<table class=install cellSpacing=0 cellPadding=0 width=100% align=center border=0>
								<tr>
									<td>
										<table cellSpacing=1 cellPadding=5 width="100%" border=0>
											<tr>
												<td class=head align=center>
													<b>'. $error .'</b>
												</td>
											</tr>
											<tr>
												<td class=install>
													<center>
														<br><font color=red><b>'. $message .'</b></font><br>
														<b>Please press the back button on your browser to correct the problem.</b><br><br>
													</center>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
							<br>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>';
}

/***********************************************************************************************************
**	function getContactsAlphabeticIndex():
************************************************************************************************************/
function getContactsAlphabeticIndex($letter) {
	global $mysql_people_table;
	// need to filter out company_id = 2 (supporters) and default contact with id = 1
//	$sql = "select count(*) from $mysql_people_table where last_name < '$letter' and company_id != '2' and id != '1'";
	$sql = "select count(*) from $mysql_people_table where last_name < '$letter' and company_id != '2' and id != '1' and user='1'";
	$result = execsql($sql);
	$row = mysql_fetch_array($result);
	return $row[0];
}

/***********************************************************************************************************
**	function outputBar():
************************************************************************************************************/
function outputBar($value, $total) {
	if($total == 0) {
		$percent = 0;
	} else {
		$percent = round(($value/$total)*100);
	}
	$scale = $percent * 0.8;
	echo '
		<img src=./images/blue_bar.jpg height=10 width='. $scale .'%>';
	echo str_pad($value, (3-strlen(strval($value)))*12 + strlen(strval($value)), "&nbsp;&nbsp;", STR_PAD_LEFT);
}

/***********************************************************************************************************
**	function outputSimpleTable():
************************************************************************************************************/
function outputSimpleTable($title, &$headrow, &$rows, &$align, $message=false) {
	$numcolumns = count($headrow);
	// reverse rows
	$rows = array_reverse($rows);
	$messagerow = "";
	if($message) {
		$messagerow = "<tr><td class=cat align=left>$message</td></tr>";
	}
	echo '
	<table class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
		<tr>
			<td>
				<table cellSpacing=1 cellPadding=5 width="100%" border=0>
					<tr>
						<td class=info align=middle><b>'.$title.'</b></td>
					</tr>
					'.$messagerow.'
					<tr>
						<td class=back>
							<table class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
								<tr>
									<td>
										<table cellSpacing=1 cellPadding=5 width="100%" border=0>
											<tr>';
	for($j = 0; $j < $numcolumns; $j++) {
		echo '<td class=cat align=center><b>'.$headrow[$j].'</b></td>';
	}
	echo '</tr>';
	while(!is_null($row = array_pop($rows))) {
		echo '<tr>';
		$class = "back2";
		for($j = 0; $j < $numcolumns; $j++) {
			echo '
			<td class='.$class.' align='.$align[$j].'>'.$row[$j].'</td>';
			if($class == "back") {
				$class = "back2";
			} else {
				$class = "back";
			}
		}
		echo '</tr>';
	}
	echo '
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table><br>';
}

/***********************************************************************************************************
**	function outputFrameTable():
************************************************************************************************************/
function outputFrameTable($title, &$innertable, $innertype='detail') {
	echo '
	<table class=border cellSpacing=0 cellPadding=0 width=100% align=center border=0>
		<tr>
			<td>
				<table cellSpacing=1 cellPadding=5 width=100% border=0>
					<tr>
						<td class=info align=middle><b>'.$title.'</b></td>
					</tr>
					<tr>
						<td class=back>';
						outputDisplayTable($innertable, $innertype); echo '
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>';
}

/***********************************************************************************************************
**	function outputDisplayTable():
************************************************************************************************************/
function outputDisplayTable(&$rows, $type='detail') {
	// reverse rows
	$rows = array_reverse($rows);
	$row = array_pop($rows);
	$headleft = $row[0];
	$headright = $row[1];
	if($type == 'faq') {
		$alignleft = "center";
		$alignright = "center";
		$headright = "<b>$headright</b>";
	} else {
		$alignleft = "left";
		$alignright = "right";
	}
	echo '
	<table cellSpacing=0 cellPadding=0 width=100% align=center border=0>
		<tr>
			<td>
				<table class=border cellSpacing=1 cellPadding=5 width=100% border=0>
					<tr>
						<td width=20% class=info align='.$alignleft.' align=middle><b>'.$headleft.'</b></td>
						<td class=info align='.$alignright.' align=middle>'.$headright.'</td>
					</tr>';
	while(!is_null($row = array_pop($rows))) {
		echo '
					<tr>
						<td width=20% class=back2 align=right>'.$row[0].':</td>
						<td class=back>'.$row[1].'</td>
					</tr>';
	}
	echo '
				</table>
			</td>
		</tr>
	</table>';
}

/***********************************************************************************************************
**	function outputSortByFormTable():
************************************************************************************************************/
function outputSortByFormTable($actionlink, $label, &$ddmenu, &$innertables) {
	$ddmenu = array_reverse($ddmenu);
	$tables = array_reverse($innertables);
	$row = array_pop($ddmenu);
	$name = $row[0];
	$value = $row[1];
	echo '
	<form action=index.php?t='.$actionlink.' method=post>
		<table class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
			<tr>
				<td>
					<table cellSpacing=1 cellPadding=5 width="100%" border=0>
						<tr>
							<td class=info align=right>
								<b>'.$label.':
									<select name='.$name.' onChange="submit()">';
	while(!is_null($row = array_pop($ddmenu))) {
		$selected = "";
		if($value == $row[0]) $selected = " selected";
		echo "<option value=$row[0]$selected>$row[1]</option>";
	}
	echo '
									</select>
								</b>
							</td>
						</tr>
						<tr>
							<td class=back>';
	while(!is_null($table = array_pop($tables))) {
		outputDisplayTable($table);
		if(count($tables) > 0) echo '<br>';
	}
	echo '
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</form>';
}

/***********************************************************************************************************
**	function outputInputFormTable():
************************************************************************************************************/
function outputInputFormTable($action, $title, &$rows, &$buttons, $hidden=false) {
	$rows = array_reverse($rows);
	$buttons = array_reverse($buttons);
	echo '
	<form action='.$action.' method=post>
		<table class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
			<tr>
				<td>
					<table cellSpacing=1 cellPadding=5 width="100%" border=0>
						<tr>
							<td class=info align=middle>
								<b>'.$title.'</b>
							</td>
						</tr>
						<tr>
							<td class=back>
								<table class=border cellSpacing=0 cellPadding=0 width=100% align=center border=0>
									<tr>
										<td>
											<table cellSpacing=1 cellPadding=5 width="100%" border=0>';
	while(!is_null($row = array_pop($rows))) {
		$type = $row[0];
		$label = $row[1];
		echo '
												<tr>
													<td class=cat align=right width=20%>
														<b> '.$label.': </b>
													</td>';
		if($type == 'text') {
			$name = $row[2];
			echo '
													<td class=back>
														<input type=text size=40 name='.$name.'>
													</td>
												</tr>';
		}
		if($type == 'password') {
			$name = $row[2];
			echo '
													<td class=back>
														<input type=password name='.$name.'>
													</td>
												</tr>';
		}
		if($type == 'checkbox') {
			$numcolumns = $row[3];
			$width = 100/$numcolumns;
			$checkboxes = $row[2];
			$checkboxes = array_reverse($checkboxes);
			echo '
													<td class=back>
														<table class=border cellSpacing=1 cellPadding=5 width="100%" border=0>';
			$i = 0;
			while(!is_null($checkbox = array_pop($checkboxes))) {
				$i++;
				$name = $checkbox[0];
				$value = $checkbox[1];
				$display = $checkbox[2];
				if($i%$numcolumns == 1) {
					echo '<tr>';
				}
				echo '<td class=back3 width='.$width.'%><input class=box type=checkbox name='.$name.' value='.$value.'>&nbsp;&nbsp;<b>'.$display.'</b></td>';
				if($i%$numcolumns == 0) {
					echo '</tr>';
				}
			}
			$i++;
			if($i%$numcolumns != 1) {
				while($i%$numcolumns != 1) {
					echo '<td class=back>&nbsp;</td>';
					$i++;
				}
				echo '</tr>';
			}
			echo '
														</table>
													</td>
												</tr>';
		}
		if($type == 'textarea') {
			$name = $row[2];
			echo '
													<td class=back>
														<textarea name='.$name.' rows=3 cols=72></textarea>
													</td>
												</tr>';
		}
		if($type == 'select') {
			$name = $row[2];
			$ddmenu = $row[3];
			$ddmenu = array_reverse($ddmenu);
			echo '
													<td class=back>
														<select name='.$name.'>';
			while(!is_null($option = array_pop($ddmenu))) {
				$value = $option[0];
				$display = $option[1];
				echo '

															<option value='.$value.'>'.$display.'</option>';
			}
			echo '
														</select>
													</td>
												</tr>';
		}
	}
	echo '
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
	while(!is_null($button = array_pop($buttons))) {
		$type = $button[0];
		$label = $button[1];
		$name = $button[2];
		echo '	
			<input type='.$type.' name='.$name.' value="'.$label.'">';
	}
	if($hidden) {
		while(!is_null($hide = array_pop($hidden))) {
			$value = $hide[1];
			$name = $hide[0];
			echo '
				<input type=hidden name='.$name.' value="'.$value.'">';
		}
	}
	echo '
		</center>
	</form>';
}

/***********************************************************************************************************
**	function outputURL():
************************************************************************************************************/
function outputURL($link, $name, $class=false) {
	if($class) {
		$class = " class=$class";
	} else {
		$class = "";
	}
	return "<a$class href=index.php?t=$link>$name</a>";
}

/***********************************************************************************************************
**	function outputArrayOfLunks():
************************************************************************************************************/
function outputArrayOfLinks(&$links) {
	$links = array_reverse($links);
	$arraylinks = array_pop($links);
	while(!is_null($newlink = array_pop($links))) {
		$arraylinks .= ", " . $newlink;
	}
	return $arraylinks;
}

/***********************************************************************************************************
**	function outputNavigationLink():
************************************************************************************************************/
function outputNavigationLink($offset, $maxoffset, $limit, $link, $midlink=false) {
	global $lang;
	$navlink = "";
	$offset = $offset - $limit;
	if($offset + $limit == 0) {
		$navlink .= $lang['previous'];
	} else if($offset < 0) {
		$offsetval = 0;
		$navlink .= "<a href=index.php?t=$link$offsetval>".$lang['previous']."</a>";
	} else {
		$offsetval = $offset;
		$navlink .= "<a href=index.php?t=$link$offsetval>".$lang['previous']."</a>";
	}
	$navlink .= "&nbsp; |&nbsp;";
	if($midlink != false) {
		$alphabet = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
		for($k = 0; $k < 26; $k++) {
			$navlink .= " <a href=index.php?t=$midlink$alphabet[$k]>$alphabet[$k]</a>";
		}
		$navlink .= "&nbsp; |&nbsp;";
	}
	$offset = $offset + $limit + $limit;
	if($offset < $maxoffset) {
		$offsetval = $offset;
		$navlink .= " <a href=index.php?t=$link$offsetval>".$lang['next']."</a>";
	} else {
		$navlink .= " ".$lang['next'];
	}
	echo "<center>$navlink</center>";
}

?>