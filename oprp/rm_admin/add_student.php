<?php  require_once("../_php/init_rmadmin.php"); 

$years = array();
$years[0] = $session->passYear();
$years[1] = $session->passYear()+1;


if(isset($_POST["submit"])){	

	if(isset($_POST['year']) && isset($_POST['course'])){	
		
		$from = trim($_POST['roll_no_from']);
		$to = empty($_POST['roll_no_to']) ? $from : trim($_POST['roll_no_to']);
		
		for($i=$from; $i<=$to; $i++)
		{
			if($i<10) $zero=0; else $zero=NULL;
			$rollno  = trim($_POST['roll_no_prefix']).$zero.$i.trim($_POST['roll_no_suffix']);
			$year 	 = trim($_POST['year']);
			$branch  = trim($_POST['branch']);
			$course	 = trim($_POST['course']);
			
			// Insert User Info
			$user = new User();
			$user->uname 	  = $rollno;
			$user->access     = $session->student_access();		
			$user->passw 	  = sha1($rollno);
			$inserted_user_id = User::insertUser($user);
			
			if($inserted_user_id){
				
				// Insert Student Info
				$student = new Student();
				$student->student_id = $inserted_user_id;
				$student->roll_no    = $rollno;
				$student->course     = $course;
				$inserted_student    = Student::insertStudent($student);
				
				// Insert Academic Info
				switch($course)
				{
						case 'be': 
							$acad_be = new Academics_BE();
							$acad_be->student_id   = $inserted_user_id;
							$acad_be->branch       = $branch;
							$acad_be->year_of_grad = $year;
							$inserted = Academics_BE::insertAcadBE($acad_be); break;
							
						case 'me': 
							$acad_me = new Academics_ME();
							$acad_me->student_id = $inserted_user_id;
							$acad_me->branch     = $branch;
							$acad_me->year_of_pg = $year;
							$inserted = Academics_ME::insertAcadME($acad_me); break;
							
						case 'mba': 
							$acad_mba = new Academics_MBA();
							$acad_mba->student_id = $inserted_user_id;
							$acad_mba->branch     = $branch;
							$acad_mba->year_of_pg = $year;
							$inserted = Academics_MBA::insertAcadMBA($acad_mba); break;
				}
				
				
				//Insert Project Info
				$proj = new Project();
				$proj->student_id = $inserted_user_id;
				$inserted_proj = Project::insertProject($proj);
				
			}
			
			if($inserted_user_id && $inserted_student && $inserted && $inserted_proj)
				$msg = setErrNotMsg("New Student has been created.");		
			else
				$msg = setErrMsg("New Student could not be created. Please try later.");
		}
		
	}else $msg = setErrMsg("Please enter full details.");
	
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php include("../_include/title.php"); ?> - Add Student</title>
<?php include("../_include/design.php"); ?>

<script type="text/javascript"> 
$(document).ready(function() { 
  $("#add_student_form").validate({ 
	rules: { 
	  roll_no_from: {required: true, digits:true},
	  roll_no_to: {digits:true},
	  course: {required: true}
	}, 
	messages: { 
	  roll_no_from: {required: "Please enter the starting roll no",
	  				 digits: "Please enter digits"},
	  roll_no_to: {digits: "Please enter digits"},
	  course: {required: "Please enter course"}
	},
	errorElement: "div"
  }); 
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
        <tr height="40px" valign="middle"><td><span class="topicTxt">Add Student</span></td></tr>
        <tr valign="top"><td width="100%">
        
            <table cellpadding="6" border="0" width="100%" class='normalTxt infotbl'>    
			
                <form action="" method="post" id="add_student_form">
                <tr><td><label><strong>Roll No. Prefix</strong><br/><span class="smallTxt">(eg 2K8CO)</span></label></td>
                	<td><input type="text" name="roll_no_prefix" id="roll_no_prefix" size="40"/></td></tr>
                <tr><td><label><strong>Roll No. </strong><br/><span class="smallTxt">(eg From 101 To 130)</span></label></td>
                	<td>From <input type="text" name="roll_no_from" id="roll_no_from" size="10"/> 
                    	To <input type="text" name="roll_no_to" id="roll_no_to" size="10"/></td></tr>
                <tr><td><label><strong>Roll No. Suffix</strong><br/><span class="smallTxt">(eg ISY2K8)</span></label></td>
                	<td><input type="text" name="roll_no_suffix" id="roll_no_suffix" size="40"/></td></tr>
                <tr><td><label><strong>Course: </strong></label> </td>
                    <td><select id="course" name="course">
            				<option value="">Select Course</option>            
 			               	<option value="be">B.E.</option>
                            <option value="me">M.E.</option>
                            <option value="mba">M.B.A.</option>
                        </select></td></tr>

                <tr><td colspan="2"><label><strong>Batch (Year of Passing) : </strong></label>

                <?php 
                      while($year = array_shift($years))
					  	echo"&nbsp;&nbsp;&nbsp;<input type='radio' id='year' name='year' value='{$year}' />
						{$year} "; 
                ?>

                </td></tr>   
                <tr><td colspan="2"><label><strong>Branch : </strong></label>
                
                <?php	
					echo"<br/><br/>B.E. : &nbsp;&nbsp;&nbsp;";
					$branch_be = Branch::getDetailByCourse("be");
					while($branch = array_shift($branch_be))
					{
						echo"&nbsp;&nbsp;&nbsp;<input type='radio' id='branch' name='branch' value='{$branch->branch_code}' />
						{$branch->branch_code} ";
					}
					
					echo"<br/><br/>M.E. : &nbsp;&nbsp;";
					$branch_be = Branch::getDetailByCourse("me");
					while($branch = array_shift($branch_be))
					{
						echo"&nbsp;&nbsp;&nbsp;<input type='radio' id='branch' name='branch' value='{$branch->branch_code}' />
							{$branch->branch_code} ";
					}
					
					echo"<br/><br/>M.B.A. : ";
					$branch_be = Branch::getDetailByCourse("mba");
					while($branch = array_shift($branch_be))
					{
						echo"&nbsp;&nbsp;<input type='radio' id='branch' name='branch' value='{$branch->branch_code}' />
							{$branch->branch_code} ";
					}
                ?>

                </td></tr>
                <tr><td colspan="2"><input type="submit" name="submit" value="+ Add" class="submitStyle"/></td></tr>
                </form>
          
            </table>
        </td></tr>
            
        </table>

    </td></tr>
</table>
                
                
<!--body close-->       
            
<?php include("../_include/footer.php"); ?>
</body>
</html>