<?php
/*******************************************************************************
**	file:	logout.php
********************************************************************************
**	author:	Luis Bernardo
**	date:	2003/12/10
********************************************************************************
**	$Revision: 1.2 $ on $Date: 2003/12/13 04:19:39 $ by $Author: lmpmbernardo $
*******************************************************************************/

require_once "../../../includes/config.php";
if($session_save_db == 'on') {
	require_once "code/session_mysql.php";
}

session_start();
session_unset();
session_destroy();

// globals off vars
$HTTP_REFERER = $_SERVER['HTTP_REFERER'];

$referer = $HTTP_REFERER;

// find / in /index.php?t=...
$referer = substr($referer, 0, strrpos($referer, "/")) . "/";
header("Location: $referer");

?>
