<?php 

require_once("../../_php/init_student.php");
$topic_id = $_GET['topic_id'];
Forum_Subs::addSubscription($topic_id);

?>