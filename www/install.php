<?php
/*******************************************************************************
**	file:	install.php
********************************************************************************
**	author:	Riseon Kosten
**	date:	2011/06/24
********************************************************************************
*******************************************************************************/ 

require_once "../includes/config.php";
require_once "../includes/lang/$language/language.php";
/*******************************************************************************
*
*							Some possibly useful vars to change
*
*******************************************************************************/
$sqlfile = "../sql/webdev.sql";

$step = $_POST['step'];
$admincomments = $_POST['admincomments'];
$companycomments = $_POST['companycomments'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$fax = $_POST['fax'];
$first = $_POST['first'];
$last = $_POST['last'];
$email = $_POST['email'];
$pwd1 = $_POST['pwd1'];
$pwd2 = $_POST['pwd2'];
$username = $_POST['username'];
$company = $_POST['company'];

echo '<html><head><title>Slackdog Web Interface '.$lang['installation'].'</title>';
require_once "../includes/style.php";
echo '</head><body>';
//connect and select the proper database....die if database not found.
$connection = mysql_connect($mysql_host, $mysql_user, $mysql_pwd);
mysql_select_db($mysql_db) or die(mysql_error());

$step_one_text = str_replace("NEXT", $lang['next'], $lang['step_one_text']);
if(!isset($step)) {
	echo '
	<br>
	<form action=' . $_SERVER['PHP_SELF'] . ' method=post>
	<table class=border cellSpacing=0 cellPadding=0 width=90% align=center border=0>
		<tr>
			<td>
				<table cellSpacing=1 cellPadding=5 width=100% border=0>
					<tr>
						<td class=info align=center>
							<b>Slackdog Web Interface '.$lang['installation'].'</b>
						</td>
					</tr>
					<tr>
						<td class=back>
							<br>
							<table class=border cellSpacing=0 cellPadding=0 width=80% align=center border=0>
								<tr>
									<td>
										<table cellSpacing=1 cellPadding=5 width=100% border=0>
											<tr>
												<td class=info align=center>
													<b>'.$lang['step_one'].'</b>
												</td>
											</tr>
											<tr>
												<td class=back>
													<center>
														<br>'.$step_one_text.'<br><br>
													</center>
												</td>
											</tr>
										</table>
<table class=border width=300 border="0" cellspacing="1" cellpadding="5" align=center>
  <tr>
    <td class=back colspan=2 align=center>'.$lang['install_admin_text'].'</td>
  <tr>
    <td class=info width=150>First Name</td>
    <td class=back width=150><input name="first" type="text" value="Grid" size="20" maxlength="50" /></td>
  </tr>
  <tr>
    <td class=info >Last Name</td>
    <td class=back ><input name="last" type="text" value="Administrator" size="20" maxlength="50" /></td>
  </tr>
  <td class=info >Username</td>
    <td class=back ><input name="username" type="text" value="gridadmin" size="20" maxlength="50" /></td>
  </tr>
  <tr>
    <td class=info >Email Address</td>
    <td class=back ><input name="email" type="text" value="Enter Your Email" size="20" maxlength="50" /></td>
  </tr>
  <tr>
    <td class=info >Password</td>
    <td class=back ><input name="pwd1" type="password" value="" size="20" maxlength="50" /></td>
  </tr>
  <tr>
    <td class=info >Confirm Password</td>
    <td class=back ><input name="pwd2" type="password" value="" size="20" maxlength="50" /></td>
  </tr>
  <tr>
    <td class=info >Grid Name</td>
    <td class=back ><input name="company" type="text" value="Enter Grid Name" size="20" maxlength="50" /></td>
  </tr>
</table>

									</td>
								</tr>
							</table>
							<br>
							<center>
								<input type=hidden name=step value=1>
								<input class=border type=submit name=submit value='.$lang['next'].'>
							</center>
							<br>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	</form>';
	}
//end no step

if($step == 1) {
  $sqlblob = file_get_contents("$sqlfile");
  $sqlblob = trim($sqlblob);
  $arrsql = explode(";", $sqlblob);
  foreach ($arrsql as $sql)
  	mysql_query("$sql");
	$open = $lang['open'];
	$inprogress = $lang['in_progress'];
	$waitingforresponse = $lang['waiting_for_response'];
	$closed = $lang['closed'];
	//insert some data into the status table.
	mysql_query("INSERT into $mysql_tstatus_table VALUES(NULL, 1, '$open')");
	mysql_query("INSERT into $mysql_tstatus_table VALUES(NULL, 2, '$inprogress')");
	mysql_query("INSERT into $mysql_tstatus_table VALUES(NULL, 3, '$waitingforresponse')");
	mysql_query("INSERT into $mysql_tstatus_table VALUES(NULL, 4, '$closed')");
				
	$defaultcontact = $lang['defaultcontact'];
	$inactivecontacts = $lang['inactivecontacts'];
	$inactivecontactsaddress = $lang['inactivecontactsaddress'];
	$welcome = $lang['welcome'];

	$time = time();
	echo'						<br>
							<table class=border cellSpacing=0 cellPadding=0 width=100% align=center border=0>
								<tr>
									<td>
										<table cellSpacing=1 cellPadding=5 width="100%" border=0>';
	$flag == 0;
	if($first == '') {
		showError("first name");
		$flag = 1;
	}
	if($last == '') {
		showError("last name");
		$flag = 1;
	}
	if($username == '') {
		showError("user name");
		$flag = 1;
	}
	if($email == '') {
		showError("email address");
		$flag = 1;
	}
	if($pwd1 == '' || $pwd2 == '') {
		showError("password");
		$flag = 1;
	}
	if($company == '') {
		showError("company");
		$flag = 1;
	}
	if (!checkPwd($pwd1, $pwd2)) {
		showError("password");
		$flag = 1;
	}
	if(!validEmail($email)) {
		showError("email");
		$flag = 1;
	}
	if($flag == 1) {
	echo '
								<tr>
									<td class=back>
										<center><b>'.$lang['press_back_button'].'</b></center>
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
	</table>';
		exit;
	}

	//if nothing is missing or incorrect...put the info in the database
	//since this is the first user account...the admin status is set to 1.
	$pwd = md5($pwd1);
	$time = time();

	//Load default post install values into slackdog tables
	$query = "INSERT INTO ".C_INFOWINDOW_TBL." (`gridstatus`, `active`, `color`, `title`, `message`) VALUES ('1', '1', 'green', 'Congradulations!', 'You\'ve successfully installed the Slackdog web interface!');";
	mysql_query($query) or die(mysql_error());

	//Load first administrator account as entered during install
	$query = "INSERT INTO ".C_ADMIN_TBL." values( '1', '$username', '".md5(md5($pwd1) . ":" )."');";
	mysql_query($query) or die(mysql_error());
	//begin support system default value loads
	//insert admin in people table
	$query = "insert into $mysql_people_table values(NULL, '$first', '$last', '$username', '$pwd', '$email', '$phone', '$fax', '2', '2', '$time', '$admincomments', '0', '1', '1', 'default')";
	mysql_query($query) or die(mysql_error());

	//insert admin company in companies table
	$query = "insert into $mysql_companies_table values(NULL, '$company', '$address', '2', '2', '$time', '$companycomments', '0')";
	mysql_query($query) or die(mysql_error());

	$helpdeskname = $company . " Helpdesk";
	$query = "insert into $mysql_settings_table VALUES('$helpdeskname', '', '$email', 5, 5, 10, 5, 'on', 'on', 'off', 'default', 'off', 'off', NULL, 'on', '', 'on', 'on')";
	mysql_query($query) or die(mysql_error());

	//success!  print everything out so the user knows.
	$loginpage = str_replace("install.php", "", $_SERVER['HTTP_REFERER']);
	$nowlogin = str_replace("LOGIN", "<b><a href=".$loginpage.">login</a></b>", $lang['step_three_text']);
	echo '
								<tr>
									<td class=info align=center>
										<b>'.$lang['step_three'].'</b>
									</td>
								</tr>
								<tr>
									<td class=back>
										<center>
											<br>'.$nowlogin.'<br>
											<br><br>
										</center>
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
	</table>';
}	//end step 2
echo '</body></html>';

function showError($msg) {
	global $lang['install_error'];
	$msg = "<font color=red>". $msg ."</font>";
	$fullmsg = str_replace("XXX", $msg, $lang['install_error']);
	echo '
		<tr>
			<td class=back>
				<center><b>' . $fullmsg . '</b></center>
			</td>
		</tr>';
}

function checkPwd($pwd1, $pwd2)	{
	if($pwd1 == $pwd2)
		return true;
	else
		return false;
}

function validEmail($address) {
	if (ereg('^[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+'. '@'. '[-!#$%&\'*+\\/0-9=?A-Z^_`a-z{|}~]+\.' . '[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+$', $address))
		return true;
	else
		return false;
}
?>

