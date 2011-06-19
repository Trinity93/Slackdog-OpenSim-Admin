<?php
//
// Configration file
//
//
//

if (!defined('ENV_HELPER_URL'))  define('ENV_HELPER_URL',  'http://webfront.infinitegrid.org/helper');
if (!defined('ENV_HELPER_PATH')) define('ENV_HELPER_PATH', '/usr/local/share/slackdog/helper');

//////////////////////////////////////////////////////////////////////////////////i
// Valiables for OpenSim

define('OPENSIM_DB_HOST',			'localhost');
define('OPENSIM_DB_NAME',			'griddy');
define('OPENSIM_DB_USER',			'griddy');
define('OPENSIM_DB_PASS',			'iImW0cjm');

define('CURRENCY_SCRIPT_KEY',		'kuZaMV9Kc0GoX9BTTD8ircMSJCXB63N2');
define('USER_SERVER_URI',			'http://grid.infinitegrid.org:8002');	// not use localhost or 127.0.0.1


//
define('USE_CURRENCY_SERVER',		1);
define('USE_UTC_TIME',				1);

define('SYSURL',					ENV_HELPER_URL);
$GLOBALS['xmlrpc_internalencoding'] = 'UTF-8';

if (USE_UTC_TIME) date_default_timezone_set('UTC');



//////////////////////////////////////////////////////////////////////////////////
// Currency DB
define('CURRENCY_DB_HOST',			OPENSIM_DB_HOST);
define('CURRENCY_DB_NAME',			OPENSIM_DB_NAME);
define('CURRENCY_DB_USER',			OPENSIM_DB_USER);
define('CURRENCY_DB_PASS',			OPENSIM_DB_PASS);
define('CURRENCY_MONEY_TBL',	  	'balances');
define('CURRENCY_TRANSACTION_TBL',	'transactions');


//
if (!defined('ENV_READED_CONFIG')) define('ENV_READED_CONFIG', 'YES');

?>
