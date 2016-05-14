<?php require_once("../_php/init_rmadmin.php"); 

if(isset($_GET['id'])){
	
	$id = $_GET['id'];
	$info = Recruiter::getDetailByID($id); 
	if(!$info)
		redirect_to("index.php");
	
}else redirect_to("index.php");

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php include("../_include/title.php"); ?> - Recruiter's Profile</title>
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
        <tr height="40px" valign="middle"><td colspan="2"><span class="topicTxt">Company Profile</span>
        		<a href="edit_recruiter.php?id=<?php echo $id; ?>" title="Edit Profile">
                <img src="../_images/edit.png" hspace="10" align="middle" alt="Edit Profile" />
                </a></td></tr>
        <tr valign="top"><td width="100%">
        
            <table cellpadding="6" border="0" width="100%" class='normalTxt infotbl' >    
            <?php 
                
                if(!empty($info->logo_url)){
                    echo"<tr class='seperator'><td colspan='2'><img class='logo_img' src='".$info->logo_url."' /></td></tr>";
                    echo"<tr class='seperator'><td colspan='2'>&nbsp;</td></tr>";
                }
                
                if(!empty($info->arrival_date)) 
					print_info("Arrival Date",date("l, jS F Y",strtotime($info->arrival_date)));
				print_info("Grade",$info->grade);
                print_info("Company Name",$info->name);
                print_info("Description",$info->description);
				if(!empty($info->app_date)) 
					print_info("Last Application Date",date("l, jS F Y (h:i:s A)",strtotime($info->app_date)));
                print_info("Branches",Branch::getNamesByArray(str_to_arr($info->branches)));
                print_info("Min Score",$info->min_score);
                print_info("For Year",$info->for_year);
                print_info("Job Description",$info->job_description);
                print_info("Notes",$info->notes);
                print_info("Website",$info->website);								
				
            ?>
            <tr class="seperator"><td>&nbsp;</td></tr>
            <tr class="seperator"><td colspan="2" class="contentLinks">
            	<a href="app_detail.php?id=<?php echo $id; ?>">View Applications</a></td></tr>
            </table>
           
        </td></tr>
            
        </table>

    </td></tr>
</table>

<!--body close-->       
            
<?php include("../_include/footer.php"); ?>
</body>
</html>