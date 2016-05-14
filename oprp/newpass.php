<?php require_once("_php/initialize.php"); 

if(isset($_GET['link']) && isset($_GET['id'])){
	
	$id = $_GET['id'];
	$link = $_GET['link'];
	
	if(!User::validateLink($id,$link))
		redirect_to("index.php");
	
}else{
	
	redirect_to("index.php");
}
  

if(isset($_POST["submit"])){	

	$id = trim($_POST["id"]);	
	$passw = trim($_POST["passw"]);
	
	$is_set = User::setNewPass($id, $passw);
	
	if($is_set){
		$msg = setErrNotMsg("Password has been changed successfully. You can now login.");		
	}else{		 
		$msg = setErrMsg("Password could not be changed due to some technical issues. Please try later.");
	}	
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php include("_include/title.php"); ?> - Reset Password</title>
<?php include("_include/design.php"); ?>

<script type="text/javascript"> 
$(document).ready(function() { 
  $("#newpass").validate({ 
	rules: { 
	  passw: {
		  required: true
	  },
	  passw2: {
		  required: true,
		  equalTo: "#passw"
	  }
	}, 
	messages: { 
	  passw: {
		  required: "<br/>Please enter the new password."
	  },
	  passw2: {
		  required: "<br/>Please confirm your new password.",
		  equalTo: "<br/>Both passwords do not match."
	  }
	} 
  }); 
}); 
</script>

</head>

<body>
<?php include("_include/header.php"); ?>
<?php include("_include/topmenu.php"); ?>
<?php include("_include/login.php"); ?>

<!--body-->
            	
                
<table width="100%" cellpadding="0" cellspacing="30" border="0" align="center" class="normalTxt">

<?php if(isset($msg)) echo"<tr><td>{$msg}</td></tr>"; ?>       
    
    <tr><td>
        <form action="" method="post" name="newpass" id="newpass">
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        <table width="70%" cellpadding="0" cellspacing="10" border="0" align="left">
        <tr height="50px"><td colspan="2"><strong>Please enter your new password.</strong></td></tr>
        <tr><td width="25%"><label>New Password: </label></td>
            <td><input name="passw" id="passw" type="password" maxlength="50" /></td></tr>
        <tr><td><label>Retype: </label></td>
            <td><input name="passw2" id="passw2" type="password" maxlength="50"/></td></tr>
        <tr><td>&nbsp;</td>
            <td><input name="submit" type="submit" value="Set Password"  class="submitStyle"/></td></tr>
        </table>
        </form>
    </td></tr>
</table>

<!--body close-->   
                    
<?php include("_include/footer.php"); ?>
</body>
</html>