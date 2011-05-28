<?
if($_SESSION['USERID'] == "")
{
echo "<script language='javascript'>
<!--
window.location.href='index.php?page=home';
// -->
</script>";
}
else
{ 
?>
<script>
function OpenSupport()
{
	window.open("/support/livehelp.php");
}
</script>
<?
echo "<CENTER><BUTTON OnClick = OpenSupport()>Click here to open the Support Desk</BUTTON></CENTER>";
}
