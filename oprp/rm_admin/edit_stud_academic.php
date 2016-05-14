<?php  require_once("../_php/init_rmadmin.php"); 

if(isset($_GET['id'])) $id = $_GET['id'];
else redirect_to("index.php");
$course = Student::getCourseByID($id);

if(isset($_POST["submit"])){
	
	if($_FILES['img_10']['size'] < 1000000){
		$file_uploaded_10 = uploadFile("../student/_marksheet_10/",$_FILES['img_10'],$id);
		if($file_uploaded_10)
		    $msg = " Doc was uploaded successfully.";
	}
	
	if($_FILES['img_12']['size'] < 1000000){
		$file_uploaded_12 = uploadFile("../student/_marksheet_12/",$_FILES['img_12'],$id);
		if($file_uploaded_12)
		    $msg = " Doc was uploaded successfully.";
	}
	
	
	if($course == 'be'){ $student = new Academics_BE(); }
	else if($course == 'me'){ $student = new Academics_ME(); }
	else if($course == 'mba'){ $student = new Academics_MBA(); }
	
	$student->sem_1 		= trim($_POST['sem_1']);
	$student->sem_2 		= trim($_POST['sem_2']);
	$student->sem_3 		= trim($_POST['sem_3']);
	$student->sem_4 		= trim($_POST['sem_4']);
	
	if($course == 'be'){
		$student->sem_5 		= trim($_POST['sem_5']);
		$student->sem_6 		= trim($_POST['sem_6']);
		$student->sem_7 		= trim($_POST['sem_7']);
		$student->sem_8 		= trim($_POST['sem_8']);
	}
	
	$student->agg 			= trim($_POST['agg']);
	$student->dept_rank 	= trim($_POST['dept_rank']);
	$student->backlog 		= trim($_POST['backlog']);
	$student->backlog_reason= trim($_POST['backlog_reason']);
	$student->entrance 		= trim($_POST['entrance']);
	$student->entrance_category = trim($_POST['entrance_category']);
	$student->rank 			= trim($_POST['rank']);
	$student->school_10 	= trim($_POST['school_10']);
	$student->board_10 		= trim($_POST['board_10']); 
	$student->year_10 		= trim($_POST['year_10']); 
	$student->subject_10 	= trim($_POST['subject_10']); 
	$student->agg_10		= trim($_POST['agg_10']); 
	$student->school_12 	= trim($_POST['school_12']); 
	$student->board_12 		= trim($_POST['board_12']); 
	$student->year_12 		= trim($_POST['year_12']);
	$student->subject_12 	= trim($_POST['subject_12']);
	$student->agg_12 		= trim($_POST['agg_12']);
	
	if($file_uploaded_10){
		$path_info_10 = pathinfo($_FILES['img_10']['name']);
		$student->img_10 = $path_info_10['extension'];
	}else $student->img_10 = $_POST['image_type_10']; 
	
	if($file_uploaded_12){
		$path_info_12 = pathinfo($_FILES['img_12']['name']);		
		$student->img_12 = $path_info_12['extension'];		
	}else $student->img_12 = $_POST['image_type_12']; 
	
	if($course != 'be'){
		$student->grad_course	= trim($_POST['grad_course']); 
		$student->grad_univ		= trim($_POST['grad_univ']); 
		$student->grad_field	= trim($_POST['grad_field']); 
		$student->grad_year		= trim($_POST['grad_year']); 
		$student->grad_agg		= trim($_POST['grad_agg']); 
		$student->grad_sub		= trim($_POST['grad_sub']);
		
		if($_FILES['grad_doc']['size'] < 1000000){
		$file_uploaded_grad = uploadFile("_grad_doc/",$_FILES['grad_doc'],$id);
		if($file_uploaded_grad)
		    $msg = " Doc was uploaded successfully.";
		}
		
		if($file_uploaded_grad){
				$path_info_grad = pathinfo($_FILES['grad_doc']['name']);
				$student->grad_doc = $path_info_grad['extension'];
			}else $student->grad_doc = $_POST['grad_doc_type'];
	}
			
	if($course == 'be'){ $is_updated = Academics_BE::updateAllDetailbyID($student,$id); }
	else if($course == 'me'){ $is_updated = Academics_ME::updateAllDetailbyID($student,$id); }
	else if($course == 'mba'){ $is_updated = Academics_MBA::updateAllDetailbyID($student,$id); }
	
	if($is_updated) $msg = "Profile has been updated.".$msg;		
	// else $msg = setErrMsg("Personal profile could not be updated due to some technical issues. Please try later.".$imgst);
	
	if(isset($msg)) $msg = setErrNotMsg($msg);	
}

