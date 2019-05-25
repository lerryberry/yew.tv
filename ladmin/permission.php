<?php
//set cookie to accomodate all subdomains
$seush = session_name("suesh_name");
session_set_cookie_params(0, '/', '.yew.tv');
session_start();

if (isset($_SESSION['sesh']))
{
	require ("../accounts/connect.php");
	$query = mysql_query("SELECT username FROM users WHERE session='".$_SESSION['sesh']."'");
	while ($row = mysql_fetch_assoc($query))
		{
			$username = $row['username']; 
		}
		if ($username != 'chaps')
		{
			die();
		}
		//how many videos pending
		$query = mysql_query("SELECT * FROM videos WHERE active='1'");
		$pending = mysql_num_rows($query);
		
		//how many videos pending
		$query = mysql_query("SELECT * FROM videos WHERE active='3'");
		$reported = mysql_num_rows($query);

		$setting = file_get_contents('master.txt');
		if ($setting == '1')
		{
			echo "<hr>Yew tv is under scheduled maintenance, sorry!<hr>";
		}
		
		echo "<a href='ladmin.php'>submissions(".$pending.")</a>&nbsp;&nbsp;";
		echo "<a href='reported.php'>reports(".$reported.")</a>&nbsp;&nbsp;";
		echo "<a href='stats.php'>statistics</a>&nbsp;&nbsp;";
		echo "<a href='export.php'>exports</a>&nbsp;&nbsp;";
		echo "<a href='info.php'>php info</a><br><br>";
}
else
{
	die('not a ladmin');
}
?>