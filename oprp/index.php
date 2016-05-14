<?php  require_once("_php/initialize.php"); 

if(isset($_GET["logout"])){
	if($_GET["logout"]==1)
		if($session->is_logged_in())
			$session->logout();
}

if($session->is_logged_in()) redirect_to($session->getFolder()."/");

if(isset($_POST["submit"])){	

	$uname = trim($_POST["uname"]);
	$passw = $_POST["passw"];
	$found_user = User::authenticated($uname, $passw);
	
	if($found_user){
		$session->login($found_user);
		redirect_to($session->getFolder()."/index.php");
		
	}else{
		
		$login_err=setErrMsg("Wrong Username or Password");
	}	
}

?>
 



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php include("_include/title.php"); ?> - Login</title>
<?php include("_include/design.php"); ?>
</head>

<body>
<?php include("_include/header.php"); ?>
<?php include("_include/topmenu.php"); ?>
<?php include("_include/login.php"); ?>


<!--body-->

<table width="100%" cellpadding="0" cellspacing="30" border="0">
    <tr><td style="font-size:12px">Please Login to access the &nbsp;&nbsp;<strong>O</strong>nline <strong>P</strong>latform for <strong>R</strong>ecruitment  and <strong>P</strong>reparation !!</td></tr>
    <tr><td align="left" style="font-size:12px; line-height:28px"><strong>Key Features</strong>
        <ul>
        <li>Company and branch specific announcements.</li>
        <li>Application of students in the eligible companies.</li>
        <li>Online compiler integrated for coding practice in 15 different languages.</li>
        <li>Contests for selection of students with coding skills.</li>
        <li>Calendar to view all the companies in the specific month.</li>
        <li>Forum to interact with each other and handle queries.</li>
        <li>Off-campus opportunities and interaction with alumni.</li>
        </ul>
    </td></tr>
</table>
               
<!--body close--> 
                  
<?php include("_include/footer.php"); ?>
</body>
</html>

