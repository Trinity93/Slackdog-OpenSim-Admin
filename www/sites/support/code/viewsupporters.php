<?php
/*******************************************************************************
**	file:	viewsupporters.php
********************************************************************************
**	author:	Luis Bernardo
**	date:	2003/12/10
********************************************************************************
**	$Revision: 1.5 $ on $Date: 2004/01/16 22:18:44 $ by $Author: lmpmbernardo $
*******************************************************************************/

$action = $_GET['action'];
$id = $_GET['id'] ? $_GET['id'] : $_POST['id'];
$confirmdelete = $_POST['confirmdelete'];
$o = $_GET['o'] ? $_GET['o'] : $_POST['o'];
$offset = $_GET['offset'];

if(isset($confirmdelete) && $id != '1') {
	$name = getPersonName($id);
	// supporters belong to the company with id = 2
	$company_id = 2;
	if($company_id != 1) {
		// get id of logged in user (supporter)
		$supporter_id = getPersonID($cookie_name);
		// time contact modified
		$time = time();
		// then move contact to "Inactive Contacts" company
		$sql = "update $mysql_people_table set company_id='1', author_id='$supporter_id', date_modified='$time' where id='$id'";
		execsql($sql);
		// then make sure data in old company is consistent
		contactMovedToCompany($id, '1', $supporter_id, $time);
		contactRemovedFromCompany($id, $company_id, $supporter_id, $time);
	}
	// then remove supporter from people table
	$sql = "delete from $mysql_people_table where id=$id";
	execsql($sql);
	// then remove supporter from groups
	$sql = "delete from $mysql_supporters_table where supporter_id='$id'";
	execsql($sql);
	$success_message = "Supporter \"$name\" successfully deleted.";
	printSuccess($success_message);
} else if($action == 'delete' && $id != '1' && !isset($cancel)) {
	echo '
	<form action=index.php?t=viewsupporters method=post>
		<table class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
			<tr>
				<td>
					<table cellSpacing=1 cellPadding=5 width="100%" border=0>
						<tr>
							<td class=info align=middle>
								<b>'.$lang['confirmation'].'</b>
							</td>
						</tr>
	<tr>
		<td class=back colspan=1>
			<table class=border cellSpacing=0 cellPadding=0 width=100% align=center border=0>
 				<tr>
					<td>
						<table cellSpacing=1 cellPadding=5 width="100%" border=0>
							<tr>
								<td class=back2>
									<br><center><b><font color=red>'.$lang['q_are_you_sure'].'</font><br>
									'.$lang['text_warning_del_supporter'].'</b></center><br>
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
		<input type=hidden name=id value='. $id .'><br/>
		<center>
			<input type="submit" name="confirmdelete" value="'.$lang['delete'].'">&nbsp;&nbsp;
			<input type="submit" name="cancel" value="'.$lang['cancel'].'">
		</center>
	</form>';
} else {
	echo '
	<form action=index.php?t=viewsupporters method=post>
		<table class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
			<tr>
				<td>
					<table cellSpacing=1 cellPadding=5 width="100%" border=0>
						<tr>
							<td class=info colspan=1 align=right>
								<b>'.$lang['sort_by'].':
									<select name=o onChange="submit()">
										<option value="id"'; if($o=='id') echo ' selected'; echo '>'.$lang['id'].'</option>
										<option value="last_name"'; if($o=='last_name') echo ' selected'; echo '>'.$lang['last_name'].'</option>
									</select>
								</b>
							</td>
						</tr>
						<tr>
							<td class=back>';
								getListOfSupporters($o, $offset); echo '
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</form>';

	echo "<center>";
	$offset = $offset - $users_limit;
	if($offset < 0){
		echo "&nbsp;".$lang['previous'];
	} else {
		echo "&nbsp;<a href=index.php?t=viewsupporters&o=$o&offset=$offset>".$lang['previous']."</a>";
	}
	echo "&nbsp; | &nbsp;";
	$offset = $offset + $users_limit + $users_limit;
	if($offset < getNumberOfSupporters()){
		echo "&nbsp;<a href=index.php?t=viewsupporters&o=$o&offset=$offset>".$lang['next']."</a>";
	} else {
		echo "&nbsp;".$lang['next'];
	}
}

