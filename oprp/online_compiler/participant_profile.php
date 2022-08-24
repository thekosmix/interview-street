<?php require_once("_php/init_compiler.php"); 

        $access = 0;
        $user_id = -1;
        if($session->is_logged_in())
        {
            $user_id = $session->user_id;
            $access = $session->access;
        }

	if(!isset($user_id))
		if(!isset($_GET['user_id']))
			header("Location: index.php?notloggedin");
			
	if(isset($_GET['user_id']))
			$user_id = $_GET['user_id'];
	
	if($session->isRecruiter())
		if(!isset($_GET['user_id']))
			header("Location: company_profile.php");
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php include("../_include/title.php"); ?> - Profile </title>
<?php include("../_include/design.php"); ?>
</head>

<body>
<?php include("../_include/header.php"); ?>
<?php include("_php/topmenu.php"); ?>
<?php include_once("_php/menu.php"); ?>


<!--body-->

<table width="100%" cellpadding="0" cellspacing="30" border="0">
    <tr><td align="left" style="font-size:12px; line-height:18px">
	
    <?php 
	$row = getuserdetailbyID($user_id);
	$prob_num = getString("count(distinct que_value)", "submission", "user_id", $user_id."' and submission_status = '1");
	echo 
		"
		<table cellpadding='5'  class='normalTxt infotbl' width='50%'>
			<tr>
				<th width='150px'>Username: </th>
				<td>".$row['username']."</td>
			</tr>
			<tr>
				<th>Email: </th>
				<td>".$row['email']."</td>
			</tr>
			<tr>
				<th>Problem Solved: </th>
				<td>".$prob_num."</td>
			</tr>
			<tr>
				<th>Points Earned: </th>
				<td>".userPoints($user_id)."</td>
			</tr>
		</table>
		";


	echo "<span class='contentLinks'><h3>Compiled Programs</h3>";
	$result = getcompiledlinkbyuserid($user_id);
	
	$i=0;
	echo"<table border='0' width='100%'>";
	while($row = mysqli_fetch_array($result))
	{	
		if($i%5==0) echo"<tr>";
		if($row['link_name'] == "")
			$row['link_name'] = $row['link_value'];
		
		echo "<td><a href='view.php?link_value=".$row['link_value']."'>".$row['link_name']."</a></td>";
		if($i%5==4) echo"</tr>";
		$i++;
	}
	echo "</table>";

	echo "<h3>Solved Questions</h3>";
	$result = getUniqueSubmissionsbyuserid($user_id);

	while($row = mysqli_fetch_array($result))
	{
		$que_title = getString('que_title', 'question', 'que_value', $row['que_value']);
		echo "<a href='view.php?que_value=".$row['que_value']."&user_id=".$user_id."'>".$que_title."</a><br/>";
	}
	
	echo "</span>";

?>


 </td></tr>
</table>
               
<!--body close--> 
                  
<?php include("../_include/footer.php"); ?>
</body>
</html>

