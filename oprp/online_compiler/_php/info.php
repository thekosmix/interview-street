<?php

	//ob_start("ob_gzhandler");
	//$cmd = shell_exec('"C:\\Program Files (x86)\\Java\\jdk1.6.0_13\\bin\\java" -version  2>&1');  by ankur
	//date_default_timezone_set('Asia/Calcutta');
	//$date = date("H:i:s_jMY");
	
	$path = null;
    $executable_ext = null;
	$java_compiler = null;
	$bash_compiler = null;
	$awk_compiler = null;
	$java = null;
	$js_compiler = null;
	$cpp_compiler = null;
	$c_compiler = null;
	$perl_compiler = null;
	$php_compiler = null;
	$python_compiler = null;
	$bf_compiler = null;
	$pascal_compiler = null;
	$file_comp = null;
    $resource_limit = null;
	
	$in_folder = "_competition/input/";
	$out_folder = "_competition/output/";
	$gen_out_folder = "_competition/gen_output/";	
	
	if(PHP_OS == "WINNT")
	{
		$path = getcwd().'\\';
		$executable_ext = '.exe';
		$file_comp = '"C:\\Windows\\System32\\fc" /wlb1 ';
		$output_folder = "C:\\xampp\\htdocs\\online_compiler\\_competition\\output\\";
		
		$java_compiler = '"C:\\Program Files\\Java\\jdk1.6.0_31\\bin\\javac" ';
		$java = '"C:\\Program Files\\Java\\jdk1.6.0_31\\bin\\java" -cp ';
		
		$cpp_compiler = '"C:\\Program Files\\CodeBlocks\\MinGW\\bin\\g++" -o ';
		
		$c_compiler = '"C:\\Program Files\\CodeBlocks\\MinGW\\bin\\gcc" -o ';
		
		$perl_compiler = '"C:\\xampp\\perl\\bin\\perl" ';
		
		$php_compiler = '"C:\\xampp\\php\\php" ';
		
		$python_compiler = '"C:\\Program Files\\Python32\\python" ';
		
		$bf_compiler = '"C:\\Program Files\\brainfuck\\bf" ';
		
		$pascal_compiler = '"C:\\Program Files\\fpc\\bin\\i386-win32\\fpc" ';
		
		$ruby_compiler = '"C:\\Program Files\\Ruby193\\bin\\ruby" ';
		
		$go_compiler = '"C:\\go\\bin\\go" run ';
		
		$haskell_compiler = '"C:\\Program Files\\Haskell Platform\\2011.2.0.1\\bin\\ghc" ';
		
		$r_compiler = '"C:\\Program Files\\R\\R-2.15.0\\bin\\rscript" ';

        $find = "*****";
	}

    else if(PHP_OS == "Linux")
	{
		$path = getcwd().'/';	//	/opt/lampp/htdocs/online_compiler
		$resource_limit = 'ulimit -t 2; ulimit -f 3000; ';
		$file_comp = 'diff -aq ';
		$output_folder = $path.'_competition/output/';

		$java_compiler = '"javac" ';
		$java = '"java" -cp ';

		$cpp_compiler = 'g++ -o ';

		$c_compiler = 'gcc -lm -o ';

		$perl_compiler = 'perl ';

		$php_compiler = '"php" ';

		$python_compiler = '"python" ';

		$ruby_compiler = '"/home/ubuntu/.rvm/rubies/ruby-2.2.1/bin/ruby" ';

		$haskell_compiler = '"ghc" ';

		$r_compiler = 'Rscript ';

		$go_compiler = '/usr/bin/go run ';

		$pascal_compiler = '"fpc" ';

		$bf_compiler = 'bf ';

		$fortran_compiler = 'gfortran -o';

		$cobol_compiler = 'cobc -o';

		$bash_compiler = '"bash" ';

		$awk_compiler = '"awk -f" ';

		$scala_compiler = 'scalac ';
		$scala = 'scala -cp ';
		
		$js_compiler = '"nodejs" ';

        $find = "differ";
		
	}

	else if(PHP_OS == "Darwin")
	{
		$path = getcwd().'/';	//	/opt/lampp/htdocs/online_compiler
		$resource_limit = 'ulimit -t 2; ulimit -f 3000; ';
		$file_comp = 'diff -aq ';
		$output_folder = $path.'_competition/output/';

		$java_compiler = '"/Users/siddharthkumar/.jenv/shims/javac" ';
		$java = '"/Users/siddharthkumar/.jenv/shims/java" -cp ';

		$cpp_compiler = 'g++ -o ';

		$c_compiler = 'gcc -lm -o ';

		$perl_compiler = 'perl ';

		$php_compiler = '"php" ';

		$python_compiler = '/usr/bin/python3 ';

		$ruby_compiler = '"/Users/siddharthkumar/.rvm/rubies/ruby-3.0.0/bin/ruby" ';

		$haskell_compiler = '"ghc" ';

		$r_compiler = 'Rscript ';

		$go_compiler = '/usr/local/bin/go run ';

		$pascal_compiler = '"fpc" ';

		$bf_compiler = '/usr/local/bin/brainfuck ';

        $fortran_compiler = 'gfortran -o';

        $cobol_compiler = 'cobc -o';

		$bash_compiler = '"zsh" ';

		$awk_compiler = '"awk" -f ';

        $scala_compiler = 'scalac ';
		$scala = 'scala -cp ';
		
		$js_compiler = '"/Users/siddharthkumar/.nvm/versions/node/v14.18.2/bin/node" ';

        $find = "differ";
		
	}
?>
