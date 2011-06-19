<?php
/*********************************************************************************
 * opensim.mysql.php v1.0.0 for OpenSim 	by Fumi.Iseki  2010 5/13
 *
 * 			Copyright (c) 2009,2010,2011   http://www.nsl.tuis.ac.jp/
 *
 *			supported versions of OpenSim are 0.6.7, 0.6.8, 0.6.9, 0.7 and 0.7.1Dev
 *			tools.func.php is needed
 *			mysql.func.php is needed
 *
 *********************************************************************************/


/*********************************************************************************
 * Function List

// for DB
 function  opensim_new_db($timeout=60)
 function  opensim_get_db_version(&$db=null)
 function  opensim_users_update_time(&$db=null)
 function  opensim_get_update_time($table, &$db=null)
 function  opensim_check_db(&$db=null)

// for Avatar
 function  opensim_get_avatars_num(&$db=null)
 function  opensim_get_avatar_name($uuid, &$db=null)
 function  opensim_get_avatar_uuid($name, &$db=null)
 function  opensim_get_avatar_session($uuid, &$db=null)
 function  opensim_get_avatar_info($uuid, &$db=null)
 function  opensim_get_avatars_infos($condition='', &$db=null)
 function  opensim_get_avatars_profiles_from_users($condition='', &$db=null)
 function  opensim_get_avatar_online($uuid, &$db=null)
 function  opensim_get_avatar_flags($uuid, &$db=null)
 function  opensim_set_avatar_flags($uuid, $flags=0, &$db=null)
 function  opensim_create_avatar($UUID, $firstname, $lastname, $passwd, $homeregion, &$db=null)
 function  opensim_delete_avatar($uuid, &$db=null)

// for Region
 function  opensim_get_regions_num(&$db=null)
 function  opensim_get_region_uuid($name, &$db=null)
 function  opensim_get_region_name($id, &$db=null)
 function  opensim_get_regions_names($condition='', &$db=null)
 function  opensim_get_region_info($region, &$db=null)
 function  opensim_get_regions_infos($condition='', &$db=null)
 function  opensim_set_current_region($uuid, $regionid, &$db=null)

// for Home Region
 function  opensim_get_home_region($uuid, &$db=null)
 function  opensim_set_home_region($uuid, $hmregion, $pos_x='128', $pos_y='128', $pos_z='0', &$db=null)

// for Estate Owner
 function  opensim_get_estate_owner($region, &$db=null)
 function  opensim_set_estate_owner($region, $owner, &$db=null)

// for Parcel
 function  opensim_get_parcel_name($parcel, &$db=null)
 function  opensim_get_parcel_info($parcel, &$db=null)

// for Assets
 function  opensim_get_asset_data($uuid, &$db=null)
 function  opensim_display_texture_data($uuid, $prog, $xsize='0', $ysize='0', $cachedir='', $use_tga=false)

// for Inventory
 function  opensim_create_inventory_folders($uuid, &$db=null)

// for Password
 function  opensim_get_password($uuid, $tbl='', &$db=null)
 function  opensim_set_password($uuid, $passwdhash, $passwdsalt='', $tbl='', &$db=null)

// for Update Data Base
//function  opensim_supply_passwordSalt(&$db=null)
 function  opensim_succession_agents_to_griduser($region_id, &$db=null)
 function  opensim_succession_useraccounts_to_griduser($region_id, &$db=null)
 function  opensim_succession_data($region_name, &$db=null)

// for Voice (VoIP)
 function  opensim_get_voice_mode($region, &$db=null)
 function  opensim_set_voice_mode($region, $mode, &$db=null)

// for Currency
 function opensim_set_currency_transaction($sourceId, $destId, $amount, $type, $flags, $description, $userip, &$db=null)
 function opensim_set_currency_balance($uuid, $userip, $amount, &$db=null)
 function opensim_get_currency_balance($uuid, $userip, &$db=null)

// Tools
 function  opensim_get_servers_ip(&$db=null)
 function  opensim_get_server_info($uuid, &$db=null)
 function  opensim_is_access_from_region_server()
 function  opensim_check_secure_session($uuid, $regionid, $secure, &$db=null)
 function  opensim_check_secret_region($uuid, $secret, &$db=null)
 function  opensim_clear_login_table(&$db=null)

**********************************************************************************/




/////////////////////////////////////////////////////////////////////////////////////
//
// Load Function
//

require_once(ENV_HELPER_PATH.'/../include/tools.func.php');
require_once(ENV_HELPER_PATH.'/../include/mysql.func.php');





/////////////////////////////////////////////////////////////////////////////////////
//
// for DB
//

function  opensim_new_db($timeout=60)
{
	$db = new DB(OPENSIM_DB_HOST, OPENSIM_DB_NAME, OPENSIM_DB_USER, OPENSIM_DB_PASS, $timeout);

	return $db;
}




function  opensim_get_db_version(&$db=null)
{
	if (!is_object($db)) $db = & opensim_new_db();

	$ver = null;
	if ($db->exist_table('GridUser'))  $ver = '0.7';
	else {
		if ($db->Errno!=0) return null;
		if ($db->exist_table('users')) $ver = '0.6';
	}

	return $ver;
}




function  opensim_users_update_time(&$db=null)
{
	if (!is_object($db)) $db = & opensim_new_db();

	if ($db->exist_table('GridUser')) 	$table = 'GridUser';
	else if ($db->exist_table('users')) $table = 'users';
	else return 0;

	$utime = $db->get_update_time($table);
	return $utime;
}



function  opensim_get_update_time($table, &$db=null)
{
	if ($table=="") return 0;

	if (!is_object($db)) $db = & opensim_new_db();
	$utime = $db->get_update_time($table);

	return $utime;
}




function  opensim_check_db(&$db=null)
{
	$ret['grid_status']		 = false;
	$ret['now_online']		 = 0;
	$ret['lastmonth_online'] = 0;
	$ret['user_count']		 = 0;
	$ret['region_count']	 = 0;

	if (!is_object($db)) $db = & opensim_new_db(3);

	if ($db->exist_table('regions')) {
		$db->query('SELECT COUNT(*) FROM regions');
		if ($db->Errno==0) {
			list($ret['region_count']) = $db->next_record();
		}
	}

	if ($db->exist_table('GridUser')) {				// 0.7
		$db->query('SELECT COUNT(*) FROM UserAccounts');
		list($ret['user_count']) = $db->next_record();
		//$db->query("SELECT COUNT(*) FROM GridUser WHERE Online='True' and Login>(unix_timestamp(from_unixtime(unix_timestamp(now())-86400)))");
		if ($db->exist_table('Presence')) {			// 0.7
			$db->query("SELECT COUNT(DISTINCT Presence.UserID) FROM GridUser,Presence ".
							"WHERE Online='True' and GridUser.UserID=Presence.UserID and RegionID!='00000000-0000-0000-0000-000000000000'");
		}
		else {										// 0.7 StandAlone mode
			$db->query("SELECT COUNT(*) FROM GridUser WHERE Online='True'");
		}
		list($ret['now_online']) = $db->next_record();
		$db->query('SELECT COUNT(*) FROM GridUser WHERE Login>unix_timestamp(from_unixtime(unix_timestamp(now())-2419200))');
		list($ret['lastmonth_online']) = $db->next_record();
		$ret['grid_status'] = true;
	}
	else if ($db->exist_table('users')) {			// 0.6.x
		$db->query('SELECT COUNT(*) FROM users');
		list($ret['user_count']) = $db->next_record();
		//$db->query("SELECT COUNT(*) FROM agents WHERE agentOnline='1' and logintime>(unix_timestamp(from_unixtime(unix_timestamp(now())-86400)))");
		$db->query("SELECT COUNT(*) FROM agents WHERE agentOnline='1'");
		list($ret['now_online']) = $db->next_record();
		$db->query('SELECT COUNT(*) FROM agents WHERE logintime>unix_timestamp(from_unixtime(unix_timestamp(now())-2419200))');
		list($ret['lastmonth_online']) = $db->next_record();
		$ret['grid_status'] = true;
	}

	return $ret;
}




/////////////////////////////////////////////////////////////////////////////////////
//
// for Avatar
//

