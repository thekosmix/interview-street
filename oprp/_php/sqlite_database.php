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
            $base_dir = realpath(dirname(__FILE__) . '/../../');
            if (!$base_dir) {
                $base_dir = dirname(__FILE__) . '/../../';
            }
            $db_path = $base_dir . '/oprp.sqlite';
            
            $this->pdo = new PDO('sqlite:' . $db_path);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $this->pdo = null;
            error_log('Database Connection Failed: ' . $e->getMessage());
        }
    }

    public function query($sql, $params = []) {
        if (!$this->pdo) {
            $this->open_conn();
            if (!$this->pdo) {
                return false;
            }
        }
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            
            // For compatibility with num_rows, we fetch all rows if it's a SELECT query
            if (strncasecmp(trim($sql), 'SELECT', 6) === 0) {
                $stmt->all_rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $stmt->current_row = 0;
            }
            
            return $stmt;
        } catch (PDOException $e) {
            error_log('Database Query Failed: ' . $e->getMessage());
            return false;
        }
    }

    public function fetch_array($result) {
        if ($result instanceof PDOStatement) {
            if (isset($result->all_rows)) {
                if ($result->current_row < count($result->all_rows)) {
                    return $result->all_rows[$result->current_row++];
                }
                return false;
            }
            return $result->fetch(PDO::FETCH_ASSOC);
        }
        return false;
    }

    public function num_rows($result) {
        if ($result instanceof PDOStatement) {
            if (isset($result->all_rows)) {
                return count($result->all_rows);
            }
            return $result->rowCount();
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
        if ($this->pdo) {
            return $this->pdo->lastInsertId();
        }
        return 0;
    }

    public function escape_string($string) {
        // This function is no longer needed with prepared statements,
        // but we'll keep it for now to avoid breaking other parts of the code
        // that might still be using it.
        if ($this->pdo) {
            return $this->pdo->quote($string);
        }
        return addslashes($string);
    }

    public function close_conn() {
        if (isset($this->pdo)) {
            $this->pdo = null;
        }
    }
}

$db = new SQLiteDatabase();

?>