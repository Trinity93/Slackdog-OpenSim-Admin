<?php
/*******************************************************************************
**	file:	downloadfile.php
********************************************************************************
**	author:	Luis Bernardo
**	date:	2003/12/10
********************************************************************************
**	$Revision: 1.2 $ on $Date: 2003/12/13 04:19:39 $ by $Author: lmpmbernardo $
*******************************************************************************/

require_once "../../../includes/config.php";
require_once "../../../includes/common.php";

$id = $_GET['id'];

$mimeType = "application/octet-stream";
$sql = "select * from $mysql_files_table where id='$id'";
$result = execsql($sql);
$row = mysql_fetch_row($result);
$pathfilename = $row[2];
$slashposition = strrpos($pathfilename, "/");
$filename = substr($pathfilename, $slashposition + 1);
header("Content-Disposition: filename=\"$filename\"");
header("Content-Type: $mimeType");
header("Content-Length: ". filesize("$pathfilename"));
header("Expires: 0");
readfile($pathfilename);

?>
