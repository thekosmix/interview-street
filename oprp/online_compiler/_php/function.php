<?php

function getString($string, $table, $column, $value)
{
	global $db;
	
	$sql = "select ".$string." from ".$table." where ".$column." = '".$value."'";
	
	//echo $sql."<br><br>";
	
	$result = $db->query($sql);
	$row = mysqli_fetch_array($result);
	
	return $row[$string];
}


function insertlink($link_value, $title, $link_prog, $link_ext, $link_input, $link_output, $time, $user_id, $comment, $share)
{
	global $db;
	$user_id = empty($user_id) ? ",NULL" : ",'".$user_id."'";
	
	$sql = "insert into link (link_value, link_name, link_prog, link_ext, link_input, link_output, exec_time, link_comment, share, user_id) values('"
	.mysqli_real_escape_string($db->mysqli, $link_value)."','"
	.mysqli_real_escape_string($db->mysqli, $title)."','"
	.mysqli_real_escape_string($db->mysqli, $link_prog)."','"
	.mysqli_real_escape_string($db->mysqli, $link_ext)."','"
	.mysqli_real_escape_string($db->mysqli, $link_input)."','"
	.mysqli_real_escape_string($db->mysqli, $link_output)."','"
	.$time."','"
	.mysqli_real_escape_string($db->mysqli, $comment)."','"
	.$share."'"
	.$user_id
	.")";
	
	$result = $db->query($sql);
	
	if(!$result)
		return false;
	else
		return true;

}

function insertsubmission($submission_value, $que_value, $file_content, $ext, $status, $user_id)	
{
	global $db;
	$num_user=getUniqueUserid($que_value);
	$points=200/(40+$num_user);
	$points = number_format($points, 4, '.', '');
	$sql_points="UPDATE question SET points='".$points."' WHERE que_value='".$que_value."'";
	$db->query($sql_points);
	$sql = "insert into submission (submission_value, que_value, submission_prog, submission_ext, submission_status, user_id) values('".mysqli_real_escape_string($db->mysqli, $submission_value)."','".mysqli_real_escape_string($db->mysqli, $que_value)."','".mysqli_real_escape_string($db->mysqli, $file_content)."','".mysqli_real_escape_string($db->mysqli, $ext)."','".mysqli_real_escape_string($db->mysqli, $status)."','".$user_id."')";
	
	$result = $db->query($sql);
	
	if(!$result)
		return false;
	else
		return true;
}

function getlinkdetail($link_value)
{
	global $db;
	$sql = "select * from link where link_value = '".$link_value."'";
	
	$result = $db->query($sql);
	$row = mysqli_fetch_array($result);
	
	if($result)
		return $row;
	else
		return null;
}

function getSubmissionByUserId($query)
{
	global $db;
	$sql = "select * from submission where ".$query;
	
	$result = $db->query($sql);
	
	if($result)
		return $result;
	else
		return null;
}

function link_value()
{
	$chars = "a4bfg567hijkrs6tu3vw8cde4xyz023mnopq489";
    srand((double)microtime()*1000000);
    $i = 0;
    $link_value = '' ;
    while ($i++ <= 7) 
	{
        $num = rand() % 33;
        $tmp = substr($chars, $num, 1);
        $link_value = $link_value.$tmp;
    }
	
	return $link_value;
}

function getAllQuestion()
{
	global $db;
	$sql = "select que_value, que_title from question where universal = '1'";
	
	$result = $db->query($sql);
	
	if($result)
		return $result;
	else
		return null;
}

function getQuestionbycompany($user_id)
{
	global $db;
	$sql = "select * from competition where user_id = '".$user_id."'";
	
	$result = $db->query($sql);
	
	if($result)
		return $result;
	else
		return null;
}

function getQuestionByValue($que_value)
{
	global $db;
	$sql = "select * from question where que_value='".$que_value."'";
	
	$result = $db->query($sql);
	$row = mysqli_fetch_array($result);
	
	if($result)
		return $row;
	else
		return null;
}

/*
function login($username, $password)
{
	global $db;
	$sql = "select * from user where username = '".$username."'";
	
	$result = $db->query($sql);
	$row = mysqli_fetch_array($result);
	
	if(sha1($password) == $row['password'])
	{
		$_SESSION['username'] = $username;
		$_SESSION['access'] = $row['access'];	
		$_SESSION['user_id'] = $row['user_id'];
		
		if($_SESSION['access'] == "company")
			header("Location: company_profile.php");
		
		return 1;
	}
	else
		return 0;
}



function register($username, $password, $access)
{
	global $db;
	$password = sha1($password);

	$sql = "insert into user (username, password, access) values('".$username."', '".$password."','".$access."')";
	$result = $db->query($sql);
	
	if($result)
	{

           
		session_start();
		$_SESSION['username'] = $username;
		$_SESSION['access'] = $row['access'];
		$_SESSION['user_id'] = mysqli_insert_id();
		
		return 1;
	}
	else
		return 0;
}

*/

function getuserdetailbyID($user_id)
{
	global $db;
	$sql = "select * from user where user_id = '".$user_id."'";
	
	$result = $db->query($sql);
	$row = mysqli_fetch_array($result);
	
	if($result)
		return $row;
	else
		return null;
}

function getcompiledlinkbyuserid($user_id)
{
	global $db;
	$sql = "select * from link where user_id = '".$user_id."' order by compile_date desc";
	
	$result = $db->query($sql);
	
	if($result)
		return $result;
	else
		return null;
}

function getUniqueSubmissionsbyuserid($user_id)
{
	global $db;
	$sql = "select distinct que_value from submission where user_id = '".$user_id."'";
	
	$result = $db->query($sql);
	
	if($result)
		return $result;
	else
		return null;
}

