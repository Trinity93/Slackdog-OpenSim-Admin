<?php
/*******************************************************************************
**	file:	login.php
********************************************************************************
**	author:	Luis Bernardo
**	date:	2003/12/10
********************************************************************************
**	$Revision: 1.7 $ on $Date: 2004/02/12 04:35:04 $ by $Author: lmpmbernardo $
*******************************************************************************/

// Note:  This file is required by all pages that require a user to be logged in.

// set the start time so we can calculate how long it takes to load the page.
// not being used now. may use in the future again...
//$mtime1 = explode(" ", microtime());
//$starttime = $mtime1[0] + $mtime1[1];

require_once "../../../includes/config.php";
require_once "../../../includes/sup_common.php";
require_once "../../../includes/lang/$language/language.php";
if($session_save_db == 'on') {
	require_once "code/session_mysql.php";
}

session_start();

$login = $_POST['login'];
$user = $_POST['user'];
$password = $_POST['password'];
$cookie_name = $_SESSION['cookie_name'];
$enc_pwd = $_SESSION['enc_pwd'];
$usertype = $_SESSION['usertype'];
$HTTP_REFERER = $_SERVER['HTTP_REFERER'];

//if submit has been hit, set the cookie and reload the page immediately so the cookie takes effect.
if(isset($login)) {
	//otherwise, the user is not logging in to the admin site.
	//check the user name and password against the database.
	$pwd = md5($password);
	if(checkCustomerUser($user, $pwd) || checkSupporterUser($user, $pwd) || checkAdminUser($user, $pwd)) {
		$cookie_name = $user;
		$_SESSION['cookie_name'] = $cookie_name;
		$enc_pwd = $pwd;
		$_SESSION['enc_pwd'] = $enc_pwd;
		if(checkCustomerUser($user, $pwd)) {
			$usertype = "customer";
		} else if(checkSupporterUser($user, $pwd)) {
			$usertype = "supporter";
		} else {
			$usertype = "admin";
		}
		$_SESSION['usertype'] = $usertype;
		$referer = "$HTTP_REFERER";
		header("Location: $referer"); // reload page
	} else {
		echo '
		<html><head>';
		require_once "../../../includes/style.php";
		echo '
		<title>Login to MyHelpdesk</title>
		</head><body>
		<br>';
		$error = "Login Failed";
		$error_message = "Your username and/or password was incorrect.";
		accessError($error, $error_message);
		echo '
		</body>
		</html>';
		exit;
	}
}

//check the cookie first.
if(!isCookieSet()) {
	echo '
	<html><head>';
	require_once "../../../includes/style.php";
	echo '
	<title>Login to MyHelpdesk</title>
	</head>
	<body class=body>
	<br>
	<form method=post>
		<table class=border cellSpacing=0 cellPadding=0 width="80%" align=center border=0>
			<tr>
				<td>
					<table cellSpacing=1 cellPadding=5 width="100%" border=0>
						<tr>
							<td class=info align=center><b>'.$helpdesk_name.'</b>
							</td>
						</tr>
						<tr>
							<td class=back>
								<table border=0 width=100%>
									<tr>
										<td class=back vAlign=top><br>
											<table class=border cellSpacing=0 cellPadding=0 width=25% align=center border=0>
												<tr>
													<td>
														<table cellSpacing=1 cellPadding=5 width=100% border=0>
															<tr>
																<td class=info align=center><b>'.$lang['login'].'</b></td>
															</tr>
															<tr>
																<td class=back2>
																	<table width="100%" border=0 cellspacing=0 cellpadding=3>
																		<tr>
																			<td class=back2 align=right width=50%><b>'.$lang['user_name'].':</b></td>
																			<td width=50%><input type=text name=user size=12></td>
																		</tr>
																		<tr>
																			<td class=back2 align=right width=50%><b>'.$lang['password'].':</b></td>
																			<td width=50%><input type=password name=password size=12></td>
																		</tr>
																		<tr>
																			<td class=back2 colspan=100% align=center>
																				<input type=submit name=login value='.$lang['submit'].'>
																			</td>
																		</tr>
																	</table>
																</td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
											<br>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</form>
	<center>
		<br><font size=1>'. $helpdesk_name .'</font>
	</center>';
	if($sourceforge == 'on') {
		echo '
		<center>
			<br><br><font size=1>Kindly hosted by SourceForge</font><br><br>
			<a href="http://sourceforge.net">
			<img src="http://sourceforge.net/sflogo.php?group_id=51041&type=5" width="210" height="62" border="0" alt="SourceForge Logo"></a>
		</center>';
	}
	echo '
	</body>
	</html>';
	exit;
}
//this returns back to the page that called it.

/***********************************************************************************************************
****************************************** DEFINE FUNCTIONS ************************************************
************************************************************************************************************/

/***********************************************************************************************************
**	function isCookieSet():
************************************************************************************************************/
function isCookieSet() {
	global $cookie_name, $enc_pwd;
	if((checkCustomerUser($cookie_name, $enc_pwd) || checkSupporterUser($cookie_name, $enc_pwd) || checkAdminUser($cookie_name, $enc_pwd)) && $cookie_name != '') {
		return true;
	} else {
		return false;
	}
}

/***********************************************************************************************************
**	function checkCustomerUser():
************************************************************************************************************/
function checkCustomerUser($userid, $pwd) {
	global $mysql_people_table;
	//return true if the userid is found in the database and the password matches.
	$sql = "select * from $mysql_people_table where user_name='$userid' and password='$pwd' and user='1'";
	$result = execsql($sql);
	if(mysql_fetch_row($result)) {
		return true;
	} else {
		return false;
	}
}

/***********************************************************************************************************
**	function checkSupporterUser():
************************************************************************************************************/
function checkSupporterUser($userid, $pwd) {
	global $mysql_people_table;
	//return true if the name is found in the database and the password matches.
	$sql = "select * from $mysql_people_table where user_name='$userid' and password='$pwd' and supporter='1' and admin='0'";
	$result = execsql($sql);
	if(mysql_fetch_row($result)) {
		return true;
	} else {
		return false;
	}
}

/***********************************************************************************************************
**	function checkAdminUser():
************************************************************************************************************/
function checkAdminUser($userid, $pwd) {
	global $mysql_people_table;
	//return true if the name is found in the database and the password matches.
	$sql = "select * from $mysql_people_table where user_name='$userid' and password='$pwd' and admin='1'";
	$result = execsql($sql);
	if(mysql_fetch_row($result)) {
		return true;
	} else {
		return false;
	}
}

?>
