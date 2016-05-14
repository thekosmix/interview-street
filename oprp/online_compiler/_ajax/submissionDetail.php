<?php

require_once("../../_php/config.php");
require_once("../../_php/functions.php");
require_once("../../_php/database.php");
require_once("../../_php/session.php");
require_once("../../_php/user.php");
include_once("../_php/function.php");


	$submission_value = $_GET['submission_value'];

	if($submission_value != null)
		{
			$result_sub = getSubmissionByUserId(" submission_value = '".$submission_value."'");
			
			while($row_sub = mysql_fetch_array($result_sub))
			{
				echo "<h3>Question:</h3><pre>".getString('que_title', 'question', 'que_value', $row_sub['que_value'])."</pre>";
				echo "<hr />";				
				echo "<h3>Program:</h3><pre>".$row_sub['submission_prog']."</pre>";
				echo "<hr />";
				echo "<h3>Status:</h3><pre>".returnStatus($row_sub['submission_status'])."</pre>";
				echo "<hr />";
				echo "<h3>Submitted On:</h3><pre>".$row_sub['submission_time']."</pre>";
			}
		}
?>