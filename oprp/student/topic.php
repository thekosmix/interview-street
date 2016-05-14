<?php  require_once("../_php/init_student.php"); 

if(isset($_GET['id'])) $topic_id = $_GET['id'];

if(isset($_POST["submit"])){
	
	if(!empty($_POST['content'])){

		$forum_comment = new Forum_Comment();
		$forum_comment->topic_id 	= $topic_id;
		$forum_comment->content 	= mysql_real_escape_string(trim($_POST['content'])); 
		$forum_comment->attachment  = $_FILES['attachment']['name'];
		
		$inserted = Forum_Comment::insertComment($forum_comment);
		$uploaded = move_uploaded_file($_FILES['attachment']['tmp_name'], 
					"../_attachment/forum_comment/".mysql_insert_id()."_".$_FILES['attachment']['name']);
	}
}

$topic = Forum_Topic::getDetailByID($topic_id);
$comment_all = Forum_Comment::getCommentByTopicID($topic_id);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php include("../_include/title.php"); ?> - Forum Topic</title>
<?php include("../_include/design.php"); ?>

<script type="text/javascript"> 

function getTopics(eve,id)
{	
	if(eve=='sub'){
		$.ajax({type: "POST", url: "_ajax/subscribeTopic.php?topic_id="+id});
	}else if(eve=='unsub'){
		$.ajax({type: "POST", url: "_ajax/unsubscribeTopic.php?topic_id="+id});
	}else if(eve=='delete'){
		if(confirm("Are you sure?"))
			$.ajax({type: "POST", url: "_ajax/deleteTopic.php?topic_id="+id});
	}
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
    
    <tr height="30px" valign="middle"><td><span class="topicTxt">Forum</span> 
    		<span class="contentLinks"><a href="forum.php">All Topics</a></span></td></tr>
    <tr><td>
    		
            <table cellpadding="6" width="100%" border="0" class='normalTxt infotbl'>
            <tr><td><strong><?php echo $topic->heading;?></strong> - 
            		<em style='font-size:10px'><?php echo date("jS F - h:i A",strtotime($topic->timestamp));?></em></td></tr>
            <tr><td class='announce_content_link'>
			<?php echo $topic->content;
				  if($topic->attachment) 
					echo"<br/><a href='../_attachment/forum_topic/{$topic->topic_id}_{$topic->attachment}' title='Download'>
					<img src='../_images/attach.png' vspace='10' align='absmiddle'/> {$topic->attachment}</a>";
			?>
            </td></tr>
            <tr><td><table border="0" width="100%">
            	<tr><?php echo "<td align='left'>".$topic->topic_type." - ".$topic->name."</td><td align='right'>";
						  if(Forum_Subs::checkSubscription($topic->topic_id))
						  	echo "<span class='smallTxt'><a title='Unsubscribe' onclick=\"getTopics('unsub',".$topic->topic_id.")\">
								[-]</a></span>";
						  else echo "<span class='smallTxt'><a title='Subscribe' onclick=\"getTopics('sub',".$topic->topic_id.")\">
								[+]</a></span>";
						  if($topic->user_id == $session->user_id)
			  				echo " <span class='smallTxt'><a title='Delete'	onclick=\"getTopics('delete',".$topic->topic_id.")\">[x]</a></span>";
						  echo "</td>";?></tr></table></td></tr>
            <tr class='seperator'><td>&nbsp;</td></tr>
            
            <?php 
				if($comment_all)
					while($comment = array_shift($comment_all)){
						echo "<tr><td class='announce_content_link'>".Student::getFullNameByID($comment->user_id)." - <em style='font-size:10px'>".
							date("jS F - h:i A",strtotime($comment->timestamp))."</em><br/><br/>".$comment->content;
						if($comment->attachment) 
							echo"<br/><a href='../_attachment/forum_comment/{$comment->comment_id}_{$comment->attachment}' title='Download'>
							<img src='../_images/attach.png' vspace='10' align='absmiddle'/> {$comment->attachment}</a>";
						echo"</td></tr>";
					}
			?>
            
            <tr><td>
            
            	<form action="" method="post" id="topic_form" enctype="multipart/form-data">
                <label><strong>Comment : </strong></label><br/>
                <textarea name="content" id="content" cols="60" rows="5"></textarea><br/>
                <strong>Attach a File : </strong>
               	<input type="file" id="attachment" name="attachment"/><br/>
                <input type="submit" name="submit" value="+ Add" class="submitStyle"/>
                </form>
           
           </td></tr></table>
           
    </td></tr>
</table>
                
                
<!--body close-->       
            
<?php include("../_include/footer.php"); ?>
</body>
</html>