function  opensim_get_avatars_num(&$db=null)
{
	$num = 0;

	if (!is_object($db)) $db = & opensim_new_db();

	if ($db->exist_table('UserAccounts')) {
		$db->query('SELECT COUNT(*) FROM UserAccounts');
		list($num) = $db->next_record();
	}
	else if ($db->exist_table('users')) {
		$db->query('SELECT COUNT(*) FROM users');
		list($num) = $db->next_record();
	}
	else {
		$num = -1;
	}

	return $num;
}



function  opensim_get_avatar_name($uuid, &$db=null)
{
	if (!isGUID($uuid)) return null;

	$firstname = null;
	$lastname  = null;
	$fullname  = null;

	if (!is_object($db)) $db = & opensim_new_db();
	
	if ($db->exist_table('UserAccounts')) {
		$db->query("SELECT FirstName,LastName FROM UserAccounts WHERE PrincipalID='$uuid'");
		list($firstname, $lastname) = $db->next_record();
	}
	else if ($db->exist_table('users')) {
		$db->query("SELECT username,lastname FROM users WHERE UUID='$uuid'");
		list($firstname, $lastname) = $db->next_record();
	}


	$fullname = $firstname.' '.$lastname;
	if ($fullname==' ') $fullname = null;

	$name['firstname'] = $firstname;
	$name['lastname']  = $lastname;
	$name['fullname']  = $fullname;

	return $name;
}



function  opensim_get_avatar_uuid($name, &$db=null)
{
	if (!isAlphabetNumericSpecial($name)) return false;

	//$avatar_name = explode(' ', $name);
	$avatar_name = preg_split("/ /", $name, 0, PREG_SPLIT_NO_EMPTY);
	$firstname = $avatar_name[0];
	$lastname  = $avatar_name[1];
	if ($firstname=='' or $lastname=='') return false;

	if (!is_object($db)) $db = & opensim_new_db();
	
	$uuid = null;
	if ($db->exist_table('UserAccounts')) {
		$db->query("SELECT PrincipalID FROM UserAccounts WHERE FirstName='$firstname' and LastName='$lastname'");
		list($uuid) = $db->next_record();
	}
	else if ($db->exist_table('users')) {
		$db->query("SELECT UUID FROM users WHERE username='$firstname' and lastname='$lastname'");
		list($uuid) = $db->next_record();
	}

	return $uuid;
}



function  opensim_get_avatar_session($uuid, &$db=null)
{
	if (!isGUID($uuid)) return null;

	if (!is_object($db)) $db = & opensim_new_db();

	if ($db->exist_table('Presence')) {			// 0.7
		$sql = "SELECT RegionID,SessionID,SecureSessionID FROM Presence WHERE UserID='".$uuid."'";
	}
	else if ($db->exist_table('agents')) {		// 0.6.x
		$sql = "SELECT currentRegion,sessionID,secureSessionID FROM agents WHERE UUID='".$uuid."'";
	}
	else {
		return null;
	}

	$db->query($sql);
	list($RegionID, $SessionID, $SecureSessionID) = $db->next_record();

	$avssn['regionID']  = $RegionID;
	$avssn['sessionID'] = $SessionID;
	$avssn['secureID']  = $SecureSessionID;
	//$avssn['lastlogin'] = $LastLogin;
	
	return $avssn;
}



function  opensim_get_avatar_info($uuid, &$db=null)
{
	if (!isGUID($uuid)) return null;

	if (!is_object($db)) $db = & opensim_new_db();

	//$online = false;
	$profileText  = '';
	$profileImage = '';
	$firstText	= '';
	$firstImage   = '';
	$partner	  = '';

	if ($db->exist_table('GridUser')) {
		$db->query('SELECT PrincipalID,FirstName,LastName,HomeRegionID,Created,Login FROM UserAccounts'.
						" LEFT JOIN GridUser ON PrincipalID=UserID WHERE PrincipalID='$uuid'");
		list($UUID, $firstname, $lastname, $regionUUID, $created, $lastlogin) = $db->next_record();
		$db->query("SELECT regionName,serverIP,serverHttpPort,serverURI FROM regions WHERE uuid='$regionUUID'");
		list($regionName, $serverIP, $serverHttpPort, $serverURI) = $db->next_record();
	}
	else if ($db->exist_table('users')) {
		$db->query("SELECT UUID,username,lastname,homeRegion,created,lastLogin,profileAboutText,profileFirstText,profileImage,profileFirstImage,partner".
						" FROM users WHERE uuid='$uuid'");
		list($UUID, $firstname, $lastname, $rgnHandle, $created, $lastlogin, $profileText, $firstText, $profileImage, $firstImage, $partner) = $db->next_record();
		$db->query("SELECT uuid,regionName,serverIP,serverHttpPort,serverURI FROM regions WHERE regionHandle='$rgnHandle'");
		list($regionUUID, $regionName, $serverIP, $serverHttpPort, $serverURI) = $db->next_record();
	}
	else {
		return null;
	}


	$fullname = $firstname.' '.$lastname;
	if ($fullname==' ') $fullname = null;

	$avinfo['UUID'] 		  = $UUID;
	$avinfo['firstname'] 	  = $firstname;
	$avinfo['lastname'] 	  = $lastname;
	$avinfo['fullname']   	  = $fullname;
	$avinfo['created'] 		  = $created;
	$avinfo['lastlogin'] 	  = $lastlogin;
	$avinfo['regionUUID'] 	  = $regionUUID;
	$avinfo['regionName'] 	  = $regionName;
	$avinfo['serverIP'] 	  = $serverIP;
	$avinfo['serverHttpPort'] = $serverHttpPort;
	$avinfo['serverURI'] 	  = $serverURI;
	$avinfo['profileText']	  = $profileText;
	$avinfo['profileImage']	  = $profileImage;
	$avinfo['firstText']	  = $firstText;
	$avinfo['firstImage'] 	  = $firstImage;
	$avinfo['partner']	  	  = $partner;
	//$avinfo['online']		  = $online;

	return $avinfo;
}



//
// Attention: When call this function, please check $condition for prevention of SQL Injection.
//
// return:
//		$avinfos[$UUID]['UUID']		 ... UUID
//		$avinfos[$UUID]['firstname'] ... first name
//		$avinfos[$UUID]['lastname']  ... lasti name
//		$avinfos[$UUID]['created']   ... created time
//		$avinfos[$UUID]['lastlogin'] ... lastlogin time
//		$avinfos[$UUID]['hmregion']  ... uuid of home region
//
function  opensim_get_avatars_infos($condition='', &$db=null)
{
	if (!is_object($db)) $db = & opensim_new_db();

	$avinfos = array();
	
	if ($db->exist_table('GridUser')) {
		$db->query('SELECT PrincipalID,FirstName,LastName,Created,Login,homeRegionID FROM UserAccounts '.
							'LEFT JOIN GridUser ON PrincipalID=UserID '.$condition);
	}
	else if ($db->exist_table('users')) {
		$db->query('SELECT users.UUID,username,lastname,created,lastLogin,regions.uuid FROM users '.
							'LEFT JOIN regions ON homeRegion=regionHandle '.$condition);
	}
	else {
		return null;
	}

	if ($db->Errno==0) {
		while (list($UUID,$firstname,$lastname,$created,$lastlogin,$hmregion) = $db->next_record()) {
			$avinfos[$UUID]['UUID']		 = $UUID;
			$avinfos[$UUID]['firstname'] = $firstname;
			$avinfos[$UUID]['lastname']  = $lastname;
			$avinfos[$UUID]['created']   = $created;
			$avinfos[$UUID]['lastlogin'] = $lastlogin;
			$avinfos[$UUID]['hmregion']  = $hmregion;
		}
	}			  

	return $avinfos;
}



//
// Attention: When call this function, please check $condition for prevention of SQL Injection.
//
function  opensim_get_avatars_profiles_from_users($condition='', &$db=null)
{
	if (!is_object($db)) $db = & opensim_new_db();

	$profs = null;

	if ($db->exist_table('users')) {
		$db->query('SELECT UUID,profileCanDoMask,profileWantDoMask,profileAboutText,'.
						'profileFirstText,profileImage,profileFirstImage,partner,email FROM users '.$condition);
		if ($db->Errno==0) {
			$profs = array();
			while (list($UUID,$skilmask,$wantmask,$abouttext,$firsttext,$image,$firstimage,$partnar,$email) = $db->next_record()) {
				$profs[$UUID]['UUID'] 		= $UUID;
				$profs[$UUID]['SkillsMask'] = $skilmask;
				$profs[$UUID]['WantToMask'] = $wantmask;
				$profs[$UUID]['AboutText']  = $abouttext;
				$profs[$UUID]['FirstAboutText'] = $firsttext;
				$profs[$UUID]['Image'] 	   	= $image;
				$profs[$UUID]['FirstImage'] = $firstimage;
				$profs[$UUID]['Partnar']	= $partnar;
				$profs[$UUID]['Email'] 	   	= $email;
			}
		}
	}

	return $profs;
}



