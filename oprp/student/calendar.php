<?php  require_once("../_php/init_student.php"); 

if(isset($_GET['year'])) $year = $_GET['year'];
else $year = date("Y");

if(isset($_GET['month'])) $month = $_GET['month'];
else $month = date("n");

$d=1;
try { 
    $date = new DateTime($year."-".$month."-".$d);
} catch (Exception $e) {
    $date = new DateTime(date("Y-n-").$d);
}
$day = date_format($date, 'w');
$mon = date_format($date, 'F');
$ld = date_format($date, 't');

$recruiters = Recruiter::getRecruiterBetweenDates(date_format($date,'Y-m-d'),date_format($date,'Y-m-t'));
$course = Student::getCourseByID($session->user_id);
switch($course)
{
	case 'be': $acad = Academics_BE::getDetailByID($session->user_id); $yr_of_comp = $acad->year_of_grad; break;
	case 'me': $acad = Academics_ME::getDetailByID($session->user_id); $yr_of_comp = $acad->year_of_pg; break;
	case 'mba': $acad = Academics_MBA::getDetailByID($session->user_id); $yr_of_comp = $acad->year_of_pg; break;
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php include("../_include/title.php"); ?> - Calendar</title>
<?php include("../_include/design.php"); ?>
</head>

<body>
<?php include("../_include/header.php"); ?>
<?php include("_include/topmenu.php"); ?>
<?php include("_include/menu.php"); ?>
            
<!--body-->
            	
                
<table width="100%" cellpadding="0" cellspacing="20" border="0" align="center" class="normalTxt">

<?php if(isset($msg)) echo"<tr><td>{$msg}</td></tr>"; ?>       
    
    <tr height="30px" valign="middle"><td><span class="topicTxt">Calendar</span></td></tr>
    <tr><td class='calendarLinks'>
    <table width="100%" border="0"><tr align="center">
    <td><a href="calendar.php?<?php echo "month=".$month."&year=".($year-1);?>">&lt;&lt; Year</a></td>
    <td><a href="calendar.php?month=1&year=<?php echo $year;?>">Jan</a></td>
    <td><a href="calendar.php?month=2&year=<?php echo $year;?>">Feb</a></td>
    <td><a href="calendar.php?month=3&year=<?php echo $year;?>">Mar</a></td>
    <td><a href="calendar.php?month=4&year=<?php echo $year;?>">Apr</a></td>
    <td><a href="calendar.php?month=5&year=<?php echo $year;?>">May</a></td>
    <td><a href="calendar.php?month=6&year=<?php echo $year;?>">Jun</a></td>
    <td><a href="calendar.php?month=7&year=<?php echo $year;?>">Jul</a></td>
    <td><a href="calendar.php?month=8&year=<?php echo $year;?>">Aug</a></td>
    <td><a href="calendar.php?month=9&year=<?php echo $year;?>">Sep</a></td>
    <td><a href="calendar.php?month=10&year=<?php echo $year;?>">Oct</a></td>
    <td><a href="calendar.php?month=11&year=<?php echo $year;?>">Nov</a></td>
    <td><a href="calendar.php?month=12&year=<?php echo $year;?>">Dec</a></td>
    <td><a href="calendar.php?<?php echo "month=".$month."&year=".($year+1);?>">Year &gt;&gt;</a></td>
    </tr></table>
    </td></tr>
    
    <tr><td align="center"><strong><?php echo $mon.", ".$year;?></strong></td></tr>
    
    <tr><td>
    <table bordercolor="#666" border="1px solid" width="100%" cellspacing="0" cellpadding="5" class="calendar">
    <tr height='30px' bgcolor="#ccc">
    	<td width="14%">Sun</td>
        <td width="14%">Mon</td>
        <td width="14%">Tue</td>
        <td width="14%">Wed</td>
        <td width="14%">Thu</td>
        <td width="14%">Fri</td>
        <td width="14%">Sat</td></tr>
    
    <?php 
	if($recruiters){
	    $recruiter = array_shift($recruiters);
		$rec_date = new DateTime($recruiter->arrival_date);
		$date_num = intval(date_format($rec_date, 'd'));
	}else $date_num = 0;
	
	$st=0;	
	while($d<=$ld){ 
		echo"<tr height='70px'>";
		for($i=0; $i<7; $i++)
			if(($st==0 && $i<$day) || $d>$ld)
				echo"<td>&nbsp;</td>";
			else{
				$st=1;
				echo"<td style='vertical-align:top'";
				if(date_format($date,'Y-m-').$d == date('Y-m-d')) echo " bgcolor='#f0f0f0'";
				echo">{$d}<br/><br/>";
			
				while($d==$date_num)
				{		
					$myBranch = ",".$acad->branch.",";
					if(strpos($recruiter->branches,$myBranch)===false)
						echo"<a href='rec_profile.php?id=".$recruiter->recruiter_id."'>
							<span class='otherBranch' title='".$recruiter->name."'>".
							substr($recruiter->name,0,10)."</span></a><br/><br/>";
					else if(!Recruiter::checkEligiblity($recruiter->recruiter_id,$acad->branch,$acad->agg,$yr_of_comp))
						echo"<a href='rec_profile.php?id=".$recruiter->recruiter_id."'>
							<span class='myBranch' title='".$recruiter->name."'>".
							substr($recruiter->name,0,10)."</span></a><br/><br/>";
					else if(Application::getDetailBySR($session->user_id,$recruiter->recruiter_id))
						echo"<a href='rec_profile.php?id=".$recruiter->recruiter_id."'>
							<span class='applied' title='".$recruiter->name."'>".
							substr($recruiter->name,0,10)."</span></a><br/><br/>";
					else echo"<a href='rec_profile.php?id=".$recruiter->recruiter_id."'>
							  <span class='notApplied' title='".$recruiter->name."'>".
							  substr($recruiter->name,0,10)."</span></a><br/><br/>";
					
					if($recruiters){
						$recruiter = array_shift($recruiters);
						$rec_date = new DateTime($recruiter->arrival_date);
						$date_num = intval(date_format($rec_date, 'd'));
					}else $date_num = 0;
				}
				
				echo"</td>";
				$d++;
			}
		echo"</tr>";
	}
	
	?>
    </table></td></tr>
    
    <tr><td align="center">
    <table border="0" width="100%" height="30px" cellspacing="5">
    <tr>
    	<td width="20px" class="myBranch"></td><td>My Branch</td>
        <td width="20px" class="applied"></td><td>Applied</td>
        <td width="20px" class="notApplied"></td><td>Not Applied</td>
        <td width="20px" class="otherBranch"></td><td>Other Branch</td>
    </tr>
    </table>
    
    </td></tr>
    
</table>
                
                
<!--body close-->       
            
<?php include("../_include/footer.php"); ?>
</body>
</html>