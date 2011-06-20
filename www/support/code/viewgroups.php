<?php
/*******************************************************************************
**	file:	viewgroups.php
********************************************************************************
**	author:	Luis Bernardo
**	date:	2003/12/10
********************************************************************************
**	$Revision: 1.5 $ on $Date: 2004/01/16 22:18:52 $ by $Author: lmpmbernardo $
*******************************************************************************/

$action = $_GET['action'];
$id = $_GET['id'] ? $_GET['id'] : $_POST['id'];
$confirmdelete = $_POST['confirmdelete'];
$o = $_GET['o'] ? $_GET['o'] : $_POST['o'];
$offset = $_GET['offset'];

if(isset($confirmdelete)) {
	$info = getGroupInfo($id);
	$name = $info['group_name'];
	$sql = "delete from $mysql_groups_table where id='$id'";
	execsql($sql);
	$sql = "delete from $mysql_supporters_table where group_id='$id'";
	execsql($sql);
	$success_message = "Group \"$name\" successfully deleted.";
	printSuccess($success_message);
} else if($action == 'delete' && !isset($cancel)) {
	echo '
	<form action=index.php?t=viewgroups method=post>
		<table class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
			<tr>
				<td>
					<table cellSpacing=1 cellPadding=5 width="100%" border=0>
						<tr>
							<td class=info colspan=100% align=middle>
								<b>'.$lang['confirmation'].'</b>
							</td>
						</tr>
	<tr>
		<td class=back>
			<table class=border cellSpacing=0 cellPadding=0 width=100% align=center border=0>
 				<tr>
					<td>
						<table cellSpacing=1 cellPadding=5 width="100%" border=0>
		<tr>
			<td class=back2>
				<br><center><b><font color=red>'.$lang['q_are_you_sure'].'</font><br>
				'.$lang['text_warning_del_group'].'</b></center><br>
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
		<input type=hidden name=id value='. $id .'><br>
		<center>
			<input type=submit name=confirmdelete value='.$lang['delete'].'>&nbsp;&nbsp;
			<input type=submit name=cancel value='.$lang['cancel'].'>
		</center>
	</form>';
} else {
	echo '
	<form action=index.php?t=viewgroups method=post>
		<table class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
			<tr>
				<td>
					<table cellSpacing=1 cellPadding=5 width="100%" border=0>
						<tr>
							<td class=info colspan=1 align=right>
								<b>'.$lang['sort_by'].':
									<select name=o onChange="submit()">
										<option value="id"'; if($o=='id') echo ' selected'; echo '>'.$lang['id'].'</option>
										<option value="group_name"'; if($o=='group_name') echo ' selected'; echo '>'.$lang['name'].'</option>
									</select>
								</b>
							</td>
						</tr>
						<tr>
							<td class=back>';
								getListOfGroups($o, $offset); echo '
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</form>';

	echo '
		<center>';
	$offset = $offset - $groups_limit;
	if($offset < 0){
		echo "
			&nbsp;".$lang['previous'];
	} else {
		echo "
			&nbsp;<a href=index.php?t=viewgroups&o=$o&offset=$offset>".$lang['previous']."</a>";
	}
	echo "
		&nbsp; | &nbsp;";
	$offset = $offset + $groups_limit +$groups_limit;
	if($offset < getNumberOfGroups()) {
		echo "
			&nbsp;<a href=index.php?t=viewgroups&o=$o&offset=$offset>".$lang['next']."</a>";
	} else {
		echo "
			&nbsp;".$lang['next'];
	}
}

/***********************************************************************************************************
**	function getListOfGroups():
************************************************************************************************************/
function getListOfGroups($order, $offset) {
	global $mysql_people_table, $mysql_groups_table, $groups_limit;
	if(!isset($offset))
		$offset = 0;
	$low = $offset;
	switch($order) {
		case ("group_name"):
			$sql = "select * from $mysql_groups_table order by group_name asc limit $low, $groups_limit";
			break;
		default:
			$sql = "select * from $mysql_groups_table order by id asc limit $low, $groups_limit";
			break;
	}
	$result = execsql($sql);
	//get all of the data into readable variables.
	$counter = 1;
	$numberofgroups = getNumberOfGroups();
	while($row = mysql_fetch_array($result)) {
		$id = $row['id'];
		$groupname = $row['group_name'];
		displayGroupInfo($id, $groupname);
		if($counter < $groups_limit && $counter+$offset < $numberofgroups) echo '<br>';
		$counter++;
	}	//end while
}

/***********************************************************************************************************
**	function displayGroupInfo():
************************************************************************************************************/
function displayGroupInfo($id, $groupname) {
	global $mysql_supporters_table, $mysql_people_table;
    // [15/12/2003 seh]
    global $lang;
    // [/seh]
	$supporters = "";
	$sql = "select t1.id, t1.first_name, t1.last_name, t2.supporter_id from $mysql_people_table as t1, $mysql_supporters_table as t2 where t1.id=t2.supporter_id and t2.group_id='$id'";
	$result = execsql($sql);
	while($row = mysql_fetch_array($result)) {
		$supporters .= $row[1] . " " . $row[2] . "<br>";
	}

	echo '
		<table class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
			<tr>
				<td>
					<table cellSpacing=1 cellPadding=5 width="100%" border=0>
						<tr>
							<td class=info align="left"><b>'.$lang['group_id'].': ' . $id . '</b></td>
							<td class=info align="right">
								<a class=info href=index.php?t=detailgroup&id='.$id.'>'.$lang['detail'].'</a>,
								<a class=info href=index.php?t=editgroup&id='.$id.'>'.$lang['edit'].'</a>,
								<a class=info href=index.php?t=viewgroups&action=delete&id='.$id.'>'.$lang['delete'].'</a>
							</td>
						</tr>
						<tr>
							<td width=27% class=back2 align=right>'.$lang['name'].':</td><td class=back>'. $groupname .'</td>
						</tr>
						<tr>
							<td width=27% class=back2 align=right>'.$lang['supporters'].':</td><td class=back>'. $supporters .'</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>';
}

?>