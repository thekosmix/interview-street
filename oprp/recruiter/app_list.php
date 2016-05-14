<?php 

require_once("../_php/initialize.php");
require_once("../_php/recruiter.php");
require_once("../_php/branch.php");
require_once("../_php/student.php");
require_once("../_php/acad_be.php");
require_once("../_php/acad_me.php");
require_once("../_php/acad_mba.php");
require_once("../_php/application.php");

if($session->isRecruiter()) $id=$session->user_id;
else if($session->isRMadmin())$id=$_GET['id'];
else redirect_to("../index.php");

$rec = Recruiter::getDetailByID($id); 
$applications = Application::getDetailByRecID($id);

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment;Filename=Applications_{$rec->name}.csv");


if($applications){
	
	echo"Roll No.,Name,Branch,Score,Status\r\n";
	
	while($app = array_shift($applications))
	{
		$info = Student::getDetailByID($app->student_id);
		
		switch($info->course){
			case 'be': $acad = Academics_BE::getDetailByID($app->student_id); break;
			case 'me': $acad = Academics_ME::getDetailByID($app->student_id); break;
			case 'mba': $acad = Academics_MBA::getDetailByID($app->student_id); break;
		}
		
		$name = $info->first_name;
		if(!empty($info->middle_name)) $name .= " ".$info->middle_name;
		$name .= " ".$info->last_name;
		
		echo"{$info->roll_no},{$name},{$acad->branch},{$acad->agg},{$app->status}\r\n";
		
	}
}
		
?>
            