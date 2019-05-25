<?php
require ("connect.php");
$emaildirty = mysql_real_escape_string($_POST['email']);
$email = strtolower($emaildirty);
$password = mysql_real_escape_string($_POST['password']);
$token = mysql_real_escape_string($_POST['token']);
$tokenSesh = mysql_real_escape_string($_SESSION['formToken']);
$checker = 0;

//field checkers---------------------------------------------------------------------------------------------------------------------------
echo "<ul class='alert'>";
if ($token != $tokenSesh)
{
	echo "<li class='alert'>Invalid form submission.</li>";
	$checker = 1;
}
else
if (!($email)||!($password))
{
	echo "<li class='alert'>Fill in all fields.</li>";
	$checker = 1;
}
else
if (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email)||(!preg_match("/^[0-9a-zA-Z]{6,30}$/", $password)))
{
	echo "<li class='alert'>Invalid email or password.</li>";
	$checker = 1;
}

//database comparison---------------------------------------------------------------------------------------------------------------------------

else
if($checker == 0)
{	
	require ("accounts/connect.php");
	$query = mysql_query("SELECT * FROM users WHERE email='".$email."'");
	$numrows = mysql_num_rows($query);
	
	if ($numrows != 1)
	{
		echo "<li class='alert'>User does not exist.</li>";
	}
	else
	{
		while ($row = mysql_fetch_assoc($query))
		{
			$dbemail = $row['email'];
			$dbpassword = $row['password'];
			$dbusername = $row['username'];
			$code = $row['active'];
		}
		$password = md5($password);
		if ($email==$dbemail&&$password!=$dbpassword)
		{
			sleep(3);
			echo "<li class='alert'>Incorrect password - <a href='accounts/email.php?email=$email&type=password'>forgot your password?</a>.</li>";
		}
		if ($email==$dbemail&&$password==$dbpassword)
		{
			if($code == 0)
			{
				echo "<li class='alert'>Your account has been blocked or deleted.</li>";
			}
			else
			if($code >= 2)
			{
				//update last login time, create session--------------------------------------------------------------------------------------
				
				$sesh = md5(uniqid(rand(), true));
				//find out if its the first login
				
				$query = mysql_query("SELECT session FROM users WHERE email='".$email."' ");
				while ($row = mysql_fetch_assoc($query))
				{
					$dbsesh = $row['session'];
				}
				if ($dbsesh == '0')
				{
					$firstlogin = true;
				}
				else
				{
					$firstlogin = false;
				}
				$query = mysql_query("UPDATE users SET last_login = NOW(), session='".$sesh."' WHERE email='".$email."'");
				$_SESSION['sesh'] = $sesh;
				$location = mysql_real_escape_string($_POST['location']);
				if ($location == 'yew.tv/index.php')
				{
					$location = 'yew.tv/activity.php';
				}
				if ($firstlogin == true)
				{
					$location = 'yew.tv/new-user.php';
				}
				header ("Refresh: 0; URL=http://".$location."");
			}
			else
			{
				echo "<li class='alert'>Please activate your account by clicking the link supplied in your email - <a href='accounts/email.php?email=$email&type=activate'>send email again?</a></li>";
			}
		}
	}
}
echo "</ul>";

?>