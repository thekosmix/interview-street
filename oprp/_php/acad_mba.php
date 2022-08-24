<?php

require_once("config.php");
require_once("functions.php");

class Academics_MBA{
	
	public static $student_id;
	public static $school_10;
	public static $board_10;
	public static $year_10;
	public static $subject_10;
	public static $agg_10;
	public static $img_10;
	public static $school_12;
	public static $board_12;
	public static $year_12;
	public static $subject_12;
	public static $agg_12;
	public static $img_12;
	public static $grad_course;
	public static $grad_univ;
	public static $grad_field;
	public static $grad_year;
	public static $grad_agg;
	public static $grad_sub;
	public static $grad_doc;	
	public static $entrance;
	public static $entrance_category;
	public static $rank;
	public static $sem_1;	
	public static $sem_2;	
	public static $sem_3;	
	public static $sem_4;		
	public static $agg;
	public static $dept_rank;
	public static $branch;
	public static $year_of_pg;
	public static $backlog;
	public static $backlog_reason;
	
	
	public static function getDetailByID($user_id){
		global $db;
		$sql = "SELECT * FROM academic_mba WHERE student_id = '{$user_id}' LIMIT 1";
		$result = $db->query($sql);
		$object_array = array();
		
		while ($row = mysqli_fetch_array($result)) {
		   $object_array[] = self::instantiate($row);
		}
		
		return !empty($object_array) ? array_shift($object_array) : false;
		
	}
	
	
	public static function instantiate($row){
		$obj = new self;
		$obj->student_id    = $row['student_id'];
		$obj->school_10 	= $row['school_10'];
		$obj->board_10 		= $row['board_10'];
		$obj->year_10		= $row['year_10'];
		$obj->subject_10 	= $row['subject_10']; 
		$obj->agg_10 		= $row['agg_10'];
		$obj->img_10		= $row['img_10'];
		$obj->school_12 	= $row['school_12']; 
		$obj->board_12 		= $row['board_12']; 
		$obj->year_12 		= $row['year_12']; 
		$obj->subject_12	= $row['subject_12']; 
		$obj->agg_12 		= $row['agg_12']; 
		$obj->img_12 		= $row['img_12']; 
		$obj->grad_course	= $row['grad_course']; 
		$obj->grad_univ		= $row['grad_univ']; 
		$obj->grad_field	= $row['grad_field']; 
		$obj->grad_year		= $row['grad_year']; 
		$obj->grad_agg		= $row['grad_agg']; 
		$obj->grad_sub		= $row['grad_sub']; 
		$obj->grad_doc		= $row['grad_doc']; 
		$obj->entrance 		= $row['entrance'];
		$obj->entrance_category	= $row['entrance_category'];
		$obj->rank 			= $row['rank'];
		$obj->sem_1			= $row['sem_1'];
		$obj->sem_2			= $row['sem_2'];
		$obj->sem_3			= $row['sem_3'];
		$obj->sem_4			= $row['sem_4'];
		$obj->agg 			= $row['agg']; 
		$obj->dept_rank 	= $row['dept_rank'];
		$obj->branch 		= $row['branch']; 
		$obj->year_of_pg 	= $row['year_of_pg']; 
		$obj->backlog 		= $row['backlog']; 
		$obj->backlog_reason= $row['backlog_reason'];
		
		return $obj;
	}
	
	public static function updateDetailbyID($obj){
		
		global $db;
		global $session;
		$sql = "UPDATE academic_mba SET 
					entrance_category = '{$obj->entrance_category}',
					entrance   = '{$obj->entrance}',
					rank  	   = '{$obj->rank}',
					school_10  = '{$obj->school_10}',
					board_10   = '{$obj->board_10}',
					year_10    = '{$obj->year_10}',
					subject_10 = '{$obj->subject_10}',
					agg_10     = '{$obj->agg_10}',
					img_10     = '{$obj->img_10}',
					school_12  = '{$obj->school_12}',
					board_12   = '{$obj->board_12}',
					year_12    = '{$obj->year_12}',
					subject_12 = '{$obj->subject_12}',
					agg_12 	   = '{$obj->agg_12}',
					img_12     = '{$obj->img_12}',
					grad_course= '{$obj->grad_course}',
					grad_univ  = '{$obj->grad_univ}',
					grad_field = '{$obj->grad_field}',	
					grad_year  = '{$obj->grad_year}',	
					grad_agg   = '{$obj->grad_agg}',
					grad_sub   = '{$obj->grad_sub}',
					grad_doc   = '{$obj->grad_doc}',
					backlog_reason = '{$obj->backlog_reason}'
				WHERE student_id = '{$session->user_id}'";
				
		$result = $db->query($sql);
		
		if(mysqli_affected_rows()>0)
			return true;
		else
			return false;
	}
	
	public static function updateAllDetailbyID($obj,$id){
		
		global $db;
		$sql = "UPDATE academic_mba SET 
					sem_1 = '{$obj->sem_1}',
					sem_2 = '{$obj->sem_2}',
					sem_3 = '{$obj->sem_3}',
					sem_4 = '{$obj->sem_4}',
					agg   = '{$obj->agg}',
					dept_rank = '{$obj->dept_rank}',
					backlog = '{$obj->backlog}',
					entrance_category = '{$obj->entrance_category}',
					entrance   = '{$obj->entrance}',
					rank  	   = '{$obj->rank}',
					school_10  = '{$obj->school_10}',
					board_10   = '{$obj->board_10}',
					year_10    = '{$obj->year_10}',
					subject_10 = '{$obj->subject_10}',
					agg_10     = '{$obj->agg_10}',
					img_10     = '{$obj->img_10}',
					school_12  = '{$obj->school_12}',
					board_12   = '{$obj->board_12}',
					year_12    = '{$obj->year_12}',
					subject_12 = '{$obj->subject_12}',
					agg_12 	   = '{$obj->agg_12}',
					img_12     = '{$obj->img_12}',
					grad_course= '{$obj->grad_course}',
					grad_univ  = '{$obj->grad_univ}',
					grad_field = '{$obj->grad_field}',	
					grad_year  = '{$obj->grad_year}',	
					grad_agg   = '{$obj->grad_agg}',
					grad_sub   = '{$obj->grad_sub}',
					grad_doc   = '{$obj->grad_doc}',
					backlog_reason = '{$obj->backlog_reason}'
				WHERE student_id = '{$id}'";
				
		$result = $db->query($sql);
		
		if(mysqli_affected_rows()>0)
			return true;
		else
			return false;
	}
	
	public static function insertAcadMBA($obj){
		
		global $db;
		global $session;
		
		
		$sql = "INSERT INTO academic_mba 
				(student_id, branch, year_of_pg) 
				VALUES (
						'{$obj->student_id}', 
						'{$obj->branch}', 
						'{$obj->year_of_pg}'
						)";
				
		$result = $db->query($sql);
		
		if(mysqli_affected_rows()>0)
			return true;
		else
			return false;
	}
	
	
	public static function getDetailByBranch($branch){
		global $db;
		$sql = "SELECT * FROM academic_mba WHERE branch = '{$branch}'";
		$result = $db->query($sql);
		$object_array = array();
		
		while ($row = mysqli_fetch_array($result)) {
		   $object_array[] = self::instantiate($row);
		}
		
		return !empty($object_array) ? $object_array : false;
		
	}
}

?>