<?php
/*******************************************************************************
**	file: addcompany.php
********************************************************************************
**	author:	Luis Bernardo
**	date:	10 Dec 2003
********************************************************************************
**	$Revision: 1.6 $ on $Date: 2004/03/10 05:40:50 $ by $Author: lmpmbernardo $
*******************************************************************************/

$addcompany = $_POST['addcompany'];
$company_name = $_POST['company_name'];
$address = $_POST['address'];
$comments = $_POST['comments'];

if(isset($addcompany)){
	if($company_name == '') {
		$error = 1;
		$error_message = $lang['err_missing_info'];
	}
	// time record created
	$time = time();
	// get id of logged in user (supporter)
	$supporter_id = getPersonID($cookie_name);
	if($error != 1) {
		if(companyExists($company_name)) {
			//if the company already exists, update the database rather than insert.
			$error = 1;
			$error_message = $lang['err_company_exists'];
		} else {
			$sql = "insert into $mysql_companies_table values(NULL,'$company_name','$address','0','$supporter_id', '$time','$comments','0')";
			if(execsql($sql)) {
				$success_message .= "\"$company_name\" ".$lang['msg_added_successfully'];
				// get company id of company just added.
				$sql = "select id from $mysql_companies_table where company_name='$company_name'";
				$result = execsql($sql);
				$row = mysql_fetch_array($result);
				$company_id = $row[0];
				printSuccess($success_message);
				echo '<br/>';
				displayCompanyDetail($company_id);
			}
		}
	}
	if($error == 1) {
		printError($error_message);
	}
} else {
	$action = "index.php?t=addcompany";
	$title = $lang[enter_company_info];
	$rows = array();
	$row = array('text', "* ".$lang[company_name], 'company_name');
	array_push($rows, $row);
	$row = array('textarea', $lang[address], 'address');
	array_push($rows, $row);
	$row = array('textarea', $lang[comments], 'comments');
	array_push($rows, $row);
	$buttons = array();
	$button = array('submit', $lang[add_company], 'addcompany');
	array_push($buttons, $button);
	
	// start html output
	outputInputFormTable($action, $title, $rows, $buttons);
	// end html output	
}
?>