<?php

require_once("config.php");
require_once("functions.php");

class User{
	
	public static $id;
	public static $uname;
	public static $access;
	public static $email;
	public static $passw;
	
	public static function authenticated($uname="", $passw=""){
		
		global $db;
		$passw = sha1($passw); 		
		$sql = "SELECT * FROM user WHERE username = ? AND password = ? LIMIT 1";
		$result = $db->query($sql, [$uname, $passw]);
		$object_array = array();
		
		while ($row = $db->fetch_array($result)) {
		   $object_array[] = self::instantiate($row);
		}
		
		return !empty($object_array) ? array_shift($object_array) : false;
		
	}
	
	
	public static function instantiate($row){
		$obj = new self;
		$obj->id = $row['user_id'];
		$obj->uname = $row['username'];
		$obj->access = $row['access'];
		$obj->email = $row['email'];
		return $obj;
	}
	
	
	public static function sendNewPassLink($uname="", $email=""){
	
		global $db;
		$sql = "SELECT * FROM user WHERE username = ? AND email = ?";
		$result = $db->query($sql, [$uname, $email]);

		if($db->num_rows($result)>0){
			
			$row = $db->fetch_array($result);
			$from = "From: no-reply@dce.edu";
			$sub = "Reset Password";
			$link = ABS_PATH."newpass.php?id=".$row['user_id']."&link=".$row['password'];
			$msg = "Please reset your password from the given below link. \n <a href='{$link}'>{$link}</a>";
			
			if(@mail($email,$sub,$msg,$from))	
				return true;
			else return false;	
		}
		
		return false;
	}
	
	
	public static function insertUser($obj){	
		global $db;
		global $session;
		
		$sql = "SELECT * FROM user WHERE username = ?";
		$result = $db->query($sql, [$obj->uname]);
		
		if($db->num_rows($result)==0){
			$sql = "INSERT INTO user (username, email, password, access) 
					VALUES (?, ?, ?, ?)";
					
			$result = $db->query($sql, [$obj->uname, $obj->email, $obj->passw, $obj->access]);
			
			if($db->affected_rows($result)>0)
			{
				$last_user_id = $db->insert_id();
				return $last_user_id;
			}else
				return false;
				
		}else return false;
	}
	
	
	public static function sendNewPass($user_id, $password){
	
		global $db;
		$sql = "SELECT * FROM user WHERE user_id = ?";
		$result = $db->query($sql, [$user_id]);

		if($db->num_rows($result)>0){
			
			$row = $db->fetch_array($result);
			$to = $row['email'];
			$from = "From: New Password <no-reply@dce.edu>";
			$sub = "New Password";
			$msg = "Your password has been reset. New password is {$password}";
			
			@mail($to,$sub,$msg,$from);
			
			return true;
		}
		
		return false;
	}
	
	
	public static function validateLink($id="", $link=""){
		
		global $db;
		$sql = "SELECT * FROM user WHERE user_id = ? AND password = ?";
		$result = $db->query($sql, [$id, $link]);
		
		if($db->num_rows($result)>0)
			return true;
		else
			return false;
	}
	
	
	public static function setNewPass($id="", $passw=""){

		global $db;
		$passw_enc = sha1($passw);
		$sql = "UPDATE user SET password = ? WHERE user_id = ?";
		$result = $db->query($sql, [$passw_enc, $id]);
		
		if($db->affected_rows($result)>0){
			self::sendNewPass($id, $passw);
			return true;
		}else
			return false;
		
	}
	
	public static function getUsernameByID($user_id=""){

		global $db;
		$sql = "SELECT * FROM user WHERE user_id = ?";
		$result = $db->query($sql, [$user_id]);
		$row = $db->fetch_array($result);
		
		return $row['username'];
		
	}
	
	public static function getDetailByID($id){
		
		global $db;		
		$sql = "SELECT * FROM user WHERE user_id = ? LIMIT 1";
		$result = $db->query($sql, [$id]);
		$object_array = array();
		
		while ($row = $db->fetch_array($result)) {
		   $object_array[] = self::instantiate($row);
		}
		
		return !empty($object_array) ? array_shift($object_array) : false;
		
	}
	
	public static function updateUsernameByID($uname){
		
		global $db;
		global $session;
		$sql = "SELECT * FROM user WHERE username = ?";
		$result = $db->query($sql, [$uname]);
		$flag=1;
		
		if($db->num_rows($result)>0){
			$row = $db->fetch_array($result);
			if($row['user_id'] != $session->user_id)
				$flag=0;
		}
		
		if($flag==1){
			$sql = "UPDATE user SET username  = ? WHERE user_id = ?";
			$result = $db->query($sql, [$uname, $session->user_id]);
		
			if($db->affected_rows($result)>0)
				return true;
			else
				return false;
				
		}else return false;	
	}
	
	public static function updateEmailByID($email){
		
		global $db;
		global $session;
		$sql = "SELECT * FROM user WHERE email = ?";
		$result = $db->query($sql, [$email]);
		$flag=1;
		
		if($db->num_rows($result)>0){
			$row = $db->fetch_array($result);
			if($row['user_id'] != $session->user_id)
				$flag=0;
		}
		
		if($flag==1){
			$sql = "UPDATE user SET email = ? WHERE user_id = ?";
			$result = $db->query($sql, [$email, $session->user_id]);
		
			if($db->affected_rows($result)>0)
				return true;
			else
				return false;
				
		}else return false;	
	}

}

?>