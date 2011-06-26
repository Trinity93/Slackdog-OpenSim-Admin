<?php
/*******************************************************************************
**	file:	updateticketlog.php
********************************************************************************
**	author:	Luis Bernardo
**	date:	2003/12/10
********************************************************************************
**	$Revision: 1.3 $ on $Date: 2004/01/16 07:23:45 $ by $Author: lmpmbernardo $
*******************************************************************************/

require_once "../../../../includes/config.php";
require_once "../../../../includes/sup_common.php";
require_once "../../../../includes/style.php";
require_once "../../../../includes/lang/$language/language.php";

$id = $_GET['id'];
$pop = $_GET['pop'];
$sort = $_GET['sort'];

displayTicketHistory($id, $pop, $sort);

?>

