<?php 
require_once("../_php/config.php"); 
require_once("../_php/functions.php"); 
require_once("../_php/database.php"); 
require_once("../_php/session.php");
require_once("../_php/user.php");
require_once("../_php/branch.php");
require_once("../_php/student.php");
require_once("../_php/acad_be.php");
require_once("../_php/acad_me.php");
require_once("../_php/acad_mba.php");
require_once("../_php/proj.php");

if($session->isStudent()) $id=$session->user_id;
else $id=$_GET['id'];

$user_info = User::getDetailByID($id);
$pers_info = Student::getDetailByID($id);

switch($pers_info->course){
	case 'be': $acad_info = Academics_BE::getDetailByID($id); break;
	case 'me': $acad_info = Academics_ME::getDetailByID($id); break;
	case 'mba': $acad_info = Academics_MBA::getDetailByID($id); break;
}

$proj_info = Project::getDetailByID($id);

header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=Resume_".$pers_info->roll_no.".doc");

?>

<html>
<body>
<table width="800px" align="center" cellpadding="5">
<tr align="center"><td align="center" colspan="2"><strong><h3>Curriculum Vitae</h3></strong></td></tr>
<tr><td><strong><?php echo Student::getFullNameByID($id);?></strong></td></tr>
<tr><td><?php echo $pers_info->local_address;?></td></tr>
<tr><td><?php echo $user_info->email;?></td></tr>
<tr><td><?php echo $pers_info->mobile;?></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td><strong>Academic Qualification</strong></td></tr>
<tr><td>
        <table width="100%" border="1" cellspacing="0" bordercolor="#666" cellpadding="5">
            <tr><th>Exam</th>
               	<th>School/College</th>
            	<th>Board/University</th>
                <th>Passing Year</th>
                <th>Subjects</th>
                <th>Percentage</th>
            </tr>
            <tr>
                <td>Class X</td>
                <td><?php echo $acad_info->school_10;?></td>
                <td><?php echo $acad_info->board_10;?></td>
                <td><?php echo $acad_info->year_10;?></td>
                <td><?php echo $acad_info->subject_10;?></td>
                <td><?php echo $acad_info->agg_10;?></td>
            </tr>
            <tr>
                <td>Class XII</td>
                <td><?php echo $acad_info->school_12;?></td>
                <td><?php echo $acad_info->board_12;?></td>
                <td><?php echo $acad_info->year_12;?></td>
                <td><?php echo $acad_info->subject_12;?></td>
                <td><?php echo $acad_info->agg_12;?></td>
            </tr>
            
            <?php if($pers_info->course != 'be'){ ?>	
            <tr>					
				<td><?php echo $acad_info->grad_course;?></td>
                <td><?php echo $acad_info->grad_univ;?></td>
                <td><?php echo $acad_info->grad_univ;?></td>
                <td><?php echo $acad_info->grad_year;?></td>
                <td><?php echo $acad_info->grad_field."<br/>".$acad_info->grad_sub;?></td>
                <td><?php echo $acad_info->grad_agg;?></td>
            </tr>
            <?php } ?>
            
            <tr>
                <td><?php echo getCourse($pers_info->course);?></td>
                <td>Delhi Technological University</td>
                <td>Delhi Technological University<br/>Formerly, Delhi College of Engineering</td>
                <td><?php if($pers_info->course == 'be') echo $acad_info->year_of_grad;
						  else echo $acad_info->year_of_pg;?></td>
                <td><?php echo Branch::getNameByCode($acad_info->branch);?></td>
                <td><?php echo $acad_info->agg."%";?></td>
            </tr>
        </table>
</td></tr>

<tr><td>&nbsp;</td></tr>
<tr><td><?php echo '<strong>Entrance Exam:</strong> '.$acad_info->entrance;?></td></tr>
<tr><td><?php echo '<strong>Category:</strong> '.$acad_info->entrance_category;?></td></tr>
<tr><td><?php echo '<strong>Rank:</strong> '.$acad_info->rank;?></td></tr>
<tr><td>&nbsp;</td></tr>

<tr><td><strong>Carrer Objective</strong><br/><?php echo $proj_info->career_objectives; ?></td></tr>
<tr><td>&nbsp;</td></tr>      
    
<tr><td><strong>Projects/Trainings</strong></td></tr>
<tr><td>
	<ul>
    <?php if(!empty($proj_info->training_1)) echo "<li>".$proj_info->training_1."</li>"; ?>
    <?php if(!empty($proj_info->training_2)) echo "<li>".$proj_info->training_2."</li>"; ?>
    <?php if(!empty($proj_info->training_3)) echo "<li>".$proj_info->training_3."</li>"; ?>
    <?php if(!empty($proj_info->training_4)) echo "<li>".$proj_info->training_4."</li>"; ?>
    <?php if(!empty($proj_info->training_5)) echo "<li>".$proj_info->training_5."</li>"; ?>
    <?php if(!empty($proj_info->training_6)) echo "<li>".$proj_info->training_6."</li>"; ?>
    </ul>
</td></tr>

<tr><td><strong>Technical Skills</strong><br/><?php echo $proj_info->skills_tech; ?></td></tr>
<tr><td>&nbsp;</td></tr>      

<tr><td><strong>Other Skills</strong><br/><?php echo $proj_info->skills_other; ?></td></tr>
<tr><td>&nbsp;</td></tr>   

<tr><td><strong>Professional Society</strong><br/><?php echo $proj_info->professional_society; ?></td></tr>
<tr><td>&nbsp;</td></tr>   

<tr><td><strong>Extra Curricular</strong><br/><?php echo $proj_info->extra_curricular; ?></td></tr>
<tr><td>&nbsp;</td></tr>   

<tr><td><strong>Hobbies</strong><br/><?php echo $proj_info->hobbies; ?></td></tr>
<tr><td>&nbsp;</td></tr>   

</table>
</body>
</html>
