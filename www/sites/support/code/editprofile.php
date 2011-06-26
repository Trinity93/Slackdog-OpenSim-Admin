<?php
/**************************************************************************************************
**	file:	editprofile.php
***************************************************************************************************
**	author:	Luis Bernardo
**	date:	10 Dec 2003
********************************************************************************
**	$Revision: 1.3 $ on $Date: 2003/12/19 16:09:11 $ by $Author: sasa_eh $
**************************************************************************************/
$update = $_POST['update'];
$first = $_POST['first'];
$last = $_POST['last'];
$password = $_POST['password'];
$retypepassword = $_POST['retypepassword'];
$email = $_POST['email'];
$phone = $_POST['phone'];

if(isset($update)) {
	//update the database with the information
	$id = getPersonID($cookie_name);
	if($password == '' || !isset($password)) {
		$sql = "update $mysql_people_table set first_name='$first', last_name='$last', email='$email', phone='$phone' where id=$id";
	} else {
		//make sure the two passwords match, otherwise print out the error message.
		if(!checkPwd($password, $retypepassword)) {
			$error = 1;
			$error_message .= "<br/>".$lang['err_password_mismatch'].".<br/>";
		} else {
			$pwd = md5($password);
		}
		$sql = "update $mysql_people_table set first_name='$first', last_name='$last', password='$pwd', email='$email', phone='$phone' where id=$id";
	}

	if($error == 1) {
		printError($error_message);
	} else {
		if(execsql($sql)) {
			$success_message .= $lang['msg_profile_updated'];
			printSuccess($success_message);
		}
	}
} else {
	//grab the user info from the database and store in an array.
	$supporterinfo = getPeopleInfo(getPersonID($cookie_name));
echo '
	<form action=index.php?t=editprofile method=post>
		<table class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
			<tr>
				<td>
					<table cellSpacing=1 cellPadding=5 width="100%" border=0>
						<tr>
							<td class=info align=middle>
								<b>'.$lang['edit_my_profile'].'</b>
							</td>
						</tr>
	<tr>
		<td class=back>
			<table class=border cellSpacing=1 cellPadding=5 width=100% border=0>
				<tr>
					<td width=20% class=cat align=right><b>'.$lang['user_name'].':</b></td>
					<td class=back><b>'.$supporterinfo['user_name'].'</b></td>
				</tr>
				<tr>
					<td width=20% class=cat align=right><b>'.$lang['first_name'].':</b></td>
					<td class=back> <input type=text size=30 name=first value="'. $supporterinfo['first_name'] .'"></td>
				</tr>
				<tr>
					<td width=20% class=cat align=right><b>'.$lang['last_name'].':<b></td>
					<td class=back><input type=text size=30 name=last value="'. $supporterinfo['last_name'] .'"></td>
				</tr>
				<tr>
					<td width=20% class=cat align=right><b>'.$lang['email'].':</b></td>
					<td class=back> <input type=text size=30 name=email value="'. $supporterinfo['email'] .'"></td>
				</tr>
				<tr>
					<td width=20% class=cat align=right><b>'.$lang['phone'].':</b></td>
					<td class=back> <input type=text size=30 name=phone value="'. $supporterinfo['phone'] .'"></td>
				</tr>
				<tr>
					<td width=20% class=cat align=right><b>'.$lang['password'].':</b></td>
					<td class=back> <input type=password name=password><font size=1>&nbsp;&nbsp;('.$lang['text_leave_blank'].')</font></td>
				</tr>
				<tr>
					<td width=20% class=cat align=right><b>'.$lang['password_again'].':<b></td>
					<td class=back> <input type=password name=retypepassword></td>
				</tr>
		</table>
					</table>
				</td>
			</tr>
		</table>
		<br>
		<center>
			<input type=submit name=update value="'.$lang['update'].'">
		</center>
	</form>';
}
?>