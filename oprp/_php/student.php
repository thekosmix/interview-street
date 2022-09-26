<?php

require_once("config.php");
require_once("functions.php");

class Student{
	
	public static $student_id;
	public static $roll_no;
	public static $course;
	public static $first_name;
	public static $middle_name;
	public static $last_name;
	public static $guardian_name;
	public static $last_updated_on;
	public static $local_address;
	public static $permanent_address;
	public static $phone_1;
	public static $phone_2;
	public static $mobile;
	public static $dob;
	public static $sex;
	public static $category;
	public static $citizenship;
	public static $home_town;
	public static $home_state;
	public static $language;
	public static $image_type;
	public static $mail_announce;
	
	public static function getDetailByID($user_id){
		global $db;
		$sql = "SELECT * FROM student WHERE student_id = '{$user_id}' LIMIT 1";
		$result = $db->query($sql);
		$object_array = array();
		
		while ($row = mysqli_fetch_array($result)) {
		   $object_array[] = self::instantiate($row);
		}
		
		return !empty($object_array) ? array_shift($object_array) : false;
		
	}
	
	
	public static function instantiate($row){
		$obj = new self;
		$obj->student_id        = $row['student_id'];
		$obj->roll_no 			= $row['roll_no'];
		$obj->course 			= $row['course'];
		$obj->first_name 		= $row['first_name'];
		$obj->middle_name		= $row['middle_name'];
		$obj->last_name 		= $row['last_name']; 
		$obj->guardian_name 	= $row['guardian_name'];
		$obj->last_updated_on	= $row['last_updated_on'];
		$obj->local_address 	= $row['local_address']; 
		$obj->permanent_address = $row['permanent_address']; 
		$obj->phone_1 			= $row['phone_1']; 
		$obj->phone_2			= $row['phone_2']; 
		$obj->mobile 			= $row['mobile']; 
		$obj->dob 				= $row['dob']; 
		$obj->sex 				= $row['sex'];
		$obj->category 			= $row['category'];
		$obj->citizenship 		= $row['citizenship'];
		$obj->home_town 		= $row['home_town']; 
		$obj->home_state 		= $row['home_state']; 
		$obj->language 			= $row['language']; 
		$obj->image_type 		= $row['image_type']; 
		$obj->mail_announce 	= $row['mail_announce']; 		
		return $obj;
	}

	public static function getFullNameByID($user_id=""){

		global $db;
		$sql = "SELECT * FROM student WHERE student_id = '{$user_id}'";
		$result = $db->query($sql);
		$row = mysqli_fetch_array($result);
		$name = $row['first_name'];
		if(!empty($row['middle_name'])) $name .= " ".$row['middle_name'];
		$name .= " ".$row['last_name'];
		
		return $name;
		
	}
	
	public static function getImageTypeByID($user_id=""){

		global $db;
		$sql = "SELECT * FROM student WHERE student_id = '{$user_id}'";
		$result = $db->query($sql);
		$row = mysqli_fetch_array($result);
		return $row['image_type'];
		
	}
	
	public static function getCourseByID($user_id=""){

		global $db;
		$sql = "SELECT * FROM student WHERE student_id = '{$user_id}'";
		$result = $db->query($sql);
		$row = mysqli_fetch_array($result);
		return $row['course'];
		
	}
	
	public static function updateDetailByID($obj){
		
		global $db;
		global $session;
		$sql = "UPDATE student SET 
					first_name     	  = '{$obj->first_name}',
					middle_name       = '{$obj->middle_name}',
					last_name     	  = '{$obj->last_name}',
					dob     		  = '{$obj->dob}',
					sex     		  = '{$obj->sex}',
					category     	  = '{$obj->category}',
					guardian_name     = '{$obj->guardian_name}',
					local_address 	  = '{$obj->local_address}',
					permanent_address = '{$obj->permanent_address}',
					phone_1 		  = '{$obj->phone_1}',
					phone_2 		  = '{$obj->phone_2}',
					mobile 			  = '{$obj->mobile}',
					home_town         = '{$obj->home_town}',
					home_state        = '{$obj->home_state}',
					language          = '{$obj->language}',
					image_type        = '{$obj->image_type}'
				WHERE student_id = '{$session->user_id}'";
				
		$result = $db->query($sql);
		
		if($db->mysqli->affected_rows>0)
			return true;
		else
			return false;
	}
	
