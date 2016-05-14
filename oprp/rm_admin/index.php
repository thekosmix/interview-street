<?php require_once("../_php/init_rmadmin.php"); 

if(isset($_GET['pg']))
	$page=$_GET['pg'];
else
	$page=0;
	
$num = 5; // number of announcements per page
$years = array();
$years[0] = $session->passYear();
$years[1] = $session->passYear()+1;

if(isset($_GET['del'])){
	$deleted = Announcement::deleteAnyAnnouncement($_GET['del']);
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
		$announce->content 	= trim($_POST['content']); 
		$announce->year 	= arr_to_str($_POST['year_arr']); 
		$announce->branch 	= arr_to_str($_POST['branch_arr']); 
		
		$inserted = Announcement::insertAnnouncement($announce);
		
		if($inserted)
			$msg = setErrNotMsg("New announcement has been created.");		
		else
			$msg = setErrMsg("New announcement could not be created. Please try later.");
	}
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php include("../_include/title.php"); ?> - All Announcements</title>
<?php include("../_include/design.php"); ?>

<script type="text/javascript"> 

$(document).ready(function() { 
  $("#announce_form").validate({ 
	rules: { 
	  content: { required: true}
	}, 
	messages: { 
	  content: { required: "<br/>Please enter the content of the announcement" }
	} 
  }); 
}); 

/*
$(document).ready(function() 
{ 
    $("#announce_form").submit(function() 
    { 
        if (!isCheckedById("year_arr"))
        	return false;  
        else if(!isCheckedById("branch_arr"))
			return false; 
		else
			return true;
    }); 
	
	function isCheckedById(id) 
    { 
        var checked = $("input[@id="+id+"]:checked").length; 
        if (checked == 0) 
			return false; 
        else return true; 
    } 
});
*/

</script>

</head>

<body>
<?php include("../_include/header.php"); ?>
<?php include("_include/topmenu.php"); ?>
<?php include("_include/menu.php"); ?>
            
<!--body-->
            	
                
<table width="100%" cellpadding="0" cellspacing="20" border="0" align="center" class="normalTxt">

<?php if(isset($msg)) echo"<tr><td>{$msg}</td></tr>"; ?>       
    
    <tr><td>
    
        <table width="100%" cellpadding="0" cellspacing="10" border="0" align="left">
        <tr height="40px" valign="middle"><td><span class="topicTxt">All Announcements</span></td></tr>
        <tr valign="top"><td width="100%">
        
            <table cellpadding="6" border="0" width="100%" class='normalTxt infotbl'>    
			
                <tr><td>
                <table cellpadding="6" width="100%">
                <form action="" method="post" id="announce_form">
                <tr class="highlighter"><td>New Announcement</td></tr>
                <tr><td><label><strong>Heading : </strong></label> <input type="text" name="heading" id="heading" size="40"/></td></tr>
                <tr valign="middle"><td><label><strong>Content : </strong></label><br/>
                 <textarea name="content" id="content" cols="60" rows="5"></textarea></td></tr>
                <tr><td><label><strong>Batch (Year of Passing) : </strong></label>

 				<?php 
                      while($year = array_shift($years))
					  {
                        echo"&nbsp;&nbsp;&nbsp;<input type='checkbox' id='year_arr' name='year_arr[]' value='{$year}' />
						{$year} "; 
					  }
                ?>

                </td></tr>
                        
                <tr><td><label><strong>Branches : </strong></label>
                
                 <?php	
					echo"<br/><br/>B.E. : &nbsp;&nbsp;&nbsp;";
					$branch_be = Branch::getDetailByCourse("be");
					while($branch = array_shift($branch_be))
					{
						echo"&nbsp;&nbsp;&nbsp;<input type='checkbox' id='branch_arr' name='branch_arr[]' value='{$branch->branch_code}' />
						{$branch->branch_code} ";
					}
					
					echo"<br/><br/>M.E. : &nbsp;&nbsp;";
					$branch_be = Branch::getDetailByCourse("me");
					while($branch = array_shift($branch_be))
					{
						echo"&nbsp;&nbsp;&nbsp;<input type='checkbox' id='branch_arr' name='branch_arr[]' value='{$branch->branch_code}' />
							{$branch->branch_code} ";
					}
					
					echo"<br/><br/>M.B.A. : ";
					$branch_be = Branch::getDetailByCourse("mba");
					while($branch = array_shift($branch_be))
					{
						echo"&nbsp;&nbsp;<input type='checkbox' id='branch_arr' name='branch_arr[]' value='{$branch->branch_code}' />
							{$branch->branch_code} ";
					}
                ?>


                </td></tr>
                
                <tr><td><input type="submit" name="submit" value="+ Add" class="submitStyle"/></td></tr>
                </form>
                </table></td></tr>
            
            	<tr class='seperator'><td>&nbsp;</td></tr>
                
            
            <?php 
                
                $announce_all = Announcement::getAllAnnouncement($page, $num); 
                
                if($announce_all)
                    while($announce = array_shift($announce_all))
                    {
                        echo "<tr><td><label><strong>".$announce->heading."</strong></label></td></tr>";
                        echo "<tr><td><label>".nl2br($announce->content)."</label></td></tr>";
                        echo "<tr><td>";
						echo "<table cellpadding='0' cellspacing='0' width='100%'><tr><td align='left'><span class='smallTxt'>".
								date("jS F Y - h:i:s A",strtotime($announce->announce_date))."</span></td>
								  <td align='right'><label>";
						  if($session->isStudent($announce->creator_access))
							echo"<strong>".Student::getFullNameByID($announce->creator_id)." </strong>";
						  else if($session->isRMadmin($announce->creator_access))
							echo"<strong>".User::getUsernameByID($announce->creator_id)." </strong>";	

			   ?>			<span class='smallTxt'><a href='index.php?del=<?php echo $announce->announce_id."&pg=".$page;?>' 
               									onclick="return confirm('Are you sure?');">[Delete]</a></span>
			   
			   <?php		
						echo "</label></td></tr></table></td></tr>";
                        echo "<tr class='seperator'><td>&nbsp;</td></tr>";
                    }
                else{
                    echo "<tr><td><label>No announcemens till now.</label></td></tr>";
                    echo "<tr class='seperator'><td>&nbsp;</td></tr>";
				}
				
				echo "<tr class='seperator'><td align='right'><span class='smallTxt'>";
				if(Announcement::getAllAnnouncement($page-1, $num) != false)
					echo"<a href='index.php?pg=".($page-1)."'>&lt;&lt; Newer</a> | ";
				else echo"<label><span class='fade'>&lt;&lt; Newer</span></label> | ";
				if(Announcement::getAllAnnouncement($page+1, $num) != false)
					echo"<a href='index.php?pg=".($page+1)."'>Older &gt;&gt;</a>";
				else echo"<label><span class='fade'>Older &gt;&gt;</span></label>";
            	echo"</span></td></tr>";
				
            ?>
            
            </table>
            
        </td>
        </tr>
            
        </table>

    </td></tr>
</table>
                
                
<!--body close-->       
            
<?php include("../_include/footer.php"); ?>
</body>
</html>