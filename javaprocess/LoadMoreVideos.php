<?php
ob_start("ob_gzhandler");
require ("../accounts/connect.php");
$userId = $_GET['user'];
if ($_GET['lastVideo'])
{
	
	$query = mysql_query("SELECT video_id, id FROM feedback WHERE user = '".$userId."' AND id < '".$_GET['lastVideo']."' ORDER BY date DESC LIMIT 0, 4");
	while ($row = mysql_fetch_array($query))
	{
		$id = $row['video_id'];
		$feedBackId = $row['id'];
		$query2 = mysql_query("SELECT * FROM videos WHERE id = '".$id."'");
		while ($row = mysql_fetch_array($query2))
		{		
				$id = $row['id'];
				$url = $row['url'];
				$title = $row['title'];
				$channel = $row['channel'];
				$by = $row['username'];
				
				echo "
				<div class='VotedVideos' id='".$feedBackId." VotedVideos' >
					<iframe frameborder='0' src='".$url."?rel=0' class='video'></iframe>
					<a href='http://".$channel.".yew.tv' class='overlay'>
						<h2>
						<hr>
							<div class='title'><i>".ucwords($title)."</i></div>
							<b>by:</b> ".ucwords($by)."<br>
							".$channel.".yew.tv
						<hr>
						</h2>
					</a>
				</div>
				";
		}
	}
}

?>