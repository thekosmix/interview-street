<?php require_once("_php/init_compiler.php"); 

	$user_id = $session->user_id;

	if(!isset($user_id))
		header("Location: index.php?notloggedin");
?>			
			

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php include("../_include/title.php"); ?> - Shared Links </title>
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
		$result = getSharedLinks();
		echo "<table border='0' cellpadding='5' width='100%' class='normalTxt infotbl'>
			<tr><th>Program</th><th>Language</th><th>Compile Time</th></tr>";
		while($row = mysqli_fetch_array($result))
		{
			echo "<tr><td width='150' class='contentLinks'>";
			if($row['link_name']!=NULL)
				echo "<a href='view.php?link_value=".$row['link_value']."'>".$row['link_name']."</a>";
			else
				echo "<a href='view.php?link_value=".$row['link_value']."'>".$row['link_value']."</a>";
					
			echo"</td><td width='50' align='center'>".$row['link_ext']."</td><td width='150'>".$row['compile_date']."</td></tr>";
		}
		echo "</table>";
	?>
    

   
    </td></tr>
</table>
               
<!--body close--> 
                  
<?php include("../_include/footer.php"); ?>
</body>
</html>
