<?php require_once("_php/init_compiler.php"); 

	$user_id = $session->user_id;
	$access = $session->access;

	if(!isset($user_id))
		header("Location: index.php?notloggedin");
	
	$user = null;
	if(isset($_GET['user']))
		$user = "user";
	
	$contest_value = null;
	if(isset($_GET['contest_value']))
		$contest_value = $_GET['contest_value'];
		
	$submission_status = -1;
	if(isset($_GET['submission_status']))
		$submission_status = $_GET['submission_status'];
		
		
	$question_value = null;
	if(isset($_GET['question_value']))
		$question_value = $_GET['question_value'];
	
	$view = 0;	
	if(isset($_GET['view']))
		$view = $_GET['view'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php include("../_include/title.php"); ?> - Stats </title>
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

	include_once("_php/menu.php");
	
	echo "<br><br>";
	
	if($contest_value != null)
	{
		if($user == null)
		{
			$result = getQuestionbyContestValue($contest_value);
	
			while($row = mysql_fetch_array($result))
			{
				echo "<a href='problem.php?que_value=".$row['que_value']."'>".$row['que_title']."</a><br>";
				$result_user = getUniqueUserByQuestion($row['que_value']);
				echo "Number of submissions for the question: ".getString('count(*)', 'submission', 'que_value', $row['que_value'])."<br>";
				echo "Number of successful submissions for the question: ".getString('count(*)', 'submission', 'que_value', $row['que_value']."' and submission_status = '1 ")."<br>";
				echo "Points: ".$row['points']."<br />";
				$result_user = getUniqueUserByQuestion($row['que_value']);
				
				while($row_user = mysql_fetch_array($result_user))
				{
					if($row_user['access'] != 19 )
						echo "-- <a href='participant_profile.php?user_id=".$row_user['user_id']."'>".$row_user['username']."</a><br />";			
				}
				echo "<hr/>";
			}
		}
		else
		{
			$result = getUserbySolvedQuestion($contest_value);
			echo "
				<table border='0' cellpadding='5' width='100%' class='normalTxt infotbl'>
					<tr>
						<th><label>User</label></th>
						<th><label>Question Solved</label></th>
					</tr>
				";
			
			while($row = mysql_fetch_array($result))
			{
                            $cur_access = getString('access', 'user', 'user_id', $row['user_id']);
                            if(($cur_access%2)==0)
                            {
				echo "<tr>";
				echo "<td><a href='participant_profile.php?user_id=".$row['user_id']."'>".getString('username', 'user', 'user_id', $row['user_id'])."</a></td>";
				echo "<td>".$row['num']."</td>";
				echo "</tr>";
                            }
			}
			echo "</table>";
		}
	}
?>


    </td></tr>
</table>
               
<!--body close--> 
                  
<?php include("../_include/footer.php"); ?>
</body>
</html>
