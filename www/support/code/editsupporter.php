<?php
/*******************************************************************************
**	file:	editsupporter.php
********************************************************************************
**	author:	Luis Bernardo
**	date:	2003/12/10
********************************************************************************
**	$Revision: 1.4 $ on $Date: 2003/12/19 06:05:17 $ by $Author: lmpmbernardo $
*******************************************************************************/

$id = $_GET['id'] ? $_GET['id'] : $_POST['id'];
$updatesupporter = $_POST['updatesupporter'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$user_name = $_POST['user_name'];
$old_user_name = $_POST['old_user_name'];
$fax = $_POST['fax'];
$type = $_POST['type'];
$comments = $_POST['comments'];
$pass1 = $_POST['pass1'];
$pass2 = $_POST['pass2'];

if(isset($updatesupporter) && $id!='1') {
	// get id of logged in user (supporter)
	$supporter_id = getPersonID($cookie_name);
	// time contact modified
	$time = time();
	// make sure needed fields are still there
	if($first_name == '' || $last_name == '' || !validEmail($email) || $phone == '' || $user_name == '') {
		$error = 1;
		$error_message = $lang['err_missing_info'];
	}
	if($user_name != $old_user_name) {
		if(personExists($user_name)) {
			//if the user already exists, update the database rather than insert.
			$error = 1;
			$error_message = $lang['err_user_exists'];
		}
	}
	if($pass1 != '') {
		//make sure the two passwords match, otherwise print out the error message.
		if(!checkPwd($pass1, $pass2)){
			$error = 1;
			$error_message .= $lang['err_password_mismatch'];
		} else {
			$pwd = md5($pass1);
		}
	}
	if($error != '1') {
		if(isset($pwd)) {
			switch($type) {
				case ("admin"):
					$sql = "update $mysql_people_table set first_name='$first_name', last_name='$last_name', user_name='$user_name', email='$email', phone='$phone', fax='$fax', author_id='$supporter_id', date_modified='$time', comments='$comments', password='$pwd', admin='1' where id='$id'";
					break;
				default:
					$sql = "update $mysql_people_table set first_name='$first_name', last_name='$last_name', user_name='$user_name', email='$email', phone='$phone', fax='$fax', author_id='$supporter_id', date_modified='$time', comments='$comments', password='$pwd', admin='0' where id='$id'";
					break;
			}
		} else {
			switch($type) {
				case ("admin"):
					$sql = "update $mysql_people_table set first_name='$first_name', last_name='$last_name', user_name='$user_name', email='$email', phone='$phone', fax='$fax', author_id='$supporter_id', date_modified='$time', comments='$comments', admin='1' where id='$id'";
					break;
				default:
					$sql = "update $mysql_people_table set first_name='$first_name', last_name='$last_name', user_name='$user_name', email='$email', phone='$phone', fax='$fax', author_id='$supporter_id', date_modified='$time', comments='$comments', admin='0' where id='$id'";
					break;
			}
		}
		if(execsql($sql)) {
			$success_message = $lang['msg_supporter_updated'];
			printSuccess($success_message);
			echo '<br/>';
			displaySupporterDetail($id);
		}
	} else {
		printError($error_message);
	}
} else {
	//$info is an array that contains the user information for that id number.
	$info = getPeopleInfo($id);
	echo '
	<form action="index.php?t=editsupporter&id='.$id.'" method=post>
		<table class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
			<tr>
				<td>
					<table cellSpacing=1 cellPadding=5 width="100%" border=0>
						<tr>
							<td class=info colspan=100% align=middle><b>'.$lang['edit_supporter_info'].'</b></td>
						</tr>
						<tr>
							<td class=back colspan=100%>
								<table class=border cellSpacing=0 cellPadding=0 width=100% align=center border=0>
									<tr>
										<td>
											<table cellSpacing=1 cellPadding=5 width="100%" border=0>
						<tr>
							<td class=cat align=right width=20%><b> '.$lang['first_name'].': </b></td>
							<td class=back><input type=text value=' .$info['first_name'] .' name=first_name></td>
						</tr>
						<tr>
							<td class=cat align=right width=20%><b> '.$lang['last_name'].': </b></td>
							<td class=back><input type=text value='. $info['last_name'] .' name=last_name></td>
						</tr>
						<tr>
							<td class=cat align=right width=20%><b> '.$lang['user_name'].': </b></td>
							<td class=back><input type=text value='. $info['user_name'] .' name=user_name></td>
						</tr>
						<tr>
							<td class=cat align=right width=20%><b> '.$lang['password'].': </b></td>
							<td class=back><input type=password name=pass1><font size=1>&nbsp;&nbsp;('.$lang['text_leave_blank'].')</font></td>
						</tr>
						<tr>
							<td class=cat align=right width=20%><b> '.$lang['password_again'].': </b></td>
							<td class=back><input type=password name=pass2></td>
						</tr>
						<tr>
							<td class=cat align=right width=20%><b> '.$lang['email_address'].': </b></td>
							<td class=back><input type=text value='. $info['email'] .' name=email></td>
						</tr>
						<tr>
							<td class=cat align=right width=20%><b> '.$lang['phone'].': </b></td>
							<td class=back><input type=text value='. $info['phone'] .' name=phone></td>
						</tr>
						<tr>
							<td class=cat align=right width=20%><b> '.$lang['fax'].': </b></td>
							<td class=back><input type=text value='. $info['fax'] .' name=fax></td>
						</tr>
						<tr>
							<td class=cat align=right width=20%><b> '.$lang['type'].': </b></td>
							<td class=back>
								<select name=type>
									<option></option>
									<option value=admin'; if($info['admin'] == '1') echo ' selected'; echo '>Administrator</option>
									<option value=supporter'; if($info['admin'] != '1') echo ' selected'; echo '>Supporter</option>
								</select>
							</td>
						</tr>
						<tr>
							<td class=cat align=right width=20%><b> '.$lang['comments'].': </b></td>
							<td class=back><textarea name=comments rows=3 cols=60>'. $info['comments'] .'</textarea>
					   			<input type=hidden name=id value='.$id.'>
								<input type=hidden name=old_user_name value='. $info['user_name'] .'>
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
		<br>
		<center>
			<input type=submit name=updatesupporter value="'.$lang['update'].'">
		</center>
	</form>';
}

?>