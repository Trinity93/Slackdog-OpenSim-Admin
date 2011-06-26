<?php
/*****************************************************************************************
**	file: addcontact.php
******************************************************************************************
**	author:	Luis Bernardo
**	date:	10 Dec 2003
********************************************************************************
**	$Revision: 1.3 $ on $Date: 2003/12/19 16:09:11 $ by $Author: sasa_eh $
**************************************************************************************/

$company_id = $_GET['company_id'] ? $_GET['company_id'] : $_POST['company_id'];
$addcontact = $_POST['addcontact'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$fax = $_POST['fax'];
$comments = $_POST['comments'];

if(isset($addcontact)) {
//	if($first_name == '' || $last_name == '' || !validEmail($email) || $phone == '') {
	if($first_name == '' || $last_name == '') { // people requested that contacts are not mandatory...
		$error = 1;
		$error_message = $lang['err_missing_info'];
	}
	// set username = email for possible future user
//	$user_name = $email;
	$user_name = $first_name . $last_name . time(); // needs to be unique; added after making contact info optional
	// set passwords to jdoe123
	$pass1 = 'jdoe123';
	$pass2 = 'jdoe123';
	//make sure the two passwords match, otherwise print out the error message.
	if(!checkPwd($pass1, $pass2)){
		$error = 1;
		$error_message .= $lang['err_password_mismatch'];
	} else {
		$pwd = md5($pass1);
	}
	// get id of logged in user (supporter)
	$supporter_id = getPersonID($cookie_name);
	// time contact added
	$time = time();
	if($error != 1) {
		if(personExists($user_name)) {
			//if the user already exists, update the database rather than insert.
			$error = 1;
			$error_message = "A person with that email already exists!"; // this should never happen after email stopped being mandatory
		} else {
			$sql = "insert into $mysql_people_table values(null,'$first_name','$last_name','$user_name','$pwd','$email','$phone','$fax','$company_id','$supporter_id','$time','$comments','1','0','0','$default_theme')";
			if(execsql($sql)) {
				$success_message .= "\"$first_name $last_name\" ".$lang['msg_added_successfully'];
				// get contact id of contact just added.
				$sql = "select id from $mysql_people_table where user_name='$user_name'";
				$result = execsql($sql);
				$row = mysql_fetch_array($result);
				$contact_id = $row[0];
				// do some data consistency checking (see common.php): make contact main contact if necessary
				contactMovedToCompany($contact_id, $company_id, $supporter_id, $time);
				// move to next screen by printing this
				printSuccess($success_message);
				echo '<br>';
				displayContactDetail($contact_id);
			}
		}
	}
	if($error == 1) {
		printError($error_message);
	}
} else {
	if(isset($company_id)) {
		$companyid = $company_id;
	} else {
		$companyid = '1';
	}
	echo '
	<form action="index.php?t=addcontact" method=post>
		<table class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
			<tr>
				<td>
					<table cellSpacing=1 cellPadding=5 width="100%" border=0>
						<tr>
							<td class=info align=middle>
								<b>'.$lang['enter_contact_info'].'</b>
							</td>
						</tr>
						<tr>
							<td class=back>
								<table class=border cellSpacing=0 cellPadding=0 width=100% align=center border=0>
									<tr>
										<td>
											<table cellSpacing=1 cellPadding=5 width="100%" border=0>
		<tr>
			<td class=cat align=right width=20%><b>'.$lang['first_name'].':</b></td><td class=back><input type=text name=first_name></td>
		</tr>
		<tr>
			<td class=cat align=right width=20%><b>'.$lang['last_name'].':</b></td><td class=back><input type=text name=last_name></td>
		</tr>
		<tr>
			<td class=cat align=right width=20%><b>'.$lang['email_address'].':</b></td><td class=back><input type=text name=email></td>
		</tr>
		<tr>
			<td class=cat align=right width=20%><b>'.$lang['phone'].':</b></td><td class=back><input type=text name=phone></td>
		</tr>
		<tr>
			<td class=cat align=right width=20%><b>'.$lang['fax'].':</b></td><td class=back><input type=text name=fax></td>
		</tr>
		<tr>
			<td class=cat align=right width=20%><b>'.$lang['company'].':</b></td>
			<td class=back>
				<select name=company_id>';
					createCompaniesMenu($companyid); echo '
				</select>
			</td>
		</tr>
		<tr>
			<td class=cat align=right width=20%><b>'.$lang['comments'].':</b></td>
			<td class=back><textarea name=comments rows=3 cols=60></textarea></td>
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
			<input type=submit name=addcontact value="'.$lang['add_contact'].'">
		</center>
	</form>';
}
?>