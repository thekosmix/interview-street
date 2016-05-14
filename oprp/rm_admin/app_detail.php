<?php require_once("../_php/init_rmadmin.php");

if(isset($_GET['id'])){	
	$id = $_GET['id']; 
}

if(isset($_POST["status"])){
	
	$application = new Application();
	$application->student_id = $_POST['stud_id'];
	$application->recruiter_id = $id;
	$application->status = trim($_POST['status']);
	
	$is_updated = Application::updateDetailByRS($application);
	
	if($is_updated)
		$msg = setErrNotMsg("Application Updated Successfully.");		
	else
		$msg = setErrMsg("Could not update the application. Please try later.");
}

$applications = Application::getDetailByRecID($id); 

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php include("../_include/title.php"); ?> - Applications</title>
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
        <tr height="40px" valign="middle"><td><span class="topicTxt">Applications</span></td></tr>
        <form action="" method="get">
        <tr height="40px" valign="middle">
        <td><strong>Company</strong> 
          <select name="id">
          <option value="">Select Company</option>
          <?php $rec = Recruiter::getAllActiveRecruiter(); 
		  		while($row = array_shift($rec))
				{
					echo "<option value='{$row->recruiter_id}' ";
					if($row->recruiter_id==$id) echo "selected='selected'";
					echo ">{$row->name}</option>";
				}
		  ?>
          </select>
          <input type="submit" value="Show" class="submitStyle" /></td></tr>
          </form>
        <tr valign="top"><td width="100%">
        
            <table cellpadding="6" border="0" width="100%" class='normalTxt infotbl'>    
            
             
			<?php 
                
                if($applications){
					
					echo"<tr><th><label>Roll No.</label></th>
						 <th><label>Name</label></th>
						 <th><label>Branch</label></th>
						 <th><label>Score</label></th>
						 <th><label>Status</label></th>
						 <th><label>Update</label></th>
						 <th><label>Download CV</label></th>
						 </tr>";
					
                    while($app = array_shift($applications))
                    {
                        $info = Student::getDetailByID($app->student_id);
						
						switch($info->course){
							case 'be': $acad = Academics_BE::getDetailByID($app->student_id); break;
							case 'me': $acad = Academics_ME::getDetailByID($app->student_id); break;
							case 'mba': $acad = Academics_MBA::getDetailByID($app->student_id); break;
						}
						
						$name = $info->first_name;
						if(!empty($info->middle_name)) $name .= " ".$info->middle_name;
						$name .= " ".$info->last_name;
						
						echo"<tr>";
						echo "<td><label>{$info->roll_no}</label></td>";
                        echo "<td class='contentLinks'><a href='stud_per_profile.php?id={$app->student_id}'>{$name}</a></td>";
						echo "<td><label>{$acad->branch}</label></td>";
						echo "<td><label>{$acad->agg}</label></td>";
						echo "<form action='' method='post'>";
						echo "<input type='hidden' name='stud_id' value='".$app->student_id."' />";
						echo "<td><select name='status'>";
                        echo "<option"; if($app->status == 'Applied') echo " selected='selected'"; echo">Applied</option>";
                        echo "<option"; if($app->status == 'Pending') echo " selected='selected'"; echo">Pending</option>";
                        echo "<option"; if($app->status == 'Selected') echo " selected='selected'"; echo">Selected</option>";
                        echo "<option"; if($app->status == 'Rejected') echo " selected='selected'"; echo">Rejected</option>";
                        echo "</select></td>";
						echo "<td><input type='submit' value='Update' class='submitStyle'/></td>";
						echo "<td class='contentLinks'><a href='../student/resume.php?id={$app->student_id}'>Download</a></td></tr>";
						echo "</form>";
                    }
					
						echo "<tr class='seperator'><td>&nbsp;</td></tr>
            				  <tr class='seperator'><td colspan='2' class='contentLinks'>
            				  <a href='../recruiter/app_list.php?id={$id}'>Download Applications</a></td></tr>";
				}else
                    echo "<tr><td colspan='6'><label>No applications till now.</label></td></tr>";
                    
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