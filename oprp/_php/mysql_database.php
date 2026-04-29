<?php
error_reporting(E_ERROR);
require_once("database_interface.php");

class MySQLDatabase implements DatabaseInterface {

	public $mysqli;
	
	function __construct(){
		$this->open_conn();
	}
	
	public function open_conn(){
		$this->mysqli = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
		if($this->mysqli->connect_errno) {
			error_log('Database Connection Failed: ' . $this->mysqli->connect_error);
			$this->mysqli = null;
		}
	}
	
	public function query($sql, $params = []){
		if (!$this->mysqli) {
			$this->open_conn();
			if (!$this->mysqli) {
				return false;
			}
		}
		$stmt = $this->mysqli->prepare($sql);
		if($stmt === false) {
			error_log('Database Query Failed: '. $this->mysqli->error);
			return false;
		}
		if(!empty($params)){
			$types = str_repeat('s', count($params));
			$stmt->bind_param($types, ...$params);
		}
		$stmt->execute();
		$result = $stmt->get_result();
		if($result === false && $stmt->errno) {
			error_log('Database Query Failed: '. $stmt->error);
		}
		return $result;
	}

	public function fetch_array($result){
		if ($result instanceof mysqli_result) {
			return mysqli_fetch_array($result);
		}
		return false;
	}

	public function num_rows($result){
		if ($result instanceof mysqli_result) {
			return mysqli_num_rows($result);
		}
		return 0;
	}

	public function affected_rows($result){
		if ($this->mysqli) {
			return $this->mysqli->affected_rows;
		}
		return 0;
	}

	public function insert_id(){
		if ($this->mysqli) {
			return $this->mysqli->insert_id;
		}
		return 0;
	}

	public function escape_string($string){
		if ($this->mysqli) {
			return mysqli_real_escape_string($this->mysqli, $string);
		}
		return addslashes($string);
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