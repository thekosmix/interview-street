
<link rel="shortcut icon" href="<?php echo ABS_PATH; ?>_images/favicon.png" />
<link href="<?php echo ABS_PATH; ?>_css/main.css" rel="stylesheet" type="text/css"></link>
<link href="<?php echo ABS_PATH; ?>_css/jquery-ui-1.8.5.custom.css" rel="stylesheet" type="text/css"></link>

<?php 
if(strpos(ABS_PATH, "localhost")==true)
echo "<script src='".ABS_PATH."_js/jquery-1.4.2.min.js' type='text/javascript'></script>";
else
echo"<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js'></script>";
?>

<script src="<?php echo ABS_PATH; ?>_js/jquery-ui-1.8.5.custom.min.js" type="text/javascript"></script>
<script src="<?php echo ABS_PATH; ?>_js/jquery.datetimepicker.js" type="text/javascript"></script>
<script src="<?php echo ABS_PATH; ?>_js/jquery.validate.min.js" type="text/javascript"></script>
        
<script>
	$(function() {
		$( "#menu" ).accordion({
			autoHeight: false,
			navigation: true
		});
	});
</script>
