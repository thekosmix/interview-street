<?php
error_reporting(E_ERROR);
require_once("config.php");

class MySQLDatabase {

	private $conn;
	
	function __construct(){
		$this->open_conn();
	}
	
	public function open_conn(){
		$this->conn = mysql_connect(DB_SERVER,DB_USER,DB_PASS);
		if(!$this->conn)
			die('Database Connection Failed: ' . mysql_error());
		else{
			$db_select = mysql_select_db(DB_NAME, $this->conn);
			if(!$db_select)
				die('Database Selection Failed: '.mysql_error());
		}
	}
	
	public function query($sql){
		$result = mysql_query($sql, $this->conn);
		if(!$result)
			die('Database Query Failed: '.mysql_error());
		return $result;
	}
	
	public function close_conn(){
		if(isset($this->conn)){
			mysql_close($this->conn);
			unset($this->conn);
		}
	}	

}

$db = new MySQLDatabase();

?>
