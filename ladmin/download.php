<?php
ob_start("ob_gzhandler");
require("../accounts/connect.php");
?>
<?php
	$content ='';
	$total = mysql_real_escape_string($_GET['total']);
	$cam = mysql_real_escape_string($_GET['cam']);
	$soft = mysql_real_escape_string($_GET['soft']);
	
	require ("../accounts/connect.php");
	
	//if camera is set only
	if (($cam != '')&&($soft == ''))
	{
		$query = mysql_query("SELECT * FROM videos WHERE camera = '".$cam."' ");
		while ($row = mysql_fetch_array($query))
		{
			$user = $row['username'];
			if (isset($user))
			{
				$query2 = mysql_query("SELECT * FROM users WHERE username = '".$user."' AND email_options REGEXP '[".$total."]' AND active <> '0' ");
			}
			else
			{
				$query2 = mysql_query("SELECT * FROM users WHERE email_options REGEXP '[".$total."]' AND active <> '0' ");
			}
			
			while ($row2 = mysql_fetch_assoc($query2))
			{
				$username = $row2['username'];
				$email = $row2['email'];
				$content .= 
"".$username."	".$email."
";
			}
		}
	}
	//if software isset only
	elseif (($cam == '')&&($soft != ''))
	{
		$query = mysql_query("SELECT * FROM videos WHERE software = '".$soft."' ");
		while ($row = mysql_fetch_array($query))
		{
			$user = $row['username'];
			if (isset($user))
			{
				$query2 = mysql_query("SELECT * FROM users WHERE username = '".$user."' AND email_options REGEXP '[".$total."]' AND active <> '0' ");
			}
			else
			{
				$query2 = mysql_query("SELECT * FROM users WHERE email_options REGEXP '[".$total."]' AND active <> '0' ");
			}
			
			while ($row2 = mysql_fetch_assoc($query2))
			{
				$username = $row2['username'];
				$email = $row2['email'];
				$content .= 
"".$username."	".$email."
";
			}
		}
	}
	//if cam and software are set
	elseif (($cam != '')&&($soft != ''))
	{
		$query = mysql_query("SELECT * FROM videos WHERE camera = '".$cam."' AND software = '".$soft."' ");
		while ($row = mysql_fetch_array($query))
		{
			$user = $row['username'];
			if (isset($user))
			{
				$query2 = mysql_query("SELECT * FROM users WHERE username = '".$user."' AND email_options REGEXP '[".$total."]' AND active <> '0' ");
			}
			else
			{
				$query2 = mysql_query("SELECT * FROM users WHERE email_options REGEXP '[".$total."]' AND active <> '0' ");
			}
			
			while ($row2 = mysql_fetch_assoc($query2))
			{
				$username = $row2['username'];
				$email = $row2['email'];
				$content .= 
"".$username."	".$email."
";
			}
		}
	}
	//neither cam nor software set
	elseif (($cam == '')&&($soft == ''))
	{
		
		$query2 = mysql_query("SELECT * FROM users WHERE email_options REGEXP '[".$total."]' AND active <> '0' ");
		while ($row2 = mysql_fetch_assoc($query2))
		{
			$username = $row2['username'];
			$email = $row2['email'];
			$content .= 
"".$username."	".$email."
";
		}
		
	}
	
	//download
	header("Content-type: text/plain");
	header("Content-Disposition: attachment; filename='mailing_list.txt'");
	echo $content;
?>
