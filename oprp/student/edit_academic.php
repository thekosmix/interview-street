<?php  require_once("../_php/init_student.php"); 

$course = Student::getCourseByID($session->user_id);

if(isset($_POST["submit"])){
	
	if($_FILES['img_10']['size'] < 1000000){
		$file_uploaded_10 = uploadFile("_marksheet_10/",$_FILES['img_10'],$session->user_id);
		if($file_uploaded_10)
		    $msg = " Doc was uploaded successfully.";
	}
	
	if($_FILES['img_12']['size'] < 1000000){
		$file_uploaded_12 = uploadFile("_marksheet_12/",$_FILES['img_12'],$session->user_id);
		if($file_uploaded_12)
		    $msg = " Doc was uploaded successfully.";
	}
	
	
	if($course == 'be'){ $student = new Academics_BE(); }
	else if($course == 'me'){ $student = new Academics_ME(); }
	else if($course == 'mba'){ $student = new Academics_MBA(); }
	
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
	$student->backlog_reason= trim($_POST['backlog_reason']);
	
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
		$file_uploaded_grad = uploadFile("_grad_doc/",$_FILES['grad_doc'],$session->user_id);
		if($file_uploaded_grad)
		    $msg = " Doc was uploaded successfully.";
		}
		
		if($file_uploaded_grad){
				$path_info_grad = pathinfo($_FILES['grad_doc']['name']);
				$student->grad_doc = $path_info_grad['extension'];
			}else $student->grad_doc = $_POST['grad_doc_type'];
	}
			
	if($course == 'be'){ $is_updated = Academics_BE::updateDetailbyID($student); }
	else if($course == 'me'){ $is_updated = Academics_ME::updateDetailbyID($student); }
	else if($course == 'mba'){ $is_updated = Academics_MBA::updateDetailbyID($student); }
	
	if($is_updated) $msg = "Profile has been updated.".$msg;		
	// else $msg = setErrMsg("Personal profile could not be updated due to some technical issues. Please try later.".$imgst);
	
	if(isset($msg)) $msg = setErrNotMsg($msg);	
}



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
        <tr height="40px" valign="middle"><td><span class="topicTxt">Edit Academic Profile</span></td></tr>
        <tr><td width="70%">
        
            <form action="" method="post" enctype="multipart/form-data">                       
            <table cellpadding="6" border="0" width="100%" class="normalTxt infotbl">    
            
			<?php switch($course){
					case 'be': $info = Academics_BE::getDetailByID($session->user_id); break;
					case 'me': $info = Academics_ME::getDetailByID($session->user_id); break;
					case 'mba': $info = Academics_MBA::getDetailByID($session->user_id); break;
				} 
			?>	
                
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
                
                
                
                <?php if(!empty($info->backlog))  
                      echo"<tr class='seperator'><td colspan='2'>&nbsp;</td></tr>
					  	   <tr class='highlighter'><td colspan='2'><label><strong>Reason of Backlog</strong></label></td></tr>     
                		   <tr><td colspan='2'><textarea cols='50' rows='4' id='backlog_reason' name='backlog_reason'>{$info->backlog_reason}</textarea>
						   </td></tr>";
				?>
                    
                
                <tr height="50" class="seperator"><td colspan="2"><input type="submit" class="submitStyle" name="submit" value="Update" />
                    </td></tr>
                        
            </table>
            </form>
            
        </td>
        <td width="30%" valign="top" align="center">
            <img class="dp" width="150px" src="_photo/<?php echo $session->user_id;?>.jpg"
                                          onerror="this.src='_photo/default.jpg';"/>
            
        </td></tr>
            
        </table>

    </td></tr>
</table>
                
                
<!--body close-->       
            
<?php include("../_include/footer.php"); ?>
</body>
</html>