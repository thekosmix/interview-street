<?php

require_once("config.php");
require_once("functions.php");

class Forum_Subs{
	
	public static $user_id;
	public static $topic_id;
	
	/*
	public static function getDetailByID($user_id){
		global $db;
		$sql = "SELECT * FROM recruiter WHERE recruiter_id = '{$user_id}' LIMIT 1";
		$result = $db->query($sql);
		$object_array = array();
		
		while ($row = mysqli_fetch_array($result)) {
		   $object_array[] = self::instantiate($row);
		}
		
		return !empty($object_array) ? array_shift($object_array) : false;
		
	}
	
	
	public static function instantiate($row){
		$obj = new self;
		$obj->recruiter_id      = $row['recruiter_id'];
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
	*/
	
	public static function addSubscription($topic_id){
		
		global $db;
		global $session;
		
		$user_id = $session->user_id;
		
		$sql = "INSERT INTO forum_subs (topic_id, user_id) 
				VALUES ('{$topic_id}', '{$user_id}')";
				
		$result = $db->query($sql);
		
		if($db->mysqli->affected_rows>0){
			return $db->mysqli->insert_id;
		}else
			return false;
	}
	
	public static function checkSubscription($topic_id){
		
		global $db;
		global $session;
		
		$user_id = $session->user_id;
		$sql = "SELECT * FROM forum_subs WHERE topic_id='{$topic_id}' AND user_id='{$user_id}'";
		$result = $db->query($sql);
		if(mysqli_num_rows($result)>0){
			return true;
		}else
			return false;
	}
	
	public static function removeSubscription($topic_id){
		
		global $db;
		global $session;
		
		$user_id = $session->user_id;
		$sql = "DELETE FROM forum_subs WHERE topic_id='{$topic_id}' AND user_id='{$user_id}'";
		$result = $db->query($sql);
		
		if($db->mysqli->affected_rows>0){
			return true;
		}else
			return false;
	}
	
	public static function mailComment($obj){
		global $db;
		
		$sql = "SELECT * FROM forum_topic NATURAL JOIN user WHERE topic_id = '{$obj->topic_id}'";
		$result = $db->query($sql);
		
		$from = "From: Comment <no-reply@dce.edu>";
		$sub = "New Comment";
		$msg = "{$obj->content}";
		
		while($row = mysqli_fetch_array($result)){
			$to = $row['email'];
			@mail($to,$sub,$msg,$from);
		}
		
		return true;
	}
	
}

?>