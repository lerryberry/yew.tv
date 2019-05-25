<?php
ob_start("ob_gzhandler");
?>
<html>
    <head>
    <!-----------------------------------------------------------------------------------------------------------------------------------------------
                             __          
.--.--..-----..--.--.--.    |  |_ .--.--.
|  |  ||  -__||  |  |  |    |   _||  |  |
|___  ||_____||________|    |____| \___/ 
|_____|   
-------------------------------------------------------------------------------------------------------------------------------------------------
website by Elliot Chapple.
--------------------------------------------------------------------------------------------------------------------------------------------->  	
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
    <meta name="keywords" content="edit yew tv account, change personal information, change email, change password, email preferences, delete  yew tv account, personal information, delete yew tv account" />  
    <meta name="description" content="Change your email preferences, password or delete your yew.tv account." /> 
    <link rel="shortcut icon" href="images/favicon.ico" />
    <?php include ('style/device.php'); ?>
    <script type="text/javascript" src="/java/jquery-1.7.2.min.js"></script>
    	<title>Edit account preferences.</title>
        
        <!-------GOOGLE ANALYTICS--------------------------------------------->
        <script type="text/javascript">

		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-34449316-1']);
		  _gaq.push(['_setDomainName', 'yew.tv']);
		  _gaq.push(['_trackPageview']);
		
		  (function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();
		
		</script>
		<!--------------------------------------------------------------------->
        
    </head>
    <body onLoad="load()">
    <div class='body'>
        <div id='wrapper'>
    <?php 
    require ('menu/main.php');
    include "menu/home.php";
    echo "<div class='content'>";
    if (isset($_SESSION['sesh']))
    {
		if(!isset($_POST['delete']))
        {
			require ("accounts/connect.php");
			$query = mysql_query("SELECT password FROM users WHERE session='".$_SESSION['sesh']."'");
			while ($row = mysql_fetch_assoc($query))
			{
				$pass = $row['password']; 
			}
	
			//if user has not got full account
			if ($pass != '')
			{
				//reset password----------------------------------------------------------------------------------------------------------
				
				$display = mysql_real_escape_string('reset');
				
				if (isset($_POST['reset']))
				{
					echo "<ul class='alert' style='margin-left:220px;'>";
					$password = mysql_real_escape_string($_POST['password']);
					$password2 = mysql_real_escape_string($_POST['password2']);
					$checker = 0;
					
					if ($_POST['token'] != $_SESSION['formToken'])
					{
						echo "<li class='alert'>Invalid form submission.</li>";
						$checker = 1;
					}
					if (!preg_match("/^[0-9a-zA-Z]{6,30}$/", $password))
					{
						echo "<li class='alert'>Password must be between 6 & 30 characters.</li>";
						$checker = 1;
					}
					
					else if(($password) != ($password2))
					{
						echo "<li class='alert'>Password mismatch.</li>";
						$checker = 1;
					}
					
					if ($checker == 0)
					{
						$password = md5($password);
						$display = 'saved';
						require ("accounts/connect.php");
						$query = mysql_query("UPDATE users SET password = '".$password."' WHERE session = '".$_SESSION['sesh']."'");
					}
					echo "</ul>";
				}
				if ($display == 'reset')
				{
					$token = $_SESSION['formToken'] = md5(uniqid(mt_rand(), true ));
					?>
			
				<form id='accountpassword' action ="" method='POST'>
					<label id='account'>New Password:</label>
					<input type='password' name='password' /><br />
					<label id='account'>Confirm Password:</label>
					<input type ='password' name='password2' /><br />
					<input type ='hidden' name='token' value="<?php echo $token; ?>" />
					<label id='account'>&nbsp;</label>
					<input type ='submit' value='save' name='reset' />
				</form>
				<?php
				}
				else
				{
					echo "<div class='notification' id='success'><Br>Password saved.<br><br></div>";
					header( "refresh:2;");
				}
				
				echo"<hr />";
			
				//email address---------------------------------------------------------------------------------------------------------------------
				
				if (isset($_GET['code'])&&isset($_GET['email']))
				{
					$code = mysql_real_escape_string($_GET['code']);
					$emaildirty = mysql_real_escape_string($_POST['email']);
					$email = strtolower($emaildirty);
					$query = mysql_query("UPDATE users SET email = '".$email."' WHERE token= '".$code."'");
					echo "<div class='notification' id='success'><Br>New Email address saved.<br><br></div>";
					header( "Refresh: 2; URL=account.php");
				}
				else
				{
					if (isset($_POST['emailad']))
					{
						echo "<ul class='alert' style='margin-left:240px;'>";
						$newemail = mysql_real_escape_string($_POST['newemail']);
						$checker2 = 0;
						
						if (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $newemail))
						{
							echo "<li class='alert'>Email not valid.</li>";
							$checker2 = 1;
						}
						
						if ($_POST['token2'] != $_SESSION['token2'])
						{
							echo "<li class='alert'>invalid form submission</li>";
							$checker2 = 1;
						}
						
						if ($checker2 == 0)
						{
							header ('location:accounts/email.php?email='.$newemail.'&type=emailchange');
						}
						echo "</ul>";
					}
							$token2 = $_SESSION['token2'] = md5(uniqid(mt_rand(), true ));
							?>
							
					<form id='accountemail' action ="#bottom" method='POST'>
						<label id='account'>New Email:</label>
						<input type='text' name='newemail' /><br />
						<input type ='hidden' name='token2' value="<?php echo $token2; ?>" />
						<label id='account'>&nbsp;</label>
						<input type ='submit' value='save' name='emailad' />
					</form>
					<?php
				}
				echo"<hr />";
			}
        //email preferences---------------------------------------------------------------------------------------------------------------------
            
            $display = mysql_real_escape_string('email');
            if (isset($_POST['emailsave']))
            {
                if (isset($_POST['check']))
                {
                    $total = '';
                    $check = $_POST['check'];
                    foreach($check as $ch)
                    {
                        $total .= $ch;
                    }
                }
                else
                {
                    $total = '';	
                }
                $display = mysql_real_escape_string('savedemail');
                require "accounts/connect.php";
                $query = mysql_query("UPDATE users SET email_options = '".$total."' WHERE session = '".$_SESSION['sesh']."'");
            }
        
            $query = mysql_query("SELECT email_options FROM users WHERE session='".$_SESSION['sesh']."'");
            while ($row = mysql_fetch_assoc($query))
            {
                $ch = $row['email_options'];
            }
            
            if (preg_match("[a]", $ch))
            {
                $a = 'checked';
            }
            else 
                $a = 'unchecked';
            if (preg_match("[b]", $ch))
            {
                $b = 'checked';
            }
            else 
                $b = 'unchecked';
            if (preg_match("[c]", $ch))
            {
                $c = 'checked';
            }
            else 
                $c = 'unchecked';
            if (preg_match("[d]", $ch))
            {
                $d = 'checked';
            }
            else 
                $d = 'unchecked';
            if (preg_match("[e]", $ch))
            {
                $e = 'checked';
            }
            else 
                $e = 'unchecked';
                
            if ($display == 'email')
            {
                ?>
        
            <form id='accountemailop' action ="" method='POST'>
                <strong>Email Me About:</strong><br>
                <label id='account'>Products:</label>
                <Input id='accountcheck' type = 'Checkbox' Name ="check[]" value="a"   <?php print $a; ?> /><br />
                <label id='account'>Newsletter:</label>
                <Input id='accountcheck' type = 'Checkbox' Name ="check[]" value="b"   <?php print $b; ?> /><br />
                <label id='account'>Requests:</label>
                <Input id='accountcheck' type = 'Checkbox' Name ="check[]" value="c"   <?php print $c; ?> /><br />
                <label id='account'>Polls:</label>
                <Input id='accountcheck' type = 'Checkbox' Name ="check[]" value="d"   <?php print $d; ?> /><br />
                <label id='account'>Other:</label>
                <Input id='accountcheck' type = 'Checkbox' Name ="check[]" value="e"   <?php print $e; ?> /><br />
                <label id='account'>&nbsp;</label><input type ='submit' value='save' name='emailsave' />
            </form>
            <?php
            }
            else
            {
                echo "<div class='notification' id='success' ><br>Email options saved.<br><br></div>";
                header( "refresh:2;");
            }
			echo "<hr class='hidden' />";	
			//Delete account---------------------------------------------------------------------------------------------------------
			?>
			<form class='accountdelete' action ="" method='POST'>
				<input type ='submit' class='hidden' value='delete account' name='delete' />
			</form><br>
			<?php
		}
		else 
		{
			//if delete is pressed
			echo "<div class='notification' id='fail' ><br>Are you sure you want to delete your account? <a href='?delete=true'>Delete Account</a><br><br></div>";
		}
		if (isset($_GET['delete']))
		{
			require "accounts/connect.php";
			$query = mysql_query("UPDATE users SET active = '0' WHERE session = '".$_SESSION['sesh']."'");
			session_destroy();
			header ('location:index.php');
		}
    }
    echo "</div>";
	echo "</div>";
    require('menu/footer.php');
    
    ?>
    </div>
    <a name='bottom' id='bottom'></a>
</body>
<script>
		//fade in page
		$('.content').hide();
		function load()
		{
			$('.content').fadeIn(700);
		}
	</script>
</html>