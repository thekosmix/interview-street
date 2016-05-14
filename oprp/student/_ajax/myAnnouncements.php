<?php  require_once("../../_php/init_student.php");

$year = $_GET['year'];
$branch = $_GET['branch'];
$recruiter_id = $_GET['recruiter_id'];
$page = $_GET['page'];
$num = $_GET['num'];

$announce_all = Announcement::getMyAnnouncement($year,$branch,$recruiter_id,$page,$num);

echo "<table cellpadding='6' border='0' width='100%' class='normalTxt infotbl'>";

if($announce_all)
	while($announce = array_shift($announce_all))
	{	
		echo "<tr><td class='announce_head_link'><label><strong>".$announce->heading."</strong></label> - <em>";
		if($announce->recruiter_id==0) echo "General";
		else echo "<a href='rec_profile.php?id={$announce->recruiter_id}'>".
			Recruiter::getDetailByID($announce->recruiter_id)->name."</a>";
		echo "</em></td></tr>";
		echo "<tr><td class='announce_content_link'><label>".nl2br($announce->content)."</label>";
		
		if($announce->attachment) 
			echo"<br/><a href='../_attachment/{$announce->announce_id}_{$announce->attachment}' title='Download'>
			<img src='../_images/attach.png' vspace='10' align='absmiddle'/> {$announce->attachment}</a>";
		
		echo "</td></tr>";
		echo "<tr><td>";
		echo "<table cellpadding='0' cellspacing='0' width='100%'><tr><td align='left'><span class='smallTxt'>".
				date("jS F Y - h:i:s A",strtotime($announce->announce_date))."</span></td>
				  <td align='right'><label>";
		  if($session->isStudent($announce->creator_access))
			echo"<strong>".Student::getFullNameByID($announce->creator_id)." </strong>";
		  else if($session->isRMadmin($announce->creator_access))
			echo"<strong>".User::getUsernameByID($announce->creator_id)." </strong>";		
		
		if($announce->creator_id == $session->user_id){	  
?>			<span class='smallTxt'><a href='index.php?del=<?php echo $announce->announce_id."&pg=".$page;?>' 
								onclick="return confirm('Are you sure?');">[Delete]</a></span>

<?php	}	
		echo "</label></td></tr></table></td></tr>";
		echo "<tr class='seperator'><td>&nbsp;</td></tr>";
	}
else{
	echo "<tr><td><label>No announcemens till now.</label></td></tr>";
	echo "<tr class='seperator'><td>&nbsp;</td></tr>";
}

echo "<tr class='seperator'><td align='right'><span class='smallTxt'>";
if(Announcement::getMyAnnouncement($year, $branch, $recruiter_id, $page-1, $num) != false)
	echo"<a onclick=\"getAnnouncements('prev')\" style='cursor:pointer;'>&lt;&lt; Newer</a> | ";
else echo"<label><span class='fade'>&lt;&lt; Newer</span></label> | ";
if(Announcement::getMyAnnouncement($year, $branch, $recruiter_id, $page+1, $num) != false)
	echo"<a onclick=\"getAnnouncements('next')\" style='cursor:pointer;'>Older &gt;&gt;</a>";
else echo"<label><span class='fade'>Older &gt;&gt;</span></label>";
echo"</span></td></tr></table>";
?>

