<?php
/*****************************************************************************************
**	file:	editcontact.php
******************************************************************************************
**	author:	Luis Bernardo
**	date:	10 Dec 2003
********************************************************************************
**	$Revision: 1.3 $ on $Date: 2003/12/19 16:09:11 $ by $Author: sasa_eh $
**************************************************************************************/
$id = $_GET['id'] ? $_GET['id'] : $_POST['id'];
$updatecontact = $_POST['updatecontact'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$fax = $_POST['fax'];
$company_id = $_POST['company_id'];
$oldcompany_id = $_POST['oldcompany_id'];
$comments = $_POST['comments'];

if(isset($updatecontact) && $id!='1') {
	// get id of logged in user (supporter)
	$supporter_id = getPersonID($cookie_name);

	// time contact modified
	$time = time();

	$sql = "update $mysql_people_table set first_name='$first_name', last_name='$last_name', user_name='$email', email='$email', phone='$phone', fax='$fax', company_id='$company_id', author_id='$supporter_id', date_modified='$time', comments='$comments' where id='$id'";
	if(execsql($sql)) {
		if(oldcompany_id != company_id) {
			// the order is important now!
			contactMovedToCompany($id, $company_id, $supporter_id, $time);
			contactRemovedFromCompany($id, $oldcompany_id, $supporter_id, $time);
		}
		$success_message .= "\"$first_name $last_name\" ".$lang['msg_updated_successfully'];
		printSuccess($success_message);
		echo '<br>';
		displayContactDetail($id);
	}
} else {
	//$info is an array that contains the user information for that id number.
	$info = getPeopleInfo($id);
	echo '
	<form action="index.php?t=editcontact&id='.$id.'" method=post>
		<table class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
			<tr>
				<td>
					<table cellSpacing=1 cellPadding=5 width="100%" border=0>
						<tr>
							<td class=info colspan=100% align=middle><b>'.$lang['edit_contact_info'].'</b></td>
						</tr>
						<tr>
							<td class=back colspan=100%>
								<table class=border cellSpacing=0 cellPadding=0 width=100% align=center border=0>
									<tr>
										<td>
											<table cellSpacing=1 cellPadding=5 width="100%" border=0>
						<tr>
							<td class=cat align=right width=20%><b> '.$lang['first_name'].': </b></td>
							<td class=back><input type=text value="'. $info['first_name'] .'" name=first_name></td>
						</tr>
						<tr>
							<td class=cat align=right width=20%><b> '.$lang['last_name'].': </b></td>
							<td class=back><input type=text value="'. $info['last_name'] .'" name=last_name></td>
						</tr>
						<tr>
							<td class=cat align=right width=20%><b> '.$lang['email_address'].': </b></td>
							<td class=back><input type=text size=40 value="'. $info['email'] .'" name=email></td>
						</tr>
						<tr>
							<td class=cat align=right width=20%><b> '.$lang['phone'].': </b></td>
							<td class=back><input type=text value="'. $info['phone'] .'" name=phone></td>
						</tr>
						<tr>
							<td class=cat align=right width=20%><b> '.$lang['fax'].': </b></td>
							<td class=back><input type=text value="'. $info['fax'] .'" name=fax></td>
						</tr>
						<tr>
							<td class=cat align=right width=20%><b> '.$lang['companies'].': </b></td>
							<td class=back>
								<select name=company_id>';
									createCompaniesMenu($info['company_id']); echo '
								</select>
							</td>
						</tr>
						<tr>
							<td class=cat align=right width=20%><b> '.$lang['comments'].': </b></td>
							<td class=back><textarea name=comments rows=3 cols=60>'. $info['comments'] .'</textarea>
					   			<input type=hidden name=id value='. $id .'>
								<input type=hidden name=oldcompany_id value='. $info['company_id'] .'>
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
			<input type=submit name=updatecontact value="'.$lang['update'].'">
		</center>
	</form>';
}
?>