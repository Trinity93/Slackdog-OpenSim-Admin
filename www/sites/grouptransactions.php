<?
if($_SESSION[USERID] == ""){
echo "<script language='javascript'>
<!--
window.location.href='index.php?page=home';
// -->
</script>";
}
else
{ 
?>
<link href="/css/site.css" rel="stylesheet" type="text/css">

<FORM method="post" action="index.php?page=transactions">
<input type="hidden" name="TIME" value="<?=$TIME?>" />
<br />
<table width="90%" height="90%" border="0" align="center" cellpadding="5" cellspacing="0">
    <tr>
      <td bgcolor="#FFFFFF"><table cellspacing="0" cellpadding="0">
        <tr>
          <td align="left" class="style7"><span class="style8">Transaction History </span></td>
          <td align="right" class="style7"><span class="style9"></span></td>
        </tr>
        <tr>
          <td colspan="5" class="style7"><span class="style9">These are L$ transactions for the groups you are an owner from</span></td>
        </tr>
      </table>
	</tr>
</table>
<?
}