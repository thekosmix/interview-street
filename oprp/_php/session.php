<?php

/*
-	Student (CR,IC,PC)     (2,3,5,7)
-	Faculty (HOD, TT)      (11, 13, 17)
-	Recruiter     	       (19)
-	Alumni		           (23)
-	RM admin               (29)
-	Super admin            (31)
*/

class Session{
	
	private $passout_year = 2012;
	
	private $student = 2;
	private $student_ic = 10;
	private $student_pc = 14;
	private $recruiter = 19;
	private $rm_admin = 29;
	
	private $logged_in = false;
	public $user_id;
	public $access;
	
	function __construct(){
		session_start();
		$this->check_login();
	}
	
	public function passYear(){
		return $this->passout_year;
	}
	
	public function recruiter_access(){
		return $this->recruiter;
	}
	
	public function student_access(){
		return $this->student;
	}
	
	private function check_login(){
		if(isset($_SESSION['user_id'])){
			$this->user_id = $_SESSION['user_id'];
			$this->access = $_SESSION['access'];
			$this->logged_in = true;
		}
		else{
			unset($this->user_id);
			$this->logged_in = false;
		}
	}
	
	public function is_logged_in(){
		return $this->logged_in;
	}
	
	public function login($user){
		if($user){
			$this->user_id = $_SESSION['user_id'] = $user->id;
			$this->access = $_SESSION['access'] = $user->access;
			$this->logged_in = true;		
		}
	}
	
	public function getUserID(){
		return $this->user_id;
	}
	
	public function isStudent($access=""){
		if($access==""){
			if(($this->logged_in) && ($this->access % $this->student == 0))
				return true;
			else return false;	
		}else{
			if($access % $this->student == 0)
				return true;
			else return false;
		}
	}
	
	public function isIC($access=""){
		if($access==""){
			if(($this->logged_in) && ($this->access % $this->student_ic == 0))
				return true;
			else return false;
		}else{
			if(($this->logged_in) && ($access % $this->student_ic == 0))
				return true;
			else return false;
		}
	}
	
	public function isPC($access=""){
		if($access==""){
			if(($this->logged_in) && ($this->access % $this->student_pc == 0))
				return true;
			else return false;
		}else{
			if(($this->logged_in) && ($access % $this->student_pc == 0))
				return true;
			else return false;
		}
	}
	
	public function isRecruiter($access=""){
		if($access==""){
			if(($this->logged_in) && ($this->access % $this->recruiter == 0))
				return true;
			else return false;
		}else{
			if($access % $this->recruiter == 0)
				return true;
			else return false;
		}
	}
	
	public function isRMadmin($access=""){
		if($access==""){
			if(($this->logged_in) && ($this->access % $this->rm_admin == 0))
				return true;
			else return false;	
		}else{
			if($access % $this->rm_admin == 0)
				return true;
			else return false;	
		}
	}
	
	public function moveNotStudent(){
		if(!$this->isStudent()){	
			redirect_to("../");
		}
	}
	
	public function moveNotRecruiter(){
		if(!$this->isRecruiter()){	
			redirect_to("../");
		}
	}
	
	public function moveNotRMadmin(){
		if(!$this->isRMadmin()){	
			redirect_to("../");
		}
	}
	
	public function getFolder(){
		if(self::isStudent()) return "student";
		else if(self::isRecruiter()) return "recruiter";
		else if(self::isRMadmin()) return "rm_admin";
	}
	
	public function logout(){
		unset($_SESSION['user_id']);
		unset($_SESSION['access']);
		unset($this->user_id);
		unset($this->access);
		$this->logged_in = false;	
		session_destroy();
	}
}

$session = new Session();

?>