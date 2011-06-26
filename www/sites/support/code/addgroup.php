<?php
/*******************************************************************************
**	file:	addgroup.php
********************************************************************************
**	author:	Luis Bernardo
**	date:	2003/12/10
********************************************************************************
**	$Revision: 1.6 $ on $Date: 2004/03/10 05:40:51 $ by $Author: lmpmbernardo $
*******************************************************************************/

$addgroup = $_POST['addgroup'];
$group_name = $_POST['group_name'];
$comments = $_POST['comments'];

if(isset($addgroup)) {
	if($group_name == '') {
		$error = 1;
		$error_message = $lang['err_missing_info'];
	}
	// time record created
	$time = time();
	// get id of logged in user (supporter)
	$supporter_id = getPersonID($cookie_name);
	if($error != 1) {
		if(groupExists($group_name)){
			//if the company already exists, update the database rather than insert.
			$error = 1;
			$error_message = $lang['err_group_exists'];
		} else {
			$sql = "insert into $mysql_groups_table values(NULL,'$group_name', '$supporter_id', '$time','$comments','0')";
			if(execsql($sql)) {
				$success_message .= "Group \"$group_name\" added successfully.";
				// get id of group just added.
				$sql = "select id from $mysql_groups_table where group_name='$group_name'";
				$result = execsql($sql);
				$row = mysql_fetch_array($result);
				$groupid = $row[0];
				printSuccess($success_message);
				echo '<br/>';
				displayGroupDetail($groupid);
			}
		}
	}
	if($error == 1) {
		printError($error_message);
	}
} else {
	$action = "index.php?t=addgroup";
	$title = $lang[enter_group_info];
	$rows = array();
	$row = array('text', "* ".$lang[group_name], 'group_name');
	array_push($rows, $row);
	$row = array('textarea', $lang[comments], 'comments');
	array_push($rows, $row);
	$buttons = array();
	$button = array('submit', $lang[add_group], 'addgroup');
	array_push($buttons, $button);
	
	// start html output
	outputInputFormTable($action, $title, $rows, $buttons);
	// end html output	
}

?>