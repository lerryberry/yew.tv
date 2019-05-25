<?php
$user_agent = empty($_SERVER['HTTP_USER_AGENT']) ? false : $_SERVER['HTTP_USER_AGENT'];
if  (  ( preg_match('/android/i', $user_agent ) && !preg_match('/mobile/i', $user_agent) )  ||  ( preg_match('/(ipad|android|android 3.0|xoom|sch-i800|playbook|tablet|kindle)/i', $user_agent ))  )
{
	//is a tablet
	echo "<title>tablet</title>";
	echo "<link rel='stylesheet' type='text/css' href='/style/tablet.css' />";
}
elseif (preg_match('/(iphone|ipod|android|blackberry|opera|mini|windows\sce|palm|smartphone|iemobile)/i', $user_agent) )
{
	//is a phone
	echo "<title>phone</title>";
	echo "<link rel='stylesheet' type='text/css' href='/style/phone.css' />";
}
else
{
	//is a PC
	echo "<title>pc</title>";
	echo "<link rel='stylesheet' type='text/css' href='/style/phone.css' />";
	//echo "<link rel='stylesheet' type='text/css' href='/style/main.css' />";
}
?>