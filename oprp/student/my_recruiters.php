<?php  require_once("../_php/init_student.php"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php include("../_include/title.php"); ?> - My Recruiters</title>
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
        <tr height="40px" valign="middle"><td><span class="topicTxt">My Recruiters</span>
        
        <?php if($session->isIC() || $session->isPC()){
        		echo"<a href='add_recruiter.php' title='Add Recruiter'>";
            	echo"<img src='../_images/add.png' hspace='10' align='middle' alt='Add Recruiter' /></a>";
		}?>

        		
        </td></tr>
        <tr valign="top"><td width="100%">
        
            <table cellpadding="6" border="0" width="100%" class='normalTxt infotbl'>    
            
            <?php 	$course = Student::getCourseByID($session->user_id);
					switch($course){
					case 'be': $info = Academics_BE::getDetailByID($session->user_id); 
							   $year_pass = $info->year_of_grad; break;
					case 'me': $info = Academics_ME::getDetailByID($session->user_id);
							   $year_pass = $info->year_of_pg; break;
					case 'mba': $info = Academics_MBA::getDetailByID($session->user_id);
								$year_pass = $info->year_of_pg; break;	
					}
					
	              $rec_arr = Recruiter::getMyRecruiter($info->branch, $info->agg, $year_pass); 
                
                if($rec_arr){
					
					echo"<tr><th><label>Arrival Date</label></th>
						 <th><label>Grade</label></th>
						 <th><label>Recruiter</label></th>
						 <th><label>Branches</label></th>
						 <th><label>Min Score</label></th>
						 <th><label>For</label></th>
						 <th><label>Status</label></th>
						 </tr>";
					
                    while($rec = array_shift($rec_arr))
                    {
                        echo"<tr>";
						
						if(!empty($rec->arrival_date))
							echo "<td><label>".date("d/m/y",strtotime($rec->arrival_date))."</label></td>";
                        else
							echo"<td>&nbsp;</td>";
							
						echo "<td><label>{$rec->grade}</label></td>";
                        echo "<td class='contentLinks'><a href='rec_profile.php?id={$rec->recruiter_id}'>{$rec->name}</a></td>";
						echo "<td><label>".arrDispFormat(str_to_arr($rec->branches))."</label></td>";
						echo "<td><label>{$rec->min_score}</label></td>";
						echo "<td><label>";
								if($rec->for_year==$session->passYear())
								    echo "Placement";
								else if($rec->for_year==$session->passYear()+1)
									echo "Intern";
						echo "</label></td>";
						
						$app = Application::getDetailBySR($session->user_id,$rec->recruiter_id);
						if($app)
							echo "<td><label>{$app->status}</label></td></tr>";
						else echo "<td><label>Not Applied</label></td></tr>";
                    }
				}else
                    echo "<tr><td colspan='6'><label>No recuiters till now.</label></td></tr>";
                    
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