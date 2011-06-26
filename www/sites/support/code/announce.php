<?php
/*******************************************************************************
**	file:	announce.php
********************************************************************************
**	author:	Luis Bernardo
**	date:	2003/12/10
********************************************************************************
**	$Revision: 1.4 $ on $Date: 2003/12/19 06:05:17 $ by $Author: lmpmbernardo $
*******************************************************************************/

$add = $_GET['add'];
$addannounce = $_POST['addannounce'];
$message = $_POST['message'];
$action = $_GET['action'];
$update = $_GET['update'] ? $_GET['update'] : $_POST['update'];
$id = $_GET['id'] ? $_GET['id'] : $_POST['id'];

if(isset($addannounce)) {
	$time = time();
	$sql = "insert into $mysql_announcement_table values(null, $time, '$message')";
	execsql($sql);
}

if($action == 'delete') {
	$sql = "delete from $mysql_announcement_table where id=$id";
	execsql($sql);
}

if(isset($update)) {
	$sql = "update $mysql_announcement_table set message='$message' where id=$id";
	execsql($sql);
}

if(!isset($add)) {
	$addlink = "<td class=info width=15% align=right><a class=info href=index.php?t=announce&add=true>".$lang['add']."</a></td>";
} else {
	$addlink = "<td class=info width=15% align=center>&nbsp;</td>";
}

if($usertype == "admin") {
	echo '
	<table class=border cellSpacing=0 cellPadding=0 width=100% align=center border=0>
		<tr>
			<td>
				<table cellSpacing=1 cellPadding=5 width=100% border=0>
					<tr>
						<td class=info>
							<table class=border cellSpacing=0 cellPadding=0 width=100% border=0>
								<tr>
									<td class=info width=15% align=center>&nbsp;</td>
									<td class=info width=70% align=center><b>'.$lang['announcements'].'</b></td>
									'.$addlink.'
								</tr>
							</table>
						</td>
					</tr>';
					displayAnnouncements($usertype);
	if(isset($add) || $action == 'update') {
		if($action == 'update') {
			$message = getMessage($id);
			$input = "<input type=submit name=update value=Update><input type=hidden name=id value=". $id.">";
		} else {
			$message = "";
			$input = "<input type=submit name=addannounce value=".$lang['add'].">";
		}
		echo '
					<tr>
						<td class=back align=center>
							<form action=index.php?t=announce method=post>
								<textarea name=message rows=8 cols=99%>'. $message.'</textarea><br>
								<br>'.$input.'&nbsp;&nbsp;&nbsp;
								<input type=submit name=cancel value="'.$lang['cancel'].'">
							</form>
						</td>
					</tr>';
	}
	echo '
				</table>
			</tr>
		</td>
	</table>';
} else {
	echo '
		<table class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
			<tr>
				<td>
					<table cellSpacing=1 cellPadding=5 width="100%" border=0>
						<tr>
							<td class=info align=middle>
								<b>'.$lang['announcements'].'</b>
							</td>
						</tr>';
						displayAnnouncements($usertype); echo '
					</table>
				</td>
			</tr>
		</table>';
}

/***********************************************************************************************************
**	function displayAnnouncements():
************************************************************************************************************/
function displayAnnouncements($flag) {
	echo '
		<tr>
			<td class=back colspan=1>
				<table class=border cellSpacing=0 cellPadding=0 width=100% align=center border=0>
					<tr>
						<td>
							<table cellSpacing=1 cellPadding=5 width="100%" border=0>';
								getAnnouncements($flag); echo '
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>';
}

/***********************************************************************************************************
**	function getAnnouncements():
************************************************************************************************************/
function getAnnouncements($flag) {
	global $announcements_limit, $mysql_announcement_table;
    // [12/12/2003 seh]
    global $lang;
    // [/seh]
	$sql = "select * from $mysql_announcement_table order by id desc limit $announcements_limit";

	$result = execsql($sql);
	while($row = mysql_fetch_row($result)) {
		$deleteeditlink = "";
		if($flag == 'admin') {
			$deleteeditlink = "&nbsp;&nbsp;&nbsp;&nbsp;<font size=1>[<a href=index.php?t=announce&action=delete&id=".$row[0].">".$lang['delete']."</a>, <a href=index.php?t=announce&action=update&id=".$row[0].">".$lang['edit']."</a>]</font>";
		}
		echo '
			<tr>
				<td class=date>
					<b>'. date("F d, Y",$row[1]) .'</b>' . $deleteeditlink .'
				</td>
			</tr>
			<tr>
				<td class=back2>
					&nbsp;&nbsp;&nbsp;&nbsp;'. $row[2] .'
				</td>
			</tr>';
	}
}

/***********************************************************************************************************
**	function getMessage():
************************************************************************************************************/
function getMessage($id) {
	global $mysql_announcement_table;
	$sql = "select message from $mysql_announcement_table where id=$id";
	$result = execsql($sql);
	$row = mysql_fetch_row($result);
	return $row[0];
}
?>