function  opensim_get_avatar_online($uuid, &$db=null)
{
	if (!isGUID($uuid)) return null;

	if (!is_object($db)) $db = & opensim_new_db();

	$online = false;
	$null_region = '00000000-0000-0000-0000-000000000000';
	$region	  	 = '00000000-0000-0000-0000-000000000000';
	$rgn_name	 = '';

	/*
	if ($db->exist_field('Presence', 'Online')) {	// old 0.7Dev
		$db->query("SELECT Online,RegionID FROM Presence WHERE UserID='$uuid' and RegionID!='$null_region'");
		if ($db->Errno==0) {
			list($onln, $region) = $db->next_record();
			if ($onln=='true') {
				$rgn_name = opensim_get_region_name($region);
				if ($rgn_name!='') $online = true;
			}
		}
	}
	*/

	if ($db->exist_table('Presence')) {		// 0.7
		$db->query("SELECT RegionID FROM Presence,GridUser WHERE Presence.UserID='$uuid'".
					" and RegionID!='$null_region' and Presence.UserID=GridUser.UserID and GridUser.Online='True'");
		if ($db->Errno==0) {
			list($region) = $db->next_record();
			$rgn_name = opensim_get_region_name($region);
			if ($rgn_name!='') $online = true;
		}
	}
	else if ($db->exist_table('GridUser')) {		// 0.7 StandAlone mode
		$db->query("SELECT Online,LastRegionID FROM GridUser WHERE UserID='$uuid'");
		if ($db->Errno==0) {
			list($onln, $region) = $db->next_record();
			if ($onln=='True') {
				$rgn_name = opensim_get_region_name_by_i($region);
				if ($rgn_name!='') $online = true;
			}
		}
	}
	else if ($db->exist_table('agents')) {			// 0.6.x
		$db->query("SELECT agentOnline,currentRegion FROM agents WHERE UUID='$uuid' AND logoutTime='0'");
		if ($db->Errno==0) {
			list($onln, $region) = $db->next_record();
			if ($onln=='1') {
				$rgn_name = opensim_get_region_name($region);
				if ($rgn_name!='') $online = true;
			}
		}
	}

	$ret['online'] 		= $online;
	$ret['region_id'] 	= $region;
	$ret['region_name'] = $rgn_name;
	return $ret;
}				 




function  opensim_get_avatar_flags($uuid, &$db=null)
{
	if (!isGUID($uuid)) return null;

	if (!is_object($db)) $db = & opensim_new_db();

	// for 0.7
	if ($db->exist_table('UserAccounts')) {
		$db->query("SELECT UserFlags FROM UserAccounts WHERE PrincipalID='$uuid'");
		if ($db->Errno==0) {
			list($flags) = $db->next_record();
			return $flags;
		}
	}

	// for 0.6
	else if ($db->exist_table('users')) {
		$db->query("SELECT userFlags FROM users WHERE UUID='$uuid'");
		if ($db->Errno==0) {
			list($flags) = $db->next_record();
			return $flags;
		}
	}

	return 0;
}



function  opensim_set_avatar_flags($uuid, $flags=0, &$db=null)
{
	if (!isGUID($uuid)) return false;

	if (!isNumeric($flags)) return false;

	if (!is_object($db)) $db = & opensim_new_db();

	// for 0.7
	if ($db->exist_table('UserAccounts')) {
		$query_str = "UPDATE UserAccounts SET UserFlags='$flags' WHERE PrincipalID='$uuid'";
		$db->query($query_str);
		if ($db->Errno==0) return true;
	}

	// for 0.6
	else if ($db->exist_table('users')) {
		$query_str = "UPDATE users SET userFlags='$flags' WHERE UUID='$uuid'";
		$db->query($query_str);
		if ($db->Errno==0) return true;
	}

	return false;
}



function  opensim_create_avatar($UUID, $firstname, $lastname, $passwd, $homeregion, &$db=null)
{
	if (!isGUID($UUID)) return false;
	if (!isAlphabetNumericSpecial($firstname))  return false;
	if (!isAlphabetNumericSpecial($lastname))   return false;
	if (!isAlphabetNumericSpecial($passwd))		return false;
	if (!isAlphabetNumericSpecial($homeregion)) return false;

	if (!is_object($db)) $db = & opensim_new_db();

	$nulluuid   = '00000000-0000-0000-0000-000000000000';
	$passwdsalt = make_random_hash();
	$passwdhash = md5(md5($passwd).":".$passwdsalt);

	$db->query("SELECT uuid,regionHandle FROM regions WHERE regionName='$homeregion'");
	$errno = $db->Errno;
	if ($errno==0) {
		list($regionID,$regionHandle) = $db->next_record();

		// for 0.7
		if ($db->exist_table('UserAccounts')) {
			$serviceURLs = 'HomeURI= GatekeeperURI= InventoryServerURI= AssetServerURI=';
			$db->query('INSERT INTO UserAccounts (PrincipalID,ScopeID,FirstName,LastName,Email,ServiceURLs,Created,UserLevel,UserFlags,UserTitle) '.
								  "VALUES ('$UUID','$nulluuid','$firstname','$lastname','','$serviceURLs','".time()."','0','0','')");
			$errno = $db->Errno;
			if ($errno==0) {

				if ($db->exist_table('GridUser')) {
					$db->query('INSERT INTO GridUser (UserID,HomeRegionID,HomePosition,HomeLookAt,'.
													 'LastRegionID,LastPosition,LastLookAt,Online,Login,Logout) '.
									"VALUES ('$UUID','$regionID','<128,128,0>','<0,0,0>',".
											"'$regionID','<128,128,0>','<0,0,0>','false','0','0')");
				}
				$errno = $db->Errno;
			}
			if ($errno==0) {
				$db->query('INSERT INTO auth (UUID,passwordHash,passwordSalt,webLoginKey,accountType) '.
								  "VALUES ('$UUID','$passwdhash','$passwdsalt','$nulluuid','UserAccount')");
				$errno = $db->Errno;
			}
			if ($errno==0) {
				$errno = opensim_create_inventory_folders($UUID, $db);
			}

			if ($errno!=0) {
				$db->query("DELETE FROM UserAccounts WHERE PrincipalID='$UUID'");
				$db->query("DELETE FROM auth		 WHERE UUID='$UUID'");
				$db->query("DELETE FROM inventoryfolders WHERE agentID='$UUID'");
				if ($db->exist_table('GridUser')) $db->query("DELETE FROM GridUser WHERE UserID='$UUID'");
			}
		}

		// for 0.6
		else if ($db->exist_table('users')) {
			$db->query('INSERT INTO users (UUID,username,lastname,passwordHash,passwordSalt,homeRegion,'.
										  'homeLocationX,homeLocationY,homeLocationZ,homeLookAtX,homeLookAtY,homeLookAtZ,'.
										  'created,lastLogin,userInventoryURI,userAssetURI,profileCanDoMask,profileWantDoMask,'.
										  'profileAboutText,profileFirstText,profileImage,profileFirstImage,homeRegionID) '.
						"VALUES ('$UUID','$firstname','$lastname','$passwdhash','$passwdsalt','$regionHandle',".
								"'128','128','128','100','100','100',".
								"'".time()."','0','','','0','0','','','$nulluuid','$nulluuid','$regionID')");

			if ($db->Errno!=0) {
				$db->query("DELETE FROM users WHERE UUID='$UUID'");
				if (!$db->exist_table('UserAccounts')) $errno = 99;
			}
		}
	}

	if ($errno!=0) return false;
	return true;
}



