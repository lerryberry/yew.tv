<?php
ob_start("ob_gzhandler");
require('connect.php');
?>
<html>
    <head>
    	<link rel='stylesheet' type='text/css' href='../style/notifyscreen.css' />
		<script type="text/javascript" src="/java/jquery-1.7.2.min.js"></script>
    </head>
    <body onLoad="load()">
		<?php
        
        $email = mysql_real_escape_string($_GET['email']);
        $code = mysql_real_escape_string($_GET['code']);
        
        //compare times and token-------------------------------------------------------------------------------------------------------------
        
            require ("connect.php");
            $query = mysql_query("SELECT * FROM users WHERE last_login > NOW() AND email='".$email."' AND token='".$code."' ");
            $numrows = mysql_num_rows($query);
        
        if ($numrows == 1)
        {
            //log user in
            while ($row = mysql_fetch_assoc($query))
                {
                    $dbusername = $row['username'];
                    $active = $row['active'];
                }
            if($active == 0)
                {
                    echo "<div class='center' ><br>Your account has been blocked.</div>";
                }
            else if($active >= 2)
                {
                    
                    //update last login time, create session--------------------------------------------------------------------------------------
                    
                    $seush = session_name("suesh_name");
                    session_set_cookie_params(0, '/', '.yew.tv');
                    session_start();
                    require ("connect.php");
                    $sesh = md5(uniqid(rand(), true));
                    $query = mysql_query("UPDATE users SET last_login = NOW(), session='".$sesh."' WHERE email='".$email."'");
                    $_SESSION['sesh'] = $sesh;
                    header ('location:../account.php');
                }
            else
                {
                    echo "<div class='center' ><br>Please activate your account by clicking the link supplied in your email. <a href='email.php?email=$email&type=activate'>send email again?</a></div>";
                }
        }
        else
            echo "<div class='center' ><br>an error occured, please try again later</div>";
            
        
        ?>
	</body>
    <script>
		//--fade in page-----------------------------------------------------------------------------------------
		$('.center').hide();
		function load()
		{
			$('.center').fadeIn(700);
		}
	</script>
</html>