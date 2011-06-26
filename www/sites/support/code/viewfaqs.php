<?php
/*******************************************************************************
**	file:	viewfaqs.php
********************************************************************************
**	author:	Luis Bernardo
**	date:	10 Dec 2003
********************************************************************************
**	$Revision: 1.6 $ on $Date: 2004/01/16 07:23:45 $ by $Author: lmpmbernardo $
*******************************************************************************/
echo '
	<table class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
		<tr>
			<td>
				<table cellSpacing=1 cellPadding=5 width="100%" border=0>
					<tr>
						<td class=info align=middle>
							<b>'.$lang['faqs'].'</b>
						</td>
					</tr>';
						getListOfFAQs(); echo '
				</table>
			</td>
		</tr>
	</table>';

/***********************************************************************************************************
**	function getListOfFAQs():
************************************************************************************************************/
function getListOfFAQs() {
	global $lang, $mysql_faqs_table, $mysql_faqcategories_table;
	$sql = "select distinct t1.category_id, t2.category_name from $mysql_faqs_table as t1 left join $mysql_faqcategories_table as t2 on t1.category_id=t2.id order by t2.category_name asc";
	$result = execsql($sql);

	echo '
		<tr>
			<td class=back>
				<table cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
					<tr>
						<td>
							<table class=border cellSpacing=1 cellPadding=5 width="100%" border=0>
								<tr>
									<td class=info align=center align=middle><b>'.$lang['category'].'</b></td>
									<td class=info align=center align=middle><b>'.$lang['question'].'</b></td>
								</tr>';
	while($row = mysql_fetch_array($result)) {
		$sql = "select id, question from $mysql_faqs_table where category_id='$row[0]' order by question asc";
		$newresult = execsql($sql);
		$questions = '';
		while($newrow = mysql_fetch_array($newresult)) {
			$questions .= "<b>Q".$newrow[0].":</b> <a href=index.php?t=detailfaq&id=" . $newrow[0] . ">" . $newrow[1] . "</a><br/>";
		}
		echo '
								<tr>
									<td width=20% class=back2 align=right>'. $row[1].'</td>
									<td class=back>'. $questions .'</td>
								</tr>';
	}
	echo '
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>';
}
?>