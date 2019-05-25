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
        <meta name="keywords" content="yewtv votes, yew tv votes, yew.tv votes, yewtv activity, yew tv activity, yew.tv activity," />  
	    <meta name="description" content="Yew tv film competition activity and votes" />  
    	<?php include ('style/device.php'); ?>
        <link rel="shortcut icon" href="images/favicon.ico" />
        <link rel="shortcut icon" href="images/favicon.ico" />
    	<script type="text/javascript" src="/java/jquery-1.7.2.min.js"></script>
        <title>Your votes will appear here.</title>
        
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
	echo "<a href='#'><h3><div id='loading' >loading...</div></h3></a>";
    echo "<div class='content'>";
    //is the user logged in?
    if (isset($_SESSION['sesh']))
    {
		require "accounts/connect.php";
		//get user id
		$query = mysql_query("SELECT id FROM users WHERE session = '".$_SESSION['sesh']."' ");
        while ($row = mysql_fetch_array($query))
        {
			$userId = $row['id'];
		}
		
        $counter = 0;
        $query = mysql_query("SELECT video_id, id FROM feedback WHERE user = '".$userId."' ORDER BY date DESC LIMIT 4");
        $num = mysql_num_rows($query);
        while ($row = mysql_fetch_array($query))
        {
            $id = $row['video_id'];
            $feedBackId = $row['id'];
            $query2 = mysql_query("SELECT id, url, title, channel, username FROM videos WHERE id = '".$id."'");
            while ($row = mysql_fetch_array($query2))
            {
                    $counter = $counter + 1;
                    $id = $row['id'];
                    $url = $row['url'];
                    $title = $row['title'];
                    $channel = $row['channel'];
                    $by = $row['username'];
                    
                    echo "
                    <div class='VotedVideos' id='".$feedBackId." VotedVideos' >
                        <iframe frameborder='0' src='".$url."?rel=0&wmode=transparent' class='video'></iframe>
                        <a href='http://".$channel.".yew.tv' class='overlay'>
                            <h2>
                            <hr>
                                <div class='title'><i>".ucwords($title)."</i></div>
                                <b>by:</b> ".ucwords($by)."<br>
                                ".$channel.".yew.tv
                            <hr>
                            </h2>
                        </a>
                    </div>
                    ";
            }
        }
        if ($num == 0)
        {
            echo "<div class='notification' id='fail'><br>You have not voted for any videos yet.<Br><Br></div>";
        }
		else
		{
			echo "<div id='Videos'>&nbsp;</div>";
		}
    }
    echo "</div>";
	echo "</div>";
    require('menu/footer.php');
    echo "</div>";
    ?>
    </div>
</body>
	<script>
		//--fade in page-----------------------------------------------------------------------------------------
			$('.content').hide();
			function load()
			{
				$('#loading').hide();
				$('.content').fadeIn(700);
			}
			
		
		
		//--scroll to top-----------------------------------------------------------------------------------------
		function scroller()
		{
			$("html, body").animate({ scrollTop: 0 }, 600);
			return false;
		}
			
		//foreverscroll
		function getDocHeight() 
			{
				var D = document;
				return Math.max(
				Math.max(D.body.scrollHeight, D.documentElement.scrollHeight),
				Math.max(D.body.offsetHeight, D.documentElement.offsetHeight),
				Math.max(D.body.clientHeight, D.documentElement.clientHeight)
			)};
			
			
            $(window).scroll(function(){
					if($(window).scrollTop() + $(window).height() == getDocHeight()) 
					{
						$('.top').fadeIn(700);
					} else {
						$('.top').fadeOut(700);
					}
					
					if($(window).scrollTop() + $(window).height() == getDocHeight()) 
					{
						$('#loading').fadeIn(700);
					
						$.ajax({
							url: "javaprocess/LoadMoreVideos.php?user=<?php echo $userId ?>&lastVideo=" + $(".VotedVideos:last").attr("id"),
							success: function(html){
								if (html)
								{
									$("#Videos").append(html);
									$('#loading').fadeOut(700);
								 }
								 else
								 {
									$('#loading').replaceWith("<div class='top' id='loading' onclick='scroller();' >Top^</div>");
									$('#loading').fadeIn(700);
								 }
							}
                    });
            }
        });
    </script>
</html>