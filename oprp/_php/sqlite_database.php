<?php
error_reporting(E_ERROR);
require_once("database_interface.php");

class SQLiteDatabase implements DatabaseInterface {

    public $pdo;

    function __construct() {
        $this->open_conn();
    }

    public function open_conn() {
        try {
            $this->pdo = new PDO('sqlite:' . realpath(dirname(__FILE__) . '/../../') . '/oprp.sqlite');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            error_log('Database Connection Failed: ' . $e->getMessage());
        }
    }

    public function query($sql, $params = []) {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            error_log('Database Query Failed: ' . $e->getMessage());
            return false;
        }
    }

    public function fetch_array($result) {
        if ($result instanceof PDOStatement) {
            return $result->fetch(PDO::FETCH_ASSOC);
        }
        return false;
    }

    public function num_rows($result) {
        if ($result instanceof PDOStatement) {
            $data = $result->fetchAll();
            return count($data);
        }
        return 0;
    }

    public function affected_rows($result) {
        if ($result instanceof PDOStatement) {
            return $result->rowCount();
        }
        return 0;
    }

    public function insert_id() {
        return $this->pdo->lastInsertId();
    }

    public function escape_string($string) {
        // This function is no longer needed with prepared statements,
        // but we'll keep it for now to avoid breaking other parts of the code
        // that might still be using it.
        return $this->pdo->quote($string);
    }

    public function close_conn() {
        if (isset($this->pdo)) {
            $this->pdo = null;
        }
    }
}

$db = new SQLiteDatabase();

?>