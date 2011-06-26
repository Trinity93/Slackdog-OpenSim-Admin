<?php
/*******************************************************************************
**	file:	index.php
********************************************************************************
**	author:	Luis Bernardo
**	date:	2003/12/10
********************************************************************************
**	$Revision: 1.9 $ on $Date: 2004/03/01 06:06:04 $ by $Author: lmpmbernardo $
*******************************************************************************/

require_once "../../../includes/config.php";
require_once "../../../includes/sup_common.php";
require_once "../../../includes/lang/$language/language.php";

require "login.php";
logVisitors($cookie_name);

// $t is the switch in index.php?t=something
$t = $_GET['t'];
// when page=support it means the admin is looking at the support section
$page = $_SESSION['page'];
if($_GET['page'] == "support") {
	$page = $_GET['page'];
	$_SESSION['page'] = $page;
}
if($_GET['page'] == "admin") {
	$page = $_GET['page'];
	$_SESSION['page'] = $page;
}
$adminsupportlink = "index.php?page=support";
$adminsupportlabel = $lang['support'];
if($page == "support") {
	$adminsupportlink = "index.php?page=admin";
	$adminsupportlabel = $lang['administration'];
}
if($page == "admin") {
	$adminsupportlink = "index.php?page=support";
	$adminsupportlabel = $lang['support'];
}

echo '
<html>
<head>';
require_once "code/style.php";
echo '
<title>MyHelpdesk - '. $helpdesk_name .'</title>
</head>
<body class=body>
	<table class=border cellSpacing=0 cellPadding=0 width="90%" align=center border=0>
  		<tbody>
  			<tr>
  				<td>
      				<table cellSpacing=1 cellPadding=5 width="100%" border=0>
        				<tbody>
        					<tr>
          						<td class=hf align=center>
          							<b>'.$cookie_name.'@MyHelpdesk</b>
          						</td>
        					</tr>
        					<tr>
          						<td class=back>
									<table width="100%" align=center border=0>
										<tbody>
											<tr>
												<td vAlign=top width="20%">
													<table class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
														<tbody>
															<tr>
																<td>
																	<table cellSpacing=1 cellPadding=5 width="100%" border=0>
																		<tbody>';
// start menu
echo '
	<tr>
		<td class=info align=middle><b>'.$lang['administration'].'</b></td>
	</tr>';
