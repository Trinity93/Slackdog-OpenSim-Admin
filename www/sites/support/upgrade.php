<?php
/*******************************************************************************
**	file:	upgrade.php
********************************************************************************
**	author:	Luis Bernardo
**	date:	2004/02/11
********************************************************************************
**	$Revision: 1.2 $ on $Date: 2004/02/13 23:23:37 $ by $Author: lmpmbernardo $
*******************************************************************************/

require_once "../../../includes/config.php";
require_once "../../../includes/lang/$language/language.php";

$step = $_POST['step'];

echo '<html><head><title>MyHelpdesk '.$lang['installation'].'</title>';
require_once "code/style.php";
echo '</head><body>';

//connect and select the proper database....die if database not found.
$connection = mysql_connect($mysql_host, $mysql_user, $mysql_pwd);
mysql_select_db($mysql_db) or die(mysql_error());

if(!isset($step)) {
	echo '
	<br>
	<form action=upgrade.php method=post>
	<table class=border cellSpacing=0 cellPadding=0 width=90% align=center border=0>
		<tr>
			<td>
				<table cellSpacing=1 cellPadding=5 width=100% border=0>
					<tr>
						<td class=info align=center>
							<b>MyHelpdesk Upgrade</b>
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
													<b>Step One: Alter Tables</b>
												</td>
											</tr>
											<tr>
												<td class=back>
													<center>
											<br>Run this script only if your database was created with release 20040119 or earlier.
											<br>This script modifies the tickets and faqs tables. Click next to do the update.<br><br>
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
								<input class=border type=submit name=submit value=Next>
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
	// update the settings table
	mysql_query("alter table $mysql_tickets_table add fulltext(title, description, update_log)");
	mysql_query("alter table $mysql_faqs_table add fulltext(question, answer)");

	$loginpage = str_replace("upgrade.php", "", $_SERVER['HTTP_REFERER']);

	echo '
	<br>
	<table class=border cellSpacing=0 cellPadding=0 width=90% align=center border=0>
		<tr>
			<td>
				<table cellSpacing=1 cellPadding=5 width=100% border=0>
					<tr>
						<td class=info align=center>
							<b>MyHelpdesk Upgrade</b>
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
													<b>Step Two: Finishing Up</b>
												</td>
											</tr>
											<tr>
												<td class=back>
													<center>
												You have upgraded the helpdesk software.<br>
												You can <a href='.$loginpage.'>login</a> again.
													</center>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>';
}	//end step 1

echo '</body></html>';

?>
