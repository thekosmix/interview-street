<?php  require_once("../_php/init_rmadmin.php"); 

if(isset($_GET['id'])){
	
	$id = $_GET['id'];
	$info = Student::getDetailByID($id); 
	if(!$info) redirect_to("index.php");
	$email = User::getDetailByID($id)->email;
	
}else redirect_to("index.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php include("../_include/title.php"); ?> - Student's Personal Profile</title>
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
        <tr height="40px" valign="middle"><td class="contentLinks">
        	<a href="stud_per_profile.php?id=<?php echo $id;?>">Personal</a> | 
            <a href="stud_acad_profile.php?id=<?php echo $id;?>">Academic</a> | 
            <a href="stud_pro_profile.php?id=<?php echo $id;?>">Extra Curricular</a>
            <a href="edit_stud_personal.php?id=<?php echo $id; ?>" title="Edit Personal Profile">
            <img src="../_images/edit.png" hspace="10" align="middle" alt="Edit Personal Profile" />
            </a></td></tr>
        <tr valign="top"><td width="70%">
        
            <table cellpadding="6" border="0" width="100%" class='normalTxt infotbl' >    
            <?php 
            
                print_info("Roll No",$info->roll_no);
                print_info("First Name",$info->first_name);
                print_info("Middle Name",$info->middle_name);
                print_info("Last Name",$info->last_name);
                print_info("Local Address",nl2br($info->local_address));
                print_info("Mobile",$info->mobile);
                print_info("Email",$email);
                print_info("Permanent Address",nl2br($info->permanent_address));
                print_info("Phone (Primary)",$info->phone_1);
                print_info("Phone (Secondary)",$info->phone_2);
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
            <img class="dp" width="150px" src="../student/_photo/<?php echo $id.".".$info->image_type;?>" 
                                          onerror="this.src='../student/_photo/default.jpg';"/>
        </td></tr>
            
        </table>

    </td></tr>
</table>
                
                
<!--body close-->       
            
<?php include("../_include/footer.php"); ?>
</body>
</html>