<?php

$username = mysql_real_escape_string($_POST['username']);
$password = mysql_real_escape_string($_POST['password']);
$password2 = mysql_real_escape_string($_POST['password2']);
$token = mysql_real_escape_string($_POST['token']);
$tokenSesh = mysql_real_escape_string($_SESSION['token']);
$checker = 0;

//field checkers---------------------------------------------------------------------------------------------------------------------------
echo "<ul class='alert'>";
if ($token != $tokenSesh)
{
	echo "<li class='alert'>Invalid form submission.</li>";
	$checker = 1;
}
else
if (($username)&&($email)&&($password)&&($password2))
{
	if (!preg_match("/^[0-9a-zA-Z]{2,20}$/", $username))
	{
		echo "<li class='alert'>Username must be between 2 & 20 alphabetic characters.</li>";
		$checker = 1;
	}
	else
	{
		//check database for replica entrys-------------------------------------------------------------------------------------------------------

		require ("accounts/connect.php");
		$query = mysql_query("SELECT * FROM users WHERE username='".$username."'");
		$numrows = mysql_num_rows($query);
		
		if ($numrows != 0)
		{
			//user with same username got a full login?
			require ("accounts/connect.php");
			$query3 = mysql_query("SELECT * FROM users WHERE username='".$username."' AND password <> '' ");
			$numrows3 = mysql_num_rows($query3);
			if ($numrows3 != 0)
			{
				echo "<li class='alert'>Username already taken.</li>";
				$checker = 1;
			}
		}
	}
	if (!preg_match("/^[0-9a-zA-Z]{6,30}$/", $password))
	{
		echo "<li class='alert'>Password must between 6 & 30 characters.</li>";
		$checker = 1;
	}
	else
	if(($password) != ($password2))
	{
		echo "<li class='alert'>Password mismatch.</li>";
		$checker = 1;
	}
	if (empty($_SESSION['6_letters_code'] ) || strcasecmp($_SESSION['6_letters_code'], $_POST['6_letters_code']) || ($_SESSION['6_letters_code']!= 0) && ($_POST['6_letters_code']) != 0)
	{
		//Note: the captcha code is compared case insensitively.
		//if you want case sensitive match, update the check above to
		// strcmp()
		echo "<li class='alert'>The security code does not match.</li>";
		$checker = 1;
	}	
	if (!isset($_POST['termsofuse']))
	{
		echo "<li class='alert'>You must agree to terms of use.</li>";
		$checker = 1;
	}
	
}
else
{
	echo "<li class='alert'>Fill in all fields.</li>";
	$checker = 1;
}

//update database---------------------------------------------------------------------------------------------------------------------------	

if ($checker == 0)
{
	$password = md5($password);
	require ("accounts/connect.php");
	$code = rand(23456789,98765432);
	$query = mysql_query("UPDATE users SET username = '".$username."', password = '".$password."', token = '".$code."' WHERE session = '".$_SESSION['sesh']."' ");
	
	header ('location:http://yew.tv/submit-a-video.php');
}
echo "</ul>";
?>