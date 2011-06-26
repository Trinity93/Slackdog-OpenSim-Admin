<?php
/*******************************************************************************
**	file:	ticketproperties.php
********************************************************************************
**	author:	Luis Bernardo
**	date:	2003/12/10
********************************************************************************
**	$Revision: 1.5 $ on $Date: 2004/01/16 07:23:45 $ by $Author: lmpmbernardo $
*******************************************************************************/

$property = $_GET['property'] ? $_GET['property'] : $_POST['property'];
if($property == "categories") {
	$table = $mysql_tcategories_table;
	$field = "category";
    $fieldText=$lang['new_category'];
	$header = $lang['ticket_categories'];
	$desc = $lang['text_ticket_categories'];
}
if($property == "status") {
	$table = $mysql_tstatus_table;
	$field = "status";
    $fieldText=$lang['new_status'];
	$header = $lang['ticket_status'];
	$desc = $lang['text_ticket_status'];
}
if($property == "priorities") {
	$table = $mysql_tpriorities_table;
	$field = "priority";
    $fieldText=$lang['new_priority'];
	$header = $lang['ticket_priorities'];
	$desc = $lang['text_ticket_priorities'];
}
if($property == "platforms") {
	$table = $mysql_platforms_table;
	$field = "platform";
    $fieldText=$lang['new_platform'];
	$header = $lang['ticket_platforms'];
	$desc = $lang['text_ticket_platform'];
}

$id = $_GET['id'];
$add = $_GET['add'];
$modify = $_GET['modify'];
$action = $_GET['action'];
$addproperty = $_POST['addproperty'];
$propertyname = $_POST['propertyname'];
$update = $_POST['update'];
$rank = $_POST['rank'];
$numproperties = $_POST['numproperties'];

if(isset($addproperty)) {
	$sql = "insert into $table(id, rank, $field) values(null, '$rank', '$propertyname')";
	execsql($sql);
}
if($action == 'delete') {
	$sql = "delete from $table where id=$id";
	execsql($sql);
}
if(isset($update) && $numproperties > 0) {
	for($i = 0; $i < $numproperties; $i++) {
		$prop = "property" . $i;
		$ran = "rank" . $i;
		$id = "id" . $i;
		$prop = $_POST[$prop];
		$ran = $_POST[$ran];
		$id = $_POST[$id];
		$sql = "update $table set rank='$ran', ".$field."='$prop' where id='$id'";
		execsql($sql);
	}
}
// define links to show in upper right corner
if(!isset($add) || !isset($modify)) {
	if(!isset($add) && !isset($modify)) {
		$showlink = "<a class=info href=index.php?t=ticketproperties&property=". $property ."&add=true>".$lang['add']."</a>, <a class=info href=index.php?t=ticketproperties&property=".$property."&modify=true>".$lang['modify']."</a>";
	} else if(!isset($add)) {
		$showlink = "<a class=info href=index.php?t=ticketproperties&property=".$property."&add=true>".$lang['add']."</a>";
	} else  {
		$showlink = "<a class=info href=index.php?t=ticketproperties&property=".$property."&modify=true>".$lang['modify']."</a>";
	}
} else {
	$showlink = "&nbsp;";
}

echo '
	<form action=index.php?t=ticketproperties&property='.$property.' method=post>
		<table class=border cellSpacing=0 cellPadding=0 width=100% align=center border=0>
			<tr>
				<td>
					<table cellSpacing=1 cellPadding=5 width=100% border=0>
						<tr>
							<td class=info>
								<table class=border cellSpacing=0 cellPadding=0 width=100% border=0>
									<tr>
										<td class=info width=25% align=center>&nbsp;</td>
										<td class=info width=50% align=center><b>'.$header.'</b></td>
										<td class=info align=right>'.$showlink.'</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td class=cat>'.$desc.'
							</td>
						</tr>
						<tr>
							<td class=back>
								<table class=border cellSpacing=0 cellPadding=0 width=100% align=center border=0>
									<tr>
										<td>
											<table cellSpacing=1 cellPadding=5 width="100%" border=0>';
												$numberproperties = listProperties($modify, $table, $field, $property); echo '
											</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>';
if(isset($add)) {
	echo '
						<tr>
							<td class=cat>
								<center>
								<b>';
    echo $fieldText.':</b> <input type=text name=propertyname></input>&nbsp;&nbsp;';
	echo '							<b>'.$lang['rank'].':</b> <input type=text name=rank size=2></input>
								</center>
							</td>
						</tr>';
}
echo '
					</table>
				</td>
			</tr>
		</table>';
if($numberproperties > 0 && isset($modify)) {
	echo '
		<br>
		<center>
			<input type=hidden name=numproperties value='.$numberproperties.'>
			<input type=submit name=update value="'.$lang['update'].'">&nbsp;&nbsp;
			<input type=submit name=cancel value="'.$lang['cancel'].'">
		</center>';
}
if(isset($add)) {
	echo '
		<br>
		<center>
			<input type=submit name=addproperty value="'.$lang['add'].'">&nbsp;&nbsp;
			<input type=submit name=cancel value="'.$lang['cancel'].'">
		</center>';
}
echo '
		<input type=hidden name=property value='.$property.'>
	</form>';

/***********************************************************************************************************
****************************************** DEFINE FUNCTIONS ************************************************
************************************************************************************************************/

/***********************************************************************************************************
**	function listProperties():
************************************************************************************************************/
function listProperties($modify, $table, $field, $property) {
    global $lang;
	$sql = "select * from $table order by rank, $field asc";
	$result = execsql($sql);
	$i = 0;
	while($row = mysql_fetch_row($result)) {
		echo '
			<tr>
				<td class=back>';
		if(isset($modify)) {
			echo '
					<input type=hidden name=id'. $i .' value='. $row[0] .'>
					<input type=text name=property'. $i .' value="'. $row[2] .'">
					&nbsp;&nbsp; '.$lang['rank'].': <input type=text size=2 value='. $row[1] .' name=rank'. $i .'>
					&nbsp;&nbsp;<a href=index.php?t=ticketproperties&property='.$property.'&action=delete&id='. $row[0] .'>'.$lang['delete'].'</a>';
		} else {
			echo '
				<b>'. $row[2] .'</b> &nbsp;&nbsp;<font size=1>['.$lang['rank'].': '. $row[1] .']</font>';

		}
		echo '
				</td>
			</tr>';
		$i++;
	}
	return $i;
}
?>