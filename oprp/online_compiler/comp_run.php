<?php require_once("_php/init_compiler.php");
    
	$ext = $_GET['ext'];
	$file = $_GET['file'];

    $title = null;
	$input_file = null;
	$comment = null;
	$que_value = null;
	$fin_time = 0;
	$init_time = 0;
	$in_file_content = null;
	$user_id = null;
	$share = 0;
	
	if(isset($_GET['share']))
		$share = $_GET['share'];
	if(isset($_GET['title']))
		$title = $_GET['title'];
	if(isset($_SESSION['user_id']))
		$user_id = $_SESSION['user_id'];
	if(isset($_GET['input_file']))
		$input_file = $_GET['input_file'];
	if(isset($_GET['comment']))
		$comment = $_GET['comment'];
		
	if(isset($_GET['que_value']))
	{
		$que_value = $_GET['que_value'];
		$exec_time = (getString('exec_time', 'question', 'que_value', $que_value))/1000;
		if(PHP_OS == "Linux")
		$resource_limit = 'ulimit -t '.$exec_time.'; ';
	}

	$prog_file = $path.$ext.$file;
	$fh = fopen($prog_file, 'r');
	$file_content = null;
	$file_content = htmlspecialchars(fread($fh, filesize($prog_file)));
	fclose($fh);
	
	if($input_file != null)
	{
		$in_file = $path.$ext.$input_file;
		$fh = fopen($in_file, 'r');
		$in_file_content = htmlspecialchars(fread($fh, filesize($in_file)));
		fclose($fh);
	}
	
	$submission_value = link_value();
	
	if($ext == "java/")
	{
		$classfile = substr($file, 0, -5);		
		$output = shell_exec($java_compiler.$path.$ext.$file.' 2>&1');
		if (file_exists($path.$ext.$classfile.'.class'))
		{
			$init_time = microtime(true);
			
			if($input_file == null)
			{
				if($que_value == null)
					$output = shell_exec($resource_limit.$java.$path.$ext.' '.$classfile.' > '.$path.$ext.'out.txt 2>&1');
				else
				{
					$resource_limit = $resource_limit.'ulimit -f 13666; ';
					$shell = $path.$ext.$classfile.' < '.$path.$in_folder.$que_value.'.txt > '.$path.$gen_out_folder.'out.txt';
					$output = shell_exec($resource_limit.$shell);
				}
			}
			else
				$output = shell_exec($resource_limit.$java.$path.$ext.' '.$classfile.' < '.$path.$ext.$input_file.' > '.$path.$ext.'out.txt 2>&1');
			
			$fin_time = microtime(true);
		}
		
		unlink($ext.$classfile.".class"); 
	}
        else if($ext == "scala/")
	{
		$classfile = substr($file, 0, -6);
		$output = shell_exec($scala_compiler.$path.$ext.$file.' 2>&1');
		if (file_exists($path.$classfile.'.class'))
		{
			$init_time = microtime(true);

			if($input_file == null)
			{
				if($que_value == null)
					$output = shell_exec($resource_limit.$scala.$path.' '.$classfile.' > '.$path.$ext.'out.txt 2>&1');
				else
				{
					$resource_limit = $resource_limit.'ulimit -f 13666; ';
					$shell = $path.$classfile.' < '.$path.$in_folder.$que_value.'.txt > '.$path.$gen_out_folder.'out.txt';
					$output = shell_exec($resource_limit.$shell);
				}
			}
			else
				$output = shell_exec($resource_limit.$scala.$path.' '.$classfile.' < '.$path.$ext.$input_file.' > '.$path.$ext.'out.txt 2>&1');

			$fin_time = microtime(true);
		}

		unlink($classfile.".class");
	}
	else if($ext == "cpp/")
	{
		$cpp_file_name = substr($file, 0, -4);
		$output = shell_exec($cpp_compiler.$path.$ext.$cpp_file_name.' '.$path.$ext.$file.' 2>&1');
		if (file_exists($path.$ext.$cpp_file_name.$executable_ext))
		{
			$init_time = microtime(true);			
			
			if($input_file == null)
			{
				if($que_value == null)
					$output = shell_exec($resource_limit.$path.$ext.$cpp_file_name.' > '.$path.$ext.'out.txt 2>&1');
				else
				{
					$resource_limit = $resource_limit.'ulimit -f 13666; ';
					$shell = $path.$ext.$cpp_file_name.' < '.$path.$in_folder.$que_value.'.txt > '.$path.$gen_out_folder.'out.txt';
					$output = shell_exec($resource_limit.$shell);
				}
			}
			else
				$output = shell_exec($resource_limit.$path.$ext.$cpp_file_name.' < '.$path.$ext.$input_file.' > '.$path.$ext.'out.txt 2>&1');
				
			$fin_time = microtime(true);				
		}

		unlink($ext.$cpp_file_name.$executable_ext);
	}
	else if($ext == "c/")
	{	
		$c_file_name = substr($file, 0, -2);
		$output = shell_exec($c_compiler.$path.$ext.$c_file_name.' '.$path.$ext.$file.' 2>&1');
		
		if (file_exists($path.$ext.$c_file_name.$executable_ext))
		{
			$init_time = microtime(true);			
			if($input_file == null)
			{
				if($que_value == null)
					$output = shell_exec($resource_limit.$path.$ext.$c_file_name.' > '.$path.$ext.'out.txt 2>&1');
				else
				{
					$resource_limit = $resource_limit.'ulimit -f 13666; ';
					$shell = $path.$ext.$c_file_name.' < '.$path.$in_folder.$que_value.'.txt > '.$path.$gen_out_folder.'out.txt';
					$output = shell_exec($resource_limit.$shell);					
				}
			}
			else
				$output = shell_exec($resource_limit.$path.$ext.$c_file_name.' < '.$path.$ext.$input_file.' > '.$path.$ext.'out.txt 2>&1');
				
			$fin_time = microtime(true);					
		}
		
		unlink($ext.$c_file_name.$executable_ext);
	}
	else if($ext == "pl/")
	{		
		$init_time = microtime(true);
		
		if($input_file == null)
		{
			if($que_value == null)
				$output = shell_exec($resource_limit.$perl_compiler.$path.$ext.$file.' > '.$path.$ext.'out.txt 2>&1');
			else
			{
					$resource_limit = $resource_limit.'ulimit -f 13666; ';
					$shell = $path.$ext.$file.' < '.$path.$in_folder.$que_value.'.txt > '.$path.$gen_out_folder.'out.txt';
					$output = shell_exec($resource_limit.$shell);					
			}
		}
		else
			$output = shell_exec($resource_limit.$perl_compiler.$path.$ext.$file.' '.$path.$ext.$input_file.' > '.$path.$ext.'out.txt 2>&1');
			
		$fin_time = microtime(true);
	}
	else if($ext == "php/")
	{	
		$init_time = microtime(true);
		
		if($input_file == null)
			$output = shell_exec($resource_limit.$php_compiler.$path.$ext.$file.' 2>&1');
		else
			$output = shell_exec($resource_limit.$php_compiler.$path.$ext.$file.' '.$path.$ext.$input_file.' 2>&1');
			
		$fin_time = microtime(true);
	}
	else if($ext == "js/")
        {
                $init_time = microtime(true);

                if($input_file == null)
                        $output = shell_exec($resource_limit.$js_compiler.$path.$ext.$file.' 2>&1');
                else
                        $output = shell_exec($resource_limit.$js_compiler.$path.$ext.$file.' '.$path.$ext.$input_file.' 2>&1');

                $fin_time = microtime(true);
        }
	else if($ext == "py/")
	{		
		$init_time = microtime(true);
		
		if($input_file == null)
			$output = shell_exec($resource_limit.$python_compiler.$path.$ext.$file.' > '.$path.$ext.'out.txt 2>&1');
		else
			$output = shell_exec($resource_limit.$python_compiler.$path.$ext.$file.' '.$path.$ext.$input_file.' > '.$path.$ext.'out.txt 2>&1');
			
		$fin_time = microtime(true);
	}
        else if($ext == "bash/")
        {
                $init_time = microtime(true);

                if($input_file == null)
                        $output = shell_exec($resource_limit.$bash_compiler.$path.$ext.$file.' > '.$path.$ext.'out.txt 2>&1');
                else
                        $output = shell_exec($resource_limit.$bash_compiler.$path.$ext.$file.' '.$path.$ext.$input_file.' > '.$path.$ext.'out.txt 2>&1');

                $fin_time = microtime(true);
        }

	else if($ext == "bf/")
	{		
		$init_time = microtime(true);

		if($input_file == null)
			$output = shell_exec($resource_limit.$bf_compiler.$path.$ext.$file.' > '.$path.$ext.'out.txt 2>&1');
		else
			$output = shell_exec($resource_limit.$bf_compiler.$path.$ext.$file.' < '.$path.$ext.$input_file.' > '.$path.$ext.'out.txt 2>&1');
			
		$fin_time = microtime(true);
	}
	else if($ext == "pas/")
	{
		$pas_file_name = substr($file, 0, -4);		
		$output = shell_exec($resource_limit.$pascal_compiler.$path.$ext.$file.' 2>&1');
		if (file_exists($path.$ext.$pas_file_name.$executable_ext))
		{
			$init_time = microtime(true);
			
			if($input_file == null)
				$output = shell_exec($resource_limit.$path.$ext.$pas_file_name.' 2>&1');
			else
				$output = shell_exec($resource_limit.$path.$ext.$pas_file_name.' < '.$path.$ext.$input_file.' 2>&1');
				
			$fin_time = microtime(true);
		}
		
		unlink($ext.$pas_file_name.$executable_ext);
		unlink($ext.$pas_file_name.".o");
	}
	else if($ext == "rb/")
	{		
		$init_time = microtime(true);
	
		if($input_file == null)
			$output = shell_exec($resource_limit.$ruby_compiler.$path.$ext.$file.' 2>&1');
		else
			$output = shell_exec($resource_limit.$ruby_compiler.$path.$ext.$file.' < '.$path.$ext.$input_file.' 2>&1');
			
		$fin_time = microtime(true);
	}
	else if($ext == "go/")
	{		
		$init_time = microtime(true);
	
		if($input_file == null)
			$output = shell_exec($go_compiler.$path.$ext.$file.' > '.$path.$ext.'out.txt 2>&1');
		else
			$output = shell_exec($resource_limit.$go_compiler.$path.$ext.$file.' < '.$path.$ext.$input_file.' > '.$path.$ext.'out.txt 2>&1');
			
		$fin_time = microtime(true);
	}
	else if($ext == "hs/")
	{		
		$has_file_name = substr($file, 0, -3);
		$output = shell_exec($resource_limit.$haskell_compiler.$path.$ext.$file.' 2>&1');
		if (file_exists($path.$ext.$has_file_name.$executable_ext))
		{
			$init_time = microtime(true);
			
			if($input_file == null)
				$output = shell_exec($resource_limit.$path.$ext.$has_file_name.' 2>&1');
			else
				$output = shell_exec($resource_limit.$path.$ext.$has_file_name.' < '.$path.$ext.$input_file.' 2>&1');
				
			$fin_time = microtime(true);
		}

		unlink($ext.$has_file_name.$executable_ext);
		unlink($ext.$has_file_name.".o");
		unlink($ext.$has_file_name.".hi");
	}
	else if($ext == "r/")
	{		
		$init_time = microtime(true);
	
		if($input_file == null)
			$output = shell_exec($resource_limit.$r_compiler.$path.$ext.$file.' 2>&1');
		else
			$output = shell_exec($resource_limit.$r_compiler.$path.$ext.$file.' < '.$path.$ext.$input_file.' 2>&1');
		
		$fin_time = microtime(true);
	}
        else if($ext == "f/")
	{
		$fort_file_name = substr($file, 0, -2);
		$output = shell_exec($fortran_compiler.$path.$ext.$fort_file_name.' -ffree-form '.$path.$ext.$file.' 2>&1');

		if (file_exists($path.$ext.$fort_file_name.$executable_ext))
		{
			$init_time = microtime(true);
			if($input_file == null)
			{
				if($que_value == null)
					$output = shell_exec($resource_limit.$path.$ext.$fort_file_name.' > '.$path.$ext.'out.txt 2>&1');
				else
				{
					$resource_limit = $resource_limit.'ulimit -f 13666; ';
					$shell = $path.$ext.$fort_file_name.' < '.$path.$in_folder.$que_value.'.txt > '.$path.$gen_out_folder.'out.txt';
					$output = shell_exec($resource_limit.$shell);
				}
			}
			else
				$output = shell_exec($resource_limit.$path.$ext.$fort_file_name.' < '.$path.$ext.$input_file.' > '.$path.$ext.'out.txt 2>&1');

			$fin_time = microtime(true);
		}

		unlink($ext.$fort_file_name.$executable_ext);
	}
        else if($ext == "cob/")
	{
		$cobol_file_name = substr($file, 0, -4);
		$output = shell_exec($cobol_compiler.$path.$ext.$cobol_file_name.' '.$path.$ext.$file.' 2>&1');

		if (file_exists($path.$ext.$cobol_file_name.$executable_ext))
		{
			$init_time = microtime(true);
			if($input_file == null)
			{
				if($que_value == null)
					$output = shell_exec($resource_limit.$path.$ext.$cobol_file_name.' > '.$path.$ext.'out.txt 2>&1');
				else
				{
					$resource_limit = $resource_limit.'ulimit -f 13666; ';
					$shell = $path.$ext.$cobol_file_name.' < '.$path.$in_folder.$que_value.'.txt > '.$path.$gen_out_folder.'out.txt';
					$output = shell_exec($resource_limit.$shell);
				}
			}
			else
				$output = shell_exec($resource_limit.$path.$ext.$cobol_file_name.' < '.$path.$ext.$input_file.' > '.$path.$ext.'out.txt 2>&1');

			$fin_time = microtime(true);
		}

		unlink($ext.$cobol_file_name.$executable_ext);
	}

	unlink($ext.$file);
	
	if($input_file != "")
		unlink($ext.$input_file);

	$out_file = $path.$ext.'out.txt';
	if(file_exists($out_file))
	{
		$fh = fopen($out_file, 'r');
		$output = '';
		$output = fread($fh, filesize($out_file));
		fclose($fh);
		unlink($out_file);
	}

    $ext = substr($ext, 0, -1);
	$time = $fin_time - $init_time;
	
	if($que_value == null)
	{
		if(insertlink($submission_value, $title, $file_content, $ext, $in_file_content, $output, $time, $user_id, $comment, $share))
			header("Location: view.php?link_value=".$submission_value);
	}
	else
	{
		$shell = $file_comp.$output_folder.$que_value.'.txt '.$path.$gen_out_folder.'out.txt';
		$output = shell_exec($resource_limit.$shell);
		
		unlink($path.'_competition/gen_output/out.txt');

		$status = -1;
		
		if(strpos($output, $find))
			$status = 0;
		else
			$status = 1;
		
		$que_title = getString('que_title', 'question', 'que_value', $que_value);
	/*	
		echo "que_title: ".$que_title."<br />";
		echo "output: ".$output."<br />";
		echo "shell cmd: ".$shell."<br />";
		echo "status: ".$status."<br />";
		echo "to find: ".$find."<br />";
	*/	
		if(insertsubmission($submission_value, $que_value, $file_content, $ext, $status, $user_id))
			header("Location: view.php?que_value=".$que_value."&user_id=".$_SESSION['user_id']);
	}

?>	
