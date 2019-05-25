<?php
require ("../accounts/connect.php");
//vote
$id = $_POST['vidid'];
$sesh = $_POST['sesh'];
$query = mysql_query("SELECT id, channel FROM users WHERE session='".$sesh."'");
while ($row = mysql_fetch_array($query))
{
	$userId = $row['id'];
	$channel_from = $row['channel'];
}
$query = mysql_query("SELECT * FROM feedback WHERE user='".$userId."' AND video_id = '".$id."' ");
$numrows = mysql_num_rows($query);
//if they havnt already voted
if ($numrows == 0 )
{
	$query = mysql_query("SELECT channel FROM videos WHERE id='".$id."'");
	while ($row = mysql_fetch_array($query))
	{
		$channel = $row['channel'];
	}
	$query = mysql_query("INSERT INTO feedback (video_id, channel, user, channel_from, vote) VALUES ('".$id."', '".$channel."', '".$userId."', '".$channel_from."', '1')");
}
else
{
	$query = mysql_query("UPDATE feedback SET vote = '1' WHERE user =  '".$user."' ");
}
?>