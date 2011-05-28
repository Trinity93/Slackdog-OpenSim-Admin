<?php

// Please comment out the follow line, if you do not use CMS/LMS.
//if (!defined('ENV_READED_INTERFACE')) require_once('../include/env_interface.php');	// for command line


if (defined('CMS_DB_HOST')) 
{
	$DB_HOST = 	   CMS_DB_HOST;
	$DB_NAME = 	   CMS_DB_NAME;
	$DB_USER = 	   CMS_DB_USER;
	$DB_PASSWORD = CMS_DB_PASS;
}
else 
{
	// Please set information of your mysql server, if you do not use CMS/LMS.
	$DB_HOST = 	   'localhost';
	$DB_NAME = 	   'ossearch';
	$DB_USER = 	   'root';
	$DB_PASSWORD = '*****';

	$GLOBALS['xmlrpc_internalencoding'] = 'UTF-8';

	define('SEARCH_ALLPARCELS_TBL',		'allparcels');
	define('SEARCH_CLASSIFIEDS_TBL',	'classifieds');
	define('SEARCH_EVENTS_TBL',			'events');
	define('SEARCH_HOSTSREGISTER_TBL',	'hostsregister');
	define('SEARCH_OBJECTS_TBL',		'objects');
	define('SEARCH_PARCELS_TBL',		'parcels');
	define('SEARCH_PARCELSALES_TBL',	'parcelsales');
	define('SEARCH_POPULARPLACES_TBL',	'popularplaces');
	define('SEARCH_REGIONS_TBL',		'regions');
}

?>
