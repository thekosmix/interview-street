<?php require_once("../../_php/init_student.php"); ?>

<table cellpadding="6" border="0" width="100%" class='normalTxt infotbl'>
<tr><th>Type</th><th>Topic</th><th>Company</th><th>&nbsp;</th></tr>

<?php   

$topic_type = $_GET['topic_type'];
$company_id = $_GET['company_id'];
$page = $_GET['page'];
$num = $_GET['num'];

$topics_all = Forum_Topic::getAllTopics($topic_type,$company_id,$page, $num); 

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
if(Forum_Topic::getAllTopics($topic_type,$company_id,$page-1, $num) != false)
    echo"<a onclick=\"getTopics('prev',0)\" style='cursor:pointer;'>&lt;&lt; Newer</a> | ";
else echo"<label><span class='fade'>&lt;&lt; Newer</span></label> | ";
if(Forum_Topic::getAllTopics($topic_type,$company_id,$page+1, $num) != false)
    echo"<a onclick=\"getTopics('next',0)\" style='cursor:pointer;'>Older &gt;&gt;</a>";
else echo"<label><span class='fade'>Older &gt;&gt;</span></label>";
echo"</span></td></tr>";

?>

</table>