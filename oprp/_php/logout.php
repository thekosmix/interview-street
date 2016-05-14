<?php 
require_once("config.php"); 
require_once("functions.php"); 
require_once("database.php"); 
require_once("session.php");

$session->logout();
redirect_to("../index.php");
?>