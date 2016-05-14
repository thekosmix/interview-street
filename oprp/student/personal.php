<?php require_once("../_php/init_student.php"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php include("../_include/title.php"); ?> - Personal Profile</title>
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
        <tr height="40px" valign="middle"><td><span class="topicTxt">Personal Profile</span> 
        		<a href="edit_personal.php" title="Edit Profile">
                <img src="../_images/edit.png" hspace="10" align="middle" alt="Edit Profile" />
                </a></td>
        		<td align="right">&nbsp;</td></tr>
        <tr valign="top"><td width="70%">
        
            <table cellpadding="6" border="0" width="100%" class='normalTxt infotbl' >    
            <?php $info = Student::getDetailByID($session->user_id); 
            
                print_info("Roll No",$info->roll_no);
                print_info("Guardian's Name",$info->guardian_name);
                print_info("Local Address",nl2br($info->local_address));
                print_info("Permanent Address",nl2br($info->permanent_address));
                print_info("Phone (Primary)",$info->phone_1);
                print_info("Phone (Secondary)",$info->phone_2);
                print_info("Mobile",$info->mobile);
                print_info("Date of Birth",date("jS F Y",strtotime($info->dob)));
                print_info("Sex",$info->sex);
                print_info("Category",$info->category);
                print_info("Citizenship",$info->citizenship);
                print_info("Home Town",$info->home_town);
                print_info("Home State",$info->home_state);
                print_info("Language",$info->language);
                
            ?>
            </table>
            
        </td>
        <td width="30%" valign="top" align="center">
            <img class="dp" width="150px" src="_photo/<?php echo $session->user_id.".".$info->image_type;?>" 
                                          onerror="this.src='_photo/default.jpg';"/>
        </td></tr>
            
        </table>

    </td></tr>
</table>
                
                
<!--body close-->       
            
<?php include("../_include/footer.php"); ?>
</body>
</html>