if($usertype == "admin" && $page != "support") {
	echo '
	<tr>
		<td class=cat><b>'.$lang['ticket_options'].'</b></td>
	</tr>
	<tr>
		<td class=subcat>
			<li><a href=index.php?t=ticketproperties&property=categories>'.$lang['ticket_categories'].'</a></li>
			<li><a href=index.php?t=ticketproperties&property=priorities>'.$lang['ticket_priorities'].'</a></li>
			<li><a href=index.php?t=ticketproperties&property=status>'.$lang['ticket_status'].'</a></li>
			<li><a href=index.php?t=ticketproperties&property=platforms>'.$lang['ticket_platforms'].'</a></li>
		</td>
	</tr>';
	if($enable_products == 'on') {
		echo '
	<tr>
		<td class=cat><b>'.$lang['product_options'].'</b></td>
	</tr>
	<tr>
		<td class=subcat>
			<li><a href=index.php?t=productproperties&property=modules>'.$lang['product_modules'].'</a></li>
			<li><a href=index.php?t=productproperties&property=versions>'.$lang['product_versions'].'</a></li>
		</td>
	</tr>';
	}
	echo '
	<tr>
		<td class=cat><b>'.$lang['supporter_management'].'</b></td>
	</tr>
	<tr>
		<td class=subcat>
			<li><a href=index.php?t=viewsupporters>'.$lang['view_supporters'].'</a></li>
			<li><a href=index.php?t=viewgroups>'.$lang['view_groups'].'</a></li>
			<li><a href=index.php?t=addsupporter>'.$lang['add_supporter'].'</a></li>
			<li><a href=index.php?t=addgroup>'.$lang['add_group'].'</a></li>
		</td>
	</tr>
	<tr>
		<td class=cat><b>'.$lang['faqs_management'].'</b></td>
	</tr>
	<tr>
		<td class=subcat>
			<li><a href=index.php?t=viewfaqs>'.$lang['view_faqs'].'</a></li>
			<li><a href=index.php?t=addfaq>'.$lang['add_faq'].'</a></li>
			<li><a href=index.php?t=productproperties&property=faqcategories>'.$lang['faq_categories'].'</a></li>
		</td>
	</tr>
	<tr>
		<td class=cat><b>'.$lang['ticket_reporting'].'</b></td>
	</tr>
	<tr>
		<td class=subcat>
			<li><a href=index.php?t=ticketstatistics>'.$lang['cumulative_statistics'].'</a></li>
			<li><a href=index.php?t=ticketstatisticsreport>'.$lang['pipeline_statistics'].'</a></li>
			<li><a href=index.php?t=processmap>Process Map</a></li>
			<li><a href=index.php?t=companystatistics>'.$lang[company_statistics].'</a></li>';
	if($enable_time_tracking == 'on') {
	echo '
			<li><a href=index.php?t=tracktime&case=administrator>'.$lang['time_sheets'].'</a></li>';
	}
	echo '
		</td>
	</tr>';
}
if($usertype == "supporter" || $page == "support") {
	echo '
	<tr>
		<td class=cat><b>'.$lang['ticket_management'].'</b></td>
	</tr>
	<tr>
		<td class=subcat>
			<li><a href=index.php?t=createticket>'.$lang['create_ticket'].'</a></li>
			<li><a href=index.php?t=viewtickets&case=supporter>'.$lang['my_tickets'].'</a></li>
			<li><a href=index.php?t=viewtickets&case=groups>'.$lang['my_groups_tickets'].'</a></li>';
	if(isAdministrator($cookie_name)) {
	echo '
			<li><a href=index.php?t=viewtickets&case=all>'.$lang['all_tickets'].'</a></li>';
	}
	echo '
			<li><a href=index.php?t=ticketsearch>'.$lang['ticket_search'].'</a></li>
		</td>
	</tr>
	<tr>
		<td class=cat><b>'.$lang['client_management'].'</b></td>
	</tr>
	<tr>
		<td class=subcat>
			<li><a href=index.php?t=viewcontacts>'.$lang['view_contacts'].'</a></li>
			<li><a href=index.php?t=viewcompanies>'.$lang['view_companies'].'</a></li>
			<li><a href=index.php?t=addcontact>'.$lang['add_contact'].'</a></li>
			<li><a href=index.php?t=addcompany>'.$lang['add_company'].'</a></li>
			<li><a href=index.php?t=addressbook>'.$lang[address_book].'</a></li>
			<li><a href=index.php?t=contactsearch>'.$lang['contact_search'].'</a> </li>
		</td>
	</tr>
	<tr>
		<td class=cat><b>'.$lang['my_records'].'</b></td>
	</tr>
	<tr>
		<td class=subcat>
			<li><a href=index.php?t=editprofile>'.$lang['edit_my_profile'].'</a></li>';
	if($enable_time_tracking == 'on') {
	echo '
			<li><a href=index.php?t=tracktime>'.$lang['my_time_sheet'].'</a></li>';
	}
	echo '
			<li><a href=index.php?t=ticketstatistics&case=supporter>'.$lang['my_ticket_statistics'].'</a></li>
		</td>
	</tr>
	<tr>
		<td class=cat><b>'.$lang['knowledge_base'].'</b></td>
	</tr>
	<tr>
		<td class=subcat>
			<li><a href=index.php?t=viewfaqs>'.$lang['view_faqs'].'</a></li>
			<li><a href=index.php?t=searchfaqs>'.$lang['search_faqs'].'</a></li>
		</td>
	</tr>';
}
if($usertype == "customer") {
}
// end menu
echo '
																		</tbody>
																	</table>
																</td>
															</tr>
														</tbody>
													</table>
												</td>
												<td vAlign=top width=80%>';
// start body
require getBody($usertype, $t, $page);
// end body
echo '
												</td>
											</tr>
										</tbody>
									</table>
          						</td>
        					</tr>';
if($enable_whosonline == 'on' && $usertype == "admin") {
	echo '
							<tr>
								<td class=cat colspan=1>';
									printVisitors(); echo '
								</td>
				</tr>';
}
echo '
        					<tr>
          						<td class=hf align=middle>
          							<a class=hf href="./">'.$lang['home'].'</a> &nbsp; | &nbsp;';
if($usertype == "admin") {
		echo '
          							<a class=hf href='.$adminsupportlink.'>'.$adminsupportlabel.'</a> &nbsp; | &nbsp;';
}
if($usertype == "admin" && $page != "support") {
	echo '
          							<a class=hf href="./index.php?t=settings">'.$lang['settings'].'</a> &nbsp; | &nbsp;';
}
echo '
          							<a class=hf href="./logout.php">'.$lang['logout'].'</a>
								</td>
							</tr>
       				</tbody>
      				</table>
      			</td>
			</tr>
		</tbody>
	</table>
	<center>
		<br><font size=1>'. $helpdesk_name .'</font>
	</center>
</body>
</html>';

/***********************************************************************************************************
****************************************** DEFINE FUNCTIONS ************************************************
************************************************************************************************************/

