<?php
/*******************************************************************************
**	file:	ticketfiles.php
********************************************************************************
**	author:	Luis Bernardo
**	date:	2003/12/10
********************************************************************************
**	$Revision: 1.4 $ on $Date: 2004/01/16 22:18:45 $ by $Author: lmpmbernardo $
*******************************************************************************/

$id = $_GET['id'] ? $_GET['id'] : $_POST['id'];
$edit = $_GET['edit'];
$cancel = $_POST['cancel'];
$comments = $_POST['comments'];
$name = $_POST['name'];
$uploadfile = $_POST['uploadfile'];
$userfile = $_FILES['userfile'];
$action = $_GET['action'];
$fileid = $_GET['fileid'];

$supporter_id = getPersonID($cookie_name);

if(isset($cancel)) {
	$edit = null;
}

if(isset($uploadfile)) {
	$edit = null;
	$time = time();
	if(!file_exists($filesdir)) {
		mkdir($filesdir, 0777);
	}
	// $filesdir is defined in config.php
	$ticketfilesdir = $filesdir . "/ticket" . str_pad($id, 5, "0", STR_PAD_LEFT);
	if(!file_exists($ticketfilesdir)) {
		mkdir($ticketfilesdir, 0777);
	}
	// the following was tested with PHP4.3.3, register globals off, on W2K+Apache
	// thanks to Dick Brunner for pointing out the fix.
	$filesize = $userfile['size'];
	if($filesize > 0) {
		if($name == '') {
			$name = $userfile['name'];
		}
		$newfilename = $ticketfilesdir . "/" . $userfile['name'];
		if(copy($userfile['tmp_name'], $newfilename)) {
			$sql = "insert into $mysql_files_table values(null, '$name', '$newfilename', '$filesize', '$supporter_id', '$time', '$comments')";
			execsql($sql);
			// get id of file uploaded
			$sql = "select id from $mysql_files_table where filename='$newfilename'";
			$result = execsql($sql);
			$row = mysql_fetch_row($result);
			$fileid = $row[0];
			// insert ticket-file pair into table
			$sql = "insert into $mysql_ticketfiles_table values('$id', '$fileid')";
			execsql($sql);
		}
	}
}

if($action == 'delete') {
	$sql = "select filename from $mysql_files_table where id='$fileid'";
	$result = execsql($sql);
	$row = mysql_fetch_row($result);
	$filename = $row[0];
	unlink($filename);
	$sql = "delete from $mysql_files_table where id='$fileid'";
	execsql($sql);
	// a file can only be associated with one ticket
	$sql = "delete from $mysql_ticketfiles_table where file_id='$fileid'";
	execsql($sql);
}

$header = $lang['files_ticket_id'] . str_pad($id, 5, "0", STR_PAD_LEFT);

echo '
	<table class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
		<tr>
			<td>
				<table cellSpacing=1 cellPadding=5 width="100%" border=0>
					<tr>
						<td class=info>
							<table class=border cellSpacing=0 cellPadding=0 width=100% border=0>
								<tr>
									<td class=info width="30%" align=center>&nbsp;</td>
									<td class=info width="40%" align=center><b>'. $header .'</b></td>
									<td class=info width=30% align=right>';
if(!isset($edit)) {
	echo '
										<a class=info href=index.php?t=ticketfiles&edit=true&id='. $id .'>'.$lang['add_file'].'</a>,';
} else {
	echo '
										&nbsp;';
}
echo '
										<a class=info href=index.php?t=detailticket&id='. $id .'>'.$lang['ticket_detail'].'</a>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td class=back colspan="100%">
							<table class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
								<tr>
									<td>
										<table cellSpacing=1 cellPadding=5 width="100%" border=0>';
displayTicketFiles($id, $edit);
if(isset($edit)) {
	echo '
		<tr>
			<td class=back colspan="100%">
				<form enctype=multipart/form-data action=index.php?t=ticketfiles method=post>
					<table>
						<tr>
							<td align=right width=25%><b>'.$lang['file'].':</b></td>
							<td><input name=userfile size=40 type=file></td>
						</tr>
						<tr>
							<td align=right width=25%><b>'.$lang['name'].':</b></td>
							<td><input type=text size=40 name=name></td>
						</tr>
						<tr>
							<td align=right width=25%><b>'.$lang['comments'].':</b></td>
							<td class=back><textarea name=comments rows=3 cols=50></textarea></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td align=left>
								<input type=hidden name=id value='. $id .'>
								<input type=submit name=uploadfile value='.$lang['upload'].'>&nbsp;&nbsp;&nbsp;&nbsp;
								<input type=submit name=cancel value='.$lang['cancel'].'>
							</td>
						</tr>
					</table>
				</form>
			</td>
		</tr>';
}
echo '
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>';

function displayTicketFiles($id, $edit) {
	global $mysql_ticketfiles_table, $mysql_files_table, $lang;
	$sql = "select t2.* from $mysql_ticketfiles_table as t1, $mysql_files_table as t2 where t1.file_id=t2.id and t1.ticket_id='$id'";
	$result = execsql($sql);
	$counter = 0;
	while($row = mysql_fetch_row($result)) {
		$counter++;
		$fileid = $row[0];
		$name = $row[1];
		$filename = $row[2];
		$size = $row[3];
		$authorid = $row[4];
		$authorname = getPersonName($authorid);
		$modified = date("m/d/y",$row[5]);
		$comments = $row[6];
		displayTicketFile($id, $fileid, $name, $filename, $size, $authorname, $modified, $comments);
	}
	if($counter == 0 && !isset($edit)) {
		echo '
			<tr>
				<td class=back2>
				'.$lang['no_files'].'
				</td>
			</tr>';
	}
}

function displayTicketFile($ticketid, $id, $name, $filename, $size, $authorname, $modified, $comments) {
	global $lang;
	$postedbytext = str_replace("XXX", $modified, $lang['posted_by']);
	$postedbytext = str_replace("YYY", $authorname, $postedbytext);
	echo '
		<tr>
			<td class=back2>
				'.$lang['file'].': <a href=downloadfile.php?id='.$id.' target="myWindow" onClick="window.open(\'downloadfile.php?id='.$id.'\', \'myWindow\',
					\'location=no, status=yes, scrollbars=yes, height=500, width=800, menubar=yes, toolbar=yes, resizable=yes\')"><b>'. $name .'</b></a>
				('. round($size/1024) .' KB) <font size=1>[<a href=index.php?t=ticketfiles&id='. $ticketid .'&action=delete&fileid='. $id .'>'.$lang['delete'].'</a>]</font><br>'; 
				if($comments != '') echo $comments . '<br>'; echo $postedbytext.'
			</td>
		</tr>';
}

?>