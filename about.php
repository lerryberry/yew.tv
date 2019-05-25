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
------------------------------------------------------------------------------------------------------------------------------------------------>
   		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="keywords" content="about yew tv, about yewtv, about yew.tv, yew tv information, yewtv information, yew.tv information, yew tv info, yewtv details, yew tv details, yew.tv details, yewtv facts, yew tv facts, yew.tv facts, yewtv FAQ" />  
    	<meta name="description" content="information and details about yew tv" /> 
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php include ('style/device.php'); ?>
        <link rel="shortcut icon" href="images/favicon.ico" />
        <script type="text/javascript" src="/java/jquery-1.7.2.min.js"></script>
        <title>Information, details, facts and FAQS.</title>
        
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
                <h1><center>About Us</center></h1>
                    <p>Yew Tv is an online action sports film community.</p><p> Yew Tv hosts film competitions, continuously cycling through all the most popular action sports type's. The Yew Tv community chooses the top films by voting online and a film festival is held playing the top films in an established venue.</p>
                    <p>Yew Tv is epic because we;</p>
                    <ul>
                        <li><p>Focus on filmmakers.</p></li>
                        <li><p>Use 100% carbon neutral web hosting, <a href='http://www.digitalpacific.com.au/green-hosting/' target='_blank'>digitalpacific.com.au</a>.</p></li>
                        <li><p>Don't have sweaty corporate ball sacks.</p></li>
                    </ul>
                    <p>So please check out our shit and if you dig it like us on Facebook&nbsp;&nbsp;<iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.facebook.com%2Fwww.yew.tv&amp;send=false&amp;layout=button_count&amp;width=450&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21&amp;appId=235699793132893" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:21px;" allowTransparency="true"></iframe><br>Otherwise help us improve our site by <a href='mailto:feedback@yew.tv' target='_blank' >sending feedback</a>.
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