/***********************************************************************************************************
**	function getBody():
************************************************************************************************************/
function getBody($usertype, $t, $page='') {
	$newbody = "";
	if($usertype == "customer") {
	//
	} else if($usertype == "supporter" || $page == "support") {
		switch($t) {
			case ("ticketsearch"):
				$newbody = "code/ticketsearch.php";
				break;
			case ("editticket"):
				$newbody = "code/editticket.php";
				break;
			case ("detailticket"):
				$newbody = "code/detailticket.php";
				break;
			case ("createticket"):
				$newbody = "code/createticket.php";
				break;
			case ("updateticketlog"):
				$newbody = "code/updateticketlog.php";
				break;
			case ("editprofile"):
				$newbody = "code/editprofile.php";
				break;
			case ("addcontact"):
				$newbody = "code/addcontact.php";
				break;
			case ("addcompany"):
				$newbody = "code/addcompany.php";
				break;
			case ("viewcontacts"):
				$newbody = "code/viewcontacts.php";
				break;
			case ("viewcompanies"):
				$newbody = "code/viewcompanies.php";
				break;
			case ("editcontact"):
				$newbody = "code/editcontact.php";
				break;
			case ("editcompany"):
				$newbody = "code/editcompany.php";
				break;
			case ("detailcontact"):
				$newbody = "code/detailcontact.php";
				break;
			case ("detailcompany"):
				$newbody = "code/detailcompany.php";
				break;
			case ("contactsearch"):
				$newbody = "code/contactsearch.php";
				break;
			case ("viewfaqs"):
				$newbody = "code/viewfaqs.php";
				break;
			case ("searchfaqs"):
				$newbody = "code/searchfaqs.php";
				break;
			case ("detailfaq"):
				$newbody = "code/viewfaq.php";
				break;
			case ("viewtickets"):
				$newbody = "code/viewtickets.php";
				break;
			case ("tracktime"):
				$newbody = "code/tracktime.php";
				break;
			case ("tickettime"):
				$newbody = "code/tickettime.php";
				break;
			case ("ticketfiles"):
				$newbody = "code/ticketfiles.php";
				break;
			case ("ticketstatistics"):
				$newbody = "code/ticketstatistics.php";
				break;
			case ("addressbook"):
				$newbody = "code/addressbook.php";
				break;
			default:
				$newbody = "code/announce.php";
				break;
		}
	} else { // usertype == admin
		switch($t){
			case ("ticketproperties"):
				$newbody = "code/ticketproperties.php";
				break;
			case ("ticketstatistics"):
				$newbody = "code/ticketstatistics.php";
				break;
			case ("ticketstatisticsreport"):
				$newbody = "code/ticketstatisticsreport.php";
				break;
			case ("companystatistics"):
				$newbody = "code/companystatistics.php";
				break;
			case ("processmap"):
				$newbody = "code/processmap.php";
				break;
			case ("productproperties"):
				$newbody = "code/productproperties.php";
				break;
			case ("productmodules"):
				$newbody = "code/productmodules.php";
				break;
			case ("productversions"):
				$newbody = "code/productversions.php";
				break;
			case ("addgroup"):
				$newbody = "code/addgroup.php";
				break;
			case ("addsupporter"):
				$newbody = "code/addsupporter.php";
				break;
			case ("viewgroups"):
				$newbody = "code/viewgroups.php";
				break;
			case ("viewsupporters"):
				$newbody = "code/viewsupporters.php";
				break;
			case ("editsupporter"):
				$newbody = "code/editsupporter.php";
				break;
			case ("editgroup"):
				$newbody = "code/editgroup.php";
				break;
			case ("detailsupporter"):
				$newbody = "code/detailsupporter.php";
				break;
			case ("detailgroup"):
				$newbody = "code/detailgroup.php";
				break;
			case ("viewfaqs"):
				$newbody = "code/viewfaqs.php";
				break;
			case ("addfaq"):
				$newbody = "code/addfaq.php";
				break;
			case ("faqcategories"):
				$newbody = "code/faqcategories.php";
				break;
			case ("detailfaq"):
				$newbody = "code/detailfaq.php";
				break;
			case ("editfaq"):
				$newbody = "code/editfaq.php";
				break;
			case ("tracktime"):
				$newbody = "code/tracktime.php";
				break;
			case ("tickettime"):
				$newbody = "code/tickettime.php";
				break;
			case ("settings"):
				$newbody = "code/control.php";
				break;
			default:
				$newbody = "code/announce.php";
				break;
		}
	}
	return $newbody;
}

/***********************************************************************************************************
**	function logVisitors():
************************************************************************************************************/
function logVisitors($cookie) {
	global $mysql_whosonline_table;
	$phpself = $_SERVER['PHP_SELF'];
	$remoteaddr = $_SERVER['REMOTE_ADDR'];
	//this is the delay time before the db is updated when a user is no longer online.
	$timeoutseconds = 60;
	$timestamp = time();
	$timeout = $timestamp - $timeoutseconds;
	$sql = "insert ignore into $mysql_whosonline_table values('$timestamp', '$cookie', '$remoteaddr','$phpself')";
	execsql($sql);
	$sql = "delete from $mysql_whosonline_table where timestamp<'$timeout'";
	execsql($sql);
}

/***********************************************************************************************************
**	function logVisitors():
************************************************************************************************************/
function printVisitors() {
	global $mysql_whosonline_table;
    // [15/12/2003 seh]
    global $lang;
    // [/seh]
	$sql = "select distinct ip, user from $mysql_whosonline_table order by user";
	$r = execsql($sql);

	echo $lang['text_who_online'].": ";
	$j = 0;
	$pad = "";
	while($row = mysql_fetch_array($r)) {
		if($j > 0) $pad = ", ";
		if(isSupporter($row[1])) {
			echo $pad . "<b>$row[1]</b>";
		} else {
			echo $pad . "$row[1]";
		}
		$j++;
	}
}
?>
