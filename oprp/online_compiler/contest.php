<?php require_once("_php/init_compiler.php"); 

	$user_id = $session->user_id;
	$access = $session->access;
	
	if(!isset($user_id))
		header("Location: index.php?notloggedin");
	
	date_default_timezone_set('Asia/Calcutta');

	$view = 0;	
	if(isset($_GET['view']))
		$view = $_GET['view'];
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php include("../_include/title.php"); ?> - Contest </title>
<?php include("../_include/design.php"); ?>
</head>

<body>
<?php include("../_include/header.php"); ?>
<?php include("_php/topmenu.php"); ?>
<?php include_once("_php/menu.php"); ?>


<!--body-->

<table width="100%" cellpadding="0" cellspacing="30" border="0">
    <tr><td align="left" style="font-size:12px; line-height:18px" class="contentLinks">


	<?php

		echo "<h2>Contest</h2>";
        $result = getAllContest();
		
		while($row = mysql_fetch_array($result))
		{					
			$cur_time=strtotime(date('Y-m-d H:i:s'));
			$start_time=strtotime($row['start_date']." ".$row['start_time']);

			$diff =  ($cur_time - $start_time)/60;
			
			if(((strcmp($cur_time, $start_time) > 0) && ($diff <= $row['duration'])) || ($user_id == $row['user_id']))
			{
				echo "<strong>".getString('username', 'user', 'user_id', $row['user_id'])."'s Contest: ".$row['contest_name']."</strong><br/>";
				echo "<a href='stats.php?contest_value=".$row['contest_value']."'>Question's Stats</a> || ";
				echo "<a href='stats.php?user=user&contest_value=".$row['contest_value']."'>User's Stats</a><br/>";
				$que_result = getQuestionbyContestValue($row['contest_value']);
				
				while($que_row = mysql_fetch_array($que_result))
					echo "--- <a href='problem.php?que_value=".$que_row['que_value']."'>".$que_row['que_title']."</a><br>";
			}			
			if($diff<0)
			{
				if($row['user_id'] == $user_id)
					echo "--- <a href='upload_question.php?contest_value=".$row['contest_value']."'>Upload Question to this contest</a>";
				else
					echo getString('username', 'user', 'user_id', $row['user_id'])."'s Contest <strong>".$row['contest_name']."</strong> will start in ".round(abs($diff), 2)." minutes";	
			}
			if($diff <= $row['duration'])
				echo "<hr/>";
		}
?>

    

   
    </td></tr>
</table>
               
<!--body close--> 
                  
<?php include("../_include/footer.php"); ?>
</body>
</html>