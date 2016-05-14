<?php  

require_once("../_php/functions.php"); 
require_once("../_php/database.php"); 
require_once("../_php/session.php"); 
require_once("../_php/user.php"); 
require_once("../_php/student.php");
require_once("../_php/announcement.php");

//two  things are missing...... I need time of the announcement....and also the name of the creater is not there in the class, so do retrieve 
//creator's name.....

$last_announce= intval($_POST["number"]);

$announce_all = Announcement::getAllAnnouncement(0, 100); 

if($announce_all)
	{
		$index = 0;
        while(($announce = array_shift($announce_all)) && ($announce->announce_id > $last_announce))
		{
		$dd = date("Y-m-d",strtotime($announce->announce_date));	
		$tt = date("h:i:s",strtotime($announce->announce_date));
		
		if($session->isStudent($announce->creator_access))
			$name = Student::getFullNameByID($announce->creator_id);
		else if($session->isRMadmin($announce->creator_access))
			$name = User::getUsernameByID($announce->creator_id);	
		
		$var[$index] = array(
							"id"=> $announce->announce_id,
							"com_name"=>$announce->heading,
							"date"=>$dd,
							"time"=>$tt,
							"body"=>$announce->content,
							"user"=>$name
//something like retrieving creator_name by ID needs to be called.........									
							);
		$index = $index +1;
		
		}
		
				echo json_encode($var);
	}
	
/*	
	$var[0] =array("id"=>"10", "com_name"=>"L&T", "date"=>"2011-09-21","time"=>"02:58:19", "body"=>htmlentities("Written on 22nd Sept at 8.30 am and <a href='http://www.directi.com'>Directi</a> you can still apply before 5 p.m to",ENT_QUOTES,"UTF-8"),"user" => "Neeraj");

$var[1]=array("id"=>"15", "com_name"=>"Hero MotoCorp", "date"=>"2011-09-20","time" =>"", "body"=>"Those selected in Hero Motocorp ,collect your Bio-data and Medical Examination Form from T&P tomorrow.", "user"=>"ABHINAV VERMA");

$var[2] =array("id"=>"20", "com_name"=>"G.S.Constructions", "date"=>"2011-09-21","time"=>"02:58:19", "body"=>"Written on 22nd Sept at 8.30 am and you can still apply before 5 p.m","user" => "Neeraj");

$var[3] =array("id"=>"30", "com_name"=>"EVS", "date"=>"2011-10-27","time"=>"12:16:19", "body"=>"All those who want to appear for EVS must apply on RM. Last date to apply is today (27th Oct), 4 pm.","user" => "J JAYAKUMAR");

echo json_encode($var);
	
	*/
	
?>
 
