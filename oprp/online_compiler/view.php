<?php require_once("_php/init_compiler.php"); 

$link_value = null;
$que_value = null;
$submission_value = null;
$user_id = 0;

$cur_user_id=0;
$cur_access = 0;
if($session->is_logged_in())
{
    $cur_user_id = $session->user_id;
    $cur_access = $session->access;
}

if(isset($_GET['link_value']))
	$link_value = $_GET['link_value'];
if(isset($_GET['submission_value']))
	$submission_value = $_GET['submission_value'];
if(isset($_GET['que_value']))
	$que_value = $_GET['que_value'];
if(isset($_GET['user_id']))
	$user_id = $_GET['user_id'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php include("../_include/title.php"); ?> - Problem </title>
<?php include("../_include/design.php"); ?>

<script type="text/javascript">
	function myscript(submission_value)
	{
			$.ajax({ 
			   type: "POST",
			   url: "_ajax/submissionDetail.php?submission_value="+submission_value,
			   success: function(msg){
				  $("#submission_detail").html(msg)
			   }
			});
	}
</script>
</head>
<body>
<?php include("../_include/header.php"); ?>
<?php include("_php/topmenu.php"); ?>
<?php include_once("_php/menu.php"); ?>


<!--body-->

<table width="100%" cellpadding="0" cellspacing="30" border="0">
    <tr><td align="left" style="font-size:12px; line-height:18px">
    
	<?php
	
	if($link_value != null)
	{
		$row_link = getlinkdetail($link_value);
		
		echo "<h3>Program:</h3><pre>".$row_link['link_prog']."</pre>";
		echo "<hr />";
		echo "<h3>Input:</h3><pre>".$row_link['link_input']."</pre>";
		echo "<hr />";
		echo "<h3>Output</h3><pre>".$row_link['link_output']."</pre>";
		echo "<hr />";
		echo "<h3>Execution time:</h3><pre>".$row_link['exec_time']."</pre>";
		echo "<hr />";
		echo "<h3>Comment:</h3><pre>".$row_link['link_comment']."</pre>";
		echo "<hr />";
		echo "<h3>Compile Date:</h3><pre>".$row_link['compile_date']."</pre>";
	}
	else
	{
		if(($que_value != null) && ($user_id != 0))
			$result = getSubmissionByUserId("que_value = '".$que_value."' and user_id = '".$user_id."'");
		elseif($user_id != 0)
			$result = getSubmissionByUserId("user_id = '".$user_id."'");
		elseif($que_value != null)
			$result = getSubmissionByUserId("que_value = '".$que_value."'");	
		
			?>

				<table border='0' cellpadding='5' width='100%' class='normalTxt infotbl'>
					<tr>
						<th>Problems</th>
						<th>Programming Lang</th>
						<th>Status</th>
						<th>Submitted On</th>
					</tr>
		<?php
			while($row_submission = mysql_fetch_array($result))
			{
				echo "<tr>
					<td class='contentLinks'>";
					
				if(($cur_user_id == $user_id) || ($session->isRecruiter()))
					echo "<a onclick='return myscript(\"{$row_submission['submission_value']}\");'>";
					
				echo getString('que_title', 'question', 'que_value', $row_submission['que_value'])."</a></td><td>".$row_submission['submission_ext']."</td>";
				echo "<td>".returnStatus($row_submission['submission_status'])."</td>";
				echo "<td>".$row_submission['submission_time']."</td>";
				echo "</tr>";
			}
			echo "</table>";
			
			if($cur_user_id == $user_id)
				echo "<br/><span class='contentLinks'><a href='index.php?que_value=".$que_value."'>Submit Again</a><span>";
	}
?>
<div id="submission_detail"></div>
    
    
    </td></tr>
</table>
               
<!--body close--> 
                  
<?php include("../_include/footer.php"); ?>
</body>
</html>
