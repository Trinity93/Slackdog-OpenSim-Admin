<?php
/*******************************************************************************
**	file:	searchfaqs.php
********************************************************************************
**	author:	Luis Bernardo
**	date:	10 Dec 2003
********************************************************************************
**	$Revision: 1.6 $ on $Date: 2004/02/12 04:34:04 $ by $Author: lmpmbernardo $
*******************************************************************************/
$search = $_POST['search'];
$keyword = $_POST['keyword'];

if(isset($search)) {
//	$sql = "select t1.id, t1.question, t2.category_name from $mysql_faqs_table as t1 left join $mysql_faqcategories_table as t2 on t1.category_id=t2.id where t1.question like '%$keyword%' or t1.answer like '%$keyword%' order by t2.category_name, t1.question asc";
	$sql = "select t1.id, t1.question, t2.category_name from $mysql_faqs_table as t1 left join $mysql_faqcategories_table as t2 on t1.category_id=t2.id where match(t1.question, t1.answer) against('$keyword') order by t2.category_name, t1.question asc";

	$title = $lang[search_faqs];
	$innertable = array();
	$row = array($lang[category], $lang[question]);
	array_push($innertable, $row);
	
	$r = execsql($sql);
	$dummy = "HGKJHKHKUYIUY"; // dummy value
	$category = $dummy;
	//get all of the data into readable variables.
	while($rr = mysql_fetch_row($r)) {
		if($rr[2] != $category) {
			if($category != $dummy) {
				$row = array($category, $questions);
				array_push($innertable, $row);
			}
			$category = $rr[2];
			$questions = "";
		}
		$questions .= "<b>Q$rr[0]:</b> " . outputURL("detailfaq&id=$rr[0]", $rr[1]) . "<br>";
	}
	if($category != $dummy) {
		$row = array($category, $questions);
		array_push($innertable, $row);
	}
	// start html output
	outputFrameTable($title, $innertable, "faq");
	// end html output
} else {
	echo '
	<form action=index.php?t=searchfaqs method=post>
	<table class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
		<tr>
			<td>
				<table cellSpacing=1 cellPadding=5 width="100%" border=0>
					<tr>
						<td class=info colspan=100% align=middle><b>'.$lang['search_faqs'].'</b></td>
					</tr>
					<tr>
							<td class=back colspan=100%>
								<table class=border cellSpacing=0 cellPadding=0 width=100% align=center border=0>
									<tr>
										<td>
											<table cellSpacing=1 cellPadding=5 width="100%" border=0>
					<tr>
						<td colspan=2 class=cat>
							'.$lang['text_enter_keyword'].'.
						</td>
					</tr>
					<tr>
						<td class=cat align=right width=20%><b> '.$lang['keyword'].': </b></td><td class=back><input type=text name=keyword></td>
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
			<input type=submit name=search value="'.$lang['search'].'">
		</center>
	</form>';
}

?>