//
// データベースからアバタ情報を削除する．
//
function  opensim_delete_avatar($uuid, &$db=null)
{
	if (!isGUID($uuid)) return false;

	if (!is_object($db)) $db = & opensim_new_db();

	if ($db->exist_table('UserAccounts')) {
		$db->query("DELETE FROM UserAccounts WHERE PrincipalID='$uuid'");
		$db->query("DELETE FROM auth		 WHERE UUID='$uuid'");
		$db->query("DELETE FROM Avatars	  WHERE PrincipalID='$uuid'");
		$db->query("DELETE FROM Friends	  WHERE PrincipalID='$uuid'");
		$db->query("DELETE FROM tokens	   WHERE UUID='$uuid'");
		if ($db->exist_table('Presence')) $db->query("DELETE FROM Presence WHERE UserID='$uuid'");
		if ($db->exist_table('GridUser')) $db->query("DELETE FROM GridUser WHERE UserID='$uuid'");
	}

	if ($db->exist_table('users')) {
		$db->query("DELETE FROM users		WHERE UUID='$uuid'");
		$db->query("DELETE FROM agents	   WHERE UUID='$uuid'");
		$db->query("DELETE FROM avatarappearance  WHERE Owner='$uuid'");
		$db->query("DELETE FROM avatarattachments WHERE UUID='$uuid'");
		$db->query("DELETE FROM userfriends	 WHERE ownerID='$uuid'");
	}

	$db->query("DELETE FROM estate_managers	 WHERE uuid='$uuid'");
	$db->query("DELETE FROM estate_users	 WHERE uuid='$uuid'");
	$db->query("DELETE FROM estateban		 WHERE bannedUUID='$uuid'");
	$db->query("DELETE FROM inventoryfolders WHERE agentID='$uuid'");
	$db->query("DELETE FROM inventoryitems	 WHERE avatarID='$uuid'");
	$db->query("DELETE FROM landaccesslist   WHERE AccessUUID='$uuid'");
	$db->query("DELETE FROM regionban		 WHERE bannedUUID='$uuid'");

	// for DTL Money Server
	if ($db->exist_table('balances')) {
		//$db->query("DELETE FROM transactions WHERE UUID='$uuid'");
		$db->query("DELETE FROM balances WHERE user LIKE '".$uuid."@%'");
		$db->query("DELETE FROM userinfo WHERE user LIKE '".$uuid."@%'");
	}

	return true;
}




/////////////////////////////////////////////////////////////////////////////////////
//
// for Region
//

function  opensim_get_regions_num(&$db=null)
{
	$num = 0;

	if (!is_object($db)) $db = & opensim_new_db();

	$db->query('SELECT COUNT(*) FROM regions');
	list($num) = $db->next_record();

	return $num;
}



function  opensim_get_region_uuid($name, &$db=null)
{
	if (!isAlphabetNumericSpecial($name)) return false;

	if (!is_object($db)) $db = & opensim_new_db();

	$uuid = '';
	if ($name!='') {
		$db->query("SELECT uuid FROM regions WHERE regionName='$name'");
		list($uuid) = $db->next_record();
	}
  
	return $uuid;
}



function  opensim_get_region_name($id, &$db=null)
{
	if (!isGUID($id) and !isNumeric($id)) return null;

	if (!is_object($db)) $db = & opensim_new_db();

	if (isGUID($id)) {
		$db->query("SELECT regionName FROM regions WHERE uuid='$id'");
		list($regionName) = $db->next_record();
	}
	else {
		$db->query("SELECT regionName FROM regions WHERE regionHandle='$id'");
		list($regionName) = $db->next_record();
	}

	return $regionName;
}



//
// Attention: When call this function, please check $condition for prevention of SQL Injection.
//
function  opensim_get_regions_names($condition='', &$db=null)
{
	if (!is_object($db)) $db = & opensim_new_db();

	$regions = array();
	$db->query("SELECT regionName FROM regions ".$condition);
	while ($db->Errno==0 and list($region)=$db->next_record()) {
		$regions[] = $region;
	}

	return $regions;
}

 

function  opensim_get_region_info($region, &$db=null)
{
	if (!isGUID($region)) return null;
	if ($region=='00000000-0000-0000-0000-000000000000') return null;

	if (!is_object($db)) $db = & opensim_new_db();

	$sql = "SELECT regionHandle,regionName,regionSecret,serverIP,serverHttpPort,serverURI,locX,locY FROM regions WHERE uuid='$region'";
	$db->query($sql);

	list($regionHandle, $regionName, $regionSecret, $serverIP, $serverHttpPort, $serverURI, $locX, $locY) = $db->next_record();
	$rginfo = opensim_get_estate_owner($region, $db);

	$rginfo['regionHandle']   = $regionHandle;
	$rginfo['regionName'] 	  = $regionName;
	$rginfo['regionSecret']   = $regionSecret;
	$rginfo['serverIP'] 	  = $serverIP;
	$rginfo['serverHttpPort'] = $serverHttpPort;
	$rginfo['serverURI'] 	  = $serverURI;
	$rginfo['locX'] 		  = $locX;
	$rginfo['locY'] 		  = $locY;

	return $rginfo;
}



//
// Attention: When call this function, please check $condition for prevention of SQL Injection.
//
//	return:
//		$rginfos[$UUID]['UUID']		  	 ... UUID
//		$rginfos[$UUID]['regionName'] 	 ... name of region
//		$rginfos[$UUID]['locX']		  	 ... location X
//		$rginfos[$UUID]['locY']		  	 ... location Y
//		$rginfos[$UUID]['serverIP']	  	 ... IP address of server
//		$rginfos[$UUID]['serverPort'] 	 ... port num of server
//		$rginfos[$UUID]['serverURI']  	 ... URI of server
//		$rginfos[$UUID]['owner_uuid'] 	 ... UUID of region owner
//		$rginfos[$UUID]['estate_id'] 	 ... ID of estate
//		$rginfos[$UUID]['estate_owner']  ... UUID of estate owner
//		$rginfos[$UUID]['est_firstname'] ... first name
//		$rginfos[$UUID]['est_lastname']  ... last name
//		$rginfos[$UUID]['est_fullname']  ... full name
//
function  opensim_get_regions_infos($condition='', &$db=null)
{
	if (!is_object($db)) $db = & opensim_new_db();

	$rginfos = array();

	$items = ' regions.uuid,regionName,locX,locY,serverIP,serverURI,serverHttpPort,owner_uuid,estate_map.EstateID,EstateOwner,';
 	$join1 = ' FROM regions LEFT JOIN estate_map ON RegionID=regions.uuid ';
 	$join2 = ' LEFT JOIN estate_settings ON estate_map.EstateID=estate_settings.EstateID ';

	if ($db->exist_table('UserAccounts')) {
		$uname = 'firstname,lastname ';
		$join3 = ' LEFT JOIN UserAccounts ON EstateOwner=UserAccounts.PrincipalID ';
		$frmwh = ' FROM UserAccounts WHERE UserAccounts.PrincipalID=';
	}
	else if ($db->exist_table('users')) {
		$uname = 'username,lastname ';
		$join3 = ' LEFT JOIN users ON EstateOwner=users.UUID ';
		$frmwh = ' FROM users WHERE users.UUID=';
	}
	else {
		return null;
	}

	$query_str = 'SELECT '.$items.$uname.$join1.$join2.$join3.$condition;

	$db->query($query_str);
	if ($db->Errno==0) {
		while (list($UUID,$regionName,$locX,$locY,$serverIP,$serverURI,$serverPort,
						$owneruuid,$estateid,$estateowner,$firstname,$lastname) = $db->next_record()) {
			$rginfos[$UUID]['UUID']		  	= $UUID;
			$rginfos[$UUID]['regionName'] 	= $regionName;
			$rginfos[$UUID]['locX']		  	= $locX;
			$rginfos[$UUID]['locY']		  	= $locY;
			$rginfos[$UUID]['serverIP']	  	= $serverIP;
			$rginfos[$UUID]['serverPort'] 	= $serverPort;
			$rginfos[$UUID]['serverURI']  	= $serverURI;
			$rginfos[$UUID]['owner_uuid'] 	= $owneruuid;
			$rginfos[$UUID]['estate_id'] 	= $estateid;
			$rginfos[$UUID]['estate_owner'] = $estateowner;
			$rginfos[$UUID]['est_firstname']= $firstname;
			$rginfos[$UUID]['est_lastname'] = $lastname;
			$rginfos[$UUID]['est_fullname'] = null;
			$fullname = $firstname.' '.$lastname;
			if ($fullname!=' ') $rginfos[$UUID]['est_fullname'] = $fullname;
		}
	}

	// Region Owner
	foreach($rginfos as $region) {
		$rginfos[$region['UUID']]['rgn_firstname'] = null;
		$rginfos[$region['UUID']]['rgn_lastname']  = null;
		$rginfos[$region['UUID']]['rgn_fullname']  = null;

		if ($region['owner_uuid']!=null) {
			$db->query('SELECT '.$uname.$frmwh."'".$region['owner_uuid']."'");
			list($firstname,$lastname) = $db->next_record();
			$rginfos[$region['UUID']]['rgn_firstname'] = $firstname;
			$rginfos[$region['UUID']]['rgn_lastname']  = $lastname;
			$fullname = $firstname.' '.$lastname;
			if ($fullname!=' ') $rginfos[$region['UUID']]['rgn_fullname'] = $fullname;
		}
	}

	return $rginfos;
}



