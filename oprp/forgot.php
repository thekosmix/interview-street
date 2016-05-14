<?php require_once("_php/initialize.php"); 

if(isset($_POST["submit"])){	

	$uname = trim($_POST["uname"]);
	$email = trim($_POST["email"]);
	
	if(User::sendNewPassLink($uname, $email)){
		$msg = setErrNotMsg("Link to reset your password has been sent to your Email ID.");		
	}else{	
		$msg = setErrMsg("Either Username or Email ID is incorrect.");
	}	
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php include("_include/title.php"); ?> - Forgot Password</title>
<?php include("_include/design.php"); ?>
</head>

<body>
<?php include("_include/header.php"); ?>
<?php include("_include/topmenu.php"); ?>
<?php include("_include/login.php"); ?>

<!--body-->

<table width="100%" cellpadding="0" cellspacing="20" border="0" align="center" class="normalTxt">

<?php if(isset($msg)) echo"<tr><td>{$msg}</td></tr>"; ?>       
    
    <tr><td>
        <form action="" method="post" name="sendpass">
        <table width="60%" cellpadding="0" cellspacing="10" border="0" align="left" class="normalTxt">
        <tr height="50px"><td colspan="2"><strong>Please enter your Username and Email ID.</strong></td></tr>
        <tr><td width="25%"><label>Username: </label></td><td><input name="uname" type="text" maxlength="50" /></td></tr>
        <tr><td><label>Email: </label></td><td><input name="email" type="text" maxlength="50" /></td></tr>
        <tr><td colspan="2" align="center"><input name="submit" type="submit" value="Get Password"  class="submitStyle"/></td></tr>
        </table>
        </form>
    </td></tr>
</table>
 
 
<!--body close-->  
                    
<?php include("_include/footer.php"); ?>
</body>
</html>