/***********************************************************************************************************
****************************************** DEFINE FUNCTIONS ************************************************
************************************************************************************************************/

/***********************************************************************************************************
**	function getListOfSupporters():
************************************************************************************************************/
function getListOfSupporters($order, $offset) {
	global $mysql_people_table, $users_limit;
	if(!isset($offset))
		$offset = 0;
	$low = $offset;

	// note that since supporters can belong to more than one group ordering them by group name is not feasible
	switch($order) {
		case ("last_name"):
			$sql = "select * from $mysql_people_table where supporter = '1' order by last_name, first_name asc limit $low, $users_limit";
			break;
		default:
			$sql = "select * from $mysql_people_table where supporter = '1' order by id asc limit $low, $users_limit";
			break;
	}
	$result = execsql($sql);
	//get all of the data into readable variables.
	$counter = 1;
	$numberofsupporters = getNumberOfSupporters();
	while($row = mysql_fetch_array($result)) {
		$id = $row['id'];
		$first = ucwords($row['first_name']);
		$last = ucwords($row['last_name']);
		$user_name = $row['user_name'];
		$email = $row['email'];
		$phone = $row['phone'];
		$user = $row['user'];
		$supp = $row['supporter'];
		$admin = $row['admin'];
		displaySupporterInfo($id, $first, $last, $email, $phone);
		if($counter < $users_limit && $counter+$offset < $numberofsupporters) echo '<br>';
		$counter++;
	}	//end while
}

/***********************************************************************************************************
**	function displaySupporterInfo():
************************************************************************************************************/
function displaySupporterInfo($id, $first, $last, $email, $phone) {
	global $mysql_groups_table, $mysql_supporters_table, $enable_time_tracking;
    // [12/12/2003 seh]
    global $lang;
    // [/seh]
	$groups = "";
	$sql = "select t1.id, t1.group_name, t2.supporter_id from $mysql_groups_table as t1, $mysql_supporters_table as t2 where t1.id=t2.group_id and t2.supporter_id='$id'";
	$result = execsql($sql);
	while($row = mysql_fetch_array($result)) {
		$groups .= $row[1] . "<br/>";
	}

	echo '
		<table class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0><tr><td>
			<table cellSpacing=1 cellPadding=5 width="100%" border=0>
				<tr><td class=info align=left ><b>'.$lang['supporter_id'].': ' . $id . '</b></td>
					<td class=info align=right>
						<a class=info href=index.php?t=detailsupporter&id='.$id.'>'.$lang['detail'].'</a>,
						<a class=info href=index.php?t=editsupporter&id='.$id.'>'.$lang['edit'].'</a>,
						<a class=info href=index.php?t=viewsupporters&action=delete&id='.$id.'>'.$lang['delete'].'</a>,';
	if($enable_time_tracking == 'on') {
		echo '
						<a class=info href=index.php?t=tracktime&case=supporter&id='.$id.'>'.$lang['time_sheets'].'</a>,';
	}
	echo '
						<a class=info href=index.php?t=ticketstatistics&id='.$id.'>'.$lang['ticket_statistics'].'</a>
					</td>
				</tr>
				<tr>
					<td width=27% class=back2 align=right>'.$lang['name'].':</td><td class=back>'. $first .' '. $last .'</td>
				</tr>
				<!--
				<tr>
					<td width=27% class=back2 align=right>'.$lang['email'].'</td><td class=back><a href=mailto:'. $email .'>'.$email.'</td>
				</tr>
				-->
				<tr>
					<td width=27% class=back2 align=right>'.$lang['phone'].':</td><td class=back>'. $phone .'</td>
				</tr>
				<tr>
					<td width=27% class=back2 align=right>'.$lang['groups'].':</td><td class=back>'. $groups .'</td>
				</tr>
			</table></td></tr>
		</table>';
}

?>