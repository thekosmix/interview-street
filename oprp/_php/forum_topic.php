<?php

require_once("config.php");
require_once("functions.php");

class Forum_Topic extends Company{
	
	public static $topic_id;
	public static $heading;
	public static $content;
	public static $attachment;
	public static $topic_type;
	public static $company_id;
	public static $user_id;
	public static $timestamp;
	
	public static function getDetailByID($topic_id){
		global $db;
		$sql = "SELECT * FROM forum_topic LEFT JOIN company 
				ON forum_topic.company_id = company.company_id 
				WHERE topic_id = '{$topic_id}' LIMIT 1";
		//echo $sql;
		$result = $db->query($sql);
		$object_array = array();
		
		while ($row = mysql_fetch_array($result)) {
		   $object_array[] = self::instantiate($row);
		}
		
		return !empty($object_array) ? array_shift($object_array) : false;
		
	}
	
	
	public static function instantiate($row){
		$obj = new self;
		$obj->topic_id    = $row['topic_id'];
		$obj->heading     = $row['heading'];		
		$obj->content     = $row['content'];
		$obj->attachment  = $row['attachment'];
		$obj->topic_type  = $row['topic_type'];
		$obj->company_id  = $row['company_id'];
		$obj->user_id	  = $row['user_id'];
		$obj->timestamp   = $row['timestamp'];
		$obj->name 		  = $row['name'];
		$obj->description = $row['description'];
		$obj->website	  = $row['website']; 
		$obj->logo_url	  = $row['logo_url']; 
		return $obj;
	}
	
	public static function getAllTopics($topic_type, $company_id, $page, $num){
		global $db;
		$start = ($page-1)*$num;
		if($start<0) return false;
		$sql = "SELECT * FROM forum_topic LEFT JOIN company ON forum_topic.company_id = company.company_id WHERE 1 ";
		if($topic_type != 'all') $sql .= "AND topic_type = '{$topic_type}' ";
		if($company_id != 'all') $sql .= "AND forum_topic.company_id = '{$company_id}' ";
		$sql .= " ORDER BY timestamp DESC LIMIT {$start}, {$num}"; 
		//echo $sql;
		$result = $db->query($sql);
		$object_array = array();
		
		while ($row = mysql_fetch_array($result)) {
		   $object_array[] = self::instantiate($row);
		}

		return !empty($object_array) ? $object_array : false;
		
	}
	
	public static function insertTopic($obj){
		
		global $db;
		global $session;
		
		$obj->user_id = $session->user_id;
		
		$sql = "INSERT INTO forum_topic 
				(heading, content, attachment, topic_type, company_id, user_id)
				VALUES (
						'{$obj->heading}', 
						'{$obj->content}', 
						'{$obj->attachment}', 
						'{$obj->topic_type}', 
						'{$obj->company_id}', 
						'{$obj->user_id}'
						)";
				
		$result = $db->query($sql);
		
		if(mysql_affected_rows()>0){
			return mysql_insert_id();
		}else
			return false;
	}
	
	public static function deleteTopic($topic_id){
		
		global $db;
		global $session;
		
		$user_id = $session->user_id;
		$sql = "DELETE FROM forum_topic WHERE topic_id='{$topic_id}' AND user_id='{$user_id}'";
		$result = $db->query($sql);
		if(mysql_affected_rows()>0){
			return true;
		}else
			return false;
	}

	
}

?>