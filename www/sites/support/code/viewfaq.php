<?php
/*****************************************************************************************
**	file:	detailfaq.php
******************************************************************************************
**	author:	Luis Bernardo
**	date:	10 Dec 2003
********************************************************************************
**	$Revision: 1.3 $ on $Date: 2003/12/19 16:09:11 $ by $Author: sasa_eh $
**************************************************************************************/
$id = $_GET['id'];

//$info is an array that contains the faq information for that id number.
$info = getFAQInfo($id);
$question = $info['question'];
$modifiedon = date("m/d/y",$info['date_modified']);
$answer = ereg_replace("\r\n","<br>",$info['answer']);

echo '
	<table class=border cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
		<tr>
			<td>
				<table cellSpacing=1 cellPadding=5 width="100%" border=0>
					<tr>
						<td class=info colspan=2 align=middle><b>'.$lang['faq_id'].': '. $id .'</b></td>
					</tr>
					<tr>
						<td class=back>
							<table cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
								<tr>
									<td>
										<table class=border cellSpacing=1 cellPadding=5 width="100%" border=0>
											<tr>
												<td class=back2>
													<br><b>'. $question .'</b><br>
													<br>'. $answer .'<br>
													<br><i>'.$lang['last_updated'].': '. $modifiedon .'<br>
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

?>