function uploadquestion($que_value, $que_title, $que_description, $que_input, $que_output, $output_description, $exec_time, $marks, $universal, $contest_value)
{
	global $db;
	
	$sql = "insert into question (que_value, que_title, que_description, que_input, que_output, output_description, exec_time, marks, points, universal, contest_value) values('".mysqli_real_escape_string($db->mysqli, $que_value)."','".mysqli_real_escape_string($db->mysqli, $que_title)."','".htmlspecialchars(mysqli_real_escape_string($db->mysqli, $que_description))."','".htmlspecialchars(mysqli_real_escape_string($db->mysqli, $que_input))."','".htmlspecialchars(mysqli_real_escape_string($db->mysqli, $que_output))."','".htmlspecialchars(mysqli_real_escape_string($db->mysqli, $output_description))."','".$exec_time."','".$marks."','5','".$universal."','".$contest_value."')";
	
	$result = $db->query($sql);
	
	if(!$result)
		return false;
	else
		return true;
}
	
function insertContest($contest_name, $contest_value, $user_id, $start_date, $start_time, $duration, $min_marks)
{
	global $db;
	$sql = "insert into contest (contest_name, contest_value, user_id, start_date, start_time, duration, min_marks) values('".$contest_name."','".$contest_value."','".$user_id."','".$start_date."','".$start_time."','".$duration."','".$min_marks."')";
	//echo $sql;
	$result = $db->query($sql);
	
	if(!$result)
		return false;
	else
		return true;
	
}

function getuserdetail($username)
{
	global $db;
	$sql="SELECT * FROM user WHERE username='".$username."'";
	$result=$db->query($sql);
	if($result)
		return $result;
	else
		return null;
}

function getContestbyCompanyID($user_id)
{
	global $db;
	$sql="SELECT * FROM contest WHERE user_id='".$user_id."'";
	//$sql = "SELECT * FROM contest c, question q where user_id = '".$user_id."'";
	$result=$db->query($sql);
	if($result)
		return $result;
	else
		return null;
}

function getQuestionbyContestValue($contest_value)
{
	global $db;
	$sql="SELECT * FROM question WHERE contest_value='".$contest_value."'";
	//$sql = "SELECT * FROM contest c, question q where user_id = '".$user_id."'";
	$result=$db->query($sql);
	if($result)
		return $result;
	else
		return null;
}

function getAllContest()
{
	global $db;
	$sql="SELECT * FROM contest";
	//$sql = "SELECT * FROM contest c, question q where user_id = '".$user_id."'";
	$result=$db->query($sql);
	if($result)
		return $result;
	else
		return null;
}
function getUniqueUserByQuestion($que_value)
{
	global $db;
 	$sql = "SELECT u.user_id, u.username, u.access, s.submission_status FROM submission s RIGHT JOIN user u ON u.user_id = s.user_id WHERE que_value = '".$que_value."' GROUP BY s.user_id";
	
	//echo $sql."<br><br>";
	
	$result = $db->query($sql);
	
	if($result)
		return $result; 
	else
		return null;
}
function getUniqueUserid($que_value)
{
	global $db;
	$sql="SELECT COUNT( DISTINCT (user_id) ) FROM submission WHERE que_value = '".$que_value."' AND submission_status =  '1' AND user_id >0";
	$result = $db->query($sql);	
	$row = mysqli_fetch_array($result);
	if($result)
		return $row[0]; 
	else
		return null;
}
function userPoints($user_id)
{
	global $db;
	$sql="SELECT SUM( points ) FROM question WHERE que_value IN (
			SELECT DISTINCT (
			que_value
			)
			FROM submission
			WHERE user_id =  '".$user_id."'
			AND submission_status =  '1'
			) ";
	
	$result=$db->query($sql);
	$row=mysqli_fetch_array($result);
	return $row[0];
}

function getUserbyPoints()
{
	global $db;
	
	$sql = "SELECT DISTINCT user_id, sum( points ) as points FROM submission NATURAL JOIN question WHERE submission_status = '1' GROUP BY user_id ORDER BY sum( points ) desc";
	
	//echo $sql;
	$result = $db->query($sql);
	if($result)
		return $result;
	else
		return null;
	
}

function getUserbySolvedQuestion($contest_value)
{
	global $db;
	
	$sql = "select count(DISTINCT que_value, user_id) as num, user_id 
			from question natural join submission
			where contest_value = '".$contest_value."' and submission_status = '1'
			group by user_id
			order by num desc";
			
	$result = $db->query($sql);
	if($result)
		return $result;
	else
		return null;
}

function returnStatus($status)
{
	if($status == 1)
		return "Right Answer";
	else
		return "Wrong Answer";	
}

function successful_submission($que_value)
{
	global $db;
	
	$sql = "SELECT count(*)  FROM submission  WHERE que_value = '".$que_value."' and submission_status = '1'";
	
	$result = $db->query($sql);
	$row = mysqli_fetch_array($result);
	
	if($result)
		return $row[0];
	else
		return 0;
}

function total_submission($que_value)
{
	global $db;
	
	$sql = "SELECT count(*)  FROM submission  WHERE que_value = '".$que_value."'";
	
	$result = $db->query($sql);
	$row = mysqli_fetch_array($result);
	
	if($result)
		return $row[0];
	else
		return 0;
}

function getSharedLinks()
{
	global $db;
	$sql = "select * from link where share = '1' order by compile_date desc";
	
	$result = $db->query($sql);
	
	if($result)
		return $result;
	else
		return null;
}


?>