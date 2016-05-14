<?php  require_once("../_php/init_student.php"); 

if(!$session->isIC() && !$session->isPC()) redirect_to("./");

$course = Student::getCourseByID($session->user_id);
switch($course)
{
	case 'be': $acad = Academics_BE::getDetailByID($session->user_id); $yr_of_comp = $acad->year_of_grad; break;
	case 'me': $acad = Academics_ME::getDetailByID($session->user_id); $yr_of_comp = $acad->year_of_pg; break;
	case 'mba': $acad = Academics_MBA::getDetailByID($session->user_id); $yr_of_comp = $acad->year_of_pg; break;
}

$years = array();
$years[0] = $session->passYear();
$years[1] = $session->passYear()+1;


if(isset($_POST["submit"])){	

		$user = new User();
		$user->uname 	= trim($_POST['uname']);
		$user->email 	= trim($_POST['email']);
		$user->passw 	= sha1(trim($_POST['passw']));
		$user->access   = $session->recruiter_access();
		
		$inserted_user_id = User::insertUser($user);
		
		if($inserted_user_id){
		
			$recruiter = new Recruiter();
			$recruiter->recruiter_id	= $inserted_user_id;
			$recruiter->company_id		= $_POST['company_id'];
			$recruiter->arrival_date 	= trim($_POST['arr_date']);
			$recruiter->grade 			= trim($_POST['grade']);
			$recruiter->app_date		= trim($_POST['app_till']);
			$recruiter->min_score 		= trim($_POST['min_score']);
			$recruiter->for_year		= trim($_POST['for_year']);
			$recruiter->contact			= trim($_POST['contact']);
			$recruiter->job_description	= trim($_POST['job_desc']);
			$recruiter->notes			= trim($_POST['extra_info']);
			$recruiter->year 			= trim($_POST['year']); 
			$recruiter->branches		= arr_to_str($_POST['branch_arr']); 
			
			if($_POST['company_id']=='0'){
				$company = new Company();
				$company->name 			= trim($_POST['name']);
				$company->description 	= trim($_POST['comp_desc']);
				$company->website		= trim($_POST['website']);
				$company->logo_url		= trim($_POST['logo_url']);
				$recruiter->company_id	= Company::insertCompany($company);
			}
				
			if($recruiter->company_id)
				$inserted = Recruiter::insertRecruiter($recruiter);
			
			if($inserted)
				$msg = setErrNotMsg("New Recruiter has been created.");		
			else
				$msg = setErrMsg("New Recruiter could not be created. Please try later.");
		}
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php include("../_include/title.php"); ?> - Add Recruiter</title>
<?php include("../_include/design.php"); ?>

<script type="text/javascript"> 

$(document).ready(function() { 
  $("#add_recruiter_form").validate({ 
	rules: { 
	  uname: { required: true},
	  passw: { required: true},
  	  company_id: { required: true},
	  grade: { required: true}
	}, 
	messages: { 
	  uname: { required: "<br/>Please enter the username" },
	  passw: { required: "<br/>Please enter the passw" },
	  company_id: { required: "<br/>Please select a company" },
	  grade: { required: "<br/>Please enter the grade" }
	}  
  }); 
}); 

</script>

<script type="application/javascript">
$(function() {
	$( "#arr_date" ).datepicker({dateFormat: "yy-mm-dd"});
	$( "#app_till" ).datetimepicker({
		dateFormat: 'yy-mm-dd',
		timeFormat: 'hh:mm:ss'
	});
});

function newCompanyCheck()
{
	var company_id = $("#company_id").val();
	if(company_id == '0'){
		$("#new_company").html("<table border='0' width='100%' cellpadding='6'><tr><td><label><strong>Company Name</strong></label></td><td><input type='text' name='name' id='name' size='40'/></td></tr><tr><td><label><strong>Website</strong></label></td><td><input type='text' name='website' id='website' size='40'/></td></tr><tr><td><label><strong>Logo URL</strong></label></td><td><input type='text' name='logo_url' id='logo_url' size='40'/></td></tr><tr valign='middle'><td colspan='2'><label><strong>Company Description</strong></label><br/><textarea name='comp_desc' id='comp_desc' cols='60' rows='5'></textarea></td></tr></table>");
	}else $("#new_company").html("");
	
}

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
        <tr height="40px" valign="middle"><td><span class="topicTxt">Add Recruiter</span></td></tr>
        <tr valign="top"><td width="100%">
        	
            <form action="" method="post" id="add_recruiter_form">
            <table cellpadding="6" border="0" width="100%" class='normalTxt infotbl'>    
                <tr><td><label><strong>Company Username</strong></label></td>
                	<td><input type="text" name="uname" id="uname" size="40"/></td></tr>
                <tr><td><label><strong>Company Password</strong></label></td>
                	<td><input type="password" name="passw" id="passw" size="40"/></td></tr>
                
                 <tr><td><label><strong>Company </strong></label></td>
                	<td><select name="company_id" id="company_id" onchange="newCompanyCheck()">
                    	<option value="">Select Company</option>
                        <option value="0">New Company</option>
                    	<?php $company_all = Company::getAllCompany(); 
                    		  while($company = array_shift($company_all))
                    		  	echo "<option value='".$company->company_id."'>".$company->name."</option>"; ?>
                        </select></td></tr>   
                <tr><td colspan="2" id="new_company">&nbsp;</td></tr>
                <tr><td><label><strong>Arrival Date</strong><br/><span class="smallTxt">(YYYY-MM-DD)</span></label></td>
                	<td><input type="text" name="arr_date" id="arr_date" size="40"/></td></tr>
                <tr><td><label><strong>Grade</strong></label> </td>
                    <td><select id="grade" name="grade">
            				<option value="">Select Grade</option>            
 			               	<option value="X">Exclusive</option>
                            <option value="S">Super</option>
                            <option value="A+">A+</option>
                            <option value="A">A</option>
                        </select></td></tr>
                <tr><td><label><strong>Last Application Date</strong><br/><span class="smallTxt">(YYYY-MM-DD HH:MM:SS)</span></label></td>
                	<td><input type="text" name="app_till" id="app_till" size="40"/></td></tr>
                <tr><td><label><strong>Minimum Score</strong></label></td>
                	<td><input type="text" name="min_score" id="min_score" size="40"/></td></tr>
                <tr><td><label><strong>Contact</strong><br/><span class="smallTxt">(Not visible to Students)</span></label></td>
                	<td><input type="text" name="contact" id="contact" size="40"/></td></tr>
                <tr><td><label><strong>Email</strong></label></td>
                	<td><input type="text" name="email" id="email" size="40"/></td></tr>
                <tr valign="middle"><td colspan="2"><label><strong>Job Description</strong></label><br/>
                 	<textarea name="job_desc" id="job_desc" cols="60" rows="5"></textarea></td></tr>
                <tr valign="middle"><td colspan="2"><label><strong>Extra Info</strong></label><br/>
                 	<textarea name="extra_info" id="extra_info" cols="60" rows="5"></textarea></td></tr>  
                <tr><td colspan="2"><label><strong>Batch (Year of Passing) : </strong></label>

                <?php 
                      while($year = array_shift($years))
					  {
                        echo"&nbsp;&nbsp;&nbsp;<input type='radio'";
						if($yr_of_comp == $year) echo " checked='checked'";
						echo " id='for_year' name='for_year' value='{$year}' /> {$year} "; 
					  }
                ?>

                </td></tr>   
                <tr><td colspan="2"><label><strong>Branches : </strong></label>
                
                <?php	
					echo"<br/><br/>B.E. : &nbsp;&nbsp;&nbsp;";
					$branch_be = Branch::getDetailByCourse("be");
					while($branch = array_shift($branch_be))
					{
						echo"&nbsp;&nbsp;&nbsp;<input type='checkbox'"; 
						if($acad->branch == $branch->branch_code) echo " checked='checked'";
						echo " id='branch_arr' name='branch_arr[]' value='{$branch->branch_code}' />
						{$branch->branch_code} ";
					}
					
					echo"<br/><br/>M.E. : &nbsp;&nbsp;";
					$branch_be = Branch::getDetailByCourse("me");
					while($branch = array_shift($branch_be))
					{
						echo"&nbsp;&nbsp;&nbsp;<input type='checkbox' id='branch_arr'";
						if($acad->branch == $branch->branch_code) echo " checked='checked'";
						echo " name='branch_arr[]' value='{$branch->branch_code}' />
							{$branch->branch_code} ";
					}
					
					echo"<br/><br/>M.B.A. : ";
					$branch_be = Branch::getDetailByCourse("mba");
					while($branch = array_shift($branch_be))
					{
						echo"&nbsp;&nbsp;<input type='checkbox' id='branch_arr'";
						if($acad->branch == $branch->branch_code) echo " checked='checked'";			
						echo " name='branch_arr[]' value='{$branch->branch_code}' />
							{$branch->branch_code} ";
					}
                ?>

                </td></tr>
                <tr><td colspan="2"><input type="submit" name="submit" value="+ Add" class="submitStyle"/></td></tr>
            	<tr class='seperator'><td>&nbsp;</td></tr>
            </table>
            </form>
        </td>
       
        </tr>
            
        </table>

    </td></tr>
</table>
                
                
<!--body close-->       
            
<?php include("../_include/footer.php"); ?>
</body>
</html>