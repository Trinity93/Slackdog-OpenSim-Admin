<?php
/*******************************************************************************
**	file:	editticket.php
********************************************************************************
**	author:	Luis Bernardo
**	date:	2003/12/10
********************************************************************************
**	$Revision: 1.4 $ on $Date: 2004/03/01 06:06:04 $ by $Author: lmpmbernardo $
*******************************************************************************/

$id = $_GET['id'] ? $_GET['id'] : $_POST['id'];
$update = $_POST['update'];
$group_id = $_POST['group_id'];
$old_group_id = $_POST['old_group_id'];
$supporter_id = $_POST['supporter_id'];
$old_supporter_id = $_POST['old_supporter_id'];
$client_id = $_POST['client_id'] ? $_POST['client_id'] : $_GET['client_id'];
$old_client_id = $_POST['old_client_id'];
$contact_id = $_POST['contact_id'] ? $_POST['contact_id'] : $_GET['contact_id'];
$old_contact_id = $_POST['old_contact_id'];
$priority_id = $_POST['priority_id'];
$old_priority_id = $_POST['old_priority_id'];
$category_id = $_POST['category_id'];
$status_id = $_POST['status_id'];
$old_status_id = $_POST['old_status_id'];
$platform_id = $_POST['platform_id'];
$title = $_POST['title'];
$description = $_POST['description'];
$update_log = $_POST['update_log'];
$detail = $_POST['detail'];
$version_id = $_POST['version_id'];
$diskid = $_POST['diskid'];
$num_boxes = $_POST['num_boxes'];
$time_spent = $_POST['time_spent'];

$timestamp = time();

