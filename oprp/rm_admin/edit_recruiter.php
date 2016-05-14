<?php require_once("../_php/init_rmadmin.php"); 

if(isset($_GET['id'])) $id = $_GET['id'];
else redirect_to("index.php");


if(isset($_POST["submit"])){
	
	$recruiter = new Recruiter();
	$recruiter->name 			= trim($_POST['name']); 
	$recruiter->arrival_date 	= trim($_POST['arrival_date']); 
	$recruiter->app_date 		= trim($_POST['app_date']);
	$recruiter->grade 			= trim($_POST['grade']);
	$recruiter->status 			= trim($_POST['status']);
	$recruiter->min_score		= trim($_POST['min_score']);
	$recruiter->contact  		= trim($_POST['contact']);
	$recruiter->website 		= trim($_POST['website']);
	$recruiter->logo_url 		= trim($_POST['logo_url']);	
	$recruiter->description 	= trim($_POST['description']); 
	$recruiter->job_description = trim($_POST['job_description']); 
	$recruiter->notes 			= trim($_POST['notes']);
	$recruiter->for_year 		= trim($_POST['for_year']); 
	$recruiter->branches 		= arr_to_str($_POST['branch_arr']); 
 
 	$is_updated = Recruiter::updateAllDetailByID($recruiter,$id);
	
	if($is_updated)
		$msg = setErrNotMsg("Profile has been updated.");		
}

$info = Recruiter::getDetailByID($id); 
if(!$info) redirect_to("index.php");

