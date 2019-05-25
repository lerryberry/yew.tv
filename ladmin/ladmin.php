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
$query = mysql_query("SELECT * FROM videos WHERE active='1' ORDER BY date DESC LIMIT 1");
while ($row = mysql_fetch_array($query))
	{
		$url = $row['url'];
		$id = $row['id'];
		echo "<iframe height='80%' width='80%' src='".$url."' name='".$id."' class='video'></iframe><br><Br>";
		echo "<a href='?review=approve&id=".$id."'>Approve</a>&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;<a href='?review=deny&id=".$id."'>Deny</a><Br>";
		
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
echo "<br>".$pending." pending submissions.";
//approve or deny is pressed
if (isset($_GET['review']))
{
	$id = mysql_real_escape_string($_GET['id']);
	$query = mysql_query("SELECT * FROM users WHERE username='".$username."'");
	while ($row = mysql_fetch_array($query))
	{
		$email = $row['email'];
	}
	//if approved
	if ($_GET['review'] == 'approve')
	{
		//activate
		require "../accounts/connect.php";
		$query = mysql_query("UPDATE videos SET active = '2' WHERE id='".$id."'");
		header('location: ../accounts/email.php?type=videoapprove&email='.$email.'&id='.$id.'');
	}
	//if denied
	elseif ($_GET['review'] == 'deny')
	{
		//deny
		require "../accounts/connect.php";
		$query = mysql_query("UPDATE videos SET active = '0' WHERE id='".$id."'");
		header('location: ../accounts/email.php?type=videodeny&email='.$email.'&id='.$id.'');
	}
}
?>
</body>
</html>