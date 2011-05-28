<?

/*
 * Copyright (c) 2007, 2008 Contributors, http://opensimulator.org/
 * See CONTRIBUTORS for a full list of copyright holders.
 *
 * See LICENSE for the full licensing terms of this file.
 *
*/

?>
<script language="JavaScript">
<!--
function Form(theForm)
{

  if (theForm.logfirstname.value == "")
  {
    alert("Please enter your \"Firstname\" ");
    theForm.logfirstname.focus();
    return (false);
  }
  
  if (theForm.loglastname.value == "")
  {
    alert("Please enter your \"Lastname\" ");
    theForm.loglastname.focus();
    return (false);
  }

  if (theForm.logpassword.value == "")
  {
    alert("Please enter your \"Password\" ");
    theForm.logpassword.focus();
    return (false);
  }

  return (true);
}
//-->
</script>

<style type="text/css">
<!--
.box {font-size: 12px;height: 20;width: 100;}
.Stil12 {font-size: 14px; font-family: Verdana, Arial, Helvetica, sans-serif}
.style1 {font-size: 14px; font-family: Verdana, Arial, Helvetica, sans-serif; color: #FFFFFF; }
-->
</style>
<form action="index.php" method="POST" onSubmit="return Form(this)">
<table width="196" border="0" align="center" cellpadding="0" cellspacing="0" background="../images/main/login_user.gif">
      <tr>
        <td class="style2">&nbsp;</td>
      </tr>
      <tr>
	    <td class="boxspace">.</td>
        </tr>
      <tr>
        <td><div align="center"><span class="style1">Firstname</span></div></td>
      </tr>
      <tr>
        <td><div align="center">
          <input name="logfirstname" type="text" class="box" value="<?=$_POST['logfirstname']?>" />
        </div></td>
      </tr>
      <tr>
        <td><div align="center"><span class="style1">Lastname</span></div></td>
      </tr>
      <tr>
        <td><div align="center">
          <input name="loglastname" type="text" class="box" value="<?=$_POST['loglastname']?>" />
        </div></td>
      </tr>
      <tr>
        <td><div align="center"><span class="style1">Password</span></div></td>
      </tr>
      <tr>
        <td><div align="center">
          <input type="password" name="logpassword" class="box"/>
        </div></td>
      </tr>
      <tr>
        <td><div align="center"><a style="color:#FFFFFF; font-size:13px" href="index.php?page=forgotpass">Forgot my Password</a></div></td>
      </tr>
      <tr>
        <td><div align="center">
          <input style="cursor:pointer" type="submit" name="Submit" value="Login" />
        </div></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
	  </form>
    </table>
</form>
