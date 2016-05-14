<div align="center" id="back">
<div id="header"></div>
<div id="subheader"></div>
<div id="container">
<table cellspacing="0" cellpadding="0" border="0" width="950px" align="left">



<tr height="100px" align="left" valign="middle">
<td colspan="3">
    <table cellpadding="0" cellspacing="0" border="0">
    <tr>
        <td width="506px"><a href="<?php echo ABS_PATH;?>"><img src="<?php echo ABS_PATH;?>_images/logo.png" height="90%"/></a></td>        <td width="148px"><a href="<?php echo ABS_PATH;?>online_compiler/index.php" title="Online Compiler">
        	<img src="<?php echo ABS_PATH;?>_images/top_images/c.jpg" /></a></td>
        
        <?php if($session->isStudent()) { ?>
        <td width="148px"><a href="<?php echo ABS_PATH;?>student/index.php" title="Recruitment">
        	<img src="<?php echo ABS_PATH;?>_images/top_images/a.jpg"/></a></td>
        <?php }else if($session->isRecruiter()) { ?>
        <td width="148px"><a href="<?php echo ABS_PATH;?>recruiter/index.php" title="Recruitment">
        	<img src="<?php echo ABS_PATH;?>_images/top_images/a.jpg"/></a></td>
        <?php }else if($session->isRMadmin()){ ?>
        <td width="148px"><a href="<?php echo ABS_PATH;?>rm_admin/index.php" title="Recruitment">
        	<img src="<?php echo ABS_PATH;?>_images/top_images/a.jpg"/></a></td>
        <?php }else { ?>
        <td width="148px"><img src="<?php echo ABS_PATH;?>_images/top_images/a.jpg"/></td>
        <?php } ?>
        
        <?php if($session->isStudent()) { ?>   
        <td width="148px"><a href="<?php echo ABS_PATH;?>student/forum.php" title="Forum">
        	<img src="<?php echo ABS_PATH;?>_images/top_images/b.jpg" /></a></td>
        <?php }else { ?>
        <td width="148px">
        	<img src="<?php echo ABS_PATH;?>_images/top_images/b.jpg" /></a></td>
        <?php } ?>
            
    </tr>
    </table>
</td>
</tr>
