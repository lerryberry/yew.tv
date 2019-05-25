<?php

$username = mysql_real_escape_string($_POST['username']);
$emaildirty = mysql_real_escape_string($_POST['email']);
$email = strtolower($emaildirty);
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
		$query2 = mysql_query("SELECT * FROM users WHERE email='".$email."'");
		$numrows = mysql_num_rows($query);
		$numrows2 = mysql_num_rows($query2);
		
		if ($numrows != 0)
		{
			echo "<li class='alert'>Username already taken.</li>";
			$checker = 1;
		}
		if ($numrows2 != 0)
		{	
			//check if found email was from facebook
			while($row = mysql_fetch_assoc($query2))
			{
				$facebookId = $row['facebook_id'];
			}
			if (empty($facebookId))
			{
				//email from previus registration
				echo "<li class='alert'>Email address already taken.</li>";
			}
			else 
			{
				//facebook code
				$loginUrl = $facebook->getLoginUrl(
				array(
					'scope' => 'email',
					'redirect_uri' => 'http://www.yew.tv/facebook/collect.php?location=yew.tv/register.php',
				));
				//show notification
				echo "<div class='notification' id='fail' ><br>The email address '".$_POST['email']."' is already on file. If this is your email address login with facebook to complete this form, <a href='".$loginUrl."'>Login with facebook</a>.<Br><br></div>";
			}
			$checker = 1;
		}
	}
	if (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email))
	{
		echo "<li class='alert'>Invalid email address.</li>";
		$checker = 1;
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
	$query = mysql_query("INSERT INTO users (email, username, password, token) VALUES ('$email', '$username', '$password', '$code')");
	
	//email dudes---------------------------------------------------------------------------------------------------------------------------
	
	header ('location:accounts/email.php?email='.$email.'&type=activate');
}
echo "</ul>";
?>