	public static function updateAllDetailByID($obj,$id){
		
		global $db;
		$sql = "UPDATE student SET 
					first_name     	  = '{$obj->first_name}',
					middle_name       = '{$obj->middle_name}',
					last_name     	  = '{$obj->last_name}',
					dob     		  = '{$obj->dob}',
					sex     		  = '{$obj->sex}',
					category     	  = '{$obj->category}',
					guardian_name     = '{$obj->guardian_name}',
					local_address 	  = '{$obj->local_address}',
					permanent_address = '{$obj->permanent_address}',
					phone_1 		  = '{$obj->phone_1}',
					phone_2 		  = '{$obj->phone_2}',
					mobile 			  = '{$obj->mobile}',
					home_town         = '{$obj->home_town}',
					home_state        = '{$obj->home_state}',
					language          = '{$obj->language}',
					image_type        = '{$obj->image_type}'
				WHERE student_id = '{$id}'";
				
		$result = $db->query($sql);
		
		if($db->mysqli->affected_rows>0)
			return true;
		else
			return false;
	}
	
	public static function updateSettingByID($obj){
		
		global $db;
		global $session;
		$sql = "UPDATE student SET 
					mail_announce     = '{$obj->mail_announce}'
				WHERE student_id = '{$session->user_id}'";
				
		$result = $db->query($sql);
		
		if($db->mysqli->affected_rows>0)
			return true;
		else
			return false;
	}
	
	public static function mailAnnouncement($announce){	
		global $db;
		global $session;
		$branches = arrFormat(str_to_arr($announce->branch));
		$years = arrFormat(str_to_arr($announce->year));
		
		$sql = "    (SELECT u.email FROM student s, user u, academic_be be
					 WHERE s.student_id = u.user_id
					 AND s.student_id = be.student_id
					 AND be.branch IN {$branches}
					 AND be.year_of_grad IN {$years}
					 AND s.mail_announce = '1')
				UNION
					(SELECT u.email FROM student s, user u, academic_me me
					 WHERE s.student_id = u.user_id
					 AND s.student_id = me.student_id
					 AND me.branch IN {$branches}
					 AND me.year_of_pg IN {$years}
					 AND s.mail_announce = '1')
				UNION
					(SELECT u.email FROM student s, user u, academic_mba mba
					 WHERE s.student_id = u.user_id
					 AND s.student_id = mba.student_id
					 AND mba.branch IN {$branches}
					 AND mba.year_of_pg IN {$years}
					 AND s.mail_announce = '1')";
		
		$result = $db->query($sql);
		
		if($session->isStudent($announce->creator_id))
			$name = Student::getFullNameByID($announce->creator_id);
		else 
			$name = User::getUsernameByID($announce->creator_id);
		
		$from = "From: Announcement <no-reply@dce.edu>";
		$sub = "New Announcement";
		$msg = "{$announce->heading}\n\n{$announce->content}\n\n- {$name}";
		
		while($row = mysqli_fetch_array($result)){
			$to = $row['email'];
			@mail($to,$sub,$msg,$from);
		}
		
		return true;
	}
	
	
	public static function insertStudent($obj){
		
		global $db;
		global $session;
		
		$sql = "SELECT * FROM student WHERE roll_no = '{$obj->roll_no}'";
		$result = $db->query($sql);
		
		if(mysqli_num_rows($result)==0){
			$sql = "INSERT INTO student 
					(student_id, roll_no, course) 
					VALUES (
							'{$obj->student_id}', 
							'{$obj->roll_no}', 
							'{$obj->course}'
							)";
					
			$result = $db->query($sql);
			
			if($db->mysqli->affected_rows>0)
				return true;
			else
				return false;
				
		}else return false;
	}
	
	
}

?>