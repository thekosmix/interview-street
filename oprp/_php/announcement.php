<?php

require_once("config.php");
require_once("functions.php");

class Announcement{
	
	public static $announce_id;
	public static $heading;
	public static $content;
	public static $attachment;
	public static $announce_date;
	public static $creator_id;
	public static $creator_access;
	public static $year;
	public static $branch;
	public static $recruiter_id;
	public static $status;
	
	public static function getMyAnnouncement($year, $branch_id, $recruiter_id, $page, $num){
		global $db;
		$start = ($page-1)*$num;
		if($start<0) return false;
		
		$params = [];
		$sql = "SELECT * FROM announcement WHERE status = '1' ";
		if($year != 'all'){
			$sql .= "AND year LIKE ? ";
			$params[] = "%,{$year},%";
		}
		if($branch_id != 'all'){
			$sql .= "AND branch LIKE ? ";
			$params[] = "%,{$branch_id},%";
		}
		if($recruiter_id != 'all'){
			$sql .= "AND recruiter_id = ? ";
			$params[] = $recruiter_id;
		}
		$sql .= " ORDER BY announce_date DESC LIMIT ?, ?"; 
		$params[] = $start;
		$params[] = $num;

		$result = $db->query($sql, $params);
		$object_array = array();
		
		while ($row = $db->fetch_array($result)) {
		   $object_array[] = self::instantiate($row);
		}

		return !empty($object_array) ? $object_array : false;
		
	}
	
	
	public static function getAllAnnouncement($page, $num){
		global $db;
		$sql = "SELECT * 
				FROM(
					SELECT @rownum:=@rownum+1 AS rownum, a.*
					FROM announcement a, (SELECT @rownum:=0)r
					WHERE status = '1' 
					ORDER BY announce_date DESC
					)s
				WHERE rownum > ?*?
				AND rownum <= ?*(?+1)";   
		$result = $db->query($sql, [$num, $page, $num, $page]);
		$object_array = array();
		
		while ($row = $db->fetch_array($result)) {
		   $object_array[] = self::instantiate($row);
		}

		return !empty($object_array) ? $object_array : false;
		
	}
	
	
	public static function instantiate($row){
		$obj = new self;
		$obj->announce_id       = $row['announce_id'];
		$obj->heading 			= $row['heading'];
		$obj->content 			= $row['content'];
		$obj->attachment 		= $row['attachment'];
		$obj->announce_date		= $row['announce_date'];
		$obj->creator_id 		= $row['creator_id']; 
		$obj->creator_access 	= $row['creator_access'];
		$obj->year				= $row['year'];
		$obj->recruiter_id 		= $row['recruiter_id']; 
		$obj->branch 			= $row['branch']; 
		
		return $obj;
	}

	
	public static function insertAnnouncement($obj){
		
		global $db;
		global $session;
		
		$obj->creator_id = $session->user_id;
		$obj->creator_access = $session->access;
		$is_recruiter_id = empty($obj->recruiter_id) ? false : true;
		$sql = "INSERT INTO announcement 
				(heading, content, attachment, creator_id, creator_access, year, branch, recruiter_id) 
				VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
	
		$result = $db->query($sql, [$obj->heading, $obj->content, $obj->attachment, $obj->creator_id, $obj->creator_access, $obj->year, $obj->branch, $obj->recruiter_id]);
		
		if($db->affected_rows($result)>0){
			Student::mailAnnouncement($obj);
			return $db->insert_id();
		}else
			return false;
	}
	
	
	public static function deleteAnnouncement($announce_id){
		
		global $db;
		global $session;
		$sql = "DELETE FROM announcement 
				WHERE announce_id = ?
				AND creator_id = ?
				AND creator_access = ?";
				
		$result = $db->query($sql, [$announce_id, $session->user_id, $session->access]);
		
		if($db->affected_rows($result)>0)
			return true;
		else
			return false;
	}
	
	public static function deleteAnyAnnouncement($announce_id){
		
		global $db;
		
		$sql = "DELETE FROM announcement 
				WHERE announce_id = ?";
				
		$result = $db->query($sql, [$announce_id]);
		
		if($db->affected_rows($result)>0)
			return true;
		else
			return false;
	}
	
}

?>