<?php

require_once("config.php");
require_once("functions.php");

class Company{
	
	public static $company_id;
	public static $name;
	public static $description;
	public static $website;
	public static $logo_url;
	
	public static function getDetailByID($company_id){
		global $db;
		$sql = "SELECT * FROM company WHERE company_id = '{$company_id}' LIMIT 1";
		$result = $db->query($sql);
		$object_array = array();
		
		while ($row = mysqli_fetch_array($result)) {
		   $object_array[] = self::instantiate($row);
		}
		
		return !empty($object_array) ? array_shift($object_array) : false;
		
	}
	
	
	public static function instantiate($row){
		$obj = new self;
		$obj->company_id      	= $row['company_id'];
		$obj->name 				= $row['name'];
		$obj->description 		= $row['description'];
		$obj->website			= $row['website']; 
		$obj->logo_url			= $row['logo_url']; 
		return $obj;
	}
	
	
	public static function updateDetailByID($obj){
		
		global $db;
		global $session;
		$sql = "UPDATE company SET 
					name 			= '{$obj->name}',
					description 	= '{$obj->description}',
					website 		= '{$obj->website}',
					logo_url 		= '{$obj->logo_url}'
				WHERE company_id = '{$obj->company_id}'";
				
		$result = $db->query($sql);
		
		if($db->mysqli->affected_rows>0)
			return true;
		else
			return false;
	}
	
	
	public static function insertCompany($obj){
		
		global $db;
		
		$sql = "INSERT INTO company 
				(name, description, website, logo_url) 
				VALUES (
						'{$obj->name}', 
						'{$obj->description}', 
						'{$obj->website}', 
						'{$obj->logo_url}'
						)";
				
		$result = $db->query($sql);
		
		if($db->mysqli->affected_rows>0){
			return $db->mysqli->insert_id;
		}else
			return false;
	}
	
	
	public static function getAllCompany(){
		global $db;
		$sql = "SELECT * FROM company ORDER BY name";
		$result = $db->query($sql);
		$object_array = array();
		
		while ($row = mysqli_fetch_array($result)) {
		   $object_array[] = self::instantiate($row);
		}
		
		return !empty($object_array) ? $object_array : false;
		
	}
		
}

?>