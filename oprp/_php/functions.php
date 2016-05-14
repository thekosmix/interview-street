<?php

function redirect_to( $location = NULL ){
	
	if ($location != NULL) {
		header("Location: {$location}");
		exit;
	}
}



/*
function genRandomString() {
    $length = 30;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $string = '';    

    for ($p = 0; $p < $length; $p++) {
        $string .= $characters[mt_rand(0, strlen($characters))];
    }

    return $string;
}
*/

function setErrMsg($msg){
	
	$new_msg = "<table class='errBox' width='100%'>
				<tr height='30px'>
						<td width='30px'><img src='".ABS_PATH."_images/alert.png' height='30px' width='30px' border='0'/></td>
						<td valign='middle' align='left'><label><span class='smallTxt err'>{$msg}</span></label></td>
				</tr> 
				</table>";
	
	return $new_msg;
}

function setErrNotMsg($msg){
	
	$new_msg = "<table class='errNotBox' width='100%'>
				<tr height='30px'>
						<td width='30px'><img src='".ABS_PATH."_images/tick.png' height='30px' width='30px' border='0'/></td>
						<td valign='middle' align='left'><label><span class='smallTxt errnot'>{$msg}</span></label></td>
				</tr> 
				</table>";
	
	return $new_msg;
}

function print_info($name,$var){
	
	if(!empty($var))
		echo "<tr><td width='45%'><label><strong>{$name}</strong></label></td>
				  <td>{$var}</td></tr>";
}

function print_area($name,$var,$value){
	
	echo "<tr><td><label><strong>{$name}</strong></label><br/>
			<textarea cols='75' rows='4' id='{$var}' name='{$var}'>".nl2br($value)."</textarea>
              </td></tr>";
}

function checkIMG($file){
	if((($file["type"] == "image/gif")
		|| ($file["type"] == "image/jpeg")
		|| ($file["type"] == "image/bmp")
		|| ($file["type"] == "image/png"))
		&& ($file["size"] < 1000000))    
		return true;
	else
		return false;	
}

function uploadFile($path,$file,$name){
	
	$info = pathinfo($file['name']);
	$ext = $info['extension'];
	$path = $path.$name.".".$ext; 
	
	if(move_uploaded_file($file['tmp_name'], $path))
		return true;
	else
		return false;
}

function str_to_arr($str){
	
	$arr=array();
	$token = strtok($str, ",");
	while ($token != false){
	  $arr[] = $token;
	  $token = strtok(",");
	}
	
	return $arr;	
}

function arr_to_str($arr){
	
	$str=",";
	while($element = array_shift($arr)){
	  $str .= $element.",";
	}
	
	return $str;	
}

function arrFormat($arr){
	$str="(";
	while($element = array_shift($arr)){
	  if($arr == NULL)
	  	$str .= "'".$element."')";
	  else
	  	$str .= "'".$element."',";
	}
	
	return $str;
}

function arrDispFormat($arr){
	$str="";
	while($element = array_shift($arr)){
	  if($arr == NULL)
	  	$str .= $element;
	  else
	  	$str .= $element.", ";
	}
	
	return $str;
}

function search_in($key,$str){
	$arr = str_to_arr($str);
	while($element = array_shift($arr)){
	  if($element == $key)
	  	return true;
	}
	return false;
}

function getCourse($course){
	switch($course){
		case 'be': $str="Bachelor of Engineering";break;
		case 'me': $str="Master of Engineering";break;
		case 'mba': $str="Master of Business Administration";break;
		default: $str="";
	}
	return $str;
}

?>