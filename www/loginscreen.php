<?
include("../includes/config.php");
include("../includes/mysql.php");

$DbLink = new DB;

$DbLink->query("SELECT gridstatus,active,color,title,message  FROM ".C_INFOWINDOW_TBL." ");
list($GRIDSTATUS,$INFOBOX,$BOXCOLOR,$BOX_TITLE,$BOX_INFOTEXT) = $DbLink->next_record();


// Doing it the same as the Who's Online now part
$DbLink = new DB;
$DbLink->query("SELECT UserID, HomeRegionID FROM ".C_AGENTS_TBL." WHERE Online != 'False' ". 
				"ORDER BY login DESC");
$NOWONLINE = 0;
while(list($UUID,$regionUUID) = $DbLink->next_record())
{
	// Let's get the user info
	$DbLink2 = new DB;
	$DbLink2->query("SELECT FirstName, LastName from ".C_USERS_TBL." where PrincipalID = '".$UUID."'");
	list($firstname, $lastname) = $DbLink2->next_record();
	$username = $firstname." ".$lastname;
	// Let's get the region information
	$DbLink3 = new DB;
	$DbLink3->query("SELECT regionName from ".C_REGIONS_TBL." where UUID = '".$regionUUID."'");
	list($region) = $DbLink3->next_record();
	if ($region != "")
	{
	$NOWONLINE = $NOWONLINE + 1;
	}
}

$DbLink->query("SELECT count(*) FROM ".C_AGENTS_TBL." where login > UNIX_TIMESTAMP(FROM_UNIXTIME(UNIX_TIMESTAMP(now()) - 2419200))");
list($LASTMONTHONLINE) = $DbLink->next_record();
 
$DbLink->query("SELECT count(*) FROM ".C_USERS_TBL."");
list($USERCOUNT) = $DbLink->next_record();

$DbLink->query("SELECT count(*) FROM ".C_REGIONS_TBL."");
list($REGIONSCOUNT) = $DbLink->next_record();
		
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<TITLE><?=SYSNAME?> Login</TITLE>
<LINK href="loginscreen/style.css" type=text/css rel=stylesheet>
<SCRIPT src="loginscreen/resize.js" type=text/javascript></SCRIPT>
<SCRIPT src="loginscreen/imageswitch.js" type=text/javascript></SCRIPT>
<script src="loginscreen/need_new_version.js" type=text/javascript></SCRIPT>


<script>
	$(document).ready(function(){

	bgImgRotate();
	if ( document.getElementById('update_box') && (os != "" || channel != "" || version != "") )
	{
		var DLurl = get_url(os, channel, version);
		var version_info = $.ajax({ url: DLurl, async: false }).responseText.split("||");
		var DLurlString = "<a href='"+version_info[1]+"' target='_blank'>"+"Download Version "+version_info[0]+"</a>";
		var releaseNotesLink = "<a href='"+getReleaseNotesUrl(channel, version_info[0])+"' target='_blank'>"+"Read the release notes</a>";

				if(versionIsNewer(version_info[0], version) && (version_info[2]==true))
				{
					$.ajax({
						url: "/app/login/_includes/update_available_box.php?lang=en-US",
						cache: false,
						success: function(html){
							$("#update_box").append(html);
							$("#url").append(DLurlString);
							$("#release_notes").append(releaseNotesLink);
						}
					});
				}
				else if(versionIsNewer(version_info[0], version) && (version_info[2]==false))
				{
					$.ajax({
						url: "/app/login/_includes/update_required_box.php?lang=en-US",
						cache: false,
						success: function(html){
							$("#update_box").append(html);
							$("#url").append(DLurlString);
							$("#release_notes").append(releaseNotesLink);
						}
					});
				}
				else
				{
					$("#update_box").load("/app/login/_includes/blog_statusblog.php");
				}
	}

	$("#blog_box").show();
});

</script>

<DIV id=top_image><IMG 
src="images/login_screens/logo.png" >
</DIV>
<DIV id=bottom_left>
<?
include("loginscreen/special.php");
?>
<BR>
<DIV id=regionbox>
<? 
include("loginscreen/region_box.php"); 
?>
</DIV>
</DIV>

<IMG id=mainImage src="images/login_screens/spacer.gif"> 
<DIV id=bottom>
<DIV id=news>
<? include("loginscreen/news.php"); ?>
</DIV></DIV>
<DIV id=topright>
<br />
<DIV id="updatebox"></DIV>
<br />
<br />
<DIV id=gridstatus>
<? include("loginscreen/gridstatus.php"); ?>
</DIV>
<br />
<DIV id=Infobox>
<? 
if(($INFOBOX=="1")&&($BOXCOLOR=="white")){
include("loginscreen/box_white.php"); 
}else if(($INFOBOX=="1")&&($BOXCOLOR=="green")){
include("loginscreen/box_green.php"); 
}else if(($INFOBOX=="1")&&($BOXCOLOR=="yellow")){
include("loginscreen/box_yellow.php"); 
}else if(($INFOBOX=="1")&&($BOXCOLOR=="red")){
include("loginscreen/box_red.php"); 
}
?>
</DIV>
</DIV>
