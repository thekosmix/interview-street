<?php
error_reporting(E_ERROR);
require_once("config.php");

if (DB_TYPE == 'mysql') {
    require_once("mysql_database.php");
} elseif (DB_TYPE == 'sqlite') {
    require_once("sqlite_database.php");
}

?>