<?php  require_once("../_php/init_student.php"); ?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php include("../_include/title.php"); ?> - Extra Curricular Profile</title>
<?php include("../_include/design.php"); ?>

</head>

<body>
<?php include("../_include/header.php"); ?>
<?php include("_include/topmenu.php"); ?>
<?php include("_include/menu.php"); ?>
            
<!--body-->
            	
                
<table width="100%" cellpadding="0" cellspacing="20" border="0" align="center" class="normalTxt">

<?php if(isset($msg)) echo"<tr><td>{$msg}</td></tr>"; ?>       
    
    <tr><td>
    
        <table width="100%" cellpadding="0" cellspacing="10" border="0" align="left">
        <tr height="40px" valign="middle"><td><span class="topicTxt">Extra Curricular Profile</span>
        		<a href="edit_projects.php" title="Edit Profile"><img src="../_images/edit.png" hspace="10" align="middle" alt="Edit Profile" />
                </a></td></tr>
        <tr valign="top"><td width="70%">
        
            <table cellpadding="6" border="0" width="100%" class='normalTxt infotbl' >    
            <?php $info = Project::getDetailByID($session->user_id);
            
			if(!empty($info->career_objectives))
				echo"<tr class='highlighter'><td><label><strong>Career Objectives</strong></label></td></tr>  
				<tr><td><label>{$info->career_objectives}</label></td></tr>";
			
			if(!empty($info->training_1))
				echo"<tr class='seperator'><td>&nbsp;</td></tr>
            		 <tr class='highlighter'><td><label><strong>Trainings/Projects</strong></label></td></tr>  
					 <tr><td><label>{$info->training_1}</label></td></tr>";
					 
            if(!empty($info->training_2)) echo"<tr><td><label>{$info->training_2}</label></td></tr>";
            if(!empty($info->training_3)) echo"<tr><td><label>{$info->training_3}</label></td></tr>";
            if(!empty($info->training_4)) echo"<tr><td><label>{$info->training_4}</label></td></tr>";
            if(!empty($info->training_5)) echo"<tr><td><label>{$info->training_5}</label></td></tr>";
            if(!empty($info->training_6)) echo"<tr><td><label>{$info->training_6}</label></td></tr>";
            
			if(!empty($info->professional_society))
				echo"<tr class='seperator'><td>&nbsp;</td></tr>
                     <tr class='highlighter'><td><label><strong>Professional Society</strong></label></td></tr>  
            		 <tr><td><label>{$info->professional_society}</label></td></tr>";
            
			if(!empty($info->extra_curricular))
				echo"<tr class='seperator'><td>&nbsp;</td></tr>
                     <tr class='highlighter'><td><label><strong>Extra Curricular</strong></label></td></tr>  
            		 <tr><td><label>{$info->extra_curricular}</label></td></tr>";
            
			if(!empty($info->skills_tech))
				echo"<tr class='seperator'><td>&nbsp;</td></tr>
                     <tr class='highlighter'><td><label><strong>Technical Skills</strong></label></td></tr>  
            		 <tr><td><label>{$info->skills_tech}</label></td></tr>";
            
			if(!empty($info->skills_other))
				echo"<tr class='seperator'><td>&nbsp;</td></tr>
                     <tr class='highlighter'><td><label><strong>Other Skills</strong></label></td></tr>  
            		 <tr><td><label>{$info->skills_other}</label></td></tr>";
            
			if(!empty($info->hobbies))
				echo"<tr class='seperator'><td>&nbsp;</td></tr>
                     <tr class='highlighter'><td><label><strong>Hobbies</strong></label></td></tr>  
            		 <tr><td><label>{$info->hobbies}</label></td></tr>";
            ?>
            
            </table>
            
        </td>
        
        <?php $image_type = Student::getImageTypeByID($session->user_id); ?>
        
        <td width="30%" valign="top" align="center">
            <img class="dp" width="150px" src="_photo/<?php echo $session->user_id.".".$image_type;?>" 
                                          onerror="this.src='_photo/default.jpg';"/>                            
            
        </td></tr>
            
        </table>

    </td></tr>
</table>
                
                
<!--body close-->       
            
<?php include("../_include/footer.php"); ?>
</body>
</html>