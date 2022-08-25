<?php

require_once("config.php");
require_once("functions.php");

class Branch{
	
	public static $branch_code;
	public static $branch_name;
	public static $branch_course;
	
	
	public static function getDetailByCode($code){
		global $db;
		$sql = "SELECT * FROM branches WHERE branch_code = '{$code}' LIMIT 1";
		$result = $db->query($sql);
		$object_array = array();
		
		while ($row = mysqli_fetch_array($result)) {
		   $object_array[] = self::instantiate($row);
		}
		
		return !empty($object_array) ? array_shift($object_array) : false;
		
	}
	
	
	public static function instantiate($row){
		$obj = new self;
		$obj->branch_code 	 = $row['branch_code'];
		$obj->branch_name 	 = $row['branch_name'];
		$obj->branch_course	 = $row['branch_course'];
		return $obj;
	}
	
	public static function updateDetailbyCode($code,$obj){
		
		global $db;
		$sql = "UPDATE branches SET 
					branch_name   = '{$obj->branch_name}',
					branch_course = '{$obj->branch_course}'
				WHERE branch_code = '{$code}'";
				
		$result = $db->query($sql);
		
		if($db->mysqli->affected_rows>0)
			return true;
		else
			return false;
	}
	
	public static function getNameByCode($code){
		global $db;
		$sql = "SELECT * FROM branches WHERE branch_code = '{$code}' LIMIT 1";
		$result = $db->query($sql);
		$object_array = array();
		$row = mysqli_fetch_array($result);
		
		return $row['branch_name'];
	}
	
	public static function getNamesByArray($arr){
		$branches="";								
		while($code = array_shift($arr))
		{
			$branches .= self::getNameByCode($code).", ";
		}
		return substr($branches,0,strlen($branches)-2);
	}
	
	public static function getDetailByCourse($course){
		global $db;
		$sql = "SELECT * FROM branches WHERE branch_course = '{$course}'";
		$result = $db->query($sql);
		$object_array = array();
		
		while ($row = mysqli_fetch_array($result)) {
		   $object_array[] = self::instantiate($row);
		}
		
		return !empty($object_array) ? $object_array : false;
		
	}
	
	
	public static function getAllBranches(){
		global $db;
		$sql = "SELECT * FROM branches ORDER BY branch_course, branch_name";
		$result = $db->query($sql);
		$object_array = array();
		
		while ($row = mysqli_fetch_array($result)) {
		   $object_array[] = self::instantiate($row);
		}
		
		return !empty($object_array) ? $object_array : false;
		
	}
	
}

?>