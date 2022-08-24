<?php require_once("_php/init_compiler.php"); 

$result = getUserbyPoints();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php include("../_include/title.php"); ?> - Ranking </title>
<?php include("../_include/design.php"); ?>
</head>

<body>
<?php include("../_include/header.php"); ?>
<?php include("_php/topmenu.php"); ?>
<?php include_once("_php/menu.php"); ?>


<!--body-->

<table width="100%" cellpadding="0" cellspacing="30" border="0">
    <tr><td align="left" style="font-size:12px; line-height:18px">
    

			<table border='0' cellpadding='5' width='100%' class='normalTxt infotbl'>
            	<tr>
                	<td><label><strong>Username</strong></label></td>
                    <td><label><strong>Points</strong></label></td>
                </tr>            
			<?php
                while($row = mysqli_fetch_array($result))
                {
                    $access = getString('access', 'user', 'user_id', $row['user_id']);
                    if(($access%2) == 0)
                    {
                    echo "<tr>";
                    echo "<td class='contentLinks'><a href='participant_profile.php?user_id=".$row['user_id']."'>".
							getString('username', 'user', 'user_id', $row['user_id'])."</a></td>";
                    echo "<td>".$row['points']."</td>";
                    echo "</tr>";
                    }
                }
            ?>
            </table>
    
    
    
    </td></tr>
</table>
               
<!--body close--> 
                  
<?php include("../_include/footer.php"); ?>
</body>
</html>
