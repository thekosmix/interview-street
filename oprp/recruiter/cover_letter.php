<?php  require_once("../_php/init_recruiter.php"); 

if(isset($_GET['id'])) $id = $_GET['id']; 
else redirect_to("index.php");

if(isset($_POST["submit"])){
	
	$application = new Application();
	$application->student_id = $id;
	$application->status = trim($_POST['status']);
	$application->notes  = trim($_POST['notes']); 
	
	$is_updated = Application::updateDetailByRec($application);
	
	if($is_updated)
		$msg = setErrNotMsg("Application Updated Successfully.");		
	else
		$msg = setErrMsg("Could not update the application. Please try later.");
}

$info = Application::getDetailBySR($id,$session->user_id); 
if(!$info) redirect_to("index.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php include("../_include/title.php"); ?> - Student's Cover Letter</title>
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
        <tr height="40px" valign="middle"><td class="contentLinks"><a href="cover_letter.php?id=<?php echo $id;?>">Cover Letter</a> |
        											  <a href="stud_per_profile.php?id=<?php echo $id;?>">Personal</a> | 
        											  <a href="stud_acad_profile.php?id=<?php echo $id;?>">Academic</a> | 
                                                      <a href="stud_pro_profile.php?id=<?php echo $id;?>">Extra Curricular</a></td></tr>
        <tr><td width="70%" valign="top">
        
            <table cellpadding="6" border="0" width="100%" class='normalTxt infotbl' >    
            
                <tr><td><label><strong>Application Date</strong></label></td>
                    <td><?php echo date("jS F Y",strtotime($info->app_date));?></td></tr>
                <tr class='seperator'><td colspan='2'>&nbsp;</td></tr>
                    
                <tr><td colspan='2'><strong>Cover Letter</strong></td></tr>
                <tr><td colspan='2'><span class="smallTxt"><?php echo nl2br($info->cover_letter);?></span></td></tr>
                <tr class='seperator'><td colspan='2'>&nbsp;</td></tr>
                    
                <form method='post' action=''>
                    <tr><td><strong>Status</strong></td>
                    	<td><select name="status">
                        	<option <?php if($info->status == 'Applied') echo "selected='selected'";?> >Applied</option>
                            <option <?php if($info->status == 'Pending') echo "selected='selected'";?> >Pending</option>
                            <option <?php if($info->status == 'Selected') echo "selected='selected'";?> >Selected</option>
                            <option <?php if($info->status == 'Rejected') echo "selected='selected'";?> >Rejected</option>
                        	</select>
                        </td></tr>
                    <tr><td><label><strong>Notes</strong><br/><span class="smallTxt">(Not Visible to Applicant)</span></label></td>
						<td><textarea name="notes" cols="30" rows="4"><?php echo $info->notes;?></textarea></td></tr>
                    <tr><td colspan='2' align="left"><input type="submit" name="submit" value="Update" class="submitStyle"/></td></tr>
                </form>
            
            </table>
            
        </td>
        
        <?php $image_type = Student::getImageTypeByID($id); ?>
        
        <td width="30%" valign="top" align="center">
            <img class="dp" width="150px" src="../student/_photo/<?php echo $id.".".$image_type;?>" 
                                          onerror="this.src='../student/_photo/default.jpg';"/>                           
        </td></tr>    
            
        </table>

    </td></tr>
</table>
                
                
<!--body close-->       
            
<?php include("../_include/footer.php"); ?>
</body>
</html>