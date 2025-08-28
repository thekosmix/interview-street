<?php  require_once("../_php/init_student.php"); 
	
$num = 10; // number of announcements per page

$years = array();
$years[0] = $session->passYear();
$years[1] = $session->passYear()+1;

if(isset($_GET['del'])){
	$deleted = Announcement::deleteAnnouncement($_GET['del']);
	if($deleted)
			$msg = setErrNotMsg("Announcement deleted successfully.");		
		else
			$msg = setErrMsg("Announcement can not deleted. Please try later.");
}

if(isset($_POST["submit"])){
	
	if(empty($_POST['content']))
		$msg = setErrMsg("Please enter the content of announcement.");
	else if(empty($_POST['year_arr']))
		$msg = setErrMsg("Please select the passing year of students.");
	else if(empty($_POST['branch_arr']))
		$msg = setErrMsg("Please select the branches of the students.");
	else{
		$announce = new Announcement();
		$announce->heading 	= trim($_POST['heading']);
		$announce->content 	= $db->escape_string(trim($_POST['content'])); 
		$announce->attachment = $_FILES['attachment']['name'];
		$announce->year 	= arr_to_str($_POST['year_arr']); 
		$announce->branch 	= arr_to_str($_POST['branch_arr']);
		$announce->recruiter_id	= $_POST['recruiter_id'];
		
		$inserted = Announcement::insertAnnouncement($announce);
		$uploaded = move_uploaded_file($_FILES['attachment']['tmp_name'], "../_attachment/".$inserted."_".$_FILES['attachment']['name']);
		
		if($inserted)
			$msg = setErrNotMsg("New announcement has been created.");		
		else
			$msg = setErrMsg("New announcement could not be created. Please try later.");
	}
}


$course = Student::getCourseByID($session->user_id);
switch($course)
{
	case 'be': $acad = Academics_BE::getDetailByID($session->user_id); $yr_of_comp = $acad->year_of_grad; break;
	case 'me': $acad = Academics_ME::getDetailByID($session->user_id); $yr_of_comp = $acad->year_of_pg; break;
	case 'mba': $acad = Academics_MBA::getDetailByID($session->user_id); $yr_of_comp = $acad->year_of_pg; break;
}

$branch_be_global = Branch::getDetailByCourse("be");
$branch_me_global = Branch::getDetailByCourse("me");
$branch_mba_global = Branch::getDetailByCourse("mba");
$recruiters_all = Recruiter::getAllActiveRecruiter();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php include("../_include/title.php"); ?> - Announcements</title>
<?php include("../_include/design.php"); ?>

<script type="text/javascript"> 

$(document).ready(function() { 
  $("#announce_form").validate({ 
	rules: { 
	  heading: {required: true},	
	  content: { required: true}
	}, 
	messages: { 
	  heading: { required: "<br/>Please enter the heading of the announcement" },	
	  content: { required: "<br/>Please enter the content of the announcement" }
	} 
  }); 
}); 

</script>

<script type="text/javascript"> 

function getAnnouncements(eve)
{
	if(eve=='change')
		$("#page").val(1);
	else if(eve=='next'){
		var pg = $("#page").val();
		$("#page").val(parseFloat(pg)+1);
	}else if(eve=='prev'){
		var pg = $("#page").val();
		$("#page").val(parseFloat(pg)-1);
	}
	
	var year = $("#year :selected").val();
	var branch = $("#branch :selected").val();
	var recruiter_id = $("#recruiter_id :selected").val();
	var page = $("#page").val();
	var num = <?php echo $num; ?>;
	var hl = "_ajax/myAnnouncements.php?year="+year+"&branch="+branch+"&recruiter_id="+recruiter_id+"&page="+page+"&num="+num;
	
	$.ajax({
	   type: "POST",
	   url: "_ajax/myAnnouncements.php?year="+year+"&branch="+branch+"&recruiter_id="+recruiter_id+"&page="+page+"&num="+num,
	   success: function(msg){
		  $("#myAnnouncements").html(msg);
	   }
 	});
	
}

