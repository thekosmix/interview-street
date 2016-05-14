<tr height="30px"><td colspan="3">
<table width="100%" border="0" cellspacing="0" cellpadding="5" class="topLinks">
<tr valign="middle">
	<?php if(isset($session->user_id)) { ?>
	<td width="90%" class="topLinks"><label>Logged in as&nbsp;<strong style="color:#FFF">
		<?php if($session->isStudent()) echo Student::getFullNameByID($session->getUserID());
			  else echo Recruiter::getCompNameByID($session->getUserID()); ?>
                            </strong></label></td>
	<td width="10%" align="center">
    	<a href="../_php/logout.php">Logout</a>
    </td>
    <?php }else echo"<td>&nbsp;</td>"; ?>
</tr>
</table>
</td></tr>
<tr height="10px"><td colspan="3">&nbsp;</td></tr>