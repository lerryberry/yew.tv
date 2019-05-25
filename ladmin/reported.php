<?php
ob_start("ob_gzhandler");
?>
<html>
<head>
</head>
<body>
<?php
require ('permission.php');

//display the oldest submission
$query = mysql_query("SELECT * FROM videos WHERE active='3' ORDER BY date DESC LIMIT 1");
while ($row = mysql_fetch_array($query))
	{
		$url = $row['url'];
		$id = $row['id'];
		echo "<iframe height='80%' width='80%' src='".$url."' name='".$id."' class='video'></iframe><br><Br>";
		echo "<a href='?review=ignore&id=".$id."'>Ignore</a>&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;<a href='?review=delete&id=".$id."'>Delete</a><Br>";
		
		//video info
		$vidid = $id;
		$query = mysql_query("SELECT * FROM videos WHERE id='".$vidid."'");
		while ($row = mysql_fetch_array($query))
		{
			$title = $row['title'];
			$username = $row['username'];
			$info = $row['info'];
			$links = $row['links'];
			$timestamp = $row['date'];
		}
		echo "".$title."";
		echo "<br>By: ".$username."";
		echo (isset($info) && $info != '')? '<br>Info: <br>'  :   '' ;
		echo (isset($info) && $info != '')? ''.$info.'' : '' ;
		
		$linkslist = preg_split('/ /', $links);
				foreach ($linkslist as $link)
				{
					echo "<br><a href='".$link."' target='_blank' >";
					$cleanlink = preg_replace('#^[^:/.]*[:/]+#i', '', $link);
					echo $cleanlink;
					echo "</a>";
				}
		
	}
echo "<br>".$reported." reported submissions.";

$review = mysql_real_escape_string(isset($_GET['review']));
//ignor or delete is pressed
if (isset($_GET['review']))
{
	$id = mysql_real_escape_string($_GET['id']);
	//if ignored
	if ($_GET['review'] == 'ignore')
	{
		//activate
		require "../accounts/connect.php";
		$query = mysql_query("UPDATE videos SET active = '2' WHERE id='".$id."'");
		header('location: reported.php');
	}
	//if denied
	elseif ($_GET['review'] == 'delete')
	{
		//deny
		$query = mysql_query("SELECT * FROM users WHERE username='".$username."'");
		while ($row = mysql_fetch_array($query))
		{
			$email = $row['email'];
		}
		require "../accounts/connect.php";
		$query = mysql_query("UPDATE videos SET active = '0' WHERE id='".$id."'");
		mysql_query("DELETE * FROM feedback WHERE video_id = '".$id."' ");
		//email the dude to let them know
		header('location: ../accounts/email.php?type=report&email='.$email.'&id='.$id.'');
	}
}
?>
</body>
</html>