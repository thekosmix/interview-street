<?php

	$que_value = null;
	$in_file_name = null;
	
	$ext = $_POST['prog_lang'];
	$title = $_POST['title'];
	$prog_content = $_POST['example_1'];
	$input = $_POST['input'];
	$comment = htmlspecialchars($_POST['comment']);	
	$share = 0;
	if(isset($_POST['share']))
	 	$share = 1;	
	
	if($ext == "")
		header("Location: index.php?msg=Please select a prog lang");
	if($prog_content == "")
		header("Location: index.php?msg=Please paste your prog");
	if(isset($_POST['que_value']))
		$que_value = $_POST['que_value'];		
	
	$file_name = "Main.".$ext;
	$ext = $ext."/";
    $createfile = fopen($ext.$file_name, 'w') or error_log("can't open file");
    fwrite($createfile, $prog_content);
    fclose($createfile);
	
	if($input != "")
	{
		$in_file_name = "input.txt";
		$createinputfile = fopen($ext.$in_file_name, 'w') or error_log("can't open file");
		fwrite($createinputfile, $input);
		fclose($createinputfile);
	}
	
	if($que_value == null)
	{
		if($in_file_name != null)
			header("Location: comp_run.php?share=".$share."&ext=".$ext."&file=".$file_name."&input_file=".$in_file_name."&title=".$title."&comment=".$comment);
		else
			header("Location: comp_run.php?share=".$share."&ext=".$ext."&file=".$file_name."&title=".$title."&comment=".$comment);
	}
	else
		header("Location: comp_run.php?que_value=".$que_value."&ext=".$ext."&file=".$file_name."&comment=".$comment);

?>

