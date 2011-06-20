<?php
/*******************************************************************************
**	file:	addfaq.php
********************************************************************************
**	author:	Luis Bernardo
**	date:	2003/12/10
********************************************************************************
**	$Revision: 1.4 $ on $Date: 2003/12/19 06:05:17 $ by $Author: lmpmbernardo $
*******************************************************************************/

$addfaq = $_POST['addfaq'];
$question = $_POST['question'];
$category_id = $_POST['category_id'];
$answer = $_POST['answer'];
$comments = $_POST['comments'];

if(isset($addfaq)) {
	// get id of logged in user (supporter)
	$supporter_id = getPersonID($cookie_name);
	// time faq added
	$time = time();

	$sql = "insert into $mysql_faqs_table values(null, '$question', '$answer', '$category_id', '$supporter_id', '$time', '$comments')";
	if(execsql($sql)) {
		$success_message .= "\"$question\" ".$lang['msg_added_successfully'];
		// get id of faq just added.
		$sql = "select id from $mysql_faqs_table where question='$question'";
		$result = execsql($sql);
		$row = mysql_fetch_array($result);
		$faqid = $row[0];
		printSuccess($success_message);
		echo '<br>';
		displayFAQDetail($faqid);
	}
} else {
	echo '
	<form action=index.php?t=addfaq method=post>
		<table class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
			<tr>
				<td>
					<table cellSpacing=1 cellPadding=5 width="100%" border=0>
						<tr>
							<td class=info align=middle>
								<b>'.$lang['compose_faq'].'</b>
							</td>
						</tr>
		<tr>
			<td class=back>
				<table class=border cellSpacing=0 cellPadding=0 width=100% align=center border=0>
					<tr>
						<td>
							<table cellSpacing=1 cellPadding=5 width="100%" border=0>
								<tr>
									<td class=cat align=right width=20%>
										<b>'.$lang['question'].':</b>
									</td>
									<td class=back>
										<input type=text size=72 name=question>
									</td>
								</tr>
								<tr>
									<td class=cat align=right width=20%>
										<b>'.$lang['category'].':</b>
									</td>
									<td class=back>
										<select name=category_id>';
											createFAQCategoriesMenu($faqid); echo '
										</select>
									</td>
								</tr>
								<tr>
									<td class=cat align=right width=20%>
										<b>'.$lang['answer'].':</b>
									</td>
									<td class=back>
										<textarea name=answer rows=15 cols=72></textarea>
									</td>
								</tr>
								<tr>
									<td class=cat align=right width=20%>
										<b>'.$lang['comments'].':</b>
									</td>
									<td class=back>
										<textarea name=comments rows=3 cols=72></textarea>
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
				<input type=submit name=addfaq value="'.$lang['add_faq'].'">
			</center>
		</form>';
}
?>