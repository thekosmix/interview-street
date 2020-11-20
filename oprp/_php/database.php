<?php
error_reporting(E_ERROR);
require_once("config.php");

class MySQLDatabase {

	private $conn;
	
	function __construct(){
		$this->open_conn();
	}
	
	public function open_conn(){
		$this->conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASS);
		if(!$this->conn)
			die('Database Connection Failed: ' . mysqli_error());
		else{
			$db_select = mysqli_select_db($this->conn, DB_NAME);
			if(!$db_select)
				die('Database Selection Failed: '.mysqli_error($this->conn));
		}
	}
	
	public function query($sql){
		$result = mysqli_query($sql, $this->conn);
		if(!$result)
			die('Database Query Failed: '.mysqli_error($this->conn));
		return $result;
	}
	
	public function close_conn(){
		if(isset($this->conn)){
			mysqli_close($this->conn);
			unset($this->conn);
		}
	}	

}

$db = new MySQLDatabase();

?>
