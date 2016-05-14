<?php  require_once("../_php/init_rmadmin.php"); 

if(isset($_POST['branch'])){	
	$branch = $_POST['branch']; 
	$course = Branch::getDetailByCode($branch)->branch_course;
	switch($course){
		case 'be': $acad = Academics_BE::getDetailByBranch($branch); break;
		case 'me': $acad = Academics_ME::getDetailByBranch($branch); break;
		case 'mba': $acad = Academics_MBA::getDetailByBranch($branch); break;
	}
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php include("../_include/title.php"); ?> - All Students</title>
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
        <tr height="40px" valign="middle"><td><span class="topicTxt">All Students</span>
        
        <a href='add_student.php' title='Add Student'>
        <img src='../_images/add.png' hspace='10' align='middle' alt='Add Student' /></a>
        
        </td></tr>
        <form action="" method="post">
        <tr height="40px" valign="middle">
        <td><strong>Branch</strong> 
          <select name="branch">
          <option value="">Select Branch</option>
          <?php $branches = Branch::getAllBranches(); 
		  		while($row = array_shift($branches))
				{
					echo "<option value='{$row->branch_code}' ";
					if($row->branch_code==$branch) echo "selected='selected'";
					echo ">{$row->branch_name} ({$row->branch_course})</option>";
				}
		  ?>
          </select>
          <input type="submit" value="Show" class="submitStyle" /></td></tr>
          </form>
          
        <tr valign="top"><td width="100%">
        
            <table cellpadding="6" border="0" width="100%" class='normalTxt infotbl'>    
            
            <?php 
                if($acad){
					
					echo "<tr><th><label>Roll No.</label></th>
							 <th><label>Name</label></th>
							 <th align='center'><label>Score</label></th>
							 <th><label>Email</label></th>
							 <th><label>Mobile</label></th>
							 <th><label>Download CV</label></th>
							 </tr>";
				
				
                    while($acad_detail = array_shift($acad))
                    {
                       	$stud = Student::getDetailByID($acad_detail->student_id);
						$user = User::getDetailByID($acad_detail->student_id);
						
						echo"<tr>";
						echo "<td><label>{$stud->roll_no}</label></td>";
                        echo "<td class='contentLinks'>
							<a href='stud_per_profile.php?id={$acad_detail->student_id}'>{$stud->first_name} {$stud->last_name}</a></td>";
						echo "<td align='center'><label>{$acad_detail->agg}</label></td>";
						echo "<td><label>{$user->email}</label></td>";
						echo "<td><label>{$stud->mobile}</label></td>";
						echo "<td class='contentLinks'><a href='../student/resume.php?id={$acad_detail->student_id}'>Download</a></td></tr>";
                    }
				}else
                    echo "<tr><td colspan='7'><label>No student in this category.</label></td></tr>";
                    
            ?>
            
            </table>
            
        </td>
       
        </tr>
            
        </table>

    </td></tr>
</table>
                
                
<!--body close-->       
            
<?php include("../_include/footer.php"); ?>
</body>
</html>