function  opensim_set_current_region($uuid, $regionid, &$db=null)
{
	if (!isGUID($uuid) or !isGUID($regionid)) return false;

	if (!is_object($db)) $db = & opensim_new_db();

	if ($db->exist_table("Presence")) {
		$sql = "UPDATE Presence SET RegionID='".$regionid."' WHERE UserID='". $uuid."'";
	}
	else if ($db->exist_table("agents")) {
		$sql = "UPDATE agents SET currentRegion='".$regionid."' WHERE UUID='".$uuid."'";
	}
	else {
		return false;
	}

	$db->query($sql);
	if ($db->Errno!=0) return false;

	$db->next_record();
	return true;
}




/////////////////////////////////////////////////////////////////////////////////////
//
// for Home Region
//

function  opensim_get_home_region($uuid, &$db=null)
{
	if (!isGUID($uuid)) return null;

	if (!is_object($db)) $db = & opensim_new_db();

	$region_name = '';
	if ($db->exist_table('GridUser')) {
		$db->query("SELECT regionName FROM GridUser,regions WHERE HomeRegionID=uuid AND UserID='$uuid'");
		list($region_name) = $db->next_record();
	}
	else if ($db->exist_table('users')) {
		$db->query("SELECT regionName FROM users,regions WHERE homeRegionID=regions.uuid AND users.UUID='$uuid'");
		list($region_name) = $db->next_record();
	}

	return $region_name;
}



function  opensim_set_home_region($uuid, $hmregion, $pos_x='128', $pos_y='128', $pos_z='0', &$db=null)
{
	if (!isGUID($uuid)) return false;
	if (!isAlphabetNumericSpecial($hmregion)) return false;
	if (!isNumeric($pos_x) or !isNumeric($pos_y) or !isNumeric($pos_z)) return false;

	if (!is_object($db)) $db = & opensim_new_db();

	$db->query("SELECT uuid,regionHandle FROM regions WHERE regionName='$hmregion'");
	$errno = $db->Errno;
	if ($errno==0) {
		list($regionID, $regionHandle) = $db->next_record();

		if ($db->exist_table('GridUser')) {
			$homePosition = "<$pos_x,$pos_y,$pos_z>";
			$db->query("UPDATE GridUser SET HomeRegionID='$regionID',HomePosition='$homePosition' WHERE UserID='$uuid'");
			$errno = $db->Errno;
		}

		if ($db->exist_table('users') and $errno==0) {
			$homePosition = "homeLocationX='$pos_x',homeLocationY='$pos_y',homeLocationZ='$pos_z' ";
			$db->query("UPDATE users SET homeRegion='$regionHandle',homeRegionID='$regionID',$homePosition WHERE UUID='$uuid'");
			if ($db->Errno!=0) {
				if (!$db->exist_table('auth')) $errno = 99;
			}
		}
	}

	if ($errno!=0) return false;
	return true;
}




/////////////////////////////////////////////////////////////////////////////////////
//
// for Estate Owner
//

//
// SIMのリージョンIDからオーナーの情報を返す．
// 
function  opensim_get_estate_owner($region, &$db=null)
{
	if (!isGUID($region)) return null;

	$firstname = null;
	$lastname  = null;
	$fullname  = null;
	$owneruuid = null;

	if (!is_object($db)) $db = & opensim_new_db();
	
	if ($db->exist_table('UserAccounts')) {
		$rqdt = 'PrincipalID,FirstName,LastName';
		$tbls = 'UserAccounts,estate_map,estate_settings';
		$cndn = "RegionID='$region' AND estate_map.EstateID=estate_settings.EstateID AND EstateOwner=PrincipalID";
	}
	else if ($db->exist_table('users')) {
		$rqdt = 'UUID,username,lastname';
		$tbls = 'users,estate_map,estate_settings';
		$cndn = "RegionID='$region' AND estate_map.EstateID=estate_settings.EstateID AND EstateOwner=UUID";
	}
	else {
		return null;
	}

	$db->query('SELECT '.$rqdt.' FROM '.$tbls.' WHERE '.$cndn);
	list($owneruuid, $firstname, $lastname) = $db->next_record();

	$fullname = $firstname.' '.$lastname;
	if ($fullname==' ') $fullname = null;

	$name['firstname']  = $firstname;
	$name['lastname']   = $lastname;
	$name['fullname']   = $fullname;
	$name['owner_uuid'] = $owneruuid;

	return $name;
}



function  opensim_set_estate_owner($region, $owner, &$db=null)
{
	if (!isGUID($region)) return false;
	if (!isGUID($owner))  return false;

	if (!is_object($db)) $db = & opensim_new_db();

	$db->query("UPDATE estate_settings,estate_map SET EstateOwner='$owner' WHERE estate_settings.EstateID=estate_map.EstateID AND RegionID='$region'");
	$errno = $db->Errno;

	if ($errno==0) $db->query("UPDATE regions SET owner_uuid='$owner' WHERE uuid='$region'");

	if ($errno!=0) return false;
	return true;
}




/////////////////////////////////////////////////////////////////////////////////////
//
// for Parcel
//

function  opensim_get_parcel_name($parcel, &$db=null)
{
	if (!isGUID($parcel)) return null;

	if (!is_object($db)) $db = & opensim_new_db();

	$name = null;
	$db->query("SELECT name FROM land WHERE UUID='$parcel'");

	if ($db->Errno==0) list($name) = $db->next_record();

	return $name;
}



function  opensim_get_parcel_info($parcel, &$db=null)
{
	if (!isGUID($parcel)) return null;
	if (!is_object($db)) $db = & opensim_new_db();

	$info = array();

	$items = "RegionUUID,Name,Description,OwnerUUID,Category,SalePrice,LandStatus,LandFlags,LandingType,Dwell";
	$query_str = "SELECT ".$items." FROM land WHERE UUID='".$parcel."'";

	$db->query($query_str);
	if ($db->Errno==0) $info = $db->next_record();

	return $info;
}




/////////////////////////////////////////////////////////////////////////////////////
//
// for Assets
//

function  opensim_get_asset_data($uuid, &$db=null)
{
	$asset = array();

	if (!isGUID($uuid)) return $asset;
	if (!is_object($db)) $db = & opensim_new_db();

	$db->query("SELECT name,description,assetType,data,asset_flags,CreatorID FROM assets WHERE id='$uuid'");
	list($name, $desc, $type, $data, $flag, $creator) = $db->next_record();

	$asset['UUID'] 	  = $uuid;
	$asset['name'] 	  = $name;
	$asset['desc'] 	  = $desc;
	$asset['type'] 	  = $type;
	$asset['data'] 	  = $data;
	$asset['flag'] 	  = $flag;
	$asset['creator'] = $creator;

	return $asset;
}



