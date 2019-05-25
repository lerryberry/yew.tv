<?php
ob_start("ob_gzhandler");
?>
<html>
<head>
</head>
<body>
<?php

require ('permission.php');

//get data

//videocount
$query = mysql_query("SELECT * FROM videos WHERE active > 1");
$videoCount = mysql_num_rows($query);

//verified users
$query = mysql_query("SELECT * FROM users WHERE active > 1");
$userCount = mysql_num_rows($query);

//total votes
$query = mysql_query("SELECT * FROM feedback");
$voteCount = mysql_num_rows($query);

//average votes per user.
$votesPerUser = $voteCount /$userCount ;

echo "".$videoCount." active videos.<Br>";
echo "".$userCount." verified users.<Br>";
echo "".$voteCount." votes in total.<Br>";
echo "".$votesPerUser." Votes per user.<br>";

echo "<a href='?email=1'>email stats</a>";

echo "<hr>cleanup database;";
?>

<form action ="" method='POST'>
<?php 
$query = mysql_query("SELECT * FROM videos WHERE active = 0");
$videoCount = mysql_num_rows($query);
echo "".$videoCount." Flagged videos";
?><br>
<input type ='submit' value='Delete inactive videos' name='deletevids' /><br>
<?php
$query = mysql_query("SELECT * FROM users WHERE active = 0");
$Count = mysql_num_rows($query);
echo "".$Count." Banned users";
?><br>
<input type ='submit' value='Delete inactive users' name='deleteusers' />
<hr />
<input type ='submit' value='<?php 
    $setting = file_get_contents('master.txt');
	if ($setting == '1')
	{
		echo "remove maintenance banner";
	}
	else
	{
		echo "add maintenance banner";
	}
	?>' name='maintenance' />
</form>

<?php

if (isset($_POST['maintenance']))
{
	$setting = file_get_contents('master.txt');
	if ($setting == '1')
	{
		file_put_contents('master.txt', 0);
	}
	else
	{
		file_put_contents('master.txt', 1);
	}
	header("Refresh: 0;url=stats.php");
}

if (isset($_POST['deletevids']))
{
	require ("../accounts/connect.php");
	mysql_query("DELETE FROM videos WHERE active = '0' ");
	echo "DELETED";
	header("Refresh: 2;url=stats.php");
}

if (isset($_POST['deleteusers']))
{
	require ("../accounts/connect.php");
	mysql_query("DELETE FROM users WHERE active = '0' ");
	echo "DELETED";
	header("Refresh: 2;url=stats.php");
}

//----email script----------------------------------------------------------------------------------------------------
$email = mysql_real_escape_string(isset($_GET['email']));
if (isset($email)&&$email=='1')
{
	ini_set("SMTP", "mail.iinet.net.au");
	
	$to = "eschapple@gmail.com";
	$subject = "Yew tv usage statistics";
	$message = "
	".$videoCount." active videos;
	".$userCount." verified users;
	".$voteCount." votes in total;
	";
	
	$from = "reports@yew.tv";
	$headers = "From:" . $from;
	mail($to,$subject,$message,$headers);
	
	echo "<Br>email sent";
}
?>
</body>
</html>