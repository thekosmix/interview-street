<?php require_once("_php/init_compiler.php"); 

	$que_value = null;
	$que_title = null;
	
	if(isset($_GET['que_value']) && isset($session->user_id))
	{
		$que_value = $_GET['que_value'];
		$que_title = getString('que_title', 'question', 'que_value', $que_value);
	}
			
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php include("../_include/title.php"); ?> - Online Compiler</title>
<?php include("../_include/design.php"); ?>

<script language="Javascript" type="text/javascript" src="_highlighter/_highlighter_full.js"></script>
<script language="javascript" type="text/javascript">
window.onload = selectsyntax; 

	function selectsyntax()
	{
		var syntax = document.getElementById("prog_lang");
		prog = syntax.options[syntax.selectedIndex].text;
		
		if(prog == "Pascal")
			prog = "pas";
		else if(prog == "Go")
			prog = "basic";
		else if(prog == "Haskell")
			prog = "basic";
		else if(prog == "R")
			prog = "basic";
        else if(prog == "Brainf**k")
			prog = "brainfuck";
        else if(prog == "Fortran")
			prog = "basic";
        else if(prog == "COBOL")
			prog = "basic";
        else if(prog == "Scala")
			prog = "basic";
                else if(prog == "Bash")
                        prog = "basic";
                else if(prog == "JavaScript")
                        prog = "basic";
                else if(prog == "Awk")
                        prog = "basic";


			
		editAreaLoader.init({
			id: "example_1"	// id of the textarea to transform		
			,start_highlight: true	// if start with highlight
			,allow_resize: "both"
			,allow_toggle: true
			,toolbar: "search, fullscreen, |, select_font, |,  syntax_selection, |, change_smooth_selection, highlight, reset_highlight, word_wrap, |, help"
			,word_wrap: true
			,language: "en"
			,syntax: prog	
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
    
    <table border="0" width="100%" cellspacing="5">
	<tr><td colspan="2"><a target="_blank" href="https://en.wikibooks.org/wiki/Computer_Programming/Hello_world">List of Hello World Programs</a></td></tr>
    <tr><td colspan="2">
        <form action="upload_file.php" method="post" enctype="multipart/form-data">
		<table border="0" cellspacing="5">
    	<tr>
        	<td><label>Program:</label></td>
        	<td><input type="file" name="prog_file" id="prog_file" /></td>
    	</tr>
    	<input type='hidden' name='que_value' value='<?php echo $que_value; ?>' />
		
		<?php if($que_value == null) { ?>
        <tr>
            <td><label>Input:</label></td>
            <td><input type="file" name="input_file" id="input_file" /></td>
        </tr>
    	<?php } ?>
        
        <?php if($que_value == null && isset($session->user_id))
              echo "<tr><td colspan='2'><input type='checkbox' name='share[]' value='sharecode' />Share this code</td></tr>";
		?>
        
        <tr>
            <td colspan="2"><input type="submit" name="submit" value="Submit" class="submitStyle"/></td>
        </tr>
		</table>
		</form>
	</td></tr>
	
    <tr><td>&nbsp;  </td></tr>
    
    <tr><td>
        <form action="create_file.php" method="post" enctype="multipart/form-data">
        <table border="0" width="100%" cellspacing="5">
        <input type='hidden' name='que_value' value='<?php echo $que_value; ?>' />
        <tr>
            <td width="10%"><label>Prog language:</label></td>
            <td width="60%"><label>Title:</label><input type="text" name="title" value="<?php echo $que_title; ?>" /></td>
        </tr>
        <tr>
        <td valign="top">
            <select size="10" name="prog_lang" id="prog_lang" onchange="selectsyntax();">
            	<option value="awk">Awk</option>
            	<option value="bash" style="font-weight: bold">Bash</option>
                <option value="bf" style="font-weight: bold">Brainf**k</option>
                <option value="c" selected="selected" style="font-weight: bold">C</option>
                <option value="cob">COBOL</option>
                <option value="cpp" style="font-weight: bold">CPP</option>
                <option value="f">Fortran</option>
                <option value="go" style="font-weight: bold">Go</option>     
                <option value="hs">Haskell</option>     
                <option value="java" style="font-weight: bold">Java</option>                
	     	    <option value="js" style="font-weight: bold">JavaScript</option>
                <option value="pas">Pascal</option>                
                <option value="pl" style="font-weight: bold">Perl</option>
                <option value="php"">PHP</option>
                <option value="py" style="font-weight: bold">Python</option>
                <option value="r" >R</option>
                <option value="rb" style="font-weight: bold">Ruby</option>
                <option value="scala">Scala</option>
            </select>
        </td>
        <td>
				<textarea id="example_1" style="height: 340px; width: 100%;" name="example_1">
                </textarea>
    	</td></tr>
        
        <?php if($que_value == null) { 	?>
        <tr><td colspan="2">Input<br />
            <textarea name="input" cols="40" style="height: 150px; width:100%"></textarea></td></tr>
        <?php } ?>
             
         <tr><td colspan="2">Comments:<br/>
             <textarea name="comment" cols="40" style="height: 150px; width: 100%;"></textarea></td></tr>
                 
		<?php if(($que_value == null) && isset($session->user_id)) {  ?>
        <tr><td colspan="2"><input type="checkbox" name="share[]" value="sharecode" />Share this code</td></tr>
        <?php } ?>

    	<tr><td colspan="2"><input type="submit" name="submit" value="Submit" class="submitStyle"/></td></tr>
		</table>
		</form>
    
    </td></tr></table>
    
    
    </td></tr>
</table>
               
<!--body close--> 
                  
<?php include("../_include/footer.php"); ?>
</body>
</html>
