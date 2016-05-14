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
		$uname = mysql_real_escape_string($uname);
		$passw = sha1($passw);		
		$sql = "SELECT * FROM user WHERE username = '{$uname}' AND password = '{$passw}' LIMIT 1";
		$result = $db->query($sql);
		$object_array = array();
		
		while ($row = mysql_fetch_array($result)) {
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
		$uname = mysql_real_escape_string($uname);
		$sql = "SELECT * FROM user WHERE username = '{$uname}' AND email = '{$email}'";
		$result = $db->query($sql);

		if(mysql_num_rows($result)>0){
			
			$row = mysql_fetch_array($result);
			$from = "From: no-reply@dce.edu";
			$sub = "Reset Password";
			$link = ABS_PATH."newpass.php?id=".$row['user_id']."&link=".$row['password'];
			$msg = "Please reset your password from the given below link. \n <a href='{$link}'>{$link}</a>";
			//echo $msg;
			if(@mail($email,$sub,$msg,$from))	
				return true;
			else return false;	
		}
		
		return false;
	}
	
	
	public static function insertUser($obj){	
		global $db;
		global $session;
		
		$sql = "SELECT * FROM user WHERE username = '{$obj->uname}'";
		$result = $db->query($sql);
		
		if(mysql_num_rows($result)==0){
			$sql = "INSERT INTO user (username, email, password, access) 
					VALUES ('{$obj->uname}', '{$obj->email}', '{$obj->passw}', '{$obj->access}' )";
					
			$result = $db->query($sql);
			
			if(mysql_affected_rows()>0)
			{
				$last_user_id = mysql_insert_id();
				return $last_user_id;
			}else
				return false;
				
		}else return false;
	}
	
	
	public static function sendNewPass($user_id, $password){
	
		global $db;
		$uname = mysql_real_escape_string($uname);
		$sql = "SELECT * FROM user WHERE user_id = '{$user_id}'";
		$result = $db->query($sql);

		if(mysql_num_rows($result)>0){
			
			$row = mysql_fetch_array($result);
			$to = $row['email'];
			$from = "From: New Password <no-reply@dce.edu>";
			$sub = "New Password";
			$msg = "Your password has been reset. New password is {$password}";
			//echo $msg;
			@mail($to,$sub,$msg,$from);
			
			return true;
		}
		
		return false;
	}
	
	
	public static function validateLink($id="", $link=""){
		
		global $db;
		$id = mysql_real_escape_string($id);
		$link = mysql_real_escape_string($link);
		$sql = "SELECT * FROM user WHERE user_id = '{$id}' AND password = '{$link}'";
		$result = $db->query($sql);
		
		if(mysql_num_rows($result)>0)
			return true;
		else
			return false;
	}
	
	
	public static function setNewPass($id="", $passw=""){

		global $db;
		$id = mysql_real_escape_string($id);
		$passw_enc = sha1($passw);
		$sql = "UPDATE user SET password = '{$passw_enc}' WHERE user_id = '{$id}'";
		$result = $db->query($sql);
		
		if(mysql_affected_rows()>0){
			self::sendNewPass($id, $passw);
			return true;
		}else
			return false;
		
	}
	
	public static function getUsernameByID($user_id=""){

		global $db;
		$sql = "SELECT * FROM user WHERE user_id = '{$user_id}'";
		$result = $db->query($sql);
		$row = mysql_fetch_array($result);
		
		return $row['username'];
		
	}
	
	public static function getDetailByID($id){
		
		global $db;		
		$sql = "SELECT * FROM user WHERE user_id = '{$id}' LIMIT 1";
		$result = $db->query($sql);
		$object_array = array();
		
		while ($row = mysql_fetch_array($result)) {
		   $object_array[] = self::instantiate($row);
		}
		
		return !empty($object_array) ? array_shift($object_array) : false;
		
	}
	
	public static function updateUsernameByID($uname){
		
		global $db;
		global $session;
		$sql = "SELECT * FROM user WHERE username = '{$uname}'";
		$result = $db->query($sql);
		$flag=1;
		
		if(mysql_num_rows($result)>0){
			$row = mysql_fetch_array($result);
			if($row['user_id'] != $session->user_id)
				$flag=0;
		}
		
		if($flag==1){
			$sql = "UPDATE user SET username  = '{$uname}' WHERE user_id = '{$session->user_id}'";
			$result = $db->query($sql);
		
			if(mysql_affected_rows()>0)
				return true;
			else
				return false;
				
		}else return false;	
	}
	
	public static function updateEmailByID($email){
		
		global $db;
		global $session;
		$sql = "SELECT * FROM user WHERE email = '{$email}'";
		$result = $db->query($sql);
		$flag=1;
		
		if(mysql_num_rows($result)>0){
			$row = mysql_fetch_array($result);
			if($row['user_id'] != $session->user_id)
				$flag=0;
		}
		
		if($flag==1){
			$sql = "UPDATE user SET email = '{$email}' WHERE user_id = '{$session->user_id}'";
			$result = $db->query($sql);
		
			if(mysql_affected_rows()>0)
				return true;
			else
				return false;
				
		}else return false;	
	}

}

?>