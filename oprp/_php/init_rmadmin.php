<?php

require_once("config.php"); 
require_once("functions.php"); 
require_once("database.php"); 
require_once("session.php"); 

require_once("user.php"); 
require_once("branch.php");


require_once("student.php");
require_once("announcement.php");
require_once("acad_be.php");
require_once("acad_me.php");
require_once("acad_mba.php");
require_once("proj.php");
require_once("recruiter.php");
require_once("company.php");
require_once("application.php");

$session->moveNotRMadmin();

date_default_timezone_set('Asia/Calcutta');

?>