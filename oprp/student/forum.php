<?php  require_once("../_php/init_student.php"); 
	
$num = 10; // number of announcements per page

if(isset($_POST["submit"])){
	
	if(empty($_POST['content']) || empty($_POST['heading']))
		$msg = setErrMsg("Please enter the heading and content");
	else{
		$forum_topic = new Forum_Topic();
		$forum_topic->heading 	= trim($_POST['heading']);
		$forum_topic->content 	= $db->escape_string(trim($_POST['content'])); 
		$forum_topic->attachment = $_FILES['attachment']['name'];
		$forum_topic->topic_type 	= $_POST['topic_type']; 
		
		if($forum_topic->topic_type != 'General'){
			if($_POST['company_id'] == 0){
				if(!empty($_POST['name'])){
					$company = new Company();
					$company->name = trim($_POST['name']);
					$forum_topic->company_id = Company::insertCompany($company);
				}else $forum_topic->company_id = NULL;				
			}else $forum_topic->company_id = $_POST['company_id']; 
		}
		
		$inserted = Forum_Topic::insertTopic($forum_topic);
		$subs_id = Forum_Subs::addSubscription($inserted);
		$uploaded = move_uploaded_file($_FILES['attachment']['tmp_name'], 
					"../_attachment/forum_topic/".$subs_id."_".$_FILES['attachment']['name']);
		
		if($inserted) $msg = setErrNotMsg("New topic has been created.");		
		else $msg = setErrMsg("New topic could not be created. Please try later.");
	}
}

$companies_all = Company::getAllCompany();
$companies = $companies_all;
while($company = array_shift($companies))
	$comp .= "<option value=".$company->company_id.">".$company->name."</option>";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php include("../_include/title.php"); ?> - Forum</title>
<?php include("../_include/design.php"); ?>

<script type="text/javascript"> 

function getTopics(eve,id)
{	
	if(eve=='change')
		$("#page").val(1);
	else if(eve=='next'){
		var pg = $("#page").val();
		$("#page").val(parseFloat(pg)+1);
	}else if(eve=='prev'){
		var pg = $("#page").val();
		$("#page").val(parseFloat(pg)-1);
	}else if(eve=='sub'){
		$.ajax({type: "POST", url: "_ajax/subscribeTopic.php?topic_id="+id});
	}else if(eve=='unsub'){
		$.ajax({type: "POST", url: "_ajax/unsubscribeTopic.php?topic_id="+id});
	}else if(eve=='delete'){
		if(confirm("Are you sure?"))
			$.ajax({type: "POST", url: "_ajax/deleteTopic.php?topic_id="+id});
	}
	
	
	var topic_type = $("#topic_type_filter :selected").val();
	var company_id = $("#company_id_filter :selected").val();
	var page = $("#page").val();
	var num = <?php echo $num; ?>;
	var hl = "_ajax/filterTopics.php?topic_type="+topic_type+"&company_id="+company_id+"&page="+page+"&num="+num;
	
	$.ajax({
	   type: "POST",
	   url: hl,
	   success: function(msg){
		  $("#topics").html(msg);
	   }
 	});
	
}

function checkType()
{
	var topic_type = $("#topic_form #topic_type :selected").val();
	if(topic_type != "General")
		$("#selectCompany").html("<td><label><strong>Company : </strong></label></td><td><select name='company_id' id='company_id' onchange='checkNewCompany()'><option value=''>Select Company</option><option value='0'>New Company</option><?php echo $comp;?></select></td>");
	else{
		$("#selectCompany").html("");
		$("#newCompany").html("");
	}
}

