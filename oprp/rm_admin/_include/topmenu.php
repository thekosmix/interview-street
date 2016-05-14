<tr height="30px"><td colspan="3">
    <table width="100%" border="0" cellspacing="0" cellpadding="5" class="topLinks">
    <tr>
        <td width="90%" class="topLinks"><label>Logged in as&nbsp;<strong style="color:#FFF">
                                <?php echo User::getUsernameByID($session->getUserID());?></strong></label></td>
        <td width="10%" align="center">
            <a href="../_php/logout.php">Logout</a>
        </td>
    </tr>
    </table>
</td></tr>
<tr height="10px"><td colspan="3">&nbsp;</td></tr>