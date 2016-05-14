<?php  

require_once("../_php/initialize.php"); 
require_once("../_php/student.php");
require_once("../_php/acad_be.php");
require_once("../_php/acad_me.php");
require_once("../_php/acad_mba.php");

if($session->isStudent()) $id=$session->user_id;
else $id=$_GET['id'];

$loc = $_GET['loc'];

$stud = Student::getDetailByID($id);
switch($stud->course){
	case 'be': $info = Academics_BE::getDetailByID($id); break;
	case 'me': $info = Academics_ME::getDetailByID($id); break;
	case 'mba': $info = Academics_MBA::getDetailByID($id); break;
}

if($loc == 'marksheet_10') $ext = $info->img_10;
else if($loc == 'marksheet_12') $ext = $info->img_12;
else if($loc == 'grad_doc') $ext = $info->grad_doc;
				
header("Content-Disposition: attachment; Filename={$stud->first_name}_{$stud->last_name}_{$loc}.{$ext}");
readfile("_{$loc}/{$id}.{$ext}");

?>
