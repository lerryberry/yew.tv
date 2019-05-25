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
		<meta name="keywords" content="yew tv contact us, yewtv contact us, yew.tv contact us, contact yew tv, contact yewtv, contact yew.tv, yewtv phone number, yew tv phone number, yew.tv phone number, yew tv email address, yewtv email, yew.tv email, email yew tv feedback, yewtv complaints, yewtv address" />  
   		<meta name="description" content="email address and phone number for yew tv staff" /> 
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php include ('style/device.php'); ?>
        <link rel="shortcut icon" href="images/favicon.ico" />
         <script type="text/javascript" src="/java/jquery-1.7.2.min.js"></script>
        <title>Contact us, email address and phone number of Yew tv staff.</title>
        
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
            ?>
            <div class='content'>
            	<center><h1>Contact Us</h1>
                <p>Elliot Chapple<br>
                <i>proprietor</i></p>
                <p>elliot@yew.tv<br>
                0478 081 851</p>
                </center>
            </div>
            </div>
            <?php
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