switch($course){
	case 'be': $info = Academics_BE::getDetailByID($id); break;
	case 'me': $info = Academics_ME::getDetailByID($id); break;
	case 'mba': $info = Academics_MBA::getDetailByID($id); break;
} 
if(!$info) redirect_to("index.php");

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php include("../_include/title.php"); ?> - Edit Academic Profile</title>
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
        <tr><td width="70%">
        
            <form action="" method="post" enctype="multipart/form-data">                       
            <table cellpadding="6" border="0" width="100%" class="normalTxt infotbl">    
                
                <tr class='highlighter'><td colspan='2'><label><strong>College Record</strong></label></td></tr>  
                
                <tr><td width='40%'><label><strong>Sem I</strong></label></td>
                    <td><input type="text" id="sem_1" name="sem_1" value="<?php echo $info->sem_1;?>"/>
                    </td></tr>
                    
                <tr><td width='40%'><label><strong>Sem II</strong></label></td>
                    <td><input type="text" id="sem_2" name="sem_2" value="<?php echo $info->sem_2;?>"/>
                    </td></tr>
                    
                <tr><td width='40%'><label><strong>Sem III</strong></label></td>
                    <td><input type="text" id="sem_3" name="sem_3" value="<?php echo $info->sem_3;?>"/>
                    </td></tr>
                
                <tr><td width='40%'><label><strong>Sem IV</strong></label></td>
                    <td><input type="text" id="sem_4" name="sem_4" value="<?php echo $info->sem_4;?>"/>
                    </td></tr>
                
                <?php if($course == 'be'){ ?>
                
                <tr><td width='40%'><label><strong>Sem V</strong></label></td>
                    <td><input type="text" id="sem_5" name="sem_5" value="<?php echo $info->sem_5;?>"/>
                    </td></tr>
                
                <tr><td width='40%'><label><strong>Sem VI</strong></label></td>
                    <td><input type="text" id="sem_6" name="sem_6" value="<?php echo $info->sem6;?>"/>
                    </td></tr>
                    
                <tr><td width='40%'><label><strong>Sem VII</strong></label></td>
                    <td><input type="text" id="sem_7" name="sem_7" value="<?php echo $info->sem_7;?>"/>
                    </td></tr>
                    
                <tr><td width='40%'><label><strong>Sem VIII</strong></label></td>
                    <td><input type="text" id="sem_8" name="sem_8" value="<?php echo $info->sem_8;?>"/>
                    </td></tr>
                
                <?php } ?>
                    
                <tr><td width='40%'><label><strong>Aggregate</strong></label></td>
                    <td><input type="text" id="agg" name="agg" value="<?php echo $info->agg;?>"/>
                    </td></tr>
                    
                <tr><td width='40%'><label><strong>Dept Rank</strong></label></td>
                    <td><input type="text" id="dept_rank" name="dept_rank" value="<?php echo $info->dept_rank;?>"/>
                    </td></tr>
                    
                <tr><td width='40%'><label><strong>Backlog</strong></label></td>
                    <td><input type="text" id="backlog" name="backlog" value="<?php echo $info->backlog;?>"/>
                    </td></tr>
                    
    			<tr><td colspan='2'><strong>Reason of Backlog</strong><br/>
                	<textarea cols='50' rows='4' id='backlog_reason' name='backlog_reason'><?php echo $info->backlog_reason; ?>
                    </textarea>
                    </td></tr>
                    
                <tr class='seperator'><td colspan='2'>&nbsp;</td></tr>           	

                <tr class='highlighter'><td colspan='2'><label><strong>Entrance</strong></label></td></tr>  
                <tr><td width='40%'><label><strong>Entrance Exam</strong></label></td>
                    <td><input type="text" id="entrance" name="entrance" value="<?php echo $info->entrance;?>"/>
                    </td></tr>
                    
                <tr><td width='40%'><label><strong>Entrance Category</strong></label></td>
                    <td><input type="text" id="entrance_category" name="entrance_category" value="<?php echo $info->entrance_category;?>"/>
                    </td></tr>
                    
                <tr><td width='40%'><label><strong>Rank</strong></label></td>
                    <td><input type="text" id="rank" name="rank" value="<?php echo $info->rank;?>"/>
                    </td></tr>
                    
                <tr class='seperator'><td colspan='2'>&nbsp;</td></tr>           	
                
                <tr class='highlighter'><td colspan='2'><label><strong>Class X</strong></label></td></tr>  
                <tr><td width='40%'><label><strong>School</strong></label></td>
                    <td><input type="text" id="school_10" name="school_10" value="<?php echo $info->school_10;?>"/>
                    </td></tr>
                    
                <tr><td width='40%'><label><strong>Board</strong></label></td>
                    <td><input type="text" id="board_10" name="board_10" value="<?php echo $info->board_10;?>"/>
                    </td></tr>
                    
                <tr><td width='40%'><label><strong>Passout Year</strong></label></td>
                    <td><input type="text" id="year_10" name="year_10" value="<?php echo $info->year_10;?>"/>
                    </td></tr>                                                                        
                    
                <tr><td><label><strong>Subjects</strong></label></td>
                    <td><textarea cols="25" rows="3" id="subject_10" name="subject_10"><?php echo $info->subject_10;?></textarea>
                    </td></tr>
                    
                <tr><td width='40%'><label><strong>Aggregate</strong></label></td>
                    <td><input type="text" id="agg_10" name="agg_10" value="<?php echo $info->agg_10;?>"/>
                    </td></tr>   
                    
                <tr><td><label><strong>Upload Marksheet</strong></label></td>
                    <td><input type="hidden" name="image_type_10" value="<?php echo $info->img_10;?>" />
                        <input type="file" id="img_10" name="img_10"/>
                        <br/><br/><span class="smallTxt">(File size must be size less then 1MB)</span>
                    
                <tr class='seperator'><td colspan='2'>&nbsp;</td></tr>
                
                <tr class='highlighter'><td colspan='2'><label><strong>Class XII</strong></label></td></tr>  
                <tr><td width='40%'><label><strong>School</strong></label></td>
                    <td><input type="text" id="school_12" name="school_12" value="<?php echo $info->school_12;?>"/>
                    </td></tr>
                    
                <tr><td width='40%'><label><strong>Board</strong></label></td>
                    <td><input type="text" id="board_12" name="board_12" value="<?php echo $info->board_12;?>"/>
                    </td></tr>
                    
                <tr><td width='40%'><label><strong>Passout Year</strong></label></td>
                    <td><input type="text" id="year_12" name="year_12" value="<?php echo $info->year_12;?>"/>
                    </td></tr>                                                                        
                    
                <tr><td><label><strong>Subjects</strong></label></td>
                    <td><textarea cols="25" rows="3" id="subject_12" name="subject_12"><?php echo $info->subject_12;?></textarea>
                    </td></tr>
                    
                <tr><td width='40%'><label><strong>Aggregate</strong></label></td>
                    <td><input type="text" id="agg_12" name="agg_12" value="<?php echo $info->agg_12;?>"/>
                    </td></tr>           
                    
                <tr><td><label><strong>Upload Marksheet</strong></label></td>
                    <td><input type="hidden" name="image_type_12" value="<?php echo $info->img_12;?>" />
                        <input type="file" id="img_12" name="img_12"/>
                        <br/><br/><span class="smallTxt">(File size must be size less then 1MB)</span>
                    </td></tr>
                
                
                <?php if($course != 'be') { ?>
                    
                    
                <tr class='seperator'><td colspan='2'>&nbsp;</td></tr>
                
                <tr class='highlighter'><td colspan='2'><label><strong>Graduation Record</strong></label></td></tr>  
                <tr><td width='40%'><label><strong>Course</strong></label></td>
                    <td><input type="text" id="grad_course" name="grad_course" value="<?php echo $info->grad_course;?>"/>
                    </td></tr>
                    
                <tr><td width='40%'><label><strong>University</strong></label></td>
                    <td><input type="text" id="grad_univ" name="grad_univ" value="<?php echo $info->grad_univ;?>"/>
                    </td></tr>
                    
                <tr><td width='40%'><label><strong>Field Specification</strong></label></td>
                    <td><input type="text" id="grad_field" name="grad_field" value="<?php echo $info->grad_field;?>"/>
                    </td></tr>                                                                        
                    
                <tr><td width='40%'><label><strong>Passout Year</strong></label></td>
                    <td><input type="text" id="grad_year" name="grad_year" value="<?php echo $info->grad_year;?>"/>
                    </td></tr> 
                
                <tr><td width='40%'><label><strong>Aggregate</strong></label></td>
                    <td><input type="text" id="grad_agg" name="grad_agg" value="<?php echo $info->grad_agg;?>"/>
                    </td></tr> 
                        
                <tr><td><label><strong>Subjects</strong></label></td>
                    <td><textarea cols="25" rows="3" id="grad_sub" name="grad_sub"><?php echo $info->grad_sub;?></textarea>
                    </td></tr>
                    
                <tr><td><label><strong>Upload Docs</strong></label></td>
                    <td><input type="hidden" name="grad_doc_type" value="<?php echo $info->grad_doc;?>" />
                        <input type="file" id="grad_doc" name="grad_doc"/>
                        <br/><br/><span class="smallTxt">(Upload all the docs as a single file of size less then 1MB)</span>
                    </td></tr>
                
                <?php } ?>
                
                <tr height="50" class="seperator"><td colspan="2"><input type="submit" class="submitStyle" name="submit" value="Update" />
                    </td></tr>
                        
            </table>
            </form>
            
        </td>
        <td width="30%" valign="top" align="center">
            <img class="dp" width="150px" src="../student/_photo/<?php echo $id;?>.jpg"
                                          onerror="this.src='../student/_photo/default.jpg';"/>
            
        </td></tr>
            
        </table>

    </td></tr>
</table>
                
                
<!--body close-->       
            
<?php include("../_include/footer.php"); ?>
</body>
</html>