$years = array();
$years[0] = $session->passYear();
$years[1] = $session->passYear()+1;

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php include("../_include/title.php"); ?> - Edit Recruiter Profile</title>
<?php include("../_include/design.php"); ?>
<script>
$(function() {
	$( "#arrival_date" ).datepicker({dateFormat: "yy-mm-dd"});
	$( "#app_date" ).datetimepicker({
		dateFormat: 'yy-mm-dd',
		timeFormat: 'hh:mm:ss'
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
        <tr height="40px" valign="middle"><td><span class="topicTxt">Edit Recruiter</span></td></tr>
        <tr><td width="100%">
        
            <form action="" method="post">                       
            <table cellpadding="6" border="0" width="100%" class="normalTxt infotbl">    
            
                <tr><td width='40%'><label><strong>Company Name</strong></label></td>
                    <td><input type="text" id="name" name="name" value="<?php echo $info->name;?>" size="40"/>
                    </td></tr>
                    
                <tr><td><label><strong>Grade</strong></label> </td>
                    <td><select id="grade" name="grade">
            				<option value="">Select Grade</option>            
 			               	<option value="X" <?php if($info->grade=='X') echo "selected='selected'";?> >Exclusive</option>
                            <option value="S" <?php if($info->grade=='S') echo "selected='selected'";?> >Super</option>
                            <option value="A+" <?php if($info->grade=='A+') echo "selected='selected'";?> >A+</option>
                            <option value="A" <?php if($info->grade=='A') echo "selected='selected'";?> >A</option>
                        </select></td></tr>
                    
                <tr><td><label><strong>Arrival Date</strong><br/><span class="smallTxt">(YYYY-MM-DD)</span></label></td>
                    <td><input type="text" id="arrival_date" name="arrival_date" value="<?php echo $info->arrival_date;?>" size="40"/>
                    </td></tr>
                
                <tr><td><label><strong>Last Application Date</strong><br/><span class="smallTxt">(YYYY-MM-DD HH:MM:SS)</span></label></td>
                	<td><input type="text" name="app_date" id="app_date" size="40" value="<?php echo $info->app_date;?>"/>
                    </td></tr>
                    
                <tr><td><label><strong>Min Score</strong></label></td>
                    <td><input type="text" id="min_score" name="min_score" value="<?php echo $info->min_score;?>" size="40"/>
                    </td></tr>
                    
                <tr><td><label><strong>Contact</strong></label></td>
                    <td><input type="text" id="contact" name="contact" value="<?php echo $info->contact;?>" size="40"/>
                    </td></tr>  
                    
                <tr><td><label><strong>Website</strong></label></td>
                    <td><input type="text" id="website" name="website" value="<?php echo $info->website;?>" size="40"/>
                    </td></tr>
                    
                <tr><td><label><strong>Company Logo URL</strong></label></td>
                    <td><input type="text" id="logo_url" name="logo_url" value="<?php echo $info->logo_url;?>" size="40"/>
                    </td></tr>                
                        
                <tr><td colspan="2"><label><strong>Company Description</strong></label><br/>
                    <textarea cols="60" rows="5" id="description" name="description"><?php echo $info->description;?></textarea>
                    </td></tr>
                    
                <tr><td colspan="2"><label><strong>Job Description</strong></label><br />
                    <textarea cols="60" rows="5" id="job_description" name="job_description"><?php echo $info->job_description;?></textarea>
                    </td></tr>
                    
                <tr><td colspan="2"><label><strong>Extra Info</strong></label><br />
                    <textarea cols="60" rows="5" id="notes" name="notes"><?php echo $info->notes;?></textarea>
                    </td></tr> 
                
                <tr><td colspan="2"><label><strong>Batch (Year of Passing) : </strong></label>

                <?php 
                      while($year = array_shift($years)){
                        echo"&nbsp;&nbsp;&nbsp;<input type='radio'";
						if($info->for_year == $year) echo "checked='checked'";
						echo "id='for_year' name='for_year' value='{$year}'/> {$year} "; 
					  }
                ?>

                </td></tr>  
                 
                <tr><td colspan="2"><label><strong>Branches : </strong></label>
                
                <?php	
					echo"<br/><br/>B.E. : &nbsp;&nbsp;&nbsp;";
					$branch_be = Branch::getDetailByCourse("be");
					while($branch = array_shift($branch_be)){
						echo"&nbsp;&nbsp;&nbsp;<input type='checkbox'"; 
						if(search_in($branch->branch_code,$info->branches)) echo "checked='checked'";
						echo "id='branch_arr' name='branch_arr[]' value='{$branch->branch_code}'/> {$branch->branch_code} ";
					}
					
					echo"<br/><br/>M.E. : &nbsp;&nbsp;";
					$branch_me = Branch::getDetailByCourse("me");
					while($branch = array_shift($branch_me)){
						echo"&nbsp;&nbsp;&nbsp;<input type='checkbox'"; 
						if(search_in($branch->branch_code,$info->branches)) echo "checked='checked'";
						echo "id='branch_arr' name='branch_arr[]' value='{$branch->branch_code}'/>	{$branch->branch_code} ";
					}
					
					echo"<br/><br/>M.B.A. : ";
					$branch_mba = Branch::getDetailByCourse("mba");
					while($branch = array_shift($branch_mba)){
						echo"&nbsp;&nbsp;&nbsp;<input type='checkbox'"; 
						if(search_in($branch->branch_code,$info->branches)) echo "checked='checked'";
						echo "id='branch_arr' name='branch_arr[]' value='{$branch->branch_code}'/>	{$branch->branch_code} ";
					}
                ?>

                </td></tr>
                
                <tr><td><label><strong>Status</strong></label> </td>
                    <td><select id="status" name="status">
            				<option value="">Select Status</option>            
 			               	<option value="1" <?php if($info->status=='1') echo "selected='selected'";?> >Active</option>
                            <option value="0" <?php if($info->status=='0') echo "selected='selected'";?> >Inactive</option>
                        </select></td></tr>
                
                <tr height="50"><td colspan="2"><input type="submit" class="submitStyle" name="submit" value="Update" />
                    </td></tr>
                        
            </table>
            </form>
            
        </td></tr>
            
        </table>

    </td></tr>
</table>


<!--body close-->             
            
<?php include("../_include/footer.php"); ?>
</body>
</html>