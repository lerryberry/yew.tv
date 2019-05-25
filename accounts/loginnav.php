<?php
require('facebook/fetch.php');
//end connect facbook details------------------------------------------------------------------------------------->.
//set cookie to accomodate all subdomains
$seush = session_name("suesh_name");
session_set_cookie_params(0, '/', '.yew.tv');
session_start();

require ("connect.php");
$setting = file_get_contents('ladmin/master.txt');
if ($setting == '1')
{
	echo "<div class='maintenance'><br>Yew tv is under scheduled maintenance, sorry!<br><br></div>";
}
$prev = mysql_real_escape_string(isset($_GET['prev']));

$domain = $_SERVER['HTTP_HOST'];
if ($domain == 'yew.tv' || $domain == 'www.yew.tv')
{
	$location = 'yew.tv/activity';
}

if (!isset($_SESSION['sesh']))
{
	echo (isset($prev)&&$prev=='true') ? "" : "<h4><a href='http://yew.tv/login.php?location=".$location."'>Login</a> | <a href='http://yew.tv/register.php'>Sign Up</a><br></h4>";
}
else  
{
	require ("accounts/connect.php");
	$query = mysql_query("SELECT username FROM users WHERE session='".$_SESSION['sesh']."'");
	$rowNum = mysql_num_rows($query);
	if ($rowNum == 1)
	{
		while ($row = mysql_fetch_assoc($query))
		{
			$username = $row['username']; 
		}
		echo "	<h4>".ucwords($username).", <a class='nav' href='";
		//link if not preview
		echo (isset($_GET['prev'])&&$_GET['prev']=='true') ? "" : "http://yew.tv/activity.php" ;
		echo "' >Home</a> | <a class='nav' href='";
		echo (isset($_GET['prev'])&&$_GET['prev']=='true') ? "" : "http://yew.tv/accounts/logout.php" ;
		echo"' >Logout</a></h4>";
	}
	else
	{
		header("Refresh: 0; http://yew.tv/accounts/logout.php");
	}
}
?>

