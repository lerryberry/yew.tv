<?php
ob_start("ob_gzhandler");
?>
<html>
		<?php
        require('fetch.php');
        require('../accounts/connect.php');
		//get location user was at and redirect
		$location = mysql_real_escape_string($_GET['location']);
		
        if ($user)
		{
            $emailAddress = $facebook->api('/me?fields=email');
            
            $token = $_SESSION['fb_408187605907772_user_id'];
            $email = $emailAddress['email'];
            $username = $user_profile['first_name'];
            $sesh = md5(uniqid(rand(), true));
            
            $query = mysql_query("SELECT * FROM users WHERE facebook_id ='".$token."' ");
            $numRows = mysql_num_rows($query);
            
            //if user hasn't got facbook account (ie facebook id) account
            if ($numRows == 0)
            {
                //check if user already has full account, compare email
                $query = mysql_query("SELECT * FROM users WHERE email ='".$email."' ");
                $numRows = mysql_num_rows($query);
                if ($numRows != 0)
                {
                    $query = mysql_query("UPDATE users SET session='".$sesh."', facebook_id = '".$token."', last_login = NOW() WHERE email = '".$email."' ");				            
					//set sesh id
					$_SESSION['sesh'] = $sesh;
                }
                else
                {
                    $query = mysql_query("INSERT INTO users (session, email, username, facebook_id, signup_date, last_login, active) VALUES ('".$sesh."', '".$email."', '".$username."', '".$token."', NOW(), NOW(), '2') ");
					//set sesh id
					$_SESSION['sesh'] = $sesh;
                }
				header ("Refresh: 0; URL=http://".$location."");
            }
            else
            {
                //check if user has active account
                $query = mysql_query("SELECT * FROM users WHERE facebook_id ='".$token."' AND active = 2 ");
                $numRows = mysql_num_rows($query);
                if ($numRows != 0)
                {
                    $query = mysql_query("UPDATE users SET last_login = NOW(), session='".$sesh."' WHERE facebook_id ='".$token."'");
					//set sesh id
					$_SESSION['sesh'] = $sesh;
					header ("Refresh: 0; URL=http://".$location."");
                }
                else
                {
					echo "<link rel='stylesheet' type='text/css' href='../style/notifyscreen.css' />";
					echo "</head>";
					echo "<body>";
                    echo "<div class='center' ><br>Your account has been blocked or deleted.</div>";
					echo "</body>";
					header ("Refresh: 2; URL=http://".$location."");
                }
            }
		}
		else
		{
			echo "<link rel='stylesheet' type='text/css' href='../style/notifyscreen.css' />";
			echo "</head>";
			echo "<body>";
			echo "<div class='center' ><br>Facebook login failed, try again later.</div>";
			echo "</body>";
			header ("Refresh: 2; URL=http://".$location."");
        }
		?>
</html>
