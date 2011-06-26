<?php
/*******************************************************************************
**	file:	control.php
********************************************************************************
**	author:	Luis Bernardo
**	date:	2003/12/10
********************************************************************************
**	$Revision: 1.4 $ on $Date: 2003/12/19 06:05:17 $ by $Author: lmpmbernardo $
*******************************************************************************/

$changesettings = $_POST['changesettings'];

if(isset($changesettings)) {
	$login_site_url = ""; // to remove later
	$ssl = ""; // to remove later
	$mail_path = ""; // to remove later
	$theme_default = "default"; // to remove later, maybe not...
	$admin_email = $_POST['admin_email'];
	$helpdesk_name = $_POST['helpdesk_name'];
	$enable_automatic = $_POST['enable_automatic'];
	$users_limit = $_POST['users_limit'];
	$announcements_limit = $_POST['announcements_limit'];
	$enable_stats = $_POST['enable_stats'];
	$groups_limit = $_POST['groups_limit'];
	$enable_smtp = $_POST['enable_smtp'];
	$enable_helpdesk = $_POST['enable_helpdesk'];
	$on_off_reason = $_POST['on_off_reason'];
	$enable_whosonline = $_POST['enable_whosonline'];
	$enable_time_tracking = $_POST['enable_time_tracking'];
	$enable_products = $_POST['enable_products'];
	$tickets_limit = $_POST['tickets_limit'];
	$sql = "update $mysql_settings_table set site_url='$login_site_url', admin_email='$admin_email', name='$helpdesk_name', automatic_notification='$enable_automatic',
			people_per_page='$users_limit', announcements_limit='$announcements_limit', stats='$enable_stats', sets_per_page='$groups_limit',
			setssl='$ssl', smtp='$enable_smtp', sendmail_path='$mail_path', on_off='$enable_helpdesk', reason='$on_off_reason', whosonline='$enable_whosonline',
			default_theme='$theme_default', time_tracking='$enable_time_tracking', products_status='$enable_products', tickets_per_page='$tickets_limit'";
	execsql($sql);
	printSuccess("Your changes were saved.");
}

