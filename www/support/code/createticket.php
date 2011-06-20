<?php
/*******************************************************************************
**	file: createticket.php
********************************************************************************
**	author:	Luis Bernardo
**	date:	10 Dec 2003
********************************************************************************
**	$Revision: 1.7 $ on $Date: 2004/03/01 06:06:04 $ by $Author: lmpmbernardo $
*******************************************************************************/

$create = $_POST['create'];
$group_id = $_POST['group_id'];
$supporter_id = $_POST['supporter_id'];
$client_id = $_POST['client_id'] ? $_POST['client_id'] : $_GET['client_id'];
$contact_id = $_POST['contact_id'] ? $_POST['contact_id'] : $_GET['contact_id'];
$priority_id = $_POST['priority_id'];
$category_id = $_POST['category_id'];
$status_id = $_POST['status_id'];
$platform_id = $_POST['platform_id'];
$title = $_POST['title'];
$description = $_POST['description'];
$detail = $_POST['detail'];
$version_id = $_POST['version_id'];
$diskid = $_POST['diskid'];
$num_boxes = $_POST['num_boxes'];

if(isset($create)) {
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
		// time record created
		$time = time();
		// get id of logged in user (supporter that creates the ticket)
		$author_id = getPersonID($cookie_name);
		$author_name = getPersonName($author_id);
		if($title == '') {
			$title = $lang['ticket_created'].' '. date("Y-m-d H:i:s", $time) . ".";
		}
		$msg = $lang['ticket_created'].".";
		$msg .= " ".$lang['assigned_to']." " . getPersonName($supporter_id) . ".";
		$log = date("F j, Y, g:i a", $time) . " by " . $author_name . "$delimiter" . addslashes($msg) . "$delimiter";

		/**
		if($diskid != '') {
			$sql = "insert into $mysql_diskid_table values(NULL, '$diskid', '$client_id')";
			execsql($sql);
			// get id of diskid just added.
			$sql = "select id from $mysql_diskid_table where diskid_name='$diskid'";
			$result = execsql($sql);
			$row = mysql_fetch_array($result);
			$diskid_id = $row[0];
		} else {
			$diskid_id = '0';
		}
		**/
		if(!isset($version_id)) $version_id = '0';
		$sql = "insert into $mysql_tickets_table values(null, '$group_id', '$supporter_id', '$client_id', '$contact_id', '$priority_id', '$status_id', '$platform_id', '$category_id', '$title', '$description', '$log', '$version_id', '$diskid_id', '$time', '$time', '$author_id', 0)";
		if(execsql($sql)) {
			$success_message .= "\"$title\" ".$lang['msg_created_successfully'].".";
	
			//now lets take care of assigning the modules to the ticket. first get the ticket id
			$sql = "select id from $mysql_tickets_table where author_id='$author_id' and date_created='$time'";
			$result = execsql($sql);
			$row = mysql_fetch_array($result);
			$ticketid = $row[0];
			//for all the modules listed, if the box was checked, assign the module to this ticket
			for($j = 1; $j <= $num_boxes; $j++) {
				$mod_id = "modbox" . $j;
				$mod_id = $_POST[$mod_id];
				if($mod_id != '') {
					$sql = "insert into $mysql_ticketmodules_table values('$ticketid', '$mod_id')";
					execsql($sql);
				}
			}
	
			// add diskid if not empty
			if($diskid != '') {
				$sql = "insert into $mysql_ticketdiskid_table values('$ticketid', '$diskid')";
				execsql($sql);
			}
	
			//lets set the time spent. by default set time to create a ticket to 6 minutes. this creates a place holder
			//for the connection between supporter and this ticket and show up in the supporter time track page
			if($enable_time_tracking == 'on') {
				$sql = "insert into $mysql_tracktime_table values('$ticketid', '$author_id', '6', '$time')";
				execsql($sql);
			}
	
			// notify supporter if needed
			if($supporter_id != $author_id && $enable_automatic == 'on') {
				$supporterinfo = getPeopleInfo($supporter_id);
				$email = $supporterinfo['email'];
				$authorinfo = getPeopleInfo($author_id);
				$emailmsg = $lang['take_a_look'];
				mail($email, $lang['ticket']." $ticketid ".$lang['text_created_assigned'].".", $emailmsg, "From: ".$helpdesk_name ."<".$authorinfo['email'].">\nReply-To: ".$authorinfo['email']."\n");
			}
			printSuccess($success_message);
			echo '<br/>';
			displayTicketDetail($ticketid);
		}
    }
} else {
	echo '
	<form action=index.php?t=createticket method=post>';
		outputTicketForm($group_id, $supporter_id, $client_id, $contact_id, '0', $detail, $priority_id, $status_id, $platform_id, $category_id, $title, $description); echo '
	</form>';
}
?>