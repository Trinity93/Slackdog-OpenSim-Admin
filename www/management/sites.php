<?

/*
 * Copyright (c) 2007, 2008 Contributors, http://opensimulator.org/
 * See CONTRIBUTORS for a full list of copyright holders.
 *
 * See LICENSE for the full licensing terms of this file.
 *
*/

switch($_SESSION[page])
{
	
	case "home":
		include("sites/home.php");
		break;
	
	case "logout":
		include("sites/logout.php");
		break;

	default:
		include("sites/home.php");

}
?>