echo '
	<form action="index.php?t=settings" method=post>
		<table class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
			<tr>
				<td>
					<table cellSpacing=1 cellPadding=5 width="100%" border=0>
						<tr>
							<td class=info colspan=100% align=middle>
								<b>'.$lang['control_panel'].'</b>
							</td>
						</tr>
						<tr>
							<td class=back colspan=100%>
								<table class=border cellSpacing=0 cellPadding=0 width=100% align=center border=0>
									<tr>
										<td>
											<table cellSpacing=1 cellPadding=5 width="100%" border=0>
			<tr>
				<td width=40% class=cat align=center>
					<b>'.$lang['setting'].'</b>
				</td>
				<td class=cat align=center>
					<b>'.$lang['value'].'</b>
				</td>
			</tr>
			<tr>
				<td width=40% class=back2>
					'.$lang['helpdesk_name'].':
				</td>
				<td class=back2>
					<input type=text size=50 name=helpdesk_name value="'. $helpdesk_name .'">
				</td>
			</tr>
			<tr>
				<td width=40% class=back2>
					'.$lang['administrator_email'].':
				</td>
				<td class=back2>
					<input type=text name=admin_email size=50 value='. $admin_email .'>
				</td>
			</tr>
			<tr>
				<td width=40% class=back2>
					'.$lang['helpdesk_on-off'].':
				</td>
				<td class=back2>
					<select name=enable_helpdesk>
						<option value=on'; if($enable_helpdesk == 'on') echo ' selected'; echo '>On</option>
						<option value=off'; if($enable_helpdesk == 'off') echo ' selected'; echo '>Off</option>
					</select>
				</td>
			</tr>
			<tr>
				<td width=40% class=back2>
					'.$lang['reason_helpdesk_off'].':
				</td>
				<td class=back2>
					<textarea name=on_off_reason rows=3 cols=50>'. "$on_off_reason" .'</textarea>
				</td>
			</tr>
			<tr>
				<td width=40% class=back2>
					'.$lang['num_supporters_per_page'].':
				</td>
				<td class=back2>
					<input size=3 type=text name=users_limit value='; echo ($users_limit == '' ? '5' : $users_limit ); echo '>
				</td>
			</tr>
			<tr>
				<td width=40% class=back2>
					'.$lang['num_groups_per_page'].':
				</td>
				<td class=back2>
					<input size=3 type=text name=groups_limit value='; echo ($groups_limit == '' ? '5' : $groups_limit ); echo '>
				</td>
			</tr>
			<tr>
				<td width=40% class=back2>
					'.$lang['num_tickets_per_page'].':
				</td>
				<td class=back2>
					<input size=3 type=text name=tickets_limit value='; echo ($tickets_limit == '' ? '10' : $tickets_limit ); echo '>
				</td>
			</tr>
			<tr>
				<td width=40% class=back2>
					'.$lang['num_announcements_to_list'].':
				</td>
				<td class=back2>
					<input size=3 type=text name=announcements_limit value='; echo ($announcements_limit == '' ? '5' : $announcements_limit ); echo '>
				</td>
			</tr>
			<tr>
				<td width=40% class=back2>
					'.$lang['time_tracking_status'].':
				</td>
				<td class=back2>
					<select name=enable_time_tracking>
						<option value=on'; if($enable_time_tracking == 'on') echo ' selected'; echo '>On</option>
						<option value=off'; if($enable_time_tracking == 'off') echo ' selected'; echo '>Off</option>
					</select>
				</td>
			</tr>
			<tr>
				<td width=40% class=back2>
					'.$lang['products_options_status'].':
				</td>
				<td class=back2>
					<select name=enable_products>
						<option value=on'; if($enable_products == 'on') echo ' selected'; echo '>On</option>
						<option value=off'; if($enable_products == 'off') echo ' selected'; echo '>Off</option>
					</select>
				</td>
			</tr>
			<tr>
				<td width=40% class=back2>
					'.$lang['smtp_status'].':
				</td>
				<td class=back2>
					<select name=enable_smtp>
						<option value=off'; if($enable_smtp == 'off') echo ' selected'; echo '>Off</option>
						<option value=on'; if($enable_smtp == 'on') echo ' selected'; echo '>On</option>
					</select>
				</td>
			</tr>';
if($enable_smtp != 'off') {
	echo '
			<tr>
				<td width=40% class=back2>
					'.$lang['automatic_mail_notification'].':
				</td>
				<td class=back2>
					<select name=enable_automatic>
						<option value=on'; if($enable_automatic == 'on') echo ' selected'; echo '>On</option>
						<option value=off'; if($enable_automatic == 'off') echo ' selected'; echo '>Off</option>
					</select>
				</td>
			</tr>';
}
echo '
			<tr>
				<td width=40% class=back2>
					'.$lang['who_online_status'].':
				</td>
				<td class=back2>
					<select name=enable_whosonline>
						<option value=on'; if($enable_whosonline == 'on') echo ' selected'; echo '>On</option>
						<option value=off'; if($enable_whosonline == 'off') echo ' selected'; echo '>Off</option>
					</select>
				</td>
			</tr>
			<tr>
				<td width=40% class=back2>
					'.$lang['system_statistics'].':
				</td>
				<td class=back2>
					<select name=enable_stats>
						<option value=on'; if($enable_stats == 'on') echo ' selected'; echo '>On</option>
						<option value=off'; if($enable_stats == 'off') echo ' selected'; echo '>Off</option>
					</select>
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
		</table>
		<br>
			<center>
				<input type=submit name=changesettings value="'.$lang['submit_changes'].'">
			</center>
		</form>';
?>

