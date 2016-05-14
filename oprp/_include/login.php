<tr valign="top">
<td width="200px" bgcolor="#dddddd">

<div id="loginbox">
                	<form name="loginForm" id="loginForm" method="post" action="index.php">
                        <table width="100%" cellspacing="5" cellpadding="0" border="0">
                        
						<?php if(isset($login_err)) echo"<tr><td>{$login_err}</td></tr>"; ?>
                        
                        <tr height="18px"><td class="smallTxt" valign="bottom" colspan="2"><label>Username</label></td></tr>
                        <tr><td colspan="2"><input name="uname" type="text" size="15"/></td></tr>
                        <tr height="18px"><td class="smallTxt" valign="bottom" colspan="2"><label>Password</label></td></tr>
                        <tr><td colspan="2"><input name="passw" type="password" size="15"/></td></tr>
                        <tr height="28px"><td valign="bottom" colspan="2"><input name="submit" type="submit" value="Login" class="submitStyle" />
                               </td></tr>
                        <tr height="30px">
                          <td class="smallTxt" valign="bottom" colspan="2"><a href="forgot.php">Forgot Password ?</a></td></tr>
                        </table>
                    </form>
</div>

</td>
            
<td width="20px">
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
</td>
            
<td width="730px" bgcolor="#dddddd" valign="top">            	