<?php  require_once("../_php/init_rmadmin.php");

if(isset($_POST["submit"])){
	
	$msg1 = "<span class='smallTxt err'>[Not Updated]</span>";
	$msg2 = $msg3 = $msg4 = $msg1;
	
	$uname = trim($_POST['uname']);
	if(!empty($uname)){
		if(User::updateUsernameByID($uname))
			$msg1 = "<span class='smallTxt errnot'>[Updated]</span>";
	}
	
	$email = trim($_POST['email']);
	if(!empty($email)){
		if(User::updateEmailByID($email))
			$msg2 = "<span class='smallTxt errnot'>[Updated]</span>";
	}
	
	$old_passw = trim($_POST['old_passw']);
	$new_passw = trim($_POST['new_passw']);
	if(!empty($old_passw) && !empty($new_passw)){
		if(User::validateLink($session->user_id, sha1($old_passw)))
			if(User::setNewPass($session->user_id, $new_passw))
				$msg3 = "<span class='smallTxt errnot'>[Updated]</span>";
	}
	
}



?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php include("../_include/title.php"); ?> - Settings</title>
<?php include("../_include/design.php"); ?>

<script type="text/javascript"> 
$(document).ready(function() { 
  $("#settings").validate({ 
	rules: { 
	  uname: { required: true, minlength: 6 },
	  email: { required: true, email: true },
	  confirm_passw: { equalTo: "#new_passw" }
	}, 
	messages: { 
	  uname: { 
	  	  required: "<br/>Username cannot be blank",
		  minlength: "<br/>Minimum length must be 6"
	  },
	  email: { 
	  	  required: "<br/>Email cannot be blank",
		  email: "<br/>Not a valid email"
	  },
	  confirm_passw: {
		  equalTo: "<br/>Both passwords must match"
	  }
	} 
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
        <tr height="40px" valign="middle"><td colspan="2"><span class="topicTxt">Settings</span></td></tr>
        <tr><td width="70%">
        
            <form action="" method="post" id="settings">                       
            <table cellpadding="6" border="0" width="100%" class="normalTxt infotbl">    
            
			<?php $info = User::getDetailByID($session->user_id); ?>
            	
				<tr class="highlighter"><td colspan="2"><?php if(isset($msg1)) echo $msg1." - "; ?> Change Username</td></tr>
                <tr><td><strong>Username</strong></td>
                	<td><input type="text" name="uname" id="uname" value="<?php echo $info->uname;?>"/></td></tr>
                <tr class="seperator"><td>&nbsp;</td></tr>
                
                <tr class="highlighter"><td colspan="2"><?php if(isset($msg2)) echo $msg2." - "; ?> Change Email</td></tr>
                <tr><td><strong>Email</strong></td>
                	<td><input type="text" name="email" id="email" value="<?php echo $info->email;?>"/></td></tr>
                <tr class="seperator"><td>&nbsp;</td></tr>
                
                <tr class="highlighter"><td colspan="2"><?php if(isset($msg3)) echo $msg3." - "; ?> Change Password</td></tr>
                <tr><td><strong>Old Password</strong></td>
                	<td><input type="password" name="old_passw" id="old_passw"/></td></tr>
                <tr><td><strong>New Password</strong></td>
                	<td><input type="password" name="new_passw" id="new_passw"/></td></tr>
                <tr><td><strong>Confirm</strong></td>
                	<td><input type="password" name="confirm_passw" id="confirm_passw"/></td></tr>
                <tr class="seperator"><td>&nbsp;</td></tr>
                
                    
                <tr height="50" class="seperator"><td colspan="2"><input type="submit" class="submitStyle" name="submit" value="Update" />
                    </td></tr>
                        
            </table>
            </form>
            
        </td>
        <td valign="top" align="center">&nbsp;</td>
        
        </tr>
            
        </table>

    </td></tr>
</table>
                
                
<!--body close-->       
            
<?php include("../_include/footer.php"); ?>
</body>
</html>