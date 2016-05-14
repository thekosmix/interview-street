<?php require_once("_php/init_compiler.php");
	
	$user_id = $session->user_id;
	$access = $session->access;

	if(!$session->isRecruiter())
		header("Location: index.php");
		
	if(!isset($_GET['contest_value']))			
		$contest_value = null;
	else
		$contest_value=$_GET['contest_value'];
	
	if(isset($_POST['submit']))
	{
		$que_value = $_POST['que_value'];
		$que_title = $_POST['que_title'];
		$que_description = $_POST['que_description'];
		$que_input = $_POST['que_input'];			
		$que_output = $_POST['que_output'];	
		$output_description = $_POST['output_description'];
        $exec_time = $_POST['exec_time'];
		$contest_value = $_POST['contest_value'];
		$marks = $_POST['marks'];
		$universal = $_POST['universal'];
		
		$in_file_error = $_FILES["input_file"]["error"];
		$in_file_size = $_FILES["input_file"]["size"]; 
		$in_file_name = $que_value.".txt";
		$in_file_tmp = $_FILES["input_file"]["tmp_name"];
		
		$out_file_error = $_FILES["output_file"]["error"];
		$out_file_size = $_FILES["output_file"]["size"]; 
		$out_file_name = $que_value.".txt";
		$out_file_tmp = $_FILES["output_file"]["tmp_name"];
		
		if(($in_file_error == 0) && ($out_file_error == 0))
		{
			if(move_uploaded_file($out_file_tmp,$out_folder.$out_file_name) && move_uploaded_file($in_file_tmp,$in_folder.$in_file_name))
			{
				$bool = uploadquestion($que_value, $que_title, $que_description, $que_input, $que_output, $output_description, $exec_time, $marks, $universal, $contest_value);
				if($bool)
				{
					if($contest_value == null)
						echo "Que Uploaded<br>";
					else
						header("Location: contest.php?view=1");
				}
				else
					echo "Que not Uploaded";
			}
		}	
	}
	
$value = link_value();	
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php include("../_include/title.php"); ?> - Upload Question </title>
<?php include("../_include/design.php"); ?>
</head>

<body>
<?php include("../_include/header.php"); ?>
<?php include("_php/topmenu.php"); ?>
<?php include_once("_php/menu.php"); ?>


<!--body-->

<table width="100%" cellpadding="0" cellspacing="30" border="0">
    <tr><td align="left" style="font-size:12px; line-height:18px">
        
        <form action="" id="upload_question" method="post" name="upload_question" enctype="multipart/form-data">
        	<input type="hidden" name="que_value" value="<?php echo $value; ?>" />
        	<table border="0" cellspacing="5">
            <input type="hidden" name="contest_value" id="contest_value" value="<?php echo $contest_value; ?>" />
            	<tr>
                    <td>Que Title:</td>
                    <td><input type="text" name="que_title" /></td>
                </tr>
                	<td>Que Description:</td>
                    <td><textarea name="que_description"></textarea></td>
                <tr>
                	<td>Input:</td>
                    <td><textarea name="que_input"></textarea></td>
                </tr>
                <tr>
                	<td>Output:</td>
                    <td><textarea name="que_output"></textarea></td>
                </tr>
                <tr>
                	<td>Output Description:</td>
                    <td><textarea name="output_description"></textarea></td>
                </tr>
                <tr>
                	<td>Time limit (in ms):</td>
                    <td><input type="text" name="exec_time" /></td>
                </tr>
                <tr>
                	<td>Marks:</td>
                    <td><input type="text" name="marks" /></td>
                </tr>
                <tr>
                	<td>Universal:</td>
                    <td><input type="radio" name="universal" value="1" />Yes || 
                    	<input type="radio" name="universal" value="0" />No </td>
                </tr>
                <tr>
                	<td>Upload Input</td>
                    <td><input type="file" name="input_file" id="input_file" /></td>
                </tr>   
				<tr>
                	<td>Upload Output</td>
                    <td><input type="file" name="output_file" id="output_file" /></td>
                </tr>   
                <tr>
                	<td colspan="2"><input type="submit" name="submit" value="Submit" class="submitStyle" /></td>
                </tr>                                           
            </table>
        </form>
        
    </td></tr>
</table>
               
<!--body close--> 
                  
<?php include("../_include/footer.php"); ?>
</body>
</html>