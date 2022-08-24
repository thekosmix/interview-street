<?php require_once("_php/init_compiler.php"); 

$que_value = null;
if(isset($_GET['que_value']))
	$que_value = $_GET['que_value'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php include("../_include/title.php"); ?> - Problem</title>
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
    if($que_value != null)
	{
	$row = getQuestionByValue($que_value);

		?>
        
        <table width="100%">
        	<tr>
            	<td width="500"><h3>Program:</h3></td>
            </tr>
            <tr>
            	<td><?php echo $row['que_title']; ?></td>
            </tr>
            <tr>
            	<td><h3>Description:</h3></td>
            </tr>
            <tr>
                <td><?php echo $row['que_description']; ?></td>
            </tr>
            <tr>
            	<td><h3>Input Specification:</h3></td>
            </tr>
            <tr>
                <td><?php echo $row['que_input']; ?></td>
            </tr>
            <tr>
            	<td><h3>Output Specification:</h3></td>
            </tr>
            <tr>
                <td><?php echo $row['que_output']; ?></td>
            </tr>
            <tr>
            	<td><h3>Description:</h3></td>
            </tr>
            <tr>
                <td><?php echo $row['output_description']; ?></td>
            </tr>
            
            <?php if(isset($session->user_id)) { ?>
            <tr>
                <td class="contentLinks"><a href='index.php?que_value=<?php echo $que_value; ?>'>Submit Solution</a></td>
            </tr>
            <?php } ?>
            
        </table>
        
        <?php
	}
	else
	{
		$result = getAllQuestion();
		$count = 1;
		
		echo "<table border='0' cellpadding='5' width='100%' class='normalTxt infotbl'>
			<tr><td><label><strong>S.No.</strong></label></td><td><label><strong>Questions</strong></label></td>
			<td><label><strong>Stats </strong></label></td></tr>";
		
		while($row = mysqli_fetch_array($result))
		{
			echo "<tr>";
	   		echo "<td>".$count.".</td>"; 
			echo "<td class='contentLinks'><a href='problem.php?que_value=".$row['que_value']."'>".$row['que_title']."</a></td>";
			echo "<td>".successful_submission($row['que_value'])."/".total_submission($row['que_value'])."</td></tr>";
			$count++;
		}
		echo "</table>";
	}
	
?>
    
    
    </td></tr>
</table>
               
<!--body close--> 
                  
<?php include("../_include/footer.php"); ?>
</body>
</html>

