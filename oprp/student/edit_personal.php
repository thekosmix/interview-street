<?php  require_once("../_php/init_student.php"); 

if(isset($_POST["submit"])){
	
	if(checkIMG($_FILES['dpic'])){
		$file_uploaded = uploadFile("_photo/",$_FILES['dpic'],$session->user_id);
		if(!$file_uploaded)
		    $imgst = " Image cannot be uploaded.";
	}
			
	$student = new Student();
	$student->first_name 		= trim($_POST['first_name']);
	$student->middle_name 		= trim($_POST['middle_name']);
	$student->last_name 		= trim($_POST['last_name']);
	$student->dob 				= trim($_POST['dob']);
	$student->sex 				= trim($_POST['sex']);
	$student->category 			= trim($_POST['category']);
	$student->guardian_name 	= trim($_POST['guardian_name']);
	$student->local_address 	= trim($_POST['local_address']); 
	$student->permanent_address = trim($_POST['permanent_address']); 
	$student->phone_1 			= trim($_POST['phone_1']); 
	$student->phone_2			= trim($_POST['phone_2']); 
	$student->mobile 			= trim($_POST['mobile']); 
	$student->dob 				= trim($_POST['dob']); 
	$student->sex 				= trim($_POST['sex']);
	$student->category 			= trim($_POST['category']);
	$student->citizenship 		= trim($_POST['citizenship']);
	$student->home_town 		= trim($_POST['home_town']); 
	$student->home_state 		= trim($_POST['home_state']); 
	$student->language 			= trim($_POST['language']);
	
	if($file_uploaded){
		$path_info = pathinfo($_FILES['dpic']['name']);
		$student->image_type = $path_info['extension'];
	}else
		$student->image_type = $_POST['image_type']; 
	
	$is_updated = Student::updateDetailByID($student);
	
	if($is_updated)
		$msg = setErrNotMsg("Personal profile has been updated.".$imgst);		
	 else
		$msg = setErrMsg("Personal profile could not be updated due to some technical issues. Please try later.".$imgst);
}



?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php include("../_include/title.php"); ?> - Edit Personal Profile</title>
<?php include("../_include/design.php"); ?>
<script>
$(function() {
	$( "#dob" ).datepicker({dateFormat: "yy-mm-dd"});
});
</script>
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
        <tr height="40px" valign="middle"><td><span class="topicTxt">Edit Personal Profile</span></td></tr>
        <tr><td width="70%">
        
            <form action="" method="post" enctype="multipart/form-data">                       
            <table cellpadding="6" border="0" width="100%" class="normalTxt infotbl">    
            <?php $info = Student::getDetailByID($session->user_id); ?>
            
                <tr><td width='40%'><label><strong>First Name</strong></label></td>
                    <td><input type="text" id="first_name" name="first_name" value="<?php echo $info->first_name;?>"/>
                    </td></tr>
                    
                <tr><td width='40%'><label><strong>Middle Name</strong></label></td>
                    <td><input type="text" id="middle_name" name="middle_name" value="<?php echo $info->middle_name;?>"/>
                    </td></tr>
                
                <tr><td width='40%'><label><strong>Last Name</strong></label></td>
                    <td><input type="text" id="last_name" name="last_name" value="<?php echo $info->last_name;?>"/>
                    </td></tr>
                    
                <tr><td width='40%'><label><strong>Date of Birth</strong><br/><span class="smallTxt">(YYYY-MM-DD)</span></label></td>
                    <td><input type="text" id="dob" name="dob" value="<?php echo $info->dob;?>"/>
                    </td></tr>
                    
                <tr><td width='40%'><label><strong>Sex</strong></label></td>
                    <td><input type="radio" id="sex" name="sex" value="Male" 
						<?php if($info->sex=="Male") echo "checked='checked'";?> /> Male &nbsp;&nbsp;&nbsp;
                        <input type="radio" id="sex" name="sex" value="Female" 
						<?php if($info->sex=="Female") echo "checked='checked'";?> /> Female
                    </td></tr>
                
                <tr><td width='40%'><label><strong>Category</strong></label></td>
                    <td><input type="text" id="category" name="category" value="<?php echo $info->category;?>"/>
                    </td></tr>
                    
                <tr><td width='40%'><label><strong>Guardian's Name</strong></label></td>
                    <td><input type="text" id="guardian_name" name="guardian_name" value="<?php echo $info->guardian_name;?>"/>
                    </td></tr>
                    
                <tr><td><label><strong>Local Address</strong></label></td>
                    <td><textarea cols="25" rows="3" id="local_address" name="local_address"><?php echo $info->local_address;?></textarea>
                    </td></tr>
                    
                <tr><td><label><strong>Permanent Address</strong></label></td>
                    <td><textarea cols="25" rows="3" id="permanent_address" 
                    	name="permanent_address"><?php echo $info->permanent_address;?></textarea>
                    </td></tr>
                
                <tr><td><label><strong>Phone (Primary)</strong></label></td>
                    <td><input type="text" id="phone_1" name="phone_1" value="<?php echo $info->phone_1;?>"/>
                    </td></tr>
                    
                <tr><td><label><strong>Phone (Secondary)</strong></label></td>
                    <td><input type="text" id="phone_2" name="phone_2" value="<?php echo $info->phone_2;?>"/>
                    </td></tr> 
                    
                <tr><td><label><strong>Mobile</strong></label></td>
                    <td><input type="text" id="mobile" name="mobile" value="<?php echo $info->mobile;?>"/>
                    </td></tr> 
                
                <tr><td><label><strong>Home Town</strong></label></td>
                    <td><input type="text" id="home_town" name="home_town" value="<?php echo $info->home_town;?>"/>
                    </td></tr> 
                
                <tr><td><label><strong>Home State</strong></label></td>
                    <td><input type="text" id="home_state" name="home_state" value="<?php echo $info->home_state;?>"/>
                    </td></tr> 
                    
                <tr><td><label><strong>Language</strong></label></td>
                    <td><input type="text" id="language" name="language" value="<?php echo $info->language;?>"/>
                    </td></tr>
                    
                <tr><td><label><strong>Upload Image</strong></label></td>
                    <td><input type="hidden" name="image_type" value="<?php echo $info->image_type;?>" />
                        <input type="file" id="dpic" name="dpic"/>
                        <br/><br/><span class="smallTxt">(File must be of type jpg/bmp/png/gif and size less then 1MB)</span>
                    
                    </td></tr>
                    
                <tr height="50"><td colspan="2"><input type="submit" class="submitStyle" name="submit" value="Update" />
                    </td></tr>
                        
            </table>
            </form>
            
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