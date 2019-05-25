<?php
require ("../accounts/connect.php");
//default display not voted
$display = 'Vote: &#9744;' ;

//get variable
$id = $_POST['vidid'];
$sesh = $_POST['sesh'];

$query = mysql_query("SELECT id FROM users WHERE session='".$sesh."'");
while ($row = mysql_fetch_array($query))
{
	$userId = $row['id'];
}
$query = mysql_query("SELECT * FROM feedback WHERE user='".$userId."' AND video_id = '".$id."' AND vote = 1 ");
$numrows = mysql_num_rows($query);
//if they have voted
if ($numrows != 0)
{
	$display = 'Voted: &#9745;' ;
}
echo $display;
?>