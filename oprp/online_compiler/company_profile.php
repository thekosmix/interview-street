<?php require_once("_php/init_compiler.php"); 
	
	$user_id = $session->user_id;
	$access = $session->access;

	if(!$session->isRecruiter())
		header("Location: index.php");
		
	if(isset($_POST['submit']))
	{
		$contest_name=$_POST['contest_name'];
		$start_date = $_POST['start_date'];
		$start_time = $_POST['start_time'];
		$duration = $_POST['duration'];
		$contest_value  = link_value();
		$min_marks = $_POST['min_marks'];
		
		$bool = insertContest($contest_name, $contest_value, $user_id, $start_date, $start_time, $duration, $min_marks);
		if($bool)
			header("Location: contest.php?view=1");
		else
			echo "error";
	}

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php include("../_include/title.php"); ?> - Add Contest </title>
<?php include("../_include/design.php"); ?>
<script type="application/javascript">
$(function() {
	$( "#start_date" ).datepicker({dateFormat: "yy-mm-dd"});
});
</script>
</head>

<body>
<?php include("../_include/header.php"); ?>
<?php include("_php/topmenu.php"); ?>
<?php include_once("_php/menu.php"); ?>


<!--body-->

<table width="100%" cellpadding="0" cellspacing="30" border="0">
    <tr><td align="left" style="font-size:12px; line-height:18px">
    
    
<h3>Start a contest</h3>
<form action="" method="post">
	<table border='0' cellpadding='5' width='100%' class='normalTxt infotbl'>
    	<tr>
        	<td>Contest Name: </td>
            <td><input name="contest_name" id="contest_name" value="" /></td>
        </tr>
        <tr>
                <td>Start Date </td>
                <td><input name="start_date" id="start_date" value="" /></td>
        </tr>
        <tr>
        	<td>Start Time (hh:mm:ss)</td>
            <td><input name="start_time" id="start_time" value="" /></td>
        </tr>         
        <tr>
                <td>Duration(in minutes): </td>
                <td><input name="duration" id="duration" value="" /></td>
            </tr>
         <tr>
                <td>Cut off Marks: </td>
                <td><input name="min_marks" id="min_marks" value="" /></td>
            </tr>
        <tr>
            	<td colspan="2"><input type="submit" name="submit" id="submit" value="Submit" class="submitStyle"/></td>
        </tr>
    </table>
</form>

    </td></tr>
</table>
               
<!--body close--> 
                  
<?php include("../_include/footer.php"); ?>
</body>
</html>
