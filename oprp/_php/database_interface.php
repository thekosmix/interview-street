<?php
interface DatabaseInterface {
    public function query($sql, $params = []);
    public function fetch_array($result);
    public function num_rows($result);
    public function affected_rows($result);
    public function insert_id();
    public function escape_string($string);
}
?>