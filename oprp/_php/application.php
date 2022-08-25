<?php

require_once("config.php");
require_once("functions.php");

class Application{
	
	public static $recruiter_id;
	public static $student_id;
	public static $status;
	public static $app_date;
	public static $cover_letter;
	public static $notes;
	
	public static function getDetailByStudID($student_id){
		global $db;
		$sql = "SELECT * FROM applications WHERE student_id = '{$student_id}' ORDER BY app_date DESC";
		$result = $db->query($sql);
		$object_array = array();
		
		while ($row = mysqli_fetch_array($result)) {
		   $object_array[] = self::instantiate($row);
		}
		
		return !empty($object_array) ? $object_array : false;
		
	}
	
	public static function getDetailByRecID($recruiter_id){
		global $db;
		$sql = "SELECT * FROM applications WHERE recruiter_id = '{$recruiter_id}' ORDER BY app_date DESC";
		$result = $db->query($sql);
		$object_array = array();
		
		while ($row = mysqli_fetch_array($result)) {
		   $object_array[] = self::instantiate($row);
		}
		
		return !empty($object_array) ? $object_array : false;
		
	}
	
	public static function getDetailBySR($student_id,$recruiter_id){
		global $db;
		$sql = "SELECT * FROM applications 
				WHERE student_id = '{$student_id}' 
				AND   recruiter_id = '{$recruiter_id}' 
				LIMIT 1";
		//echo $sql;		
		$result = $db->query($sql);
		$object_array = array();
		
		while ($row = mysqli_fetch_array($result)) {
		   $object_array[] = self::instantiate($row);
		}
		
		return !empty($object_array) ? array_shift($object_array) : false;
		
	}
	
	public static function instantiate($row){
		$obj = new self;
		$obj->recruiter_id  = $row['recruiter_id'];
		$obj->student_id 	= $row['student_id'];
		$obj->status 		= $row['status'];
		$obj->app_date		= $row['app_date'];
		$obj->cover_letter 	= $row['cover_letter']; 
		$obj->notes 		= $row['notes'];
		return $obj;
	}

	public static function insertApplication($obj){
		
		global $db;
		global $session;
		
		$applied = self::getDetailBySR($session->user_id,$obj->recruiter_id);
		
		if(!$applied){
			
			$sql = "INSERT INTO applications (recruiter_id, student_id, cover_letter)
					VALUES ('{$obj->recruiter_id}','{$session->user_id}','{$obj->cover_letter}')";
					
			$result = $db->query($sql);
			
			if($db->mysqli->affected_rows>0)
				return true;
			else
				return false;
				
		}else  return false;
		
	}
	
	public static function updateDetailByRec($obj){
		
		global $db;
		global $session;
		$sql = "UPDATE applications SET 
					status = '{$obj->status}',
					notes  = '{$obj->notes}'
				WHERE recruiter_id = '{$session->user_id}'
				AND	  student_id   = '{$obj->student_id}'";
				
		$result = $db->query($sql);
		
		if($db->mysqli->affected_rows>0)
			return true;
		else
			return false;
	}
	
	public static function collegePolicy($student_id, $rec_grade){
		
		global $db;
		$sql = "SELECT * FROM applications a, recruiter r
				WHERE a.recruiter_id = r.recruiter_id
				AND a.student_id = '{$student_id}' 
				AND a.status = 'Selected'
				AND r.grade >= '{$rec_grade}'";
		$result = $db->query($sql);
		
		if(mysqli_num_rows($result)>0)
		   return false;
		else
			return true;
	}
	
	public static function getNumberByRec($rec_id){
		global $db;
		$sql = "SELECT * FROM applications a
				WHERE recruiter_id = {$rec_id}";
		$result = $db->query($sql);

		return mysqli_num_rows($result);
		
	}
	
	public static function updateDetailByRS($obj){
		
		global $db;
		$sql = "UPDATE applications SET 
					status = '{$obj->status}'
				WHERE recruiter_id = '{$obj->recruiter_id}'
				AND	  student_id   = '{$obj->student_id}'";
		
		$result = $db->query($sql);
		
		if($db->mysqli->affected_rows>0)
			return true;
		else
			return false;
	}
	
}

?>