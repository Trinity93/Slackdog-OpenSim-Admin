<?php
/*
 * Copyright (c) 2007, 2008 Contributors, http://opensimulator.org/
 * See CONTRIBUTORS for a full list of copyright holders.
 *
 * See LICENSE for the full licensing terms of this file.
 *
*/

##################### System #########################
define("SYSNAME","Slackdog Grid");
define("SYSURL","http://localhost");
define("SYSMAIL","your@email.com");


$userInventoryURI="http://localhost:8003/";
$userAssetURI="http://localhost:8003/";

############ Delete Unconfirmed accounts ################
// e.g. 24 for 24 hours  leave empty for no timed delete
$unconfirmed_deltime="24";

###################### Money Settings ####################

// Key of the account that all fees go to:
$economy_sink_account="<UUID of your Money Avatar>";

// Key of the account that all purchased currency is debited from:
$economy_source_account="<UUID of your Money Avatar>";

// Minimum amount of real currency (in CENTS!) to allow purchasing:
$minimum_real=1;

// Error message if the amount is not reached:
$low_amount_error="You tried to buy less than the minimum amount of currency. You cannot buy currency for less than US$ %.2f.";

// Sets wich Pageeditor should be used:
$editor_to_use='standard';
// $editor_to_use='fckeditor';


################### GridMap Settings  #####################
//Allowing Zoom on your Map
$ALLOW_ZOOM=TRUE;

//Default StartPoint for Map
$mapstartX=4471;
$mapstartY=5726;

//Direction where Info Image has to stay ex.: dr = down right ; dl =down left ; tr = top right ; tl = top left ; c = center 
$display_marker="dr";

##################### Database ########################
define("C_DB_TYPE","mysql");
//Your Hostname here:
define("C_DB_HOST","localhost");
//Your Databasename here:
define("C_DB_NAME","wiredux");
//Your Username from Database here:
define("C_DB_USER","root");
//Your Database Password here:
define("C_DB_PASS","********");

################ Database Tables #########################
define("C_ADMIN_TBL","admin");
define("C_WIUSR_TBL","users");
define("C_USRBAN_TBL","banned");
define("C_CODES_TBL","codetable");
define("C_ADM_TBL","adminsetting");
define("C_COUNTRY_TBL","country");
define("C_NAMES_TBL","lastnames");
define("C_CURRENCY_TBL","economy_money");
define("C_TRANSACTION_TBL","economy_transactions");
define("C_INFOWINDOW_TBL","startscreen_infowindow");
define("C_NEWS_TBL","startscreen_news");
define("C_PAGE_TBL","pagemanager");
define("C_SITES_TBL","sitemanagement");
// REGION MANAGER 
define("C_MAP_REGIONS_TBL", "regions");
// OFFLINE IM'S
define("C_OFFLINE_IM_TBL", "offline_msgs");
// STATISTICS
define("C_STATS_REGIONS_TBL", "statistics");

//OPENSIM DEFAULT TABLES (NEEDED FOR LOGINSCREEN & MONEY SYSTEM)
define("C_ASSETS_TBL","opensim.assets");
define("C_USERS_TBL","opensim.UserAccounts");
define("C_AUTH_TBL","opensim.auth");
define("C_AGENTS_TBL","opensim.GridUser");
define("C_REGIONS_TBL","opensim.regions");
define("C_APPEARANCE_TBL", "opensim.Avatars");

//GROUPS DEFAULT TABLES (NEEDED FOR THE GROUP PARTS)
//  The module can be configured to use it's own db, or opensim's.  
//  But the table names need to be those below.
define("G_MEMBERSHIP_TBL", "osgroups.osgroupmembership");
define("G_MEMBERSHIP_ROLES_TBL", "osgroups.osgrouprolemembership");
define("G_NAMES_TBL", "osgroups.osgroup");
define("G_ROLES_TBL", "osgroups.osrole");
?>
