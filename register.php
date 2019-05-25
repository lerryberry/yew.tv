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
------------------------------------------------------------------------------------------------------------------------------------------------>   		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="keywords" content="yew tv sign up, yew tv register, yewtv sign up, yewtv register, yew.tv sign up, yew.tv register" />  
   		<meta name="description" content="register to yew tv to submit a skateboard film and vote" />  
		<?php include ('style/device.php'); ?>
        <link rel="shortcut icon" href="images/favicon.ico" />
		<script type="text/javascript" src="/java/jquery-1.7.2.min.js"></script>
        <script language="JavaScript" src="captcha/scripts/gen_validatorv31.js" type="text/javascript"></script>
        <title>Sign up to enter a skate movie and vote to see it at a skateboard film festival in Melbourne.</title>
        
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
echo "<div class='content'><Br>";
		echo "<center>";
if (!isset($_SESSION['sesh']))
{		
	if (isset($_POST['register']))
	{
		require ('accounts/registerprocess.php');
	}
	$token = $_SESSION['token'] = md5(uniqid(mt_rand(), true ));
	?>
    	<form id='register' method="POST" name="contact_form" action="" >
		<label id='register' class="input">Username: </label>
        <input type='text' name='username' value="<?php echo isset($_POST['username']) ? mysql_real_escape_string($_POST['username']) : '' ?>" />
        <label id='register' class="input">Email: </label>
		<input type ='text' name="email" value="<?php echo isset($_POST['email']) ? mysql_real_escape_string($_POST['email']) : '' ?>"  />
      	<label id='register' class="input">Password: </label>
    	<input type ='password' name='password'  />
		<label id='register' class="input">Repeat Password: </label>
        <input type ='password' name='password2'  />
    	<input id='register' type ='hidden' name='token' value="<?php echo $token; ?>" />
    		<!captcha--------------------------------------------------------------------------------------------------------------------------------->
			<label id='register' class="input">&nbsp;</label>
        	<img src="captcha/captcha_code_file.php?rand=<?php echo rand(); ?>" id='captchaimg'>
    		<label id='register' class="input" for='message'>Enter above code here:</label>
		<input id="6_letters_code" name="6_letters_code" type="text" />
    		<a style='text-decoration:none;font-size:45px;font-style:normal;' href='javascript: refreshCaptcha();'>&#8635;</a><br><br><br>
            <label id='register' class="input">I Agree to <a href='legal.php' target='_blank' >terms of use</a>.</label>
       		<input type="checkbox" style='margin-top:10px;' name="termsofuse" value="agree" />
            <label id='register' class="input">&nbsp;</label><Br>
        	<input id='register' type ='submit' name='register' value='signup' />
	 		<label id='register' class="input">&nbsp;</label><Br>
   	 </form>
     <center/>
        <!capthca sript---------------------------------------------------------------------------------------------------------------------------->  
            <script language="JavaScript">
            // Code for validating the form
            // Visit http://www.javascript-coder.com/html-form/javascript-form-validation.phtml
            // for details
            var frmvalidator  = new Validator("contact_form");
            //remove the following two lines if you like error message box popups
            frmvalidator.EnableOnPageErrorDisplaySingleBox();
            frmvalidator.EnableMsgsTogether();
            
            frmvalidator.addValidation("name","req","Please provide your name"); 
            frmvalidator.addValidation("email","req","Please provide your email"); 
            frmvalidator.addValidation("email","email","Please enter a valid email address"); 
        </script>
        <script language='JavaScript' type='text/javascript'>
            function refreshCaptcha()
            {
                var img = document.images['captchaimg'];
                img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
            }
        </script>
		<?php
}
else
{
	require ("accounts/connect.php");
	$query = mysql_query("SELECT password FROM users WHERE session='".$_SESSION['sesh']."'");
	while ($row = mysql_fetch_assoc($query))
	{
		$pass = $row['password']; 
	}
	if ($pass != '')
	{
		echo "<br/><center>".ucwords($username)."  is currently logged in, <a href='accounts/logout.php'>logout?</a></center>";
	}
	else
	{
		$query = mysql_query("SELECT username, email FROM users WHERE session='".$_SESSION['sesh']."'");
		while ($row = mysql_fetch_assoc($query))
		{
			$username = $row['username']; 
			$emaildirty = $row['email'];
			//dashed email address parse with a new line after dash.
			$email = preg_replace(  '/-/', '&#8209;', $emaildirty);
		}
		
		if (isset($_POST['registerfacebook']))
		{
			require ('accounts/registerfacebookprocess.php');
		}
		$token = $_SESSION['token'] = md5(uniqid(mt_rand(), true ));
		?>
			<form id='register' method="POST" name="contact_form" action="" >
			<label id='register' class="input">Username: </label>
			<input type='text' name='username' value="<?php echo isset($_POST['username']) ? mysql_real_escape_string($_POST['username']) : $username ?>" />
			<label id='register' class="input">Email: </label><?php echo $email; ?>
			<label id='register' class="input">Password: </label>
			<input type ='password' name='password'  />
			<label id='register' class="input">Repeat Password: </label>
			<input type ='password' name='password2'  />
			<input id='register' type ='hidden' name='token' value="<?php echo $token; ?>" />
				<!captcha--------------------------------------------------------------------------------------------------------------------------------->
				<label id='register' class="input">&nbsp;</label>
				<img src="captcha/captcha_code_file.php?rand=<?php echo rand(); ?>" id='captchaimg'>
				<label id='register' class="input" for='message'>Enter above code here:</label>
			<input id="6_letters_code" name="6_letters_code" type="text" />
				<a style='text-decoration:none;font-size:45px;font-style:normal;' href='javascript: refreshCaptcha();'>&#8635;</a><br><br><br>
				<label id='register' class="input">I Agree to <a href='legal.php' target='_blank' >terms of use<a/>.</label>
				<input type="checkbox" style='margin-top:10px;' name="termsofuse" value="agree" />
				<label id='register' class="input">&nbsp;</label><Br>
				<input id='register' type ='submit' name='registerfacebook' value='signup' />
				<label id='register' class="input">&nbsp;</label><Br>
		 </form>
		 <center/>
			<!capthca sript---------------------------------------------------------------------------------------------------------------------------->  
				<script language="JavaScript">
				// Code for validating the form
				// Visit http://www.javascript-coder.com/html-form/javascript-form-validation.phtml
				// for details
				var frmvalidator  = new Validator("contact_form");
				//remove the following two lines if you like error message box popups
				frmvalidator.EnableOnPageErrorDisplaySingleBox();
				frmvalidator.EnableMsgsTogether();
				
				frmvalidator.addValidation("name","req","Please provide your name"); 
				frmvalidator.addValidation("email","req","Please provide your email"); 
				frmvalidator.addValidation("email","email","Please enter a valid email address"); 
			</script>
			<script language='JavaScript' type='text/javascript'>
				function refreshCaptcha()
				{
					var img = document.images['captchaimg'];
					img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
				}
			</script>
			<?php
	}
}
echo "</div>";
echo "</div>";
require('menu/footer.php');
?>
</div>
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