function  opensim_display_texture_data($uuid, $prog, $xsize='0', $ysize='0', $cachedir='', $use_tga=false)
{
	if (!isGuid($uuid)) return false;
	if ($prog==null or $prog=='') return false;

	if ($cachedir=='') $cachedir = '/tmp';
	$cachefile = $cachedir.'/'.$uuid;


	// PHP module
	$imagick = null;
	if ($prog=='imagick') {
		if (class_exists('Imagick')) {
			$imagick = new Imagick();
		}
		else {
			echo '<h4>PHP module Imagick is not installed!!</h4>';
			return false;
		}
	}

	// Linux Command
	else {
		if (file_exists('/usr/local/bin/'.$prog)) 	   $path = '/usr/local/bin/';
		else if (file_exists('/usr/bin/'.$prog)) 	   $path = '/usr/bin/';
		else if (file_exists('/usr/X11R6/bin/'.$prog)) $path = '/usr/X11R6/bin/';
		else if (file_exists('/bin/'. $prog)) 		   $path = '/bin/';
		else {
			echo '<h4>program '.$prog.' is not found!!</h4>';
			return false;
		}

		if ($prog=='jasper') {		// JasPer does not support Targa image format.
			$use_tga = false;
		}
	}

	
	// Check j2k to TGA command
	if ($use_tga) {
		$tga_com = get_j2k_to_tga_command();
		if ($tga_com=='') $use_tga = false;
	}


	// get and save image
	if (! ((!$use_tga and file_exists($cachefile)) or ($use_tga and file_exists($cachefile.'.tga')))) {
		$imgdata = '';

		// from MySQL Server
		$asset = opensim_get_asset_data($uuid);
		if ($asset) {
			if ($asset['type']==0) {
				$imgdata = $asset['data'];
			}
		}
		else {
			echo '<h4>asset uuid is not found!! ('.htmlspecialchars($uuid).')</h4>';
			return false;
		}

/*		// from Asset Server
		//$asset_url = $ASSET_SERVER_URL.'/assets/'.$uuid;
		$asset_url = 'http://202.26.159.200:8003/assets/'.$uuid;
		$fp = fopen($asset_url, "rb");
		stream_set_timeout($fp, 5);
		$content = stream_get_contents($fp);
		fclose($fp);
		if (!$content) {
			echo '<h4>asset uuid is not found!! ('.htmlspecialchars($uuid).')</h4>';
			return false;
		}

		$xml = new SimpleXMLElement($content);
		$imgdata = base64_decode($xml->Data);
*/

		// Save Image Data
		$fp = fopen($cachefile, 'wb');
		fwrite($fp, $imgdata);
		fclose($fp);

		if ($use_tga) {
			if (!j2k_to_tga($cachefile)) $use_tga = false;
		}
	}

	if ($use_tga && file_exists($cachefile.'.tga')) $cachefile .= '.tga';


	//
	// program for image processing of jpeg2000
	//

	// Imagick of PHP
	if ($prog=='imagick' and $imagick!=null) {
		$ret = $imagick->readImage($cachefile);
		if (!$ret) {
			echo '<h4>Imagick could not read '.$cachefile.'!!</h4>';
			return false;
		}
		$imagick->setImageFormat('JPEG'); 
		if ($xsize>0 and $ysize>0) {
			$imagick->scaleImage($xsize, $ysize);
		}

		header("Content-Type: image/jpeg"); 
		echo $imagick;
	}

	// ImageMagic (convert)
	else if ($prog=='convert') {
		$imgsize = '';
		if ($xsize>0 and $ysize>0) $imgsize = ' -resize '.$xsize.'x'.$ysize.'!';
		$prog = $path.'convert '. $cachefile.$imgsize.' jpeg:-';

		header("Content-Type: image/jpeg"); 
		passthru($prog);
	}

	// Jasper
	else if ($prog=='jasper') {
		$conv = '';
		if ($xsize>0 and $ysize>0) {
			$conv = get_image_size_convert_command($xsize, $ysize);
			if ($conv!='') $conv = ' | '.$conv;
		}
		$prog = $path.'jasper -f '.$cachefile.' -T jpg'.$conv;

		header("Content-Type: image/jpeg"); 
		passthru($prog);
	}

	return true;
}
 



/////////////////////////////////////////////////////////////////////////////////////
//
// for Inventory
//

function  opensim_create_inventory_folders($uuid, &$db=null)
{
	if (!isGUID($uuid)) return 999;

	if (!is_object($db)) $db = & opensim_new_db();
	
	$my_inventory = make_random_guid();
	$db->query('INSERT INTO inventoryfolders (folderName,type,version,folderID,agentID,parentFolderID) '.
					  "VALUES ('My Inventory','8','1','$my_inventory','$uuid','00000000-0000-0000-0000-000000000000')");
	$errno = $db->Errno;

	if ($errno==0) {
		$db->query('INSERT INTO inventoryfolders (folderName,type,version,folderID,agentID,parentFolderID) '.
						  "VALUES ('Textures','0','1','".make_random_guid()."','$uuid','$my_inventory')");
		$errno = $db->Errno;
	}
	if ($errno==0) {
		$db->query('INSERT INTO inventoryfolders (folderName,type,version,folderID,agentID,parentFolderID) '.
						  "VALUES ('Sounds','1','1','".make_random_guid()."','$uuid','$my_inventory')");
		$errno = $db->Errno;
	}
	if ($errno==0) {
		$db->query('INSERT INTO inventoryfolders (folderName,type,version,folderID,agentID,parentFolderID) '.
						  "VALUES ('Calling Cards','2','1','".make_random_guid()."','$uuid','$my_inventory')");
		$errno = $db->Errno;
	}
	if ($errno==0) {
		$db->query('INSERT INTO inventoryfolders (folderName,type,version,folderID,agentID,parentFolderID) '.
						  "VALUES ('Landmarks','3','1','".make_random_guid()."','$uuid','$my_inventory')");
		$errno = $db->Errno;
	}
	if ($errno==0) {
		$db->query('INSERT INTO inventoryfolders (folderName,type,version,folderID,agentID,parentFolderID) '.
						  "VALUES ('Clothing','5','1','".make_random_guid()."','$uuid','$my_inventory')");
		$errno = $db->Errno;
	}
	if ($errno==0) {
		$db->query('INSERT INTO inventoryfolders (folderName,type,version,folderID,agentID,parentFolderID) '.
						  "VALUES ('Objects','6','1','".make_random_guid()."','$uuid','$my_inventory')");
		$errno = $db->Errno;
	}
	if ($errno==0) {
		$db->query('INSERT INTO inventoryfolders (folderName,type,version,folderID,agentID,parentFolderID) '.
						  "VALUES ('Notecards','7','1','".make_random_guid()."','$uuid','$my_inventory')");
		$errno = $db->Errno;
	}
	if ($errno==0) {
		$db->query('INSERT INTO inventoryfolders (folderName,type,version,folderID,agentID,parentFolderID) '.
						  "VALUES ('Scripts','10','1','".make_random_guid()."','$uuid','$my_inventory')");
		$errno = $db->Errno;
	}
	if ($errno==0) {
		$db->query('INSERT INTO inventoryfolders (folderName,type,version,folderID,agentID,parentFolderID) '.
						  "VALUES ('Body Parts','13','1','".make_random_guid()."','$uuid','$my_inventory')");
		$errno = $db->Errno;
	}
	if ($errno==0) {
		$db->query('INSERT INTO inventoryfolders (folderName,type,version,folderID,agentID,parentFolderID) '.
						  "VALUES ('Trash','14','1','".make_random_guid()."','$uuid','$my_inventory')");
		$errno = $db->Errno;
	}
	if ($errno==0) {
		$db->query('INSERT INTO inventoryfolders (folderName,type,version,folderID,agentID,parentFolderID) '.
						  "VALUES ('Photo Album','15','1','".make_random_guid()."','$uuid','$my_inventory')");
		$errno = $db->Errno;
	}
	if ($errno==0) {
		$db->query('INSERT INTO inventoryfolders (folderName,type,version,folderID,agentID,parentFolderID) '.
						  "VALUES ('Lost And Found','16','1','".make_random_guid()."','$uuid','$my_inventory')");
		$errno = $db->Errno;
	}
	if ($errno==0) {
		$db->query('INSERT INTO inventoryfolders (folderName,type,version,folderID,agentID,parentFolderID) '.
						  "VALUES ('Animations','20','1','".make_random_guid()."','$uuid','$my_inventory')");
		$errno = $db->Errno;
	}
	if ($errno==0) {
		$db->query('INSERT INTO inventoryfolders (folderName,type,version,folderID,agentID,parentFolderID) '.
						  "VALUES ('Gestures','21','1','".make_random_guid()."','$uuid','$my_inventory')");
		$errno = $db->Errno;
	}

	return $errno;
}


 

/////////////////////////////////////////////////////////////////////////////////////
//
// for Password
//

