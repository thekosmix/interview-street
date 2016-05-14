<?php

require_once("config.php");
require_once("functions.php");
require_once("company.php");

class Recruiter extends Company{
	
	public static $recruiter_id;
	public static $company_id;
	public static $arrival_date;
	public static $grade;
	public static $status;
	public static $app_date;
	public static $branches;
	public static $min_score;
	public static $for_year;
	public static $job_description;
	public static $contact;
	public static $notes;
	
	public static function getDetailByID($user_id){
		global $db;
		$sql = "SELECT * FROM recruiter NATURAL JOIN company WHERE recruiter_id = '{$user_id}' LIMIT 1";
		$result = $db->query($sql);
		$object_array = array();
		
		while ($row = mysql_fetch_array($result)) {
		   $object_array[] = self::instantiate($row);
		}
		
		return !empty($object_array) ? array_shift($object_array) : false;
		
	}
	
	
	public static function instantiate($row){
		$obj = new self;
		$obj->recruiter_id      = $row['recruiter_id'];
		$obj->company_id      	= $row['company_id'];
		$obj->arrival_date      = $row['arrival_date'];		
		$obj->grade     		= $row['grade'];
		$obj->name 				= $row['name'];
		$obj->description 		= $row['description'];
		$obj->status			= $row['status'];
		$obj->app_date			= $row['app_date'];
		$obj->branches 			= $row['branches']; 
		$obj->min_score 		= $row['min_score'];
		$obj->for_year			= $row['for_year'];
		$obj->job_description 	= $row['job_description']; 
		$obj->contact 			= $row['contact']; 
		$obj->notes 			= $row['notes']; 
		$obj->website			= $row['website']; 
		$obj->logo_url			= $row['logo_url']; 
		return $obj;
	}

	public static function getCompNameByID($user_id=""){

		global $db;
		$sql = "SELECT * FROM recruiter NATURAL JOIN company WHERE recruiter_id = '{$user_id}'";
		$result = $db->query($sql);
		$row = mysql_fetch_array($result);
		return $row['name'];
		
	}
	
	
	public static function updateDetailByID($obj){
		
		global $db;
		global $session;
		$sql = "UPDATE recruiter SET 
					arrival_date 	= '{$obj->arrival_date}',
					app_date 		= '{$obj->app_date}',
					branches 		= '{$obj->branches}',
					min_score 		= '{$obj->min_score}',
					for_year 		= '{$obj->for_year}',
					job_description = '{$obj->job_description}',
					contact 		= '{$obj->contact}',
					notes 			= '{$obj->notes}' 
				WHERE recruiter_id = '{$session->user_id}'";
				
		$result = $db->query($sql);
		
		if(mysql_affected_rows()>0)
			return true;
		else
			return false;
	}
	
	public static function updateAllDetailByID($obj,$id){
		
		global $db;
		$sql = "UPDATE recruiter SET 
					arrival_date 	= '{$obj->arrival_date}',	
					grade 			= '{$obj->grade}',
					status 			= '{$obj->status}',
					app_date 		= '{$obj->app_date}',
					branches 		= '{$obj->branches}',
					min_score 		= '{$obj->min_score}',
					for_year 		= '{$obj->for_year}',
					job_description = '{$obj->job_description}',
					contact 		= '{$obj->contact}',
					notes 			= '{$obj->notes}'
				WHERE recruiter_id = '{$id}'";
				
		$result = $db->query($sql);
		
		if(mysql_affected_rows()>0)
			return true;
		else
			return false;
	}
	
	
	public static function insertRecruiter($obj){
		
		global $db;
		global $session;
		
		$obj->creator_id = $session->user_id;
		$obj->creator_access = $session->access;
		
		$sql = "INSERT INTO recruiter 
				(recruiter_id, company_id, arrival_date, grade, status, app_date, branches,
				 min_score, for_year, job_description, contact, notes) 
				VALUES (
						'{$obj->recruiter_id}',
						'{$obj->company_id}',
						'{$obj->arrival_date}', 
						'{$obj->grade}', 
						'1', 
						'{$obj->app_date}', 
						'{$obj->branches}', 
						'{$obj->min_score}', 
						'{$obj->for_year}', 
						'{$obj->job_description}', 
						'{$obj->contact}', 
						'{$obj->notes}'
						)";
				
		$result = $db->query($sql);
		
		if(mysql_affected_rows()>0){
			return true;
		}else
			return false;
	}
	
	
	
	public static function getAllActiveRecruiter(){
		global $db;
		$sql = "SELECT * FROM recruiter NATURAL JOIN company WHERE status = '1' ORDER BY arrival_date DESC";
		$result = $db->query($sql);
		$object_array = array();
		
		while ($row = mysql_fetch_array($result)) {
		   $object_array[] = self::instantiate($row);
		}
		
		return !empty($object_array) ? $object_array : false;
		
	}
	
	public static function getMyRecruiter($branch,$score,$year){
		global $db;
		$sql = "SELECT * FROM recruiter NATURAL JOIN company
				WHERE status = '1' 
				AND branches LIKE '%{$branch}%'
				AND min_score <= {$score}
				AND for_year = '{$year}'
				ORDER BY arrival_date DESC";
				
		$result = $db->query($sql);
		$object_array = array();
		
		while ($row = mysql_fetch_array($result)) {
		   $object_array[] = self::instantiate($row);
		}
		
		return !empty($object_array) ? $object_array : false;
		
	}
	
	public static function getRecruiterBetweenDates($date1,$date2){
		global $db;
		$sql = "SELECT * FROM recruiter NATURAL JOIN company
				WHERE status = '1' AND
				arrival_date BETWEEN '{$date1}' AND '{$date2}'
				ORDER BY arrival_date";
		//echo $sql;
		$result = $db->query($sql);
		$object_array = array();
		
		while ($row = mysql_fetch_array($result)) {
		   $object_array[] = self::instantiate($row);
		}
		
		return !empty($object_array) ? $object_array : false;
		
	}
	
	
	public static function checkEligiblity($recruiter_id,$branch,$score,$year){
		global $db;
		global $session;
		$sql = "SELECT * FROM recruiter NATURAL JOIN company
				WHERE status = '1'
				AND recruiter_id = '{$recruiter_id}'
				AND branches LIKE '%{$branch}%'
				AND min_score <= {$score}
				AND for_year = '{$year}'";
				
		$result = $db->query($sql);

		if(mysql_num_rows($result)>0){
			$row = mysql_fetch_array($result);
			return Application::collegePolicy($session->user_id, $row['grade']);			
		}else
			return false;
		
	}
	
}

?>