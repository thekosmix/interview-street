<?php
error_reporting(E_ERROR);
require_once("config.php");

class MySQLDatabase {

	public $mysqli;
	
	function __construct(){
		$this->open_conn();
	}
	
	public function open_conn(){
		$this->mysqli = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
		if($mysqli -> connect_errno)
			error_log('Database Connection Failed: ' . $mysqli -> connect_error);
	}
	
	public function query($sql){
		$result = $this->mysqli->query($sql);
		if(!$result)
			error_log('Database Query Failed: '. $this -> mysqli -> error);
		return $result;
	}
	
	public function close_conn(){
		if(isset($this->mysqli)){
			$this->mysqli->close();
			unset($this->mysqli);
		}
	}	

}

$db = new MySQLDatabase();

?>
