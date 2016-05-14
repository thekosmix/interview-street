<?php  require_once("../_php/init_rmadmin.php");

if(isset($_GET['id'])) $id = $_GET['id'];
else redirect_to("index.php");

if(isset($_POST["submit"])){
			
	$project = new Project();
	$project->training_1 			= trim($_POST['training_1']);
	$project->training_2 			= trim($_POST['training_2']); 
	$project->training_3 			= trim($_POST['training_3']); 
	$project->training_4 			= trim($_POST['training_4']); 
	$project->training_5			= trim($_POST['training_5']); 
	$project->training_6 			= trim($_POST['training_6']); 
	$project->professional_society 	= trim($_POST['professional_society']); 
	$project->extra_curricular 		= trim($_POST['extra_curricular']);
	$project->career_objectives 	= trim($_POST['career_objectives']);
	$project->skills_tech 			= trim($_POST['skills_tech']);
	$project->skills_other 			= trim($_POST['skills_other']); 
	$project->hobbies 				= trim($_POST['hobbies']); 
	
	$is_updated = Project::updateAllDetailByID($project,$id);
	
	if($is_updated)
		$msg = setErrNotMsg("Profile has been updated.".$imgst);		
	else
		$msg = setErrMsg("Profile could not be updated due to some technical issues. Please try later.".$imgst);
}

$info = Project::getDetailByID($id);
if(!$info) redirect_to("index.php");

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php include("../_include/title.php"); ?> - Edit Extra Curricular Profile</title>
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
            <a href="stud_pro_profile.php?id=<?php echo $id;?>">Extra Curricular</a></td></tr>
        <tr><td width="100%">
        
            <form action="" method="post" enctype="multipart/form-data">                       
            <table cellpadding="10" border="0" width="100%" class="normalTxt infotbl" cellspacing="0">    
            <?php 
            
                print_area("Career Objectives","career_objectives",$info->career_objectives);
                print_area("Training/Project 1","training_1",$info->training_1);
                print_area("Training/Project 2","training_2",$info->training_2);
                print_area("Training/Project 3","training_3",$info->training_3);
                print_area("Training/Project 4","training_4",$info->training_4);
                print_area("Training/Project 5","training_5",$info->training_5);
                print_area("Training/Project 6","training_6",$info->training_6);
                print_area("Professional Society","professional_society",$info->professional_society);
                print_area("Extra Curricular","extra_curricular",$info->extra_curricular);
                print_area("Technical Skills","skills_tech",$info->skills_tech);
                print_area("Other Skills","skills_other",$info->skills_other);
                print_area("Hobbies","hobbies",$info->hobbies);
                
                ?>
                    
                <tr height="50"><td colspan="2"><input type="submit" class="submitStyle" name="submit" value="Update" />
                    </td></tr>
                        
            </table>
            </form>
            
        </td>
        <td width="0%" valign="top" align="center">&nbsp;
           
            
        </td>
        </tr>
            
        </table>

    </td></tr>
</table>
                
                
<!--body close-->       
            
<?php include("../_include/footer.php"); ?>
</body>
</html>