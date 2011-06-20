<?php
/*****************************************************************************************
**	file:	editcompany.php
******************************************************************************************
**	author:	Luis Bernardo
**	date:	10 Dec 2003
********************************************************************************
**	$Revision: 1.3 $ on $Date: 2003/12/19 16:09:11 $ by $Author: sasa_eh $
**************************************************************************************/

$id = $_GET['id'] ? $_GET['id'] : $_POST['id'];
$updatecompany = $_POST['updatecompany'];
$company_name = $_POST['company_name'];
$address = $_POST['address'];
$comments = $_POST['comments'];
$main_contact = $_POST['main_contact'];

if(isset($updatecompany) && $id!='1') {
	// get id of logged in user (supporter)
	$supporter_id = getPersonID($cookie_name);
	// time contact modified
	$time = time();

	$sql = "update $mysql_companies_table set company_name='$company_name', address='$address', author_id='$supporter_id', date_modified='$time', comments='$comments' , main_contact_id='$main_contact' where id=$id";
	if(execsql($sql)) {
		$success_message .= "\"$company_name\" ".$lang['msg_updated_successfully'];
		printSuccess($success_message);
		echo '<br>';
		displayCompanyDetail($id);
	}
} else {
	//$info is an array that contains the user information for that id number.
	$info = getCompanyInfo($id);
	$contactid = $info['main_contact_id'];
	echo '
	<form action="index.php?t=editcompany&id='.$id.'" method=post>
		<table class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
			<tr>
				<td>
					<table cellSpacing=1 cellPadding=5 width="100%" border=0>
						<tr>
							<td class=info colspan=100% align=middle><b>'.$lang['edit_company_info'].'</b></td>
						</tr>
						<tr>
							<td class=back colspan=100%>
								<table class=border cellSpacing=0 cellPadding=0 width=100% align=center border=0>
									<tr>
										<td>
											<table cellSpacing=1 cellPadding=5 width="100%" border=0>
						<tr>
							<td class=cat align=right width=20%><b> '.$lang['name'].': </b></td>
							<td class=back><input type=text value="'. $info['company_name'] .'" name=company_name></td>
						</tr>
						<tr>
							<td class=cat align=right width=20%><b> '.$lang['address'].': </b></td>
							<td class=back><textarea name=address rows=3 cols=60>'. $info['address'] .'</textarea></td>
						</tr>
						<tr>
							<td class=cat align=right width=20%><b> '.$lang['main_contact'].': </b></td>
							<td class=back>
								<select name=main_contact>';
									createCompanyContactsMenu($id,$contactid); echo '
								</select>
							</td>
						</tr>
						<tr>
							<td class=cat align=right width=20%><b> '.$lang['comments'].': </b></td>
							<td class=back><textarea name=comments rows=3 cols=60>'. $info['comments'] .'</textarea>
					   			<input type=hidden name=id value='. $info['id'] .'>
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
		<br/>
		<center>
			<input type=submit name=updatecompany value="'.$lang['update'].'">
		</center>
	</form>';
}


// $ci = company id; $mci = main contact id
function createCompanyContactsMenu($ci, $mci) {
	global $mysql_people_table;
	$sql = "select id, first_name, last_name from $mysql_people_table where company_id='$ci'";
	$result = execsql($sql);
	while($row = mysql_fetch_row($result)){
		echo "<option value=\"$row[0]\"";
			if ($row[0] == $mci) {
				echo " selected";
			}
		echo "> $row[1] $row[2] </option>";
	}
}

?>