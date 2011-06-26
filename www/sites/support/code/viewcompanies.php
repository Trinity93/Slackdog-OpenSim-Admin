<?php
/*****************************************************************************************
**	file:	viewcompanies.php
******************************************************************************************
**	author:	Luis Bernardo
**	date:	10 Dec 2003
********************************************************************************
**	$Revision: 1.5 $ on $Date: 2004/02/08 07:27:02 $ by $Author: lmpmbernardo $
**************************************************************************************/

$action = $_GET['action'];
$id = $_GET['id'] ? $_GET['id'] : $_POST['id'];
$confirmdelete = $_POST['confirmdelete'];
$o = $_GET['o'] ? $_GET['o'] : $_POST['o'];
$offset = $_GET['offset'];

if(isset($confirmdelete) && $id > '2') {
	// get id of logged in user (supporter)
	$supporter_id = getPersonID($cookie_name);
	// time contact modified
	$time = time();
	// get company name
	$info = getCompanyInfo($id);
	$name = $info['company_name'];
	// first find all contacts that belong to company
	$sql = "select id from $mysql_people_table where company_id='$id'";
	$result = execsql($sql);
	while($row = mysql_fetch_row($result)) {
		// then move contact to "Inactive Contacts" company
		$sql = "update $mysql_people_table set company_id='1', author_id='$supporter_id', date_modified='$time' where id='$row[0]'";
		execsql($sql);
		// then make sure data in old company is consistent. this step is in reality unnecessary because the company is going to be deleted
		contactMovedToCompany($row[0], '1', $supporter_id, $time);
		contactRemovedFromCompany($row[0], $id, $supporter_id, $time);
	}
	// then remove company from companies table
	$sql = "delete from $mysql_companies_table where id=$id";
	execsql($sql);
	$success_message = "Company \"$name\" successfully deleted.";
	printSuccess($success_message);
} else if($action == 'delete' && $id > '2' && !isset($cancel)) {
	// cannot delete companies with id 1 and 2
	echo '
	<form action=index.php?t=viewcompanies method=post>
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
									<br/><center><b><font color=red>'.$lang['q_are_you_sure'].'</font><br/>
                                    '.$lang['text_warning_del_company'].'</b></center><br/>
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
			<input type=submit name=confirmdelete value="'.$lang['delete'].'">&nbsp;&nbsp;
			<input type=submit name=cancel value="'.$lang['cancel'].'">
		</center>
	</form>';
} else {
	echo '
	<form action=index.php?t=viewcompanies method=post>
		<table class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
			<tr>
				<td>
					<table cellSpacing=1 cellPadding=5 width="100%" border=0>
						<tr>
							<td class=info align=right>
								<b>'.$lang['sort_by'].':
									<select name=o onChange="submit()">
										<option value="id"'; if($o=='id') echo ' selected'; echo '>'.$lang['id'].'</option>
										<option value="company_name"'; if($o=='company_name') echo ' selected'; echo '>'.$lang['company'].'</option>
									</select>
								</b>
							</td>
						</tr>
						<tr>
							<td class=back>';
								getListOfCompanies($o, $offset); echo '
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</form>';

	echo '
		<center>';
	$offset = $offset - $groups_limit;
	if($offset < 0){
		echo "
			&nbsp;".$lang['previous'];
	} else {
		echo "
			&nbsp;<a href=index.php?t=viewcompanies&o=$o&offset=$offset>".$lang['previous']."</a>";
	}
	echo "
		&nbsp; | &nbsp;";
	if($o == 'company_name') {
		$alphabet = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
		for($k = 0; $k < 26; $k++) {
			$index = getCompaniesAlphabeticIndex($alphabet[$k]);
			echo "
					<a href=index.php?t=viewcompanies&o=$o&offset=$index>$alphabet[$k]</a>";
		}
		echo "
			&nbsp; | &nbsp;";
	}
	$offset = $offset + $groups_limit +$groups_limit;
	if($offset < getNumberOfCompanies()){
		echo "
			&nbsp;<a href=index.php?t=viewcompanies&o=$o&offset=$offset>".$lang['next']."</a>";
	} else {
		echo "
			&nbsp;".$lang['next'];
	}
}

/***********************************************************************************************************
**	function getCompaniesAlphabeticIndex():
************************************************************************************************************/
function getCompaniesAlphabeticIndex($letter) {
	global $mysql_companies_table;
	// need to filter out id = 2 (supporters company)
	$sql = "select count(*) from $mysql_companies_table where company_name < '$letter' and id != '2'";
	$result = execsql($sql);
	$row = mysql_fetch_array($result);
	return $row[0];
}

/***********************************************************************************************************
**	function getListOfCompanies():
************************************************************************************************************/
function getListOfCompanies($order, $offset) {
	global $mysql_people_table, $mysql_companies_table, $groups_limit, $lang;
	if(!isset($offset))
		$offset = 0;
	$low = $offset;
	switch($order) {
		// company_id = 2 is supporter company so should not be listed... maybe should change this
		case ("company_name"):
			$sql = "select t1.*, t2.first_name, t2.last_name from $mysql_companies_table as t1 left join $mysql_people_table as t2 on t1.main_contact_id=t2.id where t1.id != '2' order by t1.company_name asc limit $low, $groups_limit";
			break;
		default:
			$sql = "select t1.*, t2.first_name, t2.last_name from $mysql_companies_table as t1 left join $mysql_people_table as t2 on t1.main_contact_id=t2.id where t1.id != '2' order by t1.id asc limit $low, $groups_limit";
			break;
	}
	$result = execsql($sql);
	//get all of the data into readable variables.
	$counter = 1;
	$numberofcompanies = getNumberOfCompanies();
	while($row = mysql_fetch_array($result)) {
		$id = $row['id'];
		if(is_null($row['last_name'])) {
			$first = "<i>".$lang['unknown']."</i>";
			$last = "";
		} else {
			$first = ucwords($row['first_name']);
			$last = ucwords($row['last_name']);
		}
		$company = $row['company_name'];
		$address = $row['address'];
		$address = ereg_replace("\r\n","<br>",$address);
		displayCompanyInfo($id, $company, $address, $first, $last);
		if($counter < $groups_limit && $counter+$offset < $numberofcompanies) echo '<br/>';
		$counter++;
	}	//end while
}
?>