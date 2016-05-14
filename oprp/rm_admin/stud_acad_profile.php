<?php  require_once("../_php/init_rmadmin.php"); 

if(isset($_GET['id'])){
	
	$id = $_GET['id'];
	$course = Student::getCourseByID($id);
	switch($course){
		case 'be': $info = Academics_BE::getDetailByID($id); break;
		case 'me': $info = Academics_ME::getDetailByID($id); break;
		case 'mba': $info = Academics_MBA::getDetailByID($id); break;
	}
	
	if(!$info) redirect_to("index.php");
	
}else redirect_to("index.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php include("../_include/title.php"); ?> - Student's Academic Profile</title>
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
            <a href="edit_stud_academic.php?id=<?php echo $id; ?>" title="Edit Academic Profile">
            <img src="../_images/edit.png" hspace="10" align="middle" alt="Edit Academic Profile" />
            </a></td></tr>
        <tr><td width="70%" valign="top">
        
            <table cellpadding="6" border="0" width="100%" class='normalTxt infotbl' >    
            
            <?php
           
                echo "<tr class='highlighter'><td colspan='2'><label><strong>College Records</strong></label></td></tr>";
                print_info("Branch",Branch::getNameByCode($info->branch));
				
                if($course == 'be') print_info("Year of Graduation",$info->year_of_grad);
				else print_info("Year of Post Graduation",$info->year_of_pg);
					
                print_info("Sem I",$info->sem_1);
                print_info("Sem II",$info->sem_2);
                print_info("Sem III",$info->sem_3);
                print_info("Sem IV",$info->sem_4);
				
                if($course == 'be'){
					print_info("Sem V",$info->sem_5);
					print_info("Sem VI",$info->sem_6);
					print_info("Sem VII",$info->sem_7);
					print_info("Sem VIII",$info->sem_8);
				}
				
                print_info("Aggregate",$info->agg."%");	
                print_info("Dept Rank",$info->dept_rank);	
                print_info("Backlogs",$info->backlog);
                print_info("Reason of Backlog",$info->backlog_reason);
                echo "<tr class='seperator'><td colspan='2'>&nbsp;</td></tr>";
                
                echo "<tr class='highlighter'><td colspan='2'><label><strong>Entrance</strong></label></td></tr>";	
                print_info("Entrance Exam",$info->entrance);
                print_info("Entrance Category",$info->entrance_category);
                print_info("Rank",$info->rank);
                echo "<tr class='seperator'><td colspan='2'>&nbsp;</td></tr>";
				
				if($course != 'be'){						
					echo "<tr class='highlighter'><td colspan='2'><label><strong>Graduation Record</strong></label></td></tr>";
					print_info("Course",$info->grad_course);
					print_info("University",$info->grad_univ);
					print_info("Field Specification",$info->grad_field);
					print_info("Passout Year",$info->grad_year);							
					print_info("Aggregate",$info->grad_agg);
					print_info("Subjects",$info->grad_sub);
					echo "<tr class='seperator'><td colspan='2'>&nbsp;</td></tr>";
				}
                
                echo "<tr class='highlighter'><td colspan='2'><label><strong>Class X</strong></label></td></tr>";
                print_info("School",$info->school_10);
                print_info("Board",$info->board_10);
                print_info("Passout Year",$info->year_10);
                print_info("Subjects",$info->subject_10);							
                print_info("Percentage",$info->agg_10."%");
                echo "<tr class='seperator'><td colspan='2'>&nbsp;</td></tr>";
                
                echo "<tr class='highlighter'><td colspan='2'><label><strong>Class XII</strong></label></td></tr>";								
                print_info("School",$info->school_12);
                print_info("Board",$info->board_12);
                print_info("Passout Year",$info->year_12);
                print_info("Subjects",$info->subject_12);
                print_info("Percentage",$info->agg_12."%");
                
            ?>
            
            </table>
            
        </td>
        
        <?php $image_type = Student::getImageTypeByID($id); ?>
        
        <td width="30%" valign="top" align="center">
            <img class="dp" width="150px" src="../student/_photo/<?php echo $id.".".$image_type;?>" 
                                          onerror="this.src='../student/_photo/default.jpg';"/>                           
        
        <div style="padding-left:20px; text-align:left;" class="smallTxt"> <br/> 
        <?php     
            
            if(!empty($info->img_10)) 
                echo"<br/><a href='../student/download.php?loc=marksheet_10&id=".$id."' title='Download'>
					<img src='../_images/download.png' align='middle' alt='Download' hspace='5'/></a> <label>X Marksheet</label>";
                    
            if(!empty($info->img_12)) 		
               echo"<br/><a href='../student/download.php?loc=marksheet_12&id=".$id."' title='Download'>
					<img src='../_images/download.png' align='middle' alt='Download' hspace='5'/></a> <label>XII Marksheet</label>";
					
			if(!empty($info->grad_doc)) 		
                echo"<br/><a href='../student/download.php?loc=grad_doc&id=".$id."' title='Download'>
					<img src='../_images/download.png' align='middle' alt='Download' hspace='5'/></a> <label>Graduation Docs</label>";
               
        ?>
        </div>    
        </td></tr>    
            
        </table>

    </td></tr>
</table>
                
                
<!--body close-->       
            
<?php include("../_include/footer.php"); ?>
</body>
</html>