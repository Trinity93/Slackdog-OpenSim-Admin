<?php
/*******************************************************************************
**	file:	install.php
********************************************************************************
**	author:	Luis Bernardo
**	date:	2003/12/10
********************************************************************************
**	$Revision: 1.5 $ on $Date: 2004/02/12 04:35:04 $ by $Author: lmpmbernardo $
*******************************************************************************/

require_once "code/config.php";
require_once "code/lang/$language/language.php";

$step = $_POST['step'];
$first = $_POST['first'];
$last = $_POST['last'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$fax = $_POST['fax'];
$pwd1 = $_POST['pwd1'];
$pwd2 = $_POST['pwd2'];
$username = $_POST['username'];
$company = $_POST['company'];
$admincomments = $_POST['admincomments'];
$companycomments = $_POST['companycomments'];
$address = $_POST['address'];


echo '<html><head><title>MyHelpdesk '.$lang['installation'].'</title>';
require_once "code/style.php";
echo '</head><body>';

//connect and select the proper database....die if database not found.
$connection = mysql_connect($mysql_host, $mysql_user, $mysql_pwd);
mysql_select_db($mysql_db) or die(mysql_error());

$step_one_text = str_replace("NEXT", $lang['next'], $lang['step_one_text']);
if(!isset($step)) {
	echo '
	<br>
	<form action=install.php method=post>
	<table class=border cellSpacing=0 cellPadding=0 width=90% align=center border=0>
		<tr>
			<td>
				<table cellSpacing=1 cellPadding=5 width=100% border=0>
					<tr>
						<td class=info align=center>
							<b>MyHelpdesk '.$lang['installation'].'</b>
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
}	//end no step

if($step == 1) {
	//create the tables from scratch now.
	mysql_query("
			CREATE TABLE $mysql_sessions_table (
				sesskey char(32) not null,
				expiry int(11) unsigned not null,
				value text not null,
				PRIMARY KEY (sesskey)
			)")or die(mysql_errno() . " " . mysql_error());

	mysql_query("
			CREATE TABLE $mysql_announcement_table (
			  id int(11) NOT NULL auto_increment,
			  time int(11) default 0 not null,
			  message text,
			  PRIMARY KEY (id)
			)")or die(mysql_errno() . " " . mysql_error());

	mysql_query("
			CREATE TABLE $mysql_platforms_table (
			  id int(11) NOT NULL auto_increment,
			  rank int(4) NOT NULL default '0',
			  platform varchar(60) NOT NULL default '',
			  PRIMARY KEY  (id),
			  UNIQUE KEY (platform)
			)")or die(mysql_errno() . " " . mysql_error());

	mysql_query("
			CREATE TABLE $mysql_settings_table (
			  name varchar(60) default NULL,
			  site_url varchar(255) default NULL,
			  admin_email varchar(255) default NULL,
			  people_per_page int(4) default '5',
			  sets_per_page int(4) default '5',
			  tickets_per_page int(4) default '10',
			  announcements_limit int(4) default '5',
			  stats varchar(3) default 'on',
			  products_status varchar(3) default 'on',
			  setssl varchar(3) NOT NULL default 'off',
			  default_theme varchar(60) default 'default' not null,
			  smtp varchar(3) default 'off',
			  automatic_notification varchar(3) default 'off',
			  sendmail_path varchar(255),
			  on_off varchar(3) default 'on',
			  reason text,
			  whosonline varchar(3) default 'on',
			  time_tracking varchar(3) default 'off' not null
			)")or die(mysql_errno() . " " . mysql_error());

	mysql_query("
			CREATE TABLE $mysql_tcategories_table (
			  id int(11) NOT NULL auto_increment,
			  rank int(4) NOT NULL default '0',
			  category varchar(60) NOT NULL default '',
			  PRIMARY KEY  (id),
			  UNIQUE KEY (category)
			)")or die(mysql_errno() . " " . mysql_error());

	mysql_query("
			CREATE TABLE $mysql_tpriorities_table (
			  id int(11) NOT NULL auto_increment,
			  rank int(4) NOT NULL default '0',
			  priority varchar(60) NOT NULL default '',
			  PRIMARY KEY  (id),
			  UNIQUE KEY (priority)
			)")or die(mysql_errno() . " " . mysql_error());

	mysql_query("
			CREATE TABLE $mysql_tstatus_table (
			  id int(11) NOT NULL auto_increment,
			  rank int(4) NOT NULL default '0',
			  status varchar(60) NOT NULL default '',
			  PRIMARY KEY  (id),
			  UNIQUE KEY (status)
			)")or die(mysql_errno() . " " . mysql_error());

	mysql_query("
			CREATE TABLE $mysql_whosonline_table(
			  timestamp int(11) default '0' not null,
			  user varchar(60) not null,
			  ip varchar(40) not null,
			  file varchar(255) not null,
			  primary key(timestamp),
			  key (ip)
			)")or die(mysql_errno() . " " . mysql_error());

	mysql_query("
			CREATE TABLE $mysql_people_table (
				id int(11) NOT NULL auto_increment,
				first_name varchar(60) NOT NULL default '',
				last_name varchar(60) NOT NULL default '',
				user_name varchar(60) NOT NULL default '',
				password varchar(255) NOT NULL default '',
				email varchar(100) NOT NULL default '',
				phone varchar(100) NOT NULL default '',
				fax varchar(100) default NULL,
				company_id int(11) NOT NULL,
				author_id int(11) NOT NULL,
				date_modified int(11) NOT NULL default '0',
				comments text,
				user int(1) NOT NULL default '0',
				supporter int(1) NOT NULL default '0',
				admin int(1) NOT NULL default '0',
				theme varchar(60) default 'default' not null,
				PRIMARY KEY  (id),
				UNIQUE KEY (user_name)
			)")or die(mysql_errno() . " " . mysql_error());

	mysql_query("
			CREATE TABLE $mysql_companies_table (
				id int(11) NOT NULL auto_increment,
				company_name varchar(100) NOT NULL default '',
				address text,
				main_contact_id int(11) NOT NULL default '0',
				author_id int(11) NOT NULL,
				date_modified int(11) NOT NULL default '0',
				comments text,
				rank int(4) NOT NULL default '0',
				PRIMARY KEY  (id),
				UNIQUE KEY (company_name)
			)")or die(mysql_errno() . " " . mysql_error());

	mysql_query("
			CREATE TABLE $mysql_groups_table (
				id int(11) NOT NULL auto_increment,
				group_name varchar(100) NOT NULL default '',
				author_id int(11) NOT NULL,
				date_modified int(11) NOT NULL default '0',
				comments text,
				rank int(4) NOT NULL default '0',
				PRIMARY KEY  (id),
				UNIQUE KEY (group_name)
			)")or die(mysql_errno() . " " . mysql_error());

	mysql_query("
			CREATE TABLE $mysql_supporters_table (
				group_id int(11) NOT NULL,
				supporter_id int(11) NOT NULL,
				UNIQUE KEY (group_id, supporter_id)
			)")or die(mysql_errno() . " " . mysql_error());

	mysql_query("
		CREATE TABLE $mysql_tracktime_table (
			ticket_id int(11) not null,
			supporter_id int(11) not null,
			minutes int(11) default 0,
			date_logged int(11) NOT NULL default '0'
		)")or die(mysql_errno() . " " . mysql_error());

	mysql_query("
			CREATE TABLE $mysql_modules_table (
				id int(11) NOT NULL auto_increment,
				module_name varchar(60) NOT NULL default '',
				rank int(4) NOT NULL default '0',
				PRIMARY KEY  (id),
				UNIQUE KEY (module_name)
			)")or die(mysql_errno() . " " . mysql_error());

	mysql_query("
			CREATE TABLE $mysql_versions_table (
				id int(11) NOT NULL auto_increment,
				version_name varchar(60) NOT NULL default '',
				rank int(4) NOT NULL default '0',
				PRIMARY KEY  (id),
				UNIQUE KEY (version_name)
			)")or die(mysql_errno() . " " . mysql_error());

	mysql_query("
			CREATE TABLE $mysql_tickets_table (
				id int(11) NOT NULL auto_increment,
				group_id int(11) NOT NULL default '1',
				supporter_id int(11) NOT NULL default '1',
				company_id int(11) NOT NULL default '1',
				contact_id int(11) NOT NULL default '1',
				priority_id int(11) NOT NULL default '1',
				status_id int(11) NOT NULL default '1',
				platform_id int(11) NOT NULL default '1',
				category_id int(11) NOT NULL default '1',
				title varchar(255) NOT NULL default '',
				description text,
				update_log text,
				version_id int(11) NOT NULL default '0',
				diskid_id int(11) NOT NULL default '0',
				date_created int(11) NOT NULL default '0',
				date_modified int(11) NOT NULL default '0',
				author_id int(11) NOT NULL,
				survey int(1) default 0 not null,
				PRIMARY KEY  (id),
				FULLTEXT (title, description, update_log)
			)")or die(mysql_errno() . " " . mysql_error());

	mysql_query("
			CREATE TABLE $mysql_ticketmodules_table (
				ticket_id int(11) NOT NULL,
				module_id int(11) NOT NULL,
				UNIQUE KEY (ticket_id, module_id)
			)")or die(mysql_errno() . " " . mysql_error());

	mysql_query("
			CREATE TABLE $mysql_diskid_table (
				id int(11) NOT NULL auto_increment,
				diskid_name varchar(60) NOT NULL default '',
				client_id int(11) NOT NULL,
				PRIMARY KEY  (id),
				UNIQUE KEY (diskid_name)
			)")or die(mysql_errno() . " " . mysql_error());

	mysql_query("
			CREATE TABLE $mysql_faqcategories_table (
				id int(11) NOT NULL auto_increment,
				category_name varchar(60) NOT NULL default '',
				rank int(4) NOT NULL default '0',
				PRIMARY KEY  (id),
				UNIQUE KEY (category_name)
			)")or die(mysql_errno() . " " . mysql_error());

	mysql_query("
			CREATE TABLE $mysql_faqs_table (
				id int(11) NOT NULL auto_increment,
				question varchar(255) NOT NULL default '',
				answer text,
				category_id int(11) NOT NULL default '0',
				author_id int(11) NOT NULL,
				date_modified int(11) NOT NULL default '0',
				comments text,
				PRIMARY KEY  (id),
				UNIQUE KEY (question),
				FULLTEXT (question, answer)
			)")or die(mysql_errno() . " " . mysql_error());

	mysql_query("
			CREATE TABLE $mysql_ticketdiskid_table (
				ticket_id int(11) NOT NULL,
				diskid varchar(60)
			)")or die(mysql_errno() . " " . mysql_error());

	mysql_query("
			CREATE TABLE $mysql_ticketfiles_table (
				ticket_id int(11) NOT NULL,
				file_id int(11) NOT NULL,
				UNIQUE KEY (ticket_id, file_id)
			)")or die(mysql_errno() . " " . mysql_error());

	mysql_query("
			CREATE TABLE $mysql_files_table (
				id int(11) NOT NULL auto_increment,
				name varchar(80) not null default '',
				filename varchar(250) not null,
				size bigint(20) not null,
				author_id int(11) NOT NULL,
				date_modified int(11) NOT NULL default '0',
				comments text,
				PRIMARY KEY  (id),
				UNIQUE KEY (filename)
			)")or die(mysql_errno() . " " . mysql_error());

	//insert some data into the platforms table.
	$generic = $lang['generic'];
	$pc = $lang['pc'];
	$macintosh = $lang['macintosh'];	
	mysql_query("INSERT into $mysql_platforms_table values(NULL, 0, '$generic')");
	mysql_query("INSERT into $mysql_platforms_table values(NULL, 1, '$pc')");
	mysql_query("INSERT into $mysql_platforms_table values(NULL, 1, '$macintosh')");

	$bigproblem = $lang['big_problem'];
	$smallproblem = $lang['small_problem'];
	$otherproblem = $lang['other_problem'];
	//insert some data into the categories table.
	mysql_query("INSERT into $mysql_tcategories_table values(NULL, 0, '$bigproblem')");
	mysql_query("INSERT into $mysql_tcategories_table values(NULL, 1, '$smallproblem')");
	mysql_query("INSERT into $mysql_tcategories_table values(NULL, 2, '$otherproblem')");

	$critical = $lang['critical'];
	$high = $lang['high'];
	$medium = $lang['medium'];
	$low = $lang['low'];
	//insert some data into the priorities table.
	mysql_query("INSERT into $mysql_tpriorities_table VALUES(NULL, 0, '$critical')");
	mysql_query("INSERT into $mysql_tpriorities_table VALUES(NULL, 1, '$high')");
	mysql_query("INSERT into $mysql_tpriorities_table VALUES(NULL, 2, '$medium')");
	mysql_query("INSERT into $mysql_tpriorities_table VALUES(NULL, 3, '$low')");

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
	$pwd = md5("password");
	//insert default contact for inactive contacts company
	mysql_query("insert into $mysql_people_table values(NULL, 'Default', 'Contact', 'defaultcontact', '$pwd', 'default.contact@inactivecontacts.com', 'XXX-XXX-XXXX', 'XXX-XXX-XXXX', '1', '1', '$time', '$defaultcontact', '1', '0', '0', 'default')") or die(mysql_error());
	//insert inactive contacts company
	mysql_query("insert into $mysql_companies_table values(NULL, 'Inactive Contacts', '$inactivecontactsaddress', '1', '1', '$time', '$inactivecontacts', '0')") or die(mysql_error());
	//insert welcome message in the announcements table
//	$welcome = "Welcome! Thank you for installing MyHelpdesk! Visit <a href=http://www.sourceforge.net/projects/myhelpdesk/>MyHelpdesk</a> at SourceForge if you have any question.";
	$welcome = addslashes($welcome);
	mysql_query("insert into $mysql_announcement_table values(NULL, '$time', '$welcome')") or die(mysql_error());

	echo '
	<br>
	<form action=install.php method=post>
	<table class=border cellSpacing=0 cellPadding=0 width=90% align=center border=0>
		<tr>
			<td>
				<table cellSpacing=1 cellPadding=5 width=100% border=0>
					<tr>
						<td class=info align=center>
							<b>MyHelpdesk '.$lang['installation'].'</b>
						</td>
					</tr>
					<tr>
						<td class=back>
				<table class=border cellSpacing=0 cellPadding=0 width=100% align=center border=0>
					<tr>
						<td>
							<table cellSpacing=1 cellPadding=5 width=100% border=0>
								<tr>
									<td class=info align=center colspan=2>
										<b>'.$lang['step_two'].'</b>
									</td>
								</tr>
								<tr>
									<td width=30% class=cat align=right><b>* '.$lang['first_name'].':</b></td>
									<td class=back><input type=text size=40 name=first></td>
								</tr>
								<tr>
									<td width=30% class=cat align=right><b>* '.$lang['last_name'].':</b></td>
									<td class=back><input type=text size=40 name=last></td>
								</tr>
								<tr>
									<td width=30% class=cat align=right><b>* '.$lang['user_name'].':</b></td>
									<td class=back><input type=text size=40 name=username></td>
								</tr>
								<tr>
									<td width=30% class=cat align=right><b>* '.$lang['email'].':</b></td>
									<td class=back><input type=text size=40 name=email></td>
								</tr>
								<tr>
									<td width=30% class=cat align=right><b>* '.$lang['password'].':</b></td>
									<td class=back><input type=password size=40 name=pwd1></td>
								</tr>
								<tr>
									<td width=30% class=cat align=right><b>* '.$lang['password_again'].':</b></td>
									<td class=back><input type=password size=40 name=pwd2></td>
								</tr>
								<tr>
									<td width=30% class=cat align=right><b>'.$lang['phone'].':</b></td>
									<td class=back><input type=text size=40 name=phone></td>
								</tr>
								<tr>
									<td width=30% class=cat align=right><b>'.$lang['fax'].':</b></td>
									<td class=back><input type=text size=40 name=fax></td>
								</tr>
								<tr>
									<td width=30% class=cat align=right><b>'.$lang['comments'].':</b></td>
									<td class=back><textarea name=admincomments rows=3 cols=72></textarea></td>
								</tr>
								<tr>
									<td width=30% class=cat align=right><b>* '.$lang['company_name'].':</b></td>
									<td class=back><input type=text size=40 name=company></td>
								</tr>
								<tr>
									<td width=30% class=cat align=right><b>'.$lang['address'].':</b></td>
									<td class=back><textarea name=address rows=3 cols=72></textarea></td>
								</tr>
								<tr>
									<td width=30% class=cat align=right><b>'.$lang['company_comments'].':</b></td>
									<td class=back><textarea name=companycomments rows=3 cols=72></textarea></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<font size=1>* = '.$lang['required_field'].'</font>
				<br>
				<center>
					<input type=hidden name=step value=2>
					<input type=submit name=submit value='.$lang['next'].'>
				</center>
				<br>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	</form>';
}	//end step 1


//begin step 2
if($step == 2) {
	echo '
	<br>
	<table class=border cellSpacing=0 cellPadding=0 width=90% align=center border=0>
		<tr>
			<td>
				<table cellSpacing=1 cellPadding=5 width=100% border=0>
					<tr>
						<td class=info align=center>
							<b>MyHelpdesk '.$lang['installation'].'</b>
						</td>
					</tr>
					<tr>
						<td class=back>
							<br>
							<table class=border cellSpacing=0 cellPadding=0 width=100% align=center border=0>
								<tr>
									<td>
										<table cellSpacing=1 cellPadding=5 width="100%" border=0>';
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
	$msg = "<font color=red>". $msg ."</font>";
	$fullmsg = str_replace("XXX", $msg, $lang['install_error']);
	echo '
		<tr>
			<td class=back>
				<center><b>'.$fullmsg.'</b></center>
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
