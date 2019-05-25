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
		<meta name="keywords" content="skateboard film competition details, prizes, skate film comp details, yew tv prizes, yew.tv prizes, yew tv event, yew tv votes, yew tv rules, about skate film festival, skate film comp info, skateboard film competition information, skate movie competition, skatboard clip comp " />  
    	<meta name="description" content="yew.tv skate film competition rules, information and guidelines" /> 
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php include ('style/device.php'); ?>
        <link rel="shortcut icon" href="images/favicon.ico" />
        <script type="text/javascript" src="/java/jquery-1.7.2.min.js"></script>
        <title>How to enter skate movie competition and Melbourne film festival - competition, rules, voting, event and prizes.</title>
        
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
		require ('menu/sponsors.php');
		echo "<h3>
		<a href='http://yew.tv'>Trending</a> | <a href='http://yew.tv/videos/recent'>Recent</a> | <a href='http://yew.tv/videos/all'>All</a> <a class='comp' style='color:black;font-style:normal;' href='http://yew.tv/competition-details.php'>Competition Details</a></center>
		</h3>
		<hr>";
            ?>
            <div class='content'>
             <h1><center>Competition Information</center></h1>
            	<P><strong>Submissions</strong></P>
                <p>
                Entering the competition is free.<br><Br>
                You must first upload your film to a video hosting website, we recommend <a target='_blank' href='http://www.youtube.com/'>Youtube.com</a> due to its highly compatible player.<br><Br>
                Videos are welcome from anybody, but all videos are watched by a Yew Tv staff member before being made active in the competition. You will be notified via email as to whether your video was approved for our competition.
                </p>
                <P><strong>Voting</strong></P>
                <p>
                The entire voting system is online, the online community completely decide the winners.<br><Br> Every Yew Tv member gets one vote per video.<br><br>
                Numbers of votes are kept private until the day of the event. Proof of every vote can be produced if requested after the winner has been awarded.
                </p>
                <P><strong>Event</strong></P>
                <p>
                The event is held in the established <a target='_blank' href='http://www.astortheatre.net.au/about-the-astor'>Astor Theatre</a>, Melbourne, Australia. The event will screen the top ten films of the competition and prizes will be awarded to the top three filmmakers.
                <br><br>
                If for some reason a winner of the competition cannot attend the event a short film is required in which the filmmaker thanks the public etc.
                </p>
                <P><strong>Prizes</strong></P>
                <p>
                Thanks to our sponsors <a href='' target='_blank' >1</a>, <a href='' target='_blank' >2</a>, <a href='' target='_blank' >3</a>, <a href='' target='_blank' >4</a> & <a href='' target='_blank' >5</a> for the $5000 in prizes!<Br><Br>
                <a href=''><img width='600px' height='400px' title='image of yew tv skateboard film competition prizes' src='' alt='$5000 in Prizes'/></a><Br><br>
                To keep up to date with prizes follow us on <a target='_blank' href='http://www.facebook.com/www.yew.tv/app_190322544333196'>facebook</a>.
                </p>
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