function  opensim_get_password($uuid, $tbl='', &$db=null)
{
	if (!isGUID($uuid)) return null;
	if (!isAlphabetNumeric($tbl, true)) return null;

	$passwdhash = null;
	$passwdsalt = null;

	if (!is_object($db)) $db = & opensim_new_db();

	if ($tbl=='' or $tbl=='auth') {
		if ($db->exist_table('auth')) {
			$db->query("SELECT passwordHash,passwordSalt FROM auth WHERE UUID='$uuid'");
			list($passwdhash, $passwdsalt) = $db->next_record();
		}
	}

	if ($passwdhash==null and $passwdsalt==null) {
		if ($tbl=='' or $tbl=='users') {
			if ($db->exist_table('users')) {
				$db->query("SELECT passwordHash,passwordSalt FROM users WHERE UUID='$uuid'");
				list($passwdhash, $passwdsalt) = $db->next_record();
			}
		}
	}

	$ret['passwordHash'] = $passwdhash;
	$ret['passwordSalt'] = $passwdsalt;
	return $ret;
}



function  opensim_set_password($uuid, $passwdhash, $passwdsalt='', $tbl='', &$db=null)
{
	if (!isGUID($uuid)) return false;
	if (!isAlphabetNumeric($passwdhash)) return false;
	if (!isAlphabetNumeric($passwdsalt, true)) return false;
	if (!isAlphabetNumeric($tbl, true)) return false;

	$setpasswd = "passwordHash='$passwdhash'";
	if ($passwdsalt!='') {
		$setpasswd .= ",passwordSalt='$passwdsalt'";
	}

	if (!is_object($db)) $db = & opensim_new_db();

	$errno = 0;
	if ($tbl=='' or $tbl=='auth') {
		if ($db->exist_table('auth')) {
			$db->query("UPDATE auth SET ".$setpasswd." WHERE UUID='$uuid'");
			$errno = $db->Errno;
		}
	}

	if (($tbl=='' or $tbl=='users') and $errno==0) {
		if ($db->exist_table('users')) {
			$db->query("UPDATE users SET ".$setpasswd." WHERE UUID='$uuid'");
			if ($db->Errno!=0) {
				if (!$db->exist_table('auth')) $errno = 99;
			}
		}
	}

	if ($errno!=0) return false;
	return true;
}




/////////////////////////////////////////////////////////////////////////////////////
//
// for Update Data Base
//

/*
function  opensim_supply_passwordSalt(&$db=null)
{
	if (!is_object($db)) $db = & opensim_new_db();

	$dp2 = & opensim_new_db();
	if ($db->exist_table('auth')) {
		$db->query('SELECT UUID,passwordHash,passwordSalt FROM auth');
		while ($data = $db->next_record()) {
			if ($data['passwordSalt']=='') {
				$passwdSalt = make_random_hash();
				$passwdHash = md5($data['passwordHash'].':'.$passwdSalt);
				opensim_set_password($data['UUID'], $passwdHash, $passwdSalt, 'auth', $db2);
			}
		}
	}

	if ($db->exist_table('users')) {
		$db->query('SELECT UUID,passwordHash,passwordSalt FROM users');
		while ($data = $db->next_record()) {
			if ($data['passwordSalt']=='') {
				$passwdSalt = make_random_hash();
				$passwdHash = md5($data['passwordHash'].':'.$passwdSalt);
				opensim_set_password($data['UUID'], $passwdHash, $passwdSalt, 'users', $db2);
			}
		}
	}

	return;
}
*/




function  opensim_succession_agents_to_griduser($region_id, &$db=null)
{
	if (!isGUID($region_id)) return false;

	if (!is_object($db)) $db = & opensim_new_db();

	$db->query('SELECT agents.UUID,currentRegion,loginTime,logoutTime,homeRegion,'.
								'homeLocationX,homeLocationY,homeLocationZ FROM agents,users WHERE agents.UUID=users.UUID');
	$errno = $db->Errno;
	
	if ($errno==0) {
		$db2 = & opensim_new_db();
		while(list($UUID,$currentRegion,$login,$logout,$homeHandle,$locX,$locY,$locZ) = $db->next_record()) {
			$db2->query("SELECT uuid FROM regions WHERE regionHandle='$homeHandle'");
			list($homeRegion) = $db2->next_record();
			if ($homeRegion==null) {
				$homeRegion = $region_id;
				$locX = '128';
				$locY = '128';
				$locZ = '20';
			}

			$db2->query("SELECT UserID,HomeRegionID FROM GridUser WHERE UserID='$UUID'");
			list($userid, $hmregion) = $db2->next_record();

			if ($userid==null) {
				if ($login!=0 and $logout<$login) $logout = $login;

				$db2->query('INSERT INTO GridUser (UserID,HomeRegionID,HomePosition,HomeLookAt,LastRegionID,LastPosition,LastLookAt,Online,Login,Logout) '.
							"VALUES ('$UUID','$homeRegion','<$locX,$locY,$locZ>','<0,0,0>','$currentRegion','<128,128,0>','<0,0,0>','False','$login','$logout')");
				$errno =$db2->Errno;

				if ($errno!=0) {
					$db->query("DELETE FROM GridUser WHERE UserID='$UUID'");
				}
			}
			else if ($hmregion=='00000000-0000-0000-0000-000000000000' or $hmregion==null) {
				$db2->query("UPDATE GridUser SET HomeRegionID='$homeRegion',HomePosition='<$locX,$locY,$locZ>' WHERE UserID='$UUID'");
			}
		}
	}

	if ($errno!=0) return false;
	return true;
}



function  opensim_succession_useraccounts_to_griduser($region_id, &$db=null)
{
	if (!isGUID($region_id)) return false;

	if (!is_object($db)) $db = & opensim_new_db();

	$db->query('SELECT PrincipalID FROM UserAccounts');
	$errno = $db->Errno;
	$homeRegion = $region_id;
	
	if ($errno==0) {
		$db2 = & opensim_new_db();
		while(list($UUID) = $db->next_record()) {
			$db2->query("SELECT UserID,HomeRegionID FROM GridUser WHERE UserID='$UUID'");
			list($userid, $hmregion) = $db2->next_record();

			if ($userid==null) {
				$db2->query('INSERT INTO GridUser (UserID,HomeRegionID,HomePosition,HomeLookAt,LastRegionID,LastPosition,LastLookAt,Online,Login,Logout) '.
							"VALUES ('$UUID','$homeRegion','<128,128,0>','<0,0,0>','$homeRegion','<128,128,0>','<0,0,0>','False','0','0')");
				$errno =$db2->Errno;

				if ($errno!=0) {
					$db->query("DELETE FROM GridUser WHERE UserID='$UUID'");
				}
			}
			else if ($hmregion=='00000000-0000-0000-0000-000000000000' or $hmregion==null) {
				$db2->query("UPDATE GridUser SET HomeRegionID='$homeRegion',HomePosition='<128,128,0>' WHERE UserID='$UUID'");
			}
		}
	}

	if ($errno!=0) return false;
	return true;
}




//
// agents -> GridUser
// UserAccounts -> GridUser
//
//		$region_name is default home region name.
//
function  opensim_succession_data($region_name, &$db=null)
{
	if (!isAlphabetNumericSpecial($region_name, true)) return false;

	if (!is_object($db)) $db = & opensim_new_db();

	$exist_agents   = $db->exist_table('agents');
	$exist_griduser = $db->exist_table('GridUser');
	$exist_usracnt  = $db->exist_table('UserAccounts');

	$region_id = '';
	if ($region_name!='') {
		$region_id = opensim_get_region_uuid($region_name);
	}
	if ($region_id=='') $region_id = '00000000-0000-0000-0000-000000000000';

	if ($exist_agents and $exist_griduser) {
		opensim_succession_agents_to_griduser($region_id);
	}

	if ($exist_usracnt and $exist_griduser) {
		opensim_succession_useraccounts_to_griduser($region_id);
	}

	return;
}



//
//
function  opensim_recreate_presence(&$db=null)
{
	if (!is_object($db)) $db = & opensim_new_db();

	if ($db->exist_field('Presence', 'HomeRegionID')) {
		$db->query('DROP TABLE Presence');
		$db->query("DELETE FROM migrations WHERE name='Presence'");
	}
	// Creation is automatic by ROBUST server. 

	return;
}





/////////////////////////////////////////////////////////////////////////////////////
//
// for Voice (VoIP)
//

