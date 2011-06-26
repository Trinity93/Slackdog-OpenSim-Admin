<?php
/*******************************************************************************
**	file:	productproperties.php
********************************************************************************
**	author:	Luis Bernardo
**	date:	2003/12/10
********************************************************************************
**	$Revision: 1.5 $ on $Date: 2004/01/16 07:23:45 $ by $Author: lmpmbernardo $
*******************************************************************************/

$add = $_GET['add'];
$modify = $_GET['modify'];
$addproperty = $_POST['addproperty'];
$propertyname = $_POST['propertyname'];
$numproperties = $_POST['numproperties'];
$update = $_POST['update'];
$action = $_GET['action'];
$id = $_GET['id'];
$property = $_GET['property'] ? $_GET['property'] : $_POST['property'];
if($property == "modules") {
	$table = $mysql_modules_table;
	$field = "module_name";
    $fieldText=$lang['new_module'];
	$header = $lang['product_modules'];
	$label = array($lang['module'], $lang['modules']);
}
if($property == "versions") {
	$table = $mysql_versions_table;
	$field = "version_name";
    $fieldText=$lang['new_version'];
	$header = $lang['product_versions'];
	$label = array($lang['version'], $lang['versions']);
}
// this can be used too for FAQ categories!!!
if($property == "faqcategories") {
	$table = $mysql_faqcategories_table;
	$field = "category_name";
    $fieldText=$lang['new_category'];
	$header = $lang['faq_categories'];
	$label = array(strtolower($lang['category']), strtolower($lang['categories']));
}
if(isset($addproperty)) {
	$rank = 0;
	$sql = "insert into $table values(null, '$propertyname', '$rank')";
	execsql($sql);
}

if($action == 'delete') {
	$sql = "delete from $table where id=$id";
	execsql($sql);
}

if(isset($update)) {
	for($i = 0; $i < $numproperties; $i++) {
		$mod = "property" . $i;
		$ran = "rank" . $i;
		$id = "id" . $i;
		$mod = $_POST[$mod];
		$ran = $_POST[$ran];
		$id = $_POST[$id];
		$sql = "update $table set rank='$ran', ".$field."='$mod' where id='$id'";
		execsql($sql);
	}
}

if(!isset($add) || !isset($modify)) {
	if(!isset($add) && !isset($modify)) {
		$showlink = "<a class=info href=index.php?t=productproperties&property=".$property."&add=true>".$lang['add']."</a>, <a class=info href=index.php?t=productproperties&property=".$property."&modify=true>".$lang['modify']."</a>";
	} else if(!isset($add)) {
		$showlink = "<a class=info href=index.php?t=productproperties&property=".$property."&add=true>".$lang['add']."</a>";
	} else  {
		$showlink = "<a class=info href=index.php?t=productproperties&property=".$property."&modify=true>".$lang['modify']."</a>";
	}
} else {
	$showlink = "&nbsp;";
}

echo '
	<form action=index.php?t=productproperties&property='.$property.' method=post>
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
										<td class=info align=right>'.$showlink.'
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td class=back colspan=1>
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
						</tr>
						<tr>
							<td class=cat>
								'.$lang['there_are'].' '.$numberproperties.' '. $label[1] .'.
							</td>
						</tr>';
if(isset($add)) {
    // [12/12/2003 seh]
    // * See <home>/code/ticketproperties.php for comments
	echo '
						<tr>
							<td class=cat>
								<center>';
    //echo'                           <b>'.ucwords("new ".$label[0].":").'</b> <input type=text name=propertyname></input>';
    echo'                           <b>'.$fieldText.':</b> <input type=text name=propertyname></input>';
    echo'							</center>
							</td>
						</tr>';
    // [/seh]
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
	</form>';



function listProperties($modify, $table, $field, $property) {
	$sql = "select * from $table order by $field asc";
    // [12/12/2003 seh]
    global $lang;
    // [/seh]
	$result = execsql($sql);
	$i = 0;
	while($row = mysql_fetch_row($result)) {
		echo '
			<tr>
				<td class=back>';
		if(isset($modify)) {
			echo '
					<input type=hidden name=id'. $i .' value='. $row[0] .'>
					<input type=text name=property'. $i .' value="'. $row[1] .'">
					&nbsp;&nbsp;<a href=index.php?t=productproperties&property='.$property.'&action=delete&id='. $row[0] .'>'.$lang['delete'].'</a>';
		} else {
			echo '
				<b>'. $row[1] .'</b>';
		}
		echo '
				</td>
			</tr>';
		$i++;
	}
	return $i;
}

?>
