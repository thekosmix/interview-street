<?php 

include_once("../_php/functions.php");

$arr_date = $_GET['date'];
$con = mysqli_connect('localhost','user','pass');
mysqli_select_db('rm_new', $con);
$sql = "SELECT * from recruiter where arrival_date ='".$arr_date."'";
$sqlresult = $db->query($sql);
?>

<table>

<?php
while($row=mysqli_fetch_array($sqlresult))
{
	echo '<td>';
	
		print_info('Company', $row['name']);
		print_info('Pay Type', $row['grade']);
		print_info('Description', $row['description']);
		print_info('Can Apply till', $row['app_date']);
		print_info('For Branches', substr($row['branches'], 1, -1));
		print_info('Minimum Percentage', $row['min_score']);
		print_info('For', $row['for_year']);
		print_info('Description', $row['job_description']);
		print_info('Website', $row['website']);	
		
	echo '</td>';	
}

?>

</table>