<?php
/*******************************************************************************
**	file:	editgroup.php
********************************************************************************
**	author:	Luis Bernardo
**	date:	2003/12/10
********************************************************************************
**	$Revision: 1.5 $ on $Date: 2004/01/16 07:23:45 $ by $Author: lmpmbernardo $
*******************************************************************************/

$id = $_GET['id'] ? $_GET['id'] : $_POST['id'];
$updategroup = $_POST['updategroup'];
$group_name = $_POST['group_name'];
$comments = $_POST['comments'];
$num_boxes = $_POST['num_boxes'];

if(isset($updategroup)) {
	// get id of logged in user (supporter)
	$supporter_id = getPersonID($cookie_name);
	// time contact modified
	$time = time();
	$sql = "update $mysql_groups_table set group_name='$group_name', author_id='$supporter_id', date_modified='$time', comments='$comments' where id=$id";
	if(execsql($sql)) {
		//now lets take care of updating the supporters in this group.
		//for all the supporters listed, if the box was checked, add the supporter to that group
		// note that the group id is in the $id variable.
		for($j = 1; $j <= $num_boxes; $j++) {
			$member_id = "box" . $j;
			$checkbox = "check" . $j;
			$checkboxid = "checkid" . $j;
			$member_id = $_POST[$member_id];
			$checkbox = $_POST[$checkbox];
			$checkboxid = $_POST[$checkboxid];
			if($member_id != '' && $checkbox == 'false') {
				$sql = "insert into $mysql_supporters_table values('$id', '$member_id')";
				execsql($sql);
			}
			if($member_id == '' && $checkbox == 'true') {
				$sql = "delete from $mysql_supporters_table where group_id = '$id' and supporter_id = '$checkboxid'";
				execsql($sql);
			}
		}
		$success_message .= "Group \"$group_name\" updated successfully.";
		printSuccess($success_message);
		echo '<br>';
		displayGroupDetail($id);
	}
} else {
	//$info is an array that contains the group information for that id number.
	$info = getGroupInfo($id);
	echo '
	<form action=index.php?t=editgroup method=post>
		<table class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
			<tr>
				<td>
					<table cellSpacing=1 cellPadding=5 width="100%" border=0>
						<tr>
							<td class=info colspan=100% align=middle><b>'.$lang['edit_group_info'].'</b></td>
						</tr>
						<tr>
							<td class=back colspan=100%>
								<table class=border cellSpacing=0 cellPadding=0 width=100% align=center border=0>
									<tr>
										<td>
											<table cellSpacing=1 cellPadding=5 width="100%" border=0>
												<tr>
													<td class=cat align=right width=20%>
														<b> '.$lang['group_name'].': </b>
													</td>
													<td class=back>
														<input type=text name=group_name value='. $info['group_name'] .'>
													</td>
												</tr>
												<tr>
													<td class=cat align=right width=20%>
														<b> '.$lang['comments'].': </b>
													</td>
													<td class=back>
														<textarea name=comments rows=3 cols=60>'. $info['comments'] .'</textarea>
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
		<br>';

	if (getNumberOfSupporters() != 0 ) {
		$num_boxes = createSupportersCheckboxes($id);
		echo '<input type=hidden name=num_boxes value='. $num_boxes .'>';
	}

	echo '
		<br>
		<center>
   			<input type=hidden name=id value='.$id.'>
			<input type=submit name=updategroup value="'.$lang['update'].'">
		</center>
	</form>';
}

function createSupportersCheckboxes($groupid) {
	global $mysql_groups_table, $mysql_people_table, $lang;
	// all supporters belong to company id = 2
	$sql = "select id, first_name, last_name from $mysql_people_table where company_id = '2' and supporter = '1' order by last_name asc";
	$result = execsql($sql);
	$numcolumns = 4;
	$width = 100/$numcolumns;
	echo '
		<table class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
			<tr>
				<td>
					<table cellSpacing=1 cellPadding=5 width="100%" border=0>
						<tr>
							<td class=info colspan='.$numcolumns.' align=center>
								<b>'.$lang['choose_supporters'].'</b>
							</td>
						</tr>';
	$i=1;
	while($row = mysql_fetch_array($result)) {
		if($i%$numcolumns == 1) {
			echo '<tr>';
		}
		echo '<td class=subcat width='.$width.'%>';
		$checked = "";
		if (supporterIsInGroup($row['id'], $groupid)) {
			$checked = " checked";
			echo "<input type=hidden name=check".$i." value=true>
			<input type=hidden name=checkid".$i." value=".$row['id'].">";
		} else {
			echo "<input type=hidden name=check".$i." value=false>";
		}
		echo "<b><input class=box type=checkbox name=box".$i." value=".$row['id'].$checked.">
		&nbsp;&nbsp;&nbsp;".$row['first_name']." ".$row['last_name']."</b><br>
				</td>";
		if($i%$numcolumns == 0) {
			echo '</tr>';
		}
		$i++;
	}
	$num_boxes = $i - 1;
	if($i%$numcolumns != 1) {
		while($i%$numcolumns != 1) {
			echo '<td class=back>&nbsp;</td>';
			$i++;
		}
		echo '</tr>';
	}
	echo '
					</table>
				</td>
			</tr>
		</table>';
	return $num_boxes;	
}

function supporterIsInGroup($sid, $gid) {
	global $mysql_supporters_table;
	$sql = "select * from $mysql_supporters_table where group_id = '$gid' and supporter_id = '$sid'";
	$result = execsql($sql);
	$numrows = mysql_num_rows($result);
	if($numrows == 0) {
		return false;
	} else {
		return true;
	}
}

?>