if(isset($update)) {
	if($group_id == '' || $supporter_id == '' || $client_id == '' || $contact_id == '' || $priority_id == '' || $status_id == '' || $platform_id == '' || $category_id == '') {
		$warn = "Please provide all required fields!";
		if($group_id == '') $warn .= " The Group was not set!";
		if($supporter_id == '') $warn .= " The Supporter was not set!";
		if($client_id == '') $warn .= " The Client was not set!";
		if($contact_id == '') $warn .= " The Contact was not set!";
		if($status_id == '') $warn .= " The Status was not set!";
		if($priority_id == '') $warn .= " The Priority was not set!";
		if($category_id == '') $warn .= " The Category was not set!";
		if($platform_id == '') $warn .= " The Platform was not set!";
		printError($warn);
	} else {	
		// get time
		$time = time();
		// get author info
		$author_id = getPersonID($cookie_name);
		$authorinfo = getPeopleInfo($author_id);
		$authorname = getPersonName($author_id);
	
		//lets update the time spent first. update even if supporter don't enter any info. this creates a place holder
		//for the connection between supporter and this ticket and show up in the supporter time track page
		if($enable_time_tracking == 'on') {
			$sql = "insert into $mysql_tracktime_table values('$id', '$author_id', '$time_spent', '$time')";
			execsql($sql);
		}
	
		$msg = '';
		//if the supporter/group/client/contact/priority/status changed update the log to reflect the transfer
		if($old_supporter_id != $supporter_id) {
			$newsupportername = getPersonName($supporter_id);
			$msg = $lang['transferred_to_'] . $newsupportername . ".";
			if($enable_automatic = 'on') {
				// notify new supporter. this should be moved down...
				$supporterinfo = getPeopleInfo($supporter_id);
				$email = $supporterinfo['email'];
				$emailmsg = $lang['please_take_over'];
				$subjectmsg = str_replace("XXX", $id, $lang['ticket_reassigned']);
				mail($email, $subjectmsg, $emailmsg, "From: ".$helpdesk_name ."<".$authorinfo['email'].">\nReply-To: ".$authorinfo['email']."\n");
			}
		}
		if($old_contact_id != $contact_id) {
			$newcontactname = getPersonName($contact_id);
			$msg = str_replace("XXX", $newcontactname, $lang['_contact_changed_to']);
		}
		if($old_priority_id != $priority_id) {
			$newpriority = getPriority($priority_id);
			$msg .= str_replace("XXX", $newpriority, $lang['_priority_changed_to']);
		}
		if($old_status_id != $status_id) {
			$newstatus = getStatus($status_id);
			$msg .= str_replace("XXX", $newstatus, $lang['_status_changed_to']);
		}
	
		if($email_msg != '') {
			$header = '';
			if($msg != '') {
				$header = '<br><br><i>'.$lang['email_sent'].':</i><br>';
			} else {
				$header = '<i>'.$lang['email_sent'].':</i><br>';
			}
			$msg .= $header . $email_msg;
			$contactinfo = getPeopleInfo($contact_id);
			$email = $contactinfo['email'];
			// I don't like this part. people prefer to use their regular email program and keep a list of sent emails...
			if($enable_smtp == 'on') {
				$subjectmsg = $lang['ticket'] . " $id";
				mail($email, $subjectmsg, $email_msg, "From: ".$helpdesk_name ."<".$authorinfo['email'].">\nReply-To: ".$authorinfo['email']."\n");
			}
		}
	
		if($update_log != '') {
			$header = '';
			if($msg != '') {
				$header = '<br><br><i>'.$lang['update'].':</i><br>';
			} else {
				$header = '<i>'.$lang['update'].':</i><br>';
			}
			$msg .= $header . $update_log;
		}
	
		// update/create update_log
		$log = '';
		if($msg != '') {
			$log = updateTicketLog($id, $msg, $authorname);
		} else {
			$log = getCurrentTicketLog($id);
		}
	
	//	$sql = "update $mysql_tickets_table set group_id='$group_id', supporter_id='$supporter_id', company_id='$client_id', contact_id='$contact_id', priority_id='$priority_id', status_id='$status_id', platform_id='$platform_id', category_id='$category_id', title='$title', description='$description', update_log='$log', version_id='$version_id', diskid_id='$diskid', date_modified='$time', author_id='$author_id' where id='$id'";
		// do not use diskid. this will be changed in the future
		$updateversionfield = "";
		if(isset($version_id) && $version_id > 0) $updateversionfield = " version_id='$version_id',";
	//	$sql = "update $mysql_tickets_table set group_id='$group_id', supporter_id='$supporter_id', company_id='$client_id', contact_id='$contact_id', priority_id='$priority_id', status_id='$status_id', platform_id='$platform_id', category_id='$category_id', title='$title', description='$description', update_log='$log', version_id='$version_id', date_modified='$time', author_id='$author_id' where id='$id'";
		$sql = "update $mysql_tickets_table set group_id='$group_id', supporter_id='$supporter_id', company_id='$client_id', contact_id='$contact_id', priority_id='$priority_id', status_id='$status_id', platform_id='$platform_id', category_id='$category_id', title='$title', description='$description', update_log='$log',".$updateversionfield." date_modified='$time', author_id='$author_id' where id='$id'";
		if(execsql($sql)) {
			$success_message .= $lang['ticket'] . " \"<a href=index.php?t=detailticket&id=$id>$title</a>\" " . $lang['msg_updated_successfully'] . ".";
	
			//now lets take care of updating the modules in this ticket.
			//for all the modules listed, if the box was checked, add the module to this ticket
			// note that the ticket id is in the $id variable.
			for($j = 1; $j <= $num_boxes; $j++) {
				$mod_id = "modbox" . $j;
				$checkbox = "check" . $j;
				$checkboxid = "checkid" . $j;
				$mod_id = $_POST[$mod_id];
				$checkbox = $_POST[$checkbox];
				$checkboxid = $_POST[$checkboxid];
				if($mod_id != '' && $checkbox == 'false') {
					$sql = "insert into $mysql_ticketmodules_table values('$id', '$mod_id')";
					execsql($sql);
				}
				if($mod_id == '' && $checkbox == 'true') {
					$sql = "delete from $mysql_ticketmodules_table where ticket_id = '$id' and module_id = '$checkboxid'";
					execsql($sql);
				}
			}
	
			// update diskid just in case
			$olddiskid = getDiskId($id);
			if(olddiskid != '' && $diskid != '' && $olddiskid != $diskid) {
				$sql = "update $mysql_ticketdiskid_table set diskid='$diskid' where ticket_id='$id'";
				execsql($sql);
			}
			if($diskid == '' && olddiskid != '') {
				$sql = "delete from $mysql_ticketdiskid_table where ticket_id='$id'";
				execsql($sql);
			}
			if($diskid != '' && $olddiskid == '') {
				$sql = "insert into $mysql_ticketdiskid_table values('$id', '$diskid')";
				execsql($sql);
			}
	
			printSuccess($success_message);
			echo '<br>';
			displayTicketHistory($id, $pop, $sort);
		}
	}
} else {
	$ticketinfo = getTicketInfo($id);
	if($group_id == '' && !isset($group_id)) $group_id = $ticketinfo['group_id'];
	if($supporter_id == '' && !isset($supporter_id)) $supporter_id = $ticketinfo['supporter_id'];
	$client_id = $ticketinfo['company_id']; // do not allow changes to client_id
	if($contact_id == '' && !isset($contact_id)) $contact_id = $ticketinfo['contact_id'];
	if($priority_id == '' && !isset($priority_id)) $priority_id = $ticketinfo['priority_id'];
	if($status_id == '' && !isset($status_id)) $status_id = $ticketinfo['status_id'];
	if($platform_id == '' && !isset($platform_id)) $platform_id = $ticketinfo['platform_id'];
	if($category_id == '' && !isset($category_id)) $category_id = $ticketinfo['category_id'];
	if($title == '' && !isset($title)) $title = $ticketinfo['title'];
	if($description == '' && !isset($description)) $description = $ticketinfo['description'];
	echo '
	<form action=index.php?t=editticket method=post>';
		outputTicketForm($group_id, $supporter_id, $client_id, $contact_id, $id, $detail, $priority_id, $status_id, $platform_id, $category_id, $title, $description);
	echo '
		<input type=hidden name=id value='.$id.'>
		<input type=hidden name=old_group_id value='.$group_id.'>
		<input type=hidden name=old_supporter_id value='.$supporter_id.'>
		<input type=hidden name=old_client_id value='.$client_id.'>
		<input type=hidden name=old_contact_id value='.$contact_id.'>
		<input type=hidden name=old_priority_id value='.$priority_id.'>
		<input type=hidden name=old_status_id value='.$status_id.'>
	</form>';
}

?>

