<?php
/*******************************************************************************
**	file:	config.php
********************************************************************************
**	author:	Luis Bernardo
**	date:	2003/12/10
********************************************************************************
**	$Revision: 1.9 $ on $Date: 2004/03/01 06:06:04 $ by $Author: lmpmbernardo $
*******************************************************************************/

/**********************************************************************************************************/
/****************************	Mysql Variables	***********************************************************/

$mysql_host = "localhost";		//mysql host (localhost if mysql is running on this machine)
$mysql_user = "root";			//mysql user name
$mysql_pwd = "locknar93";				//mysql password
$mysql_db = "helpdesk";		//mysql database name

/********************	directory to put files associated with the tickets	********************************/
// it is recommended that you choose the directory below your www directory, say: $filesdir = "../../files";
// below is the default, not recommended since the files are visible by http unless you .htaccess the directory
$filesdir = "./files";
/********************	choose your date and datetime format	********************************************/
//$dateformat = "m/d/y"; // example: 10/02/04 (U.S.A.)
$dateformat = "Y-m-d";
//$dateformat = "y/m/d"; // Europe....
//$datetimeformat = "m/d/y \a\\t g:ia"; // example: 01/27/04 at 1:55pm
$datetimeformat = "Y-m-d H:i:s";


/********************************* Which language will I use? *********************************************/
/**********************************************************************************************************/
// en = english
// es = spanish
// pt = portuguese - portugal
// nl = dutch
// de = german
// fr = french
// br = portuguese - brazil
$language="en";

/***************	You shouldn't need to change anything below here.	***********************************/
/**********************************************************************************************************/
/**********************************************************************************************************/

$mysql_sessions_table = "sessions";				// store sessions - necessary for load balanced systems like sourceforge
$mysql_announcement_table = "announcements";	// mysql announcement table name
$mysql_tcategories_table = "tcategories";		// mysql ticket categories table
$mysql_tpriorities_table = "tpriorities";		// mysql ticket priority table
$mysql_tstatus_table = "tstatus";				// mysql ticket status table
$mysql_platforms_table = "platforms";			// mysql platforms table
$mysql_settings_table = "settings";				// mysql settings table
$mysql_themes_table = "themes";					// mysql themes table
$mysql_whosonline_table = "whosonline";			// mysql whosonline table
$mysql_people_table = "people";					// replaces $mysql_users_table
$mysql_companies_table = "companies";           // people belong to companies
$mysql_groups_table = "groups";					// groups hold supporters
$mysql_supporters_table = "supporters";			// maps supporters to groups
$mysql_modules_table = "modules";				// modules
$mysql_versions_table = "versions";				// versions
$mysql_tickets_table = "tickets";				// tickets
$mysql_tracktime_table = "tracktime";			// keep track of time
$mysql_ticketmodules_table = "ticketmodules";	// maps modules referenced in a ticket
$mysql_diskid_table = "diskid";					// diskid is id of a cd-rom
$mysql_faqcategories_table = "faqcategories";	// faqs categories
$mysql_faqs_table = "faqs";						// faqs
$mysql_ticketdiskid_table = "ticketdiskid";		// holds diskid for a ticket. this is a temporary solution
$mysql_ticketfiles_table = "ticketfiles";		// maps files associated with ticket
$mysql_files_table = "files";					// files

$sourceforge = "off";							// on/off to display sourceforge thanks
$session_save_db = "off";						// on/off to save session in mysql or tmp directory. sourceforge requires on

/**********************************************************************************************************/
/**********************************************************************************************************/

?>
