<?php
/*******************************************************************************
**	file:	addsupporter.php
********************************************************************************
**	author:	Luis Bernardo
**	date:	2003/12/10
********************************************************************************
**	$Revision: 1.7 $ on $Date: 2004/03/10 05:40:50 $ by $Author: lmpmbernardo $
*******************************************************************************/

$addsupporter = $_POST['addsupporter'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$user_name = $_POST['user_name'];
$pass1 = $_POST['pass1'];
$pass2 = $_POST['pass2'];
$phone = $_POST['phone'];
$fax = $_POST['fax'];
$type = $_POST['type'];
$comments = $_POST['comments'];
$num_boxes = $_POST['num_boxes'];

if(isset($addsupporter)) {
	if($first_name == '' || $last_name == '' || !validEmail($email) || $phone == '' || $user_name == '' || $pass1 == '' || $pass2 == '' || $type == '') {
		$error = 1;
		$error_message = $lang['err_missing_info'];
	}
	//make sure the two passwords match, otherwise print out the error message.
	if(!checkPwd($pass1, $pass2)){
		$error = 1;
		$error_message .= $lang['err_password_mismatch'];
	} else {
		$pwd = md5($pass1);
	}

	// all supporters belong to company with id = 2
	$supporter_company_id = '2';

	// get id of logged in user (supporter)
	$supporter_id = getPersonID($cookie_name);

	// time contact added
	$time = time();

	if($error != 1) {
		if(personExists($user_name)) {
			//if the user already exists, update the database rather than insert.
			$error = 1;
			$error_message = $lang['err_user_exists'];
		} else {
			switch($type){
				case ("admin"):
					$sql = "insert into $mysql_people_table values(null, '$first_name', '$last_name', '$user_name', '$pwd', '$email', '$phone', '$fax', '$supporter_company_id', '$supporter_id', '$time', '$comments', 0, 1, 1, '$default_theme')";
					break;
				case ("supporter"):
					$sql = "insert into $mysql_people_table values(null, '$first_name', '$last_name', '$user_name', '$pwd', '$email', '$phone', '$fax', '$supporter_company_id', '$supporter_id', '$time', '$comments', 0, 1, 0, '$default_theme')";
					break;
				default:
					$sql = "insert into $mysql_people_table values(null, '$first_name', '$last_name', '$user_name', '$pwd', '$email', '$phone', '$fax', '$supporter_company_id', '$supporter_id', '$time', '$comments', 0, 1, 0, '$default_theme')";
					break;
			}

			if(execsql($sql)) {
				$success_message .= "Supporter \"$first_name $last_name\" added successfully.";
				//now lets take care of adding the supporter to the groups.
				//for all the groups listed, if the box was checked, add the supporter to that group
				$user_id = getPersonID($user_name);
				// this is not really necessary because idea of main contact is not used
				//	contactMovedToCompany($user_id, $supporter_company_id, $supporter_id, $time);
				for($j=1; $j<=$num_boxes; $j++) {
					$group_id = "box" . $j;
					$group_id = $_POST[$group_id];
					if($group_id != '') {
						$sql = "insert into $mysql_supporters_table values('$group_id', '$user_id')";
						execsql($sql);
					}
				}
				printSuccess($success_message);
				echo '<br>';
				displaySupporterDetail($user_id);
			}
		}
	}
	if($error == 1) {
		printError($error_message);
	}
} else {
	$action = "index.php?t=addsupporter";
	$title = $lang[enter_supporter_info];
	$rows = array();
	$hidden = array();
	$row = array('text', "* ".$lang[first_name], 'first_name');
	array_push($rows, $row);
	$row = array('text', "* ".$lang[last_name], 'last_name');
	array_push($rows, $row);
	$row = array('text', "* ".$lang[user_name], 'user_name');
	array_push($rows, $row);
	$row = array('password', "* ".$lang[password], 'pass1');
	array_push($rows, $row);
	$row = array('password', "* ".$lang[password_again], 'pass2');
	array_push($rows, $row);
	$row = array('text', "* ".$lang[email_address], 'email');
	array_push($rows, $row);
	$row = array('text', "* ".$lang[phone], 'phone');
	array_push($rows, $row);
	$row = array('text', $lang[fax], 'fax');
	array_push($rows, $row);
	// build drop down menu
	$ddm1 = array('', '');
	$ddm2 = array('admin', $lang[administrator]);
	$ddm3 = array('supporter', $lang[supporter]);
	$ddmenu = array($ddm1, $ddm2, $ddm3);
	$row = array('select', "* ".$lang[type], 'type', $ddmenu);
	array_push($rows, $row);
	$row = array('textarea', $lang[comments], 'comments');
	array_push($rows, $row);
	// build checkboxes
	$checkboxes = array();
	$sql = "select id, group_name from $mysql_groups_table order by group_name asc";
	$r = execsql($sql);
	$count = 0;
	while($rr = mysql_fetch_row($r)) {
		$count++;
		$name = "box" . $count;
		$value = $rr[0];
		$display = $rr[1];
		$checkbox = array($name, $value, $display);
		array_push($checkboxes, $checkbox);
	}
	$numcolumns = 4;
	$row = array('checkbox', $lang[add_to_groups], $checkboxes, $numcolumns);
	array_push($rows, $row);
	// store hidden values
	array_push($hidden, array('num_boxes', $count));
	// submit buttons
	$buttons = array();
	$button = array('submit', $lang[add_supporter], 'addsupporter');
	array_push($buttons, $button);
	
	// start html output
	outputInputFormTable($action, $title, $rows, $buttons, $hidden);
	// end html output	
}

?>
