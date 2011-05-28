<script>
function OpenAgent(firstname, lastname)
{
	locate = "app/agent/?first="+firstname+"&last="+lastname
	window.open(locate,'mywindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=no,width=800,height=400')
}
</script>

<DIV style="height:100%">
<br />
<table width="80%" border="0" align="center" cellpadding="3" cellspacing="0" bgcolor="#CCCC00">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="10">
      <tr>
        <td bgcolor="#FFFFFF">
          <div align="center"><b>This shows all the users that are online at <?=SYSNAME?> at this moment.<br>(Note: Also users that have crashed will be in this list)</b></div></td>
      </tr>
    </table></td>
  </tr>
</table>
&nbsp;
<CENTER>
<TABLE width="80%" border=0 align=center cellpadding="0" cellspacing="0">
  <TBODY>
    <TR>
      <TD width="25" background="images/main/regions_left.gif">&nbsp;</TD>
      <TD width="221" height="40" valign="bottom" background="images/main/regions_middle.jpg">
	  <b>User Name:</b></a></TD>
      <TD width="178" valign="bottom" background="images/main/regions_middle.jpg">
	  <b>Region:</b></a></TD>
      <TD width="175" valign="bottom" background="images/main/regions_middle.jpg">
	  <b>&nbsp;</b></a></TD>
      <TD width="195" valign="bottom" background="images/main/regions_middle.jpg"><b>Info</b></TD>
      <TD width="25" background="images/main/regions_right.gif">&nbsp;</TD>
    </TR>
    <TR>
      <TD bgcolor="#FFFFFF">&nbsp;</TD>
      <TD colspan="4" bgcolor="#FFFFFF"><hr /></TD>
        <TD bgcolor="#FFFFFF">&nbsp;</TD>
    </TR>

<?
        $w=0;
	$DbLink = new DB;
	$DbLink->query("SELECT UUID, currentRegion FROM ".C_AGENTS_TBL." where agentOnline = 1 AND ". 
					"logintime < (UNIX_TIMESTAMP(FROM_UNIXTIME(UNIX_TIMESTAMP(now())))) AND ".
					"logoutTime < (UNIX_TIMESTAMP(FROM_UNIXTIME(UNIX_TIMESTAMP(now())))) ".
					"ORDER BY logintime DESC");
	while(list($UUID,$regionUUID) = $DbLink->next_record())
	{
                $w++;
		// Let's get the user info
		$DbLink2 = new DB;
		$DbLink2->query("SELECT username, lastname from ".C_USERS_TBL." where UUID = '".$UUID."'");
		list($firstname, $lastname) = $DbLink2->next_record();
		$username = $firstname." ".$lastname;
		// Let's get the region information
		$DbLink3 = new DB;
		$DbLink3->query("SELECT regionName from ".C_REGIONS_TBL." where UUID = '".$regionUUID."'");
		list($region) = $DbLink3->next_record();
		if ($region != "")
		{
			echo '<TR style="BACKGROUND-COLOR: ';
    			if ($w==2) {$w=0; echo'#e8e0c5';} else {echo'#e8eff5';}
			echo '">';
			echo '<TD bgcolor="#FFFFFF">&nbsp;</TD>';
			echo '<TD><DIV style="COLOR: #000000"><B>'.$username.'</B></DIV></TD>';
			echo '<TD><DIV style="COLOR: #ff0000"><B>'.$region.'</B></DIV></TD>';
			echo '<TD><DIV style="COLOR: #339900"><B>&nbsp;</B></DIV></TD>';
			echo "<TD><DIV style=\"COLOR: #9966ff\"><A style=\"cursor:pointer\" onClick=\"OpenAgent('".$firstname."','".$lastname."')\"><B><u>Click for more Info</u></B></A></DIV></TD>";
			echo '<TD bgcolor="#FFFFFF">&nbsp;</TD>';
			echo '</TR>';
		}
	}
?>
      <TR>
        <TD bgcolor="#FFFFFF">&nbsp;</TD>
        <TD colspan="4" bgcolor="#FFFFFF"><hr /></TD>
          <TD bgcolor="#FFFFFF">&nbsp;</TD>
      </TR>
      <TR>
      <TD height="40" background="images/main/regions_d_left.gif">&nbsp;</TD>
      <TD background="images/main/regions_d_middle.jpg">&nbsp;</TD>
      <TD background="images/main/regions_d_middle.jpg">&nbsp;</TD>
      <TD background="images/main/regions_d_middle.jpg">&nbsp;</TD>
      <TD background="images/main/regions_d_middle.jpg">&nbsp;</TD>
      <TD background="images/main/regions_d_right.gif">&nbsp;</TD>
    </TR>
    </TBODY>
  </TABLE>
</CENTER>
</DIV>

<?


$DbLink->query("SELECT count(*) FROM ".C_AGENTS_TBL." where agentOnline = 1 and 
logintime > (UNIX_TIMESTAMP(FROM_UNIXTIME(UNIX_TIMESTAMP(now()) - 86400)))");
list($NOWONLINE) = $DbLink->next_record();
