<?php 


require_once("../_php/database.php");
require_once("../_php/session.php");
include("../_php/recruiter.php");

$last_recruiter= intval($_POST["number"]);
$recruiters_all = Recruiter::getAllActiveRecruiter(); 

//Missing fields are branches of BE ME INTERN, PKG of ALL, Cutoff of them separately.......to fill up branches is a MUST.....All othere blank 
//will DO.....

// "branches" contains all the branch code seperatred by comma, so you can make your coded string accordingly
// and "for_year" contains if the company is for intern or placements, it stores '2012' if it is coming for placements and '2013' if for intern
				

if($recruiters_all)
	{
		$index = 0;
        while(($recruiter = array_shift($recruiters_all))&& ($recruiter->recruiter_id > $last_recruiter))
				{
					
					
					$var[$index] = array(
									"id"=> $recruiter->recruiter_id,
									"grade"=> $recruiter->grade,
									"rec_name"=> $recruiter->name,
									"date"=> "08-08-2011",
									"branches_be"=>"1111111111",
									"pkg_be"=>"12",
									"cutoff_be"=>"55",
									"branches_me"=>"11110000000000000",
									"pkg_me"=>"13",
									"cutoff_me"=>"60",
									"branches_intern"=>"",
									"pkg_intern"=>"",
									"cutoff_intern"=>"70"
									);
				}
				echo json_encode($var);
	}
?>
 