</script>

</head>

<body>
<?php include("../_include/header.php"); ?>
<?php include("_include/topmenu.php"); ?>
<?php include("_include/menu.php"); ?>
            
<!--body-->
            	
                
<table width="100%" cellpadding="0" cellspacing="20" border="0" align="center" class="normalTxt">

<?php if(isset($msg)) echo"<tr><td>{$msg}</td></tr>"; ?>       
    
    <tr height="30px" valign="middle"><td><span class="topicTxt">Announcements</span></td></tr>
    <tr><td>
    		
            <table cellpadding="0" cellspacing="0" width="100%" border="0"><tr><td>
            <table cellpadding="6" border="0" width="100%" class='normalTxt infotbl'>    
			
            <?php if($session->isIC() || $session->isPC()){ ?>
			
                <tr><td>
                <table cellpadding="6" width="100%" border="0">
                <form action="" method="post" id="announce_form" enctype="multipart/form-data">
                <tr class="highlighter"><td>New Announcement</td></tr>
                <tr><td><label><strong>Heading : </strong></label> <input type="text" name="heading" id="heading" size="40"/></td></tr>
                <tr valign="middle"><td><label><strong>Content : </strong></label><br/>
                 <textarea name="content" id="content" cols="60" rows="5"></textarea></td></tr>
                <tr><td><label><strong>Batch (Year of Passing) : </strong></label>

                <?php 
					  $i=0;
                      while($years[$i])
					  {
                        echo"&nbsp;&nbsp;&nbsp;<input type='checkbox'";
						if($yr_of_comp == $years[$i]) echo " checked='checked'";
						echo " id='year_arr' name='year_arr[]' value='{$years[$i]}' />
						{$years[$i]} "; 
						$i++;
					  }
                ?>

                </td></tr>   
                <tr><td><label><strong>Company : </strong></label>
                	<select name="recruiter_id">
                    <option value="0">General</option>
                    <?php $recruiters = $recruiters_all;
						  while($recruiter = array_shift($recruiters))
							echo"<option value=".$recruiter->recruiter_id.">".$recruiter->name."</option>"; 
					?>
                    </select>
                </td></tr>
                <tr><td><label><strong>Branches : </strong></label><br/><br/>
                
                <table width="100%" border="0">
                
                <?php	
					echo"<tr><td rowspan='2'>B.E. :</td>";
					$branch_be = $branch_be_global;
					for($ctr=1,$branch = array_shift($branch_be);$branch;$branch = array_shift($branch_be),$ctr++)
					{	
						echo"<td><input type='checkbox'"; 
						if($acad->branch == $branch->branch_code) echo " checked='checked'";
						echo " id='branch_arr' name='branch_arr[]' value='{$branch->branch_code}' />
						<label title='{$branch->branch_name}'>{$branch->branch_code} </label></td>";
						if($ctr%5==0) echo"</tr><tr>";
					}
					echo"<td>&nbsp;</td></tr>";
					
					echo"<tr><td rowspan='2'>M.E. :</td>";
					$branch_me = $branch_me_global;
					for($ctr=1,$branch = array_shift($branch_me);$branch;$branch = array_shift($branch_me),$ctr++)
					{
						echo"<td><input type='checkbox' id='branch_arr'";
						if($acad->branch == $branch->branch_code) echo " checked='checked'";
						echo " name='branch_arr[]' value='{$branch->branch_code}' />
							<label title='{$branch->branch_name}'>{$branch->branch_code} </label></td>";
						if($ctr%8==0) echo"</tr><tr>";
					}
					echo"<td>&nbsp;</td></tr>";
					
					echo"<tr><td rowspan='2'>M.B.A. :</td>";
					$branch_mba = $branch_mba_global;
					for($ctr=1,$branch = array_shift($branch_mba);$branch;$branch = array_shift($branch_mba),$ctr++)
					{
						echo"<td><input type='checkbox' id='branch_arr'";
						if($acad->branch == $branch->branch_code) echo " checked='checked'";			
						echo " name='branch_arr[]' value='{$branch->branch_code}' />
							<label title='{$branch->branch_name}'>{$branch->branch_code} </label></td>";
						if($ctr%8==0) echo"</tr><tr>";
					}
					echo"<td>&nbsp;</td></tr>";
					
                ?>
				</table>
                </td></tr>
  	            <tr><td><strong>Attach a File : </strong> <input type="file" id="attachment" name="attachment"/></td></tr>
                <tr><td><input type="submit" name="submit" value="+ Add" class="submitStyle"/></td></tr>
                </form>
                </table></td></tr>
 
            	<tr class='seperator'><td>&nbsp;</td></tr>
                
            <?php } ?>
                        
               <tr><td><strong> Filters &nbsp;&nbsp;&nbsp;</strong>
               
               		<select name="year" id='year' onchange="getAnnouncements('change')">
               		<option value="all">All Years</option>
                    <?php 
						$i=0;
						while($years[$i])
						{
							echo"<option value='{$years[$i]}'";
							if($yr_of_comp == $years[$i]) echo " selected='selected'";
							echo">{$years[$i]}</option>"; 
                            $i++;
                        }
					?>
                    </select>
                    
                    <select name="branch" id="branch" onchange="getAnnouncements('change')">
                    <option value="all">All Branches</option>
                    <?php 
						$branch_be = Branch::getDetailByCourse("be");
						while($branch = array_shift($branch_be))
						{
							echo"<option value='{$branch->branch_code}'";
							if($acad->branch == $branch->branch_code) echo " selected='selected'";
							echo">{$branch->branch_name}</option>"; 
                        }
						$branch_me = Branch::getDetailByCourse("me");
						while($branch = array_shift($branch_me))
						{
							echo"<option value='{$branch->branch_code}'";
							if($acad->branch == $branch->branch_code) echo " selected='selected'";
							echo">{$branch->branch_name}</option>"; 
                        }
						$branch_mba = Branch::getDetailByCourse("mba");
						while($branch = array_shift($branch_mba))
						{
							echo"<option value='{$branch->branch_code}'";
							if($acad->branch == $branch->branch_code) echo " selected='selected'";
							echo">{$branch->branch_name}</option>"; 
                        }
					?>
                    </select>
                    
                    <select name="recruiter_id" id="recruiter_id" onchange="getAnnouncements('change')">
                    <option value="all">All Recruiters</option>
                    <option value="0">General</option>
                    <?php $recruiters = $recruiters_all;
						  while($recruiter = array_shift($recruiters))
							echo"<option value=".$recruiter->recruiter_id.">".$recruiter->name."</option>"; ?>
                    </select>
                    <input type="hidden" name="page" id="page" value=1 />
                    
                    </td></tr>      
               <tr class='seperator'><td>&nbsp;</td></tr>
               </table></td></tr>
               
               
               <tr><td id="myAnnouncements"><table cellpadding="6" border="0" width="100%" class='normalTxt infotbl'>
  			   
                        
            <?php   
			
                $announce_all = Announcement::getMyAnnouncement($yr_of_comp, $acad->branch,"all","1", $num); 

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
			   ?>			<span class='smallTxt'><a href='index.php?del=<?php echo $announce->announce_id;?>' 
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
				echo"<label><span class='fade'>&lt;&lt; Newer</span></label> | ";
				if(Announcement::getMyAnnouncement($acad->year_of_grad, $acad->branch, "all", 2, $num) != false)
					echo"<a onclick=\"getAnnouncements('next')\" style='cursor:pointer;'>Older &gt;&gt;</a>";
				else echo"<label><span class='fade'>Older &gt;&gt;</span></label>";
            	echo"</span></td></tr>";
				
			?>
            
			</table>
            </td></tr></table>

    </td></tr>
</table>
                
                
<!--body close-->       
            
<?php include("../_include/footer.php"); ?>
</body>
</html>