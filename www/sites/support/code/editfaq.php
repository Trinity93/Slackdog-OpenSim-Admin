<?php
/*******************************************************************************
**	file:	editfaq.php
********************************************************************************
**	author:	Luis Bernardo
**	date:	2003/12/10
********************************************************************************
**	$Revision: 1.4 $ on $Date: 2003/12/19 06:05:17 $ by $Author: lmpmbernardo $
*******************************************************************************/

$id = $_GET['id'] ? $_GET['id'] : $_POST['id'];
$updatefaq = $_POST['updatefaq'];
$question = $_POST['question'];
$category_id = $_POST['category_id'];
$answer = $_POST['answer'];
$comments = $_POST['comments'];

if(isset($updatefaq)) {
	// get id of logged in user (supporter)
	$supporter_id = getPersonID($cookie_name);
	// time contact modified
	$time = time();
	$sql = "update $mysql_faqs_table set question='$question', answer='$answer', author_id='$supporter_id', date_modified='$time', comments='$comments' , category_id='$category_id' where id=$id";
	if(execsql($sql)) {
		$success_message .= "\"$question\" ".$lang['msg_updated_successfully'].".";
		printSuccess($success_message);
		echo '<br/>';
		displayFAQDetail($id);
	}
} else {
	//$info is an array that contains the user information for that id number.
	$info = getFAQInfo($id);
	$categoryid = $info['category_id'];
	echo '
	<form action=index.php?t=editfaq method=post>
		<table class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
			<tr>
				<td>
					<table cellSpacing=1 cellPadding=5 width="100%" border=0>
						<tr>
							<td class=info align=middle><b>'.$lang['edit_faq'].'</b></td>
						</tr>
						<tr>
							<td class=back>
								<table class=border cellSpacing=0 cellPadding=0 width=100% align=center border=0>
									<tr>
										<td>
											<table cellSpacing=1 cellPadding=5 width="100%" border=0>
												<tr>
													<td class=cat align=right width=20%>
														<b> '.$lang['question'].': </b>
													</td>
													<td class=back>
														<input type=text size=72 value="'. $info['question'] .'" name=question>
													</td>
												</tr>
												<tr>
													<td class=cat align=right width=20%>
														<b> '.$lang['category'].': </b>
													</td>
													<td class=back>
														<select name=category_id>';
															createFAQCategoriesMenu($categoryid); echo '
														</select>
													</td>
												</tr>
												<tr>
													<td class=cat align=right width=20%>
														<b> '.$lang['answer'].': </b>
													</td>
													<td class=back>
														<textarea name=answer rows=15 cols=72>'. $info['answer'] .'</textarea>
													</td>
												</tr>
												<tr>
													<td class=cat align=right width=20%>
														<b> '.$lang['comments'].': </b>
													</td>
													<td class=back>
														<textarea name=comments rows=3 cols=72>'. $info['comments'] .'</textarea>
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
			<input type=hidden name=id value='.$id.'>
			<input type=submit name=updatefaq value="'.$lang['update'].'">
		</center>
	</form>';
}
?>