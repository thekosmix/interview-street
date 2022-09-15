<?php

require_once("config.php");
require_once("functions.php");

class Forum_Comment{
	
	public static $comment_id;
	public static $topic_id;
	public static $user_id;
	public static $content;
	public static $attachment;
	public static $timestamp;
	
	public static function getDetailByID($comment_id){
		global $db;
		$sql = "SELECT * FROM forum_comment WHERE comment_id = '{$comment_id}' LIMIT 1";
		$result = $db->query($sql);
		$object_array = array();
		
		while ($row = mysqli_fetch_array($result)) {
		   $object_array[] = self::instantiate($row);
		}
		
		return !empty($object_array) ? array_shift($object_array) : false;
		
	}
	
	
	public static function instantiate($row){
		$obj = new self;
		$obj->comment_id = $row['comment_id'];
		$obj->topic_id   = $row['topic_id'];		
		$obj->user_id    = $row['user_id'];
		$obj->content 	 = $row['content'];
		$obj->attachment = $row['attachment'];
		$obj->timestamp	 = $row['timestamp'];
		return $obj;
	}


	public static function insertComment($obj){
		
		global $db;
		global $session;
		$obj->user_id = $session->user_id;
		$sql = "INSERT INTO forum_comment 
				(topic_id, user_id, content, attachment) 
				VALUES (
						'{$obj->topic_id}', 
						'{$obj->user_id}', 
						'{$obj->content}', 
						'{$obj->attachment}'
						)";
			
		$result = $db->query($sql);
		if($db->mysqli->affected_rows>0){
		//	Forum_Subs::mailComment($obj);
			return $db->mysqli->insert_id;
		}else return false;
	}
	
	
	
	public static function getCommentByTopicID($topic_id){
		global $db;
		$sql = "SELECT * FROM forum_comment WHERE topic_id = '{$topic_id}' ORDER BY timestamp";
		$result = $db->query($sql);
		$object_array = array();
		
		while ($row = mysqli_fetch_array($result)) {
		   $object_array[] = self::instantiate($row);
		}
		
		return !empty($object_array) ? $object_array : false;
		
	}
	
}

?>