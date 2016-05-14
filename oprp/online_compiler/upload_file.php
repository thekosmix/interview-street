<?php

	$file_error = $_FILES["prog_file"]["error"];
	$file_size = $_FILES["prog_file"]["size"]; 
	$file_name = $_FILES["prog_file"]["name"];
	$file_tmp = $_FILES["prog_file"]["tmp_name"];
	
	$in_file_error = $_FILES["input_file"]["error"];
	$in_file_size = $_FILES["input_file"]["size"]; 
	$in_file_name = $_FILES["input_file"]["name"];
	$in_file_tmp = $_FILES["input_file"]["tmp_name"];

	$que_value = null;
	$share = 0;
	if(isset($_POST['que_value']))
		$que_value = $_POST['que_value'];
	$s=$_POST['share'];
	if($s[0] == 'sharecode')
		$share = 1;
	
	$ext = pathinfo($file_name, PATHINFO_EXTENSION);
	$ext = $ext."/";

	if ($file_error > 0)
		echo "Error: " . $file_error . "<br />";
	else if($file_size > 10240)
		echo "Error: file size is more than 10 kb.<br />";
	else if(($ext == "bf/") || ($ext == "c/") || ($ext == "cpp/") || ($ext == "go/") || ($ext == "hs/") || ($ext == "java/") || ($ext == "pas/") || ($ext == "php/") || ($ext == "pl/") || ($ext == "py/") || ($ext == "r/") || ($ext == "rb/"))
	{	
		move_uploaded_file($file_tmp,$ext.$file_name);
		move_uploaded_file($in_file_tmp,$ext.$in_file_name);
		if($que_value == null)
			header("Location: comp_run.php?share=".$share."&ext=".$ext."&file=".$file_name."&input_file=".$in_file_name);
		else
			header("Location: comp_run.php?que_value=".$que_value."&ext=".$ext."&file=".$file_name);
	}
	else
		echo "Error: Please upload a valid C/C++/Java/Perl/php/python/brainf**k/pascal file.";
		
?> 