function checkNewCompany()
{
	var company_id = $("#topic_form #company_id :selected").val();
	if(company_id == '0')
		$("#newCompany").html("<td><label><strong>Company Name : </strong></label></td><td><input type='text' name='name' id='name' size='40'/></td>");
	else
		$("#newCompany").html("");
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
    
    <tr height="30px" valign="middle"><td><span class="topicTxt">Forum</span></td></tr>
    <tr><td>
    		
            <table cellpadding="0" cellspacing="0" width="100%" border="0"><tr><td>
            <table cellpadding="6" border="0" width="100%" class='normalTxt infotbl'>    
			<tr><td>
            	<form action="" method="post" id="topic_form" enctype="multipart/form-data">
                <table cellpadding="6" width="100%" border="0">
                <tr class="highlighter"><td colspan="2">New Topic</td></tr>
                <tr><td width="25%"><label><strong>Topic Type : </strong></label></td>
                	<td>
                	<select name="topic_type" id="topic_type" onchange="checkType()">
                    <option value="General">General</option>
                    <option value="Preparation">Preparation</option>
                    <option value="Experience">Experience</option>
                    <option value="Opportunity">Opportunity</option>
                    </select></td></tr>
                <tr id="selectCompany"></tr>    
                <tr id="newCompany"></tr>
                <tr><td><label><strong>Heading : </strong></label></td>
                	<td><input type="text" name="heading" id="heading" size="40"/></td></tr>
                <tr valign="middle"><td colspan="2"><label><strong>Content : </strong></label><br/>
                 <textarea name="content" id="content" cols="60" rows="5"></textarea></td></tr>
                <tr><td><strong>Attach a File : </strong></td>
                	<td><input type="file" id="attachment" name="attachment"/></td></tr>
                <tr><td><input type="submit" name="submit" value="+ Add" class="submitStyle"/></td></tr>
                </table></form>
                </td></tr>
 
            	<tr class='seperator'><td>&nbsp;</td></tr>
                
                        
               <tr><td><strong> Filters &nbsp;&nbsp;&nbsp;</strong>
                	<select name="topic_type_filter" id="topic_type_filter" onchange="getTopics('change',0)">
                    <option value="all">Any Type</option>
                    <option value="General">General</option>
                    <option value="Preparation">Preparation</option>
                    <option value="Experience">Experience</option>
                    <option value="Opportunity">Opportunity</option>
                    </select>
                
                	<select name="company_id_filter" id="company_id_filter" onchange="getTopics('change',0)">
                    <option value="all">Any Company</option>
                    <?php $companies = $companies_all;
						  while($company = array_shift($companies))
							echo"<option value=".$company->company_id.">".$company->name."</option>";?>
                    </select>
                
                    <input type="hidden" name="page" id="page" value=1 />
                    </td></tr>      
               <tr class='seperator'><td>&nbsp;</td></tr>
               </table></td></tr>
               
               
               <tr><td id="topics"><table cellpadding="6" border="0" width="100%" class='normalTxt infotbl'>
  			   <tr><th>Type</th><th>Topic</th><th>Company</th><th>&nbsp;</th></tr>

            <?php   
			
                $topics_all = Forum_Topic::getAllTopics("all","all",1, $num); 

				if($topics_all)
                    while($topic = array_shift($topics_all))
                    {	
                        echo "<tr><td>".$topic->topic_type."</td>";
                        echo "<td class='contentLinks'><a href='topic.php?id=".$topic->topic_id."'>".$topic->heading."</a>
							- <em style='font-size:10px'>".date("jS F - h:i A",strtotime($topic->timestamp))."</em></td>";
						echo "<td>".$topic->name."</td><td>";
                        
						if(Forum_Subs::checkSubscription($topic->topic_id))
							echo "<span class='smallTxt'><a title='Unsubscribe' onclick=\"getTopics('unsub',".$topic->topic_id.")\">
								[-]</a></span>";
						else echo "<span class='smallTxt'><a title='Subscribe' onclick=\"getTopics('sub',".$topic->topic_id.")\">
								[+]</a></span>";
												
						if($topic->user_id == $session->user_id)
			  				echo " <span class='smallTxt'><a title='Delete'
               									onclick=\"getTopics('delete',".$topic->topic_id.")\">[x]</a></span>";
						echo "</td></tr>";
                    }
                else{
                    echo "<tr><td colspan='4'><label>No topic till now.</label></td></tr>";
				}
				echo "<tr class='seperator'><td colspan='4'>&nbsp;</td></tr>";
				echo "<tr class='seperator'><td align='right' colspan='4'><span class='smallTxt'>";
				echo"<label><span class='fade'>&lt;&lt; Newer</span></label> | ";
				if(Forum_Topic::getAllTopics("all","all",2, $num) != false)
					echo"<a onclick=\"getTopics('next',0)\" style='cursor:pointer;'>Older &gt;&gt;</a>";
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