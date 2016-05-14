<?php

require_once("config.php");
require_once("functions.php");

class Project{
	
	public static $student_id;
	public static $training_1;
	public static $training_2;
	public static $training_3;
	public static $training_4;
	public static $training_5;
	public static $training_6;
	public static $professional_society;
	public static $extra_curricular;
	public static $career_objectives;
	public static $skills_tech;
	public static $skills_other;
	public static $hobbies;
	
	public static function getDetailByID($user_id){
		global $db;
		$sql = "SELECT * FROM projects WHERE student_id = '{$user_id}' LIMIT 1";
		$result = $db->query($sql);
		$object_array = array();
		
		while ($row = mysql_fetch_array($result)) {
		   $object_array[] = self::instantiate($row);
		}
		
		return !empty($object_array) ? array_shift($object_array) : false;
		
	}
	
	
	public static function instantiate($row){
		$obj = new self;
		$obj->student_id        	= $row['student_id'];
		$obj->training_1 			= $row['training_1'];
		$obj->training_2 			= $row['training_2'];
		$obj->training_3			= $row['training_3'];
		$obj->training_4 			= $row['training_4']; 
		$obj->training_5 			= $row['training_5'];
		$obj->training_6			= $row['training_6'];
		$obj->professional_society 	= $row['professional_society'];
		$obj->extra_curricular	 	= $row['extra_curricular'];
		$obj->career_objectives 	= $row['career_objectives']; 
		$obj->skills_tech 			= $row['skills_tech']; 
		$obj->skills_other			= $row['skills_other']; 
		$obj->hobbies 				= $row['hobbies']; 
		return $obj;
	}

	
	public static function updateDetailByID($obj){
		
		global $db;
		global $session;
		$sql = "UPDATE projects SET 
					training_1 = '{$obj->training_1}',
					training_2 = '{$obj->training_2}',
					training_3 = '{$obj->training_3}',
					training_4 = '{$obj->training_4}',
					training_5 = '{$obj->training_5}',
					training_6 = '{$obj->training_6}',
					professional_society = '{$obj->professional_society}',
					extra_curricular = '{$obj->extra_curricular}',
					career_objectives = '{$obj->career_objectives}',
					skills_tech = '{$obj->skills_tech}',
					skills_other = '{$obj->skills_other}',
					hobbies = '{$obj->hobbies}'
				WHERE student_id = '{$session->user_id}'";
				
		$result = $db->query($sql);
		
		if(mysql_affected_rows()>0)
			return true;
		else
			return false;
	}
	
	public static function updateAllDetailByID($obj,$id){
		
		global $db;
		global $session;
		$sql = "UPDATE projects SET 
					training_1 = '{$obj->training_1}',
					training_2 = '{$obj->training_2}',
					training_3 = '{$obj->training_3}',
					training_4 = '{$obj->training_4}',
					training_5 = '{$obj->training_5}',
					training_6 = '{$obj->training_6}',
					professional_society = '{$obj->professional_society}',
					extra_curricular = '{$obj->extra_curricular}',
					career_objectives = '{$obj->career_objectives}',
					skills_tech = '{$obj->skills_tech}',
					skills_other = '{$obj->skills_other}',
					hobbies = '{$obj->hobbies}'
				WHERE student_id = '{$id}'";
				
		$result = $db->query($sql);
		
		if(mysql_affected_rows()>0)
			return true;
		else
			return false;
	}
	
	
	public static function insertProject($obj){
		
		global $db;
		global $session;
			
		$sql = "INSERT INTO projects (student_id) 
				VALUES ('{$obj->student_id}')";
				
		$result = $db->query($sql);
		
		if(mysql_affected_rows()>0)
			return true;
		else
			return false;
	}
}

?>