function  opensim_get_voice_mode($region, &$db=null)
{
	if (!isGUID($region)) return -1;
	if (!is_object($db)) $db = & opensim_new_db();

	$voiceflag = 0x60000000;

	$db->query("SELECT LandFlags FROM land WHERE RegionUUID='$region'");
	while (list($flag) = $db->next_record()) {
		$voiceflag &= $flag;
	}

	if	  ($voiceflag==0x20000000) return 1;
	else if ($voiceflag==0x40000000) return 2;
	return 0;
}	



function  opensim_set_voice_mode($region, $mode, &$db=null)
{
	if (!isGUID($region)) false;
	if (!preg_match('/^[0-2]$/', $mode)) false;

	if (!is_object($db)) $db = & opensim_new_db();

	$colum = 0;
	$vflags = array();

	$db->query("SELECT UUID,LandFlags FROM land WHERE RegionUUID='$region'");
	while (list($UUID, $flag) = $db->next_record()) {
		$flag &= 0x9fffffff;
		if ($mode==1)	  $flag |= 0x20000000;
		else if ($mode==2) $flag |= 0x40000000;

		$vflags[$colum]['UUID'] = $UUID;
		$vflags[$colum]['flag'] = $flag;
		$colum++;
	}

	foreach($vflags as $vflag) {
		$UUID = $vflag['UUID'];
		$flag = $vflag['flag'];
		$db->query("UPDATE land SET LandFlags='$flag' WHERE UUID='$UUID'");
	}

	return true;
}	




/////////////////////////////////////////////////////////////////////////////////////
//
// for Currency

function opensim_set_currency_transaction($sourceId, $destId, $amount, $type, $flags, $description, $userip, &$db=null)
{
	if (!isNumeric($amount)) return;
	if (!isGUID($sourceId))  $sourceId = '00000000-0000-0000-0000-000000000000';
	if (!isGUID($destId)) 	 $destId   = '00000000-0000-0000-0000-000000000000';

	if (!is_object($db)) $db = & opensim_new_db();

	$handle   = 0;
	$secure   = '00000000-0000-0000-0000-000000000000';
	$client	  = $sourceId;
	$UUID     = make_random_guid();
	$sourceID = $sourceId.'@'.$userip;
	$destID   = $destId.'@'.$userip;
	if ($client=='00000000-0000-0000-0000-000000000000') $client = $destId;

	$avt = opensim_get_avatar_session($client);
	if ($avt!=null) {
		$region = $avt['regionID'];
		$secure = $avt['secureID'];

		$rgn = opensim_get_region_info($region);
		if ($rgn!=null) $handle = $rgn["regionHandle"];
	}

	$sql = "INSERT INTO ".CURRENCY_TRANSACTION_TBL." (UUID,sender,receiver,amount,objectUUID,".
													"regionHandle,type,time,secure,status,description) ".
			"VALUES ('".
				$UUID."','".
				$sourceID."','".
				$destID."','".
				$amount."','".               
				"00000000-0000-0000-0000-000000000000','".
				$handle."','".
				$db->escape($type)."','".
				time()."','".
				$secure."','".
				$db->escape($flags)."','".  
				$db->escape($description)."')";
	$db->query($sql);
}



function opensim_set_currency_balance($agentid, $userip, $amount, &$db=null)
{
	if (!isGUID($agentid) or !isNumeric($amount)) return;

	if (!is_object($db)) $db = & opensim_new_db();

	$userid = $db->escape($agentid.'@'.$userip);

	$db->lock_table(CURRENCY_MONEY_TBL);

	$db->query("SELECT balance FROM ".CURRENCY_MONEY_TBL." WHERE user='".$userid."'");
	if ($db->Errno==0) {
		list($cash) = $db->next_record();
		$balance = (integer)$cash + (integer)$amount;

		$db->query("UPDATE ".CURRENCY_MONEY_TBL." SET balance='".$balance."' WHERE user='".$userid."'");
		if ($db->Errno==0) $db->next_record();
	}

	$db->unlock_table();
}



function opensim_get_currency_balance($agentid, $userip, &$db=null)
{
	if (!isGUID($agentid)) return;

	if (!is_object($db)) $db = & opensim_new_db();

	$userid = $db->escape($agentid.'@'.$userip);
	$db->query("SELECT balance FROM ".CURRENCY_MONEY_TBL." WHERE user='".$userid."'");

	$cash = 0;
	if ($db->Errno==0) list($cash) = $db->next_record();

	return (integer)$cash;
}




/////////////////////////////////////////////////////////////////////////////////////
//
// Tools
//

function  opensim_get_servers_ip(&$db=null)
{
	if (!is_object($db)) $db = & opensim_new_db();

	$ips = array();

	$db->query("SELECT DISTINCT serverIP FROM regions");
	if ($db->Errno==0) {
		$count = 0;
		while (list($serverIP) = $db->next_record()) {
			$ips[$count] = $serverIP;
			$count++;
		}		
	}

	return $ips;
}



function  opensim_get_server_info($userid, &$db=null)
{
	$ret = array();

	if (!isGUID($userid)) return $ret;

	if (!is_object($db)) $db = & opensim_new_db();

	if ($db->exist_table("GridUser")) {
		$sql = "SELECT serverIP,serverHttpPort,serverURI,regionSecret FROM GridUser".
					" INNER JOIN regions ON regions.uuid=GridUser.LastRegionID WHERE GridUser.UserID='".$userid."'";
	}
	else {
		$sql = "SELECT serverIP,serverHttpPort,serverURI,regionSecret FROM agents".
					" INNRT JOIN regions ON regions.uuid=agents.currentRegion WHERE agents.UUID='".$userid."'";
	}
	$db->query($sql);

	if ($db->Errno==0) {
		list($serverip, $httpport, $serveruri, $secret) = $db->next_record();
		$ret["serverIP"] 	   = $serverip;
		$ret["serverHttpPort"] = $httpport;
		$ret["serverURI"] 	   = $serveruri;
		$ret["regionSecret"]   = $secret;
	}
	
	return $ret;
}



function  opensim_is_access_from_region_server()
{
	$ip_match = false;
	$remote_addr = $_SERVER['REMOTE_ADDR'];
	$server_addr = $_SERVER['SERVER_ADDR'];

	if ($remote_addr==$server_addr or $remote_addr=="127.0.0.1") return true;

	$ips = opensim_get_servers_ip();

	foreach($ips as $ip) {
		if ($ip == $remote_addr) {
			$ip_match = true;
			break;
		}
	}

	return $ip_match;
}



//
function  opensim_check_secure_session($uuid, $regionid, $secure, &$db=null)
{
	if (!isGUID($uuid) or !isGUID($secure)) return false;

	if (!is_object($db)) $db = & opensim_new_db();

	if ($db->exist_table("Presence")) {
		$sql = "SELECT UserID FROM Presence WHERE UserID='".$uuid."' AND SecureSessionID='".$secure."'";
		if (isGUID($regionid)) $sql = $sql." AND RegionID='".$regionid."'";
	}
	else if ($db->exist_table("agents")) {
		$sql = "SELECT UUID FROM agents WHERE UUID='".$uuid."' AND secureSessionID='".$secure."' AND agentOnline='1'";
		if (isGUID($regionid)) $sql = $sql." AND  currentRegion='".$regionid."'";
	}
	else { 
		return false;
	}

	$db->query($sql);
	if ($db->Errno!=0) return false;

	list($UUID) = $db->next_record();
	if ($UUID!=$uuid) return false;
	return true;
}



//
function  opensim_check_secret_region($uuid, $secret, &$db=null)
{
	if (!isGUID($uuid)) return false;

	if (!is_object($db)) $db = & opensim_new_db();

	$sql = "SELECT UUID FROM regions WHERE UUID='".$uuid."' AND regionSecret='".$db->escape($secret)."'";
	$db->query($sql);
	if ($db->Errno!=0) return false;

	list($UUID) = $db->next_record();
	if ($UUID!=$uuid) return false;
	return true;
}



function  opensim_clear_login_table(&$db=null)
{
	if (!is_object($db)) $db = & opensim_new_db();

	if ($db->exist_table('Presence')) {
		$db->query("DELETE FROM Presence");
	}
	else if ($db->exist_table('agents')) {
		//$db->query("DELETE FROM agents");
		return true;
	}
	else {
		return false;
	}

	return true;
}


?>
