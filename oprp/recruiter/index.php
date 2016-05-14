<?php require_once("../_php/init_recruiter.php"); ?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php include("../_include/title.php"); ?> - Recruiter</title>
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
        <tr valign="top"><td width="100%">
        
            <table cellpadding="6" border="0" width="100%" class='normalTxt infotbl'>    
            
             
			<?php $applications = Application::getDetailByRecID($session->user_id); 
                
                if($applications){
					
					echo"<tr><th><label>Roll No.</label></th>
						 <th><label>Name</label></th>
						 <th><label>Branch</label></th>
						 <th><label>Score</label></th>
						 <th><label>Status</label></th>
						 <th><label>Notes</label></th>
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
                        echo "<td class='contentLinks'><a href='cover_letter.php?id={$app->student_id}'>{$name}</a></td>";
						echo "<td><label>{$acad->branch}</label></td>";
						echo "<td><label>{$acad->agg}</label></td>";
						echo "<td><label>{$app->status}</label></td>";
						echo "<td><label>{$app->notes}</label></td></tr>";
                    }
					
						echo "<tr class='seperator'><td>&nbsp;</td></tr>
            				  <tr class='seperator'><td colspan='2' class='contentLinks'>
            				  <a href='app_list.php'>Download Applications</a></td></tr>";
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