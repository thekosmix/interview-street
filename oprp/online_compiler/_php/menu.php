<tr valign="top">
<td width="200px" bgcolor="#dddddd" valign="top">

<?php if($session->isStudent()) { ?>
<div id="menu" style="vertical-align:top">
	<h3><a href="#section1">Preferences</a></h3>
	<div>
		<table cellpadding="8" cellspacing="0" border="0" width="100%">
			<tr><td class="menuLink"><a href="../student/index.php"><div>Announcements</div></a></td></tr>
            <tr><td class="menuLink"><a href="../student/my_recruiters.php"><div>My Recruiters</div></a></td></tr>
            <tr><td class="menuLink"><a href="../student/all_recruiters.php"><div>All Recruiters</div></a></td></tr>
		</table>
	</div>
	<h3><a href="#section2">Profile</a></h3>
	<div>
		<table cellpadding="8" cellspacing="0" border="0" width="100%">
			<tr><td class="menuLink"><a href="../student/personal.php"><div>Personal</div></a></td></tr>
			<tr><td class="menuLink"><a href="../student/academic.php"><div>Academic</div></a></td></tr>
            <tr><td class="menuLink"><a href="../student/projects.php"><div>Extra Curricular</div></a></td></tr>
		</table>
	</div>
	<h3><a href="#section3">Utilities</a></h3>
	<div>
		<table cellpadding="8" cellspacing="0" border="0" width="100%">
            <tr><td class="menuLink"><a href="../student/resume.php"><div>Download CV</div></a></td></tr>
			<tr><td class="menuLink"><a href="../student/calendar.php"><div>Calendar</div></a></td></tr>
			<tr><td class="menuLink"><a href="../student/forum.php"><div>Forum</div></a></td></tr>
		</table>
	</div>
    <h3><a href="#section4">Coding</a></h3>
	<div>
		<table cellpadding="8" cellspacing="0" border="0" width="100%">
			<tr><td class="menuLink"><a href="index.php"><div>Compiler</div></a></td></tr>
            <tr><td class="menuLink"><a href="problem.php"><div>Problems</div></a></td></tr>
            <tr><td class="menuLink"><a href="ranking.php"><div>Ranks</div></a></td></tr>
            <tr><td class="menuLink"><a href="participant_profile.php"><div>Profile</div></a></td></tr>
            <tr><td class="menuLink"><a href="shared_code.php"><div>Shared Codes</div></a></td></tr>
			<tr><td class="menuLink"><a href="contest.php"><div>Contest</div></a></td></tr>
		</table>
	</div>
    <h3><a href="#section5">Options</a></h3>
	<div>
		<table cellpadding="8" cellspacing="0" border="0" width="100%">
			<tr><td class="menuLink"><a href="../student/settings.php"><div>Settings</div></a></td></tr>
            <tr><td class="menuLink"><a href="../student/contact.php"><div>Contact</div></a></td></tr>
		</table>
	</div>
</div>

<?php }else if($session->isRecruiter()){ ?>

<div id="menu" style="vertical-align:top">
	<h3><a href="#section1">Options</a></h3>
	<div>
		<table cellpadding="8" cellspacing="0" border="0" width="100%">
			<tr><td class="menuLink"><a href="../recruiter/index.php"><div>Applications</div></a></td></tr>
            <tr><td class="menuLink"><a href="../recruiter/profile.php"><div>My Profile</div></a></td></tr>
			<tr><td class="menuLink"><a href="../recruiter/settings.php"><div>Settings</div></a></td></tr>
            <tr><td class="menuLink"><a href="../recruiter/contact.php"><div>Contact</div></a></td></tr>            
		</table>
	</div>
    <h3><a href="#section2">Coding</a></h3>
	<div>
		<table cellpadding="8" cellspacing="0" border="0" width="100%">
			<tr><td class="menuLink"><a href="index.php"><div>Compiler</div></a></td></tr>
            <tr><td class="menuLink"><a href="problem.php"><div>Problems</div></a></td></tr>
            <tr><td class="menuLink"><a href="ranking.php"><div>Ranks</div></a></td></tr>
            <tr><td class="menuLink"><a href="company_profile.php"><div>Add Contest</div></a></td></tr>
            <tr><td class="menuLink"><a href="shared_code.php"><div>Shared Codes</div></a></td></tr>
			<tr><td class="menuLink"><a href="contest.php"><div>Contest</div></a></td></tr>
		</table>
	</div>
</div>

<?php }else { ?>

<div id="menu" style="vertical-align:top">	
    <h3><a href="#section2">Coding</a></h3>
	<div>
		<table cellpadding="8" cellspacing="0" border="0" width="100%">
			<tr><td class="menuLink"><a href="index.php"><div>Compiler</div></a></td></tr>
            <tr><td class="menuLink"><a href="problem.php"><div>Problems</div></a></td></tr>
            <tr><td class="menuLink"><a href="ranking.php"><div>Ranks</div></a></td></tr>
		</table>
	</div>
</div>

<?php } ?>


<p align="center"><img src="../_images/dtu.png" align="middle" /></p>


</td>
            
<td width="20px">
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
</td>
            
<td width="730px" bgcolor="#dddddd" valign="top">            	          	


