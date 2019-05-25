<?php
ob_start("ob_gzhandler");
?>
<html>
<!-----------------------------------------------------------------------------------------------------------------------------------------------
                             __          
.--.--..-----..--.--.--.    |  |_ .--.--.
|  |  ||  -__||  |  |  |    |   _||  |  |
|___  ||_____||________|    |____| \___/ 
|_____|   
-------------------------------------------------------------------------------------------------------------------------------------------------
website by Elliot Chapple.
---------------------------------------------------------------------------------------------------------------> 
	<head>  
    	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    	<meta name="description" content="skate film festival video entrys" />  
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">                 
		<script type="text/javascript" src="/java/jquery-1.7.2.min.js"></script>
		<link rel="shortcut icon" href="images/favicon(transparent).ico" />
       <!--  <title>Skate movies, films and skateboarding events in melbourne.</title> -->
<?php
//link appropriate stylesheet
if (($_SERVER['SERVER_NAME'] == 'www.yew.tv') || $_SERVER['SERVER_NAME'] == 'yew.tv')
{
	include ('style/device.php');
?>
	<meta name="keywords" content="yew tv entrys, skate film festival, skateboard film festival, skateboarding film festival, skateboard film competition, skateboarding film competition, skate film competition, skateboard movie competition, skateboarding movie competition, skate movie competition, skateboard clip competition, skateboarding clip competition, skate clip competition" />
    
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
}
//check if its a channel or frontpage
if (($_SERVER['SERVER_NAME'] != 'www.yew.tv') && $_SERVER['SERVER_NAME'] != 'yew.tv')
{
	//set subdomain variable from URL
	$nameChunks = explode('.', $_SERVER['HTTP_HOST']);
	$subDomainName = $nameChunks[count($nameChunks) - 3];
}
else
{
	//if first time visit send to welcome page
	if (!isset($_COOKIE["been_here"]))
	{
		header("Location: welcome.php");
	}
}
//is it somebodys channel?
require ('accounts/connect.php');
if (isset($subDomainName))
{
	$query = mysql_query("SELECT * FROM users WHERE channel = '".$subDomainName."' ");
	$num = mysql_num_rows($query);
	
	//check if its an iframe
	if (isset($_GET['prev'])&&$_GET['prev'] == 'true')
	{
		if (file_exists('./channels/'.$subDomainName.'/stylepreview.css')) 
		{
			$style = 'stylepreview';
		} 
		else 
		{
			$style = 'style';
		}
	} 
	else 
	{
		$style = 'style';
	}
	//link stylesheets.
	//if stylesheet exists, aka a user has the channel already
	if (glob("./channels/".$subDomainName."/".$style.".css"))
	{
		//link existing stylesheet.
		echo"<link rel='stylesheet' type='text/css' href='/channels/".$subDomainName."/".$style.".css' />";
	}
	else
	{
		//link template
		echo"<link rel='stylesheet' type='text/css' href='/channels/template.css' />";
	}
	//check device type
	$user_agent = empty($_SERVER['HTTP_USER_AGENT']) ? false : $_SERVER['HTTP_USER_AGENT'];
	if (preg_match('/(iphone|ipod|android|blackberry|opera|mini|windows\sce|palm|smartphone|iemobile)/i', $user_agent) )
	{
		//is a phone
		echo "<link rel='stylesheet' type='text/css' href='/style/channel_phone.css' />";
	}
	else
	{
		//Is a PC or Tablet
		echo "<link rel='stylesheet' type='text/css' href='/style/channel.css' />";
	}
}
//if it is somebodys channel
if((isset($subDomainName))&&($num != 0))
{	
	require ('accounts/connect.php');
	//does the user have any videos
	$query = mysql_query("SELECT id FROM videos WHERE active > '1' AND channel='".$subDomainName."'");
	$hasvids = mysql_num_rows($query);
	
	//does the user have videos?
	if ($hasvids != 0)
	{
		//user has videos
		if (!isset($_GET['id']))
		{
			$query = mysql_query("SELECT id FROM videos WHERE active > '1' AND channel='".$subDomainName."' ORDER BY date DESC LIMIT 1");
			while ($row = mysql_fetch_assoc($query))
			{
				$id = $row['id'];
			}
		}
		else
		{
			$id = mysql_real_escape_string($_GET['id']);
		}
		$query = mysql_query("SELECT * FROM videos WHERE active > '1' AND channel='".$subDomainName."' AND id='".$id."'");
		while ($row = mysql_fetch_assoc($query))
		{
			$url = $row['url'];
			$camera =  $row['camera'];
			$software =  $row['software'];
			$tags = $row['tags'];
			$title = $row['title'];
			$by =  $row['username'];
		}
		//metatags 
		$tags = (isset($tags))? $tags : 'action sports film competition, extreme sports film competition';
		echo"<title>".$subDomainName."</title>";

		echo "<meta name='keywords' content='".$tags."' /> ";
		?>
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
        <?php
		echo "</head>";
		echo "<body onload= 'onload();'>";
		echo "<div class='body'>";
		
		//display log navigator
		echo "<div id='nav'>";
		include "accounts/loginnav.php";
		echo "</div>";
		
		
		//get camera info
		$query = mysql_query("SELECT URL FROM products WHERE title = '".$camera."'");
		while ($row = mysql_fetch_assoc($query))
		{
			$camURL = $row['URL'];
		}	
		//get the products information
		$query = mysql_query("SELECT URL FROM products WHERE title = '".$software."'  ");
		while ($row = mysql_fetch_assoc($query))
		{
			$softURL = $row['URL'];
		}
		
		if (isset($_GET['autoplay']))
		{
			$auto = '&autoplay=1';
		}
		else
		{
			$auto = '';
		}
		echo "<div class='content'>";
		//does user have a banner?
		if (glob('./channels/'.$subDomainName.'/banner.*'))
		{
			//what type of file is it?
			if (glob('./channels/'.$subDomainName.'/banner.jpg'))
			{
				$ext = 'jpg';
			}
			if (glob('./channels/'.$subDomainName.'/banner.jpeg'))
			{
				$ext = 'jpeg';
			}
			if (glob('./channels/'.$subDomainName.'/banner.png'))
			{
				$ext = 'png';
			}
			if (glob('./channels/'.$subDomainName.'/banner.pjpeg'))
			{
				$ext = 'pjpeg';
			}
			if (glob('./channels/'.$subDomainName.'/banner.gif'))
			{
				$ext = 'gif';
			}
			//display the banner
			echo "<img atl='".$subDomainName."'s banner' title='".$subDomainName."'  src='/channels/".$subDomainName."/banner.".$ext."' class='banner'/>";
		}
			//title and by info
			echo "<h1><div class='left'>&nbsp;&nbsp;".ucwords($title)."</div><div class='right'>".ucwords($by)."&nbsp;&nbsp;</div></h1>";
			
			echo "<div id='wrapper'>";
			
			//display the video
			echo "<iframe src='".$url."?rel=0".$auto."' class='video'></iframe>";
			echo "
			<t>
			<div class='left'>
			<a class='nounderline' id='button' href='#' onchange='buttonprocess();'  onclick='buttonprocess();' ></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			//display the ads
			echo "with:&nbsp;&nbsp;&nbsp;<a onclick='_gaq.push(['_trackEvent', 'adClick', 'hardware']);' href='".$camURL."' target='_blank' >".$camera."</a>";
			echo "&nbsp;&nbsp;&nbsp;&&nbsp;&nbsp;&nbsp;<a onclick='_gaq.push(['_trackEvent', 'software', '".$number."']);' href='".$softURL."' target='_blank' >".$software."</a>";
			echo "</div>";
			echo "<div class='right'>";
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='";
			//link report button if not preview
			echo (isset($_GET['prev'])&&$_GET['prev']=='true') ? "" : "accounts/report.php?id=".$id."" ;
			echo "'>Report</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";	
			
			if (!isset($_SESSION['sesh']))
			{
				echo "<a class='nounderline' href='http://www.yew.tv/login.php?location=".$_SERVER['HTTP_HOST']."".$_SERVER['REQUEST_URI']."'>Vote: &#9744;</a>";
			}
			else
			{
				echo "<a class='nounderline' id='tickbox' href='#' onclick='vote();' onmousedown='vote();' onmouseup='vote();' ></a>";
	
			}
			echo "</div>
			</t>
			<hr>
		<h2 id='info'></h2>";
	}
	else
	{
		echo "</head>";
		echo "<body onload= 'onload();'>";
		echo "<div class='body'>";
		//display log navigator
		echo "<div id='nav'>";
		include "accounts/loginnav.php";
		echo "</div>";
		echo "<div id='wrapper'>";
		echo "<div class='alert' ><br>This channel has no active videos</div>";
		echo "</div>";
	}
}
if ((isset($subDomainName))&&($num == 0))
{
	echo "</head>";
	echo "<body onload= 'onload();'>";
	echo "<div class='body'>";
	//display log navigator
	echo "<div id='nav'>";
	include "accounts/loginnav.php";
	echo "</div>";
	echo "<div id='wrapper'>";
	echo "<div class='alert' ><br>Channel available for free, click <a style='color:black;' href='http://yew.tv/submit-a-video.php'>here.</a></div>";
	echo "</div>";
}


//check if its a channel or frontpage
if (($_SERVER['SERVER_NAME'] != 'www.yew.tv') && $_SERVER['SERVER_NAME'] != 'yew.tv')
{
	if (!isset($_SESSION['count']))
	{
		$_SESSION['count'] = 0 ;
	}
	//only if the channel is loaded and arrows weren't pressed
	if (!isset($_GET['nav']))
	{
		//history array; set if empty, add to if not
		if (!isset($_SESSION['history']))
		{
			$history = array();
			//if current channel is not already in array add it to array
			if (!in_array($subDomainName, $history))
			{
				$history[] = $subDomainName;
				$_SESSION['history'] = $history;
			}
		}
		else
		{
			$history = $_SESSION['history'] ;
			//if current channel is not already in array add it to array
			if (is_array($history))
			{
				if (!in_array($subDomainName, $history))
				{
					$history[] = $subDomainName;
					$_SESSION['history'] = $history;
				}
			}
			else
			{
				if ($subDomainName != $history)
				{
					$history[] = $subDomainName;
					$_SESSION['history'] = $history;
				}
			}
		}
		
	}
	
	//get the last key of array if session isset
	$hist = (isset($_SESSION['history']))? $_SESSION['history'] : 'nill, null' ;
	$inter= array_keys($hist);
	$position = array_pop($inter);
	
	echo "</div>";
	echo "</div>";
	echo "<div id=arrowR>";
	//display right arrow
	echo "<a class='nounderline' id='right' onclick='_gaq.push(['_trackEvent', 'userAction', 'nextVideo']);' href='";
	//link if not preview
	echo (isset($_GET['prev'])&&$_GET['prev']=='true') ? "" : "?nav=a" ;
	echo "'>></a>";
	echo "</div>";
	
	echo "<div id=arrowL>";
	//display left arrow
	echo "<a class='nounderline' class='arrow' onclick='_gaq.push(['_trackEvent', 'userAction', 'lastVideo']);' id='left' href='";
	//link if not preview
	echo (isset($_GET['prev'])&&$_GET['prev']=='true') ? "" : "?nav=b" ;
	
	echo "'><</a>";
	echo "</div>";
}

//if new video is pressed (right)
if (isset($_GET['nav'])&&$_GET['nav']== 'a')
{
	//if last key value in array doesnt match counter
	if ($position != $_SESSION['count'])
	{
		//add one to counter
		$_SESSION['count'] =  $_SESSION['count'] + 1;
		//set var
		$forward = $_SESSION['count'];
		//get the history
		$history = $_SESSION['history'];
		//get forward value from array
		$channel = $history[$forward];
		//header
		header ('location:http://'.$channel.'.yew.tv');
	}
	else
	//get a new video
	{
		//if array isn't set esclude no videos in query
		if (!isset($_SESSION['history']))
		{
			$exclude = "'nill'";
		}
		else
		//exclude videos already seen and added to history array
		{
			$history = $_SESSION['history'];
			$exclude = "'".implode("','",$history)."'";
		}
		//get video
		
		require "accounts/connect.php";
		//get user id
		$query = mysql_query("SELECT id FROM users WHERE session = '".$_SESSION['sesh']."' ");
        while ($row = mysql_fetch_array($query))
        {
			$userId = $row['id'];
		}
		
		//get the last voted video of the current channel member that isn't the current channel or their own.
		$query = mysql_query("SELECT channel FROM feedback WHERE channel_from = '".$subDomainName."' AND channel NOT IN (".$exclude.") AND channel <> '".$subDomainName."' ORDER BY date ASC LIMIT 1");
		while ($row = mysql_fetch_array($query))
		{
			//get the channel 
			$channel = $row['channel'];
		}
		
		// if there are no votes go to a random channel
		if (!isset($channel))
		{
			require ('accounts/connect.php');
			$query = mysql_query("SELECT channel FROM videos WHERE channel NOT IN (".$exclude.") AND channel <> '".$subDomainName."' AND active > '1' ORDER BY RAND() LIMIT 1");
			while ($row = mysql_fetch_assoc($query))
			{
				$channel = $row['channel'];
			}
		}
		
		//if this is the only channel in competition, ie if channel is still not set by this stage
		if(!isset($channel))
		{
			//clean counter and hisotry
			$_SESSION['history'] = '';
			$_SESSION['count'] = '';
			//header to homepage
			header ('location:http://yew.tv');
		}
		else
		//header to channel found
		{
			//add value to counter
			$_SESSION['count'] =  $_SESSION['count'] + 1;
			//head to channel
			header ('location:http://'.$channel.'.yew.tv');
		}
	}
}
//if back is pressed.
if (isset($_GET['nav'])&&$_GET['nav'] == 'b')
{
	//if its the first video in history, go home.
	if (!isset($_SESSION['count'])||$_SESSION['count'] == 0)
	{
		//clean session vars
		$_SESSION['history'] = '';
		$_SESSION['count'] = '';
		//header to homepage
		header ('location:http://yew.tv');
	}
	else
	//its not the fisrt video
	{
		//subtract from counter
		$_SESSION['count'] = $_SESSION['count'] - 1;
		$back = $_SESSION['count'];
		//get the history
		$history = $_SESSION['history'];
		//get the last video
		$channel = $history[$back];
		//header there.
		header ('location:http://'.$channel.'.yew.tv');
	}
}
	
//nobodys channel
//--------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------------------------------
if (!isset($subDomainName))
{
	//delete video player history
	if (isset($_SESSION['history']))
	{
		$_SESSION['history'] = '';
	}
	
	//display homepage
	require ('menu/main.php');
	require ('menu/sponsors.php');
	$trending = (!isset($_GET['display']))? "font-style:normal;color:black;" : "" ;
	$recent = (isset($_GET['display'])&&($_GET['display'])== 'recent')? "font-style:normal;color:black;" : "" ;
	$all = (isset($_GET['display'])&&($_GET['display'])== 'all')? "font-style:normal;color:black;" : "" ;
	$compDetails = ($_SERVER['PHP_SELF'] == '/competition-details.php')? "font-style:normal;color:black;" : "" ;
	echo "
		<h3>
		<a style='".$trending."' href='http://yew.tv'>Trending</a> | <a style='".$recent."'  href='http://yew.tv/videos/recent'>Recent</a> | <a style='".$all."' href='http://yew.tv/videos/all'>All</a> <a class='comp' style='".$compDetails."' href='http://yew.tv/competition-details'>Competition Details<a/></center>
		</h3>
		<hr>
		<a href='#'><h3><div id='loading' >loading...</div></h3></a>
	";
//if popular variable isset----------------------------------------------------------------------------------------------------------------
	echo "<div class='content'>";
	//set odd even video count checker
	$count = 0;
	if (!isset($_GET['display']))
	{
		//get the 6 most voted videos in the past 24 hours
		$query = mysql_query("SELECT video_id, count(*) AS total FROM feedback WHERE date >= SYSDATE() - INTERVAL 1 DAY GROUP BY video_id ORDER BY total DESC LIMIT 6");
		while ($row = mysql_fetch_array($query))
		{
			$vid_id = $row['video_id'];
			$array[] = $vid_id;
			//get video url
			$query2 = mysql_query("SELECT id, url, title, channel, username FROM videos WHERE id = '".$vid_id."' AND active > '1' ");
			while ($row = mysql_fetch_assoc($query2))
			{
				$id = $row['id'];
				$url = $row['url'];
				$title = $row['title'];
				$channel = $row['channel'];
				$by = $row['username'];
				
				echo "<iframe frameborder='0' src='".$url."?rel=0&wmode=transparent' class='video'></iframe>
				<a href='http://".$channel.".yew.tv?autoplay=1' class='overlay'>
					<h2>
					<hr>
						<div class='title'><i>".ucwords($title)."</i></div>
						<b>by:</b> ".ucwords($by)."<br>
						".$channel.".yew.tv
					<hr>
					</h2>
				</a>
				";
				$count = $count + 1;
			}		
		}
		//if theres not 6 entrys select random ones
		if ($count != 6)
		{
			$limit = 6 - $count;
			if (isset($array))
			{
				$exclude= "'".implode("','",$array)."'";
			}
			else
			{
				$exclude = "'nill'";
			}
			
			
			$query = mysql_query("SELECT id, url, title, channel, username FROM videos WHERE id NOT IN (".$exclude.") AND active > '1' ORDER BY RAND() LIMIT ".$limit."");
			while ($row = mysql_fetch_array($query))
			{
				$id = $row['id'];
				$url = $row['url'];
				$title = $row['title'];
				$channel = $row['channel'];
				$by = $row['username'];
				
				echo "<iframe frameborder='0' src='".$url."?rel=0&wmode=transparent' class='video'></iframe>
				<a href='http://".$channel.".yew.tv?autoplay=1' class='overlay'>
					<h2>
					<hr>
						<div class='title' ><i>".ucwords($title)."</i></div>
						<b>by:</b> ".ucwords($by)."<br>
						".$channel.".yew.tv
					<hr>
					</h2>
				</a>
				";
				$count = $count + 1;
			}
		}
	}
	//if recent variable isset------------------------------------------------------------------------------------------------------------------
	if (isset($_GET['display'])&&$_GET['display'] == 'recent' )
	{
		//get recent videos
		$query = mysql_query("SELECT id FROM videos WHERE active > '1' AND date >= SYSDATE() - INTERVAL 31 DAY ORDER BY date DESC LIMIT 6");
		while ($row = mysql_fetch_assoc($query))
		{
			$vid_id = $row['id'];
			//get the channel name
			$query2 = mysql_query("SELECT id, url, title, channel, username FROM videos WHERE id = '".$vid_id."'");
			while ($row = mysql_fetch_assoc($query2))
			{
				$id = $row['id'];
				$url = $row['url'];
				$title = $row['title'];
				$channel = $row['channel'];
				$by = $row['username'];
				
				echo "<iframe frameborder='0' src='".$url."?rel=0&wmode=transparent' class='video'></iframe>
				<a href='http://".$channel.".yew.tv?autoplay=1' class='overlay'>
					<h2>
					<hr>
						<div class='title'><i>".ucwords($title)."</i></div>
						<b>by:</b> ".ucwords($by)."<br>
						".$channel.".yew.tv
					<hr>
					</h2>
				</a>
				";
				$count = $count + 1;
			}	
		}
	}
	//if all variable isset-----------------------------------------------------------------------------------------------------------------
	if (isset($_GET['display'])&&$_GET['display'] == 'all' )
	{
		//get random videos
		$query = mysql_query("SELECT id, url, title, channel, username FROM videos WHERE active > '1' ORDER BY RAND() LIMIT 6");
		while ($row = mysql_fetch_array($query))
		{
			$id = $row['id'];
			$arrayall[] = $id;
			$url = $row['url'];
			$title = $row['title'];
			$channel = $row['channel'];
			$by = $row['username'];
			
			echo "
				<iframe frameborder='0' src='".$url."?rel=0&wmode=transparent' class='video'></iframe>
				<a href='http://".$channel.".yew.tv?autoplay=1' class='overlay'>
					<h2>
					<hr>
						<div class='title'><i>".ucwords($title)."</i></div>
						<b>by:</b> ".ucwords($by)."<br>
						".$channel.".yew.tv
					<hr>
					</h2>
				</a>
			";
			$count = $count + 1;
		}
		if (isset($arrayall))
		{
			$exclude = "'".implode("','",$arrayall)."'";
		}
		
		//display exclude list as html for java purposes
		echo "<div style='display: none;' class='exclude'>";
		echo $exclude;
		echo "</div>";
	}

	if (isset($_GET['display'])&&$_GET['display'] == 'all' )
	{
		echo "<div id='Videos'></div >";
		echo "<div id='ready' style='display:none;'></div>";
	}
	
	echo "</div>";
	echo "</div>";
	require('menu/footer.php');
}
?>
</div>
   </body>
		 <script>
		 	
            //--votes and info ------------------------------------------------------------------------------------------!-->
             var button = 1;
			
			function onload()
			{
				load();
				window.onload = displayvote();
				window.onload = buttondisplay(button);
			}
			
			function vote() 
			{
				$.post('javaprocess/vote.php', {vidid: <?php echo $id; ?>, sesh: '<?php echo isset($_SESSION['sesh'])? $_SESSION['sesh'] : '' ; ?>' });
				window.onload = displayvote();
				_gaq.push(['_trackEvent', 'userAction', 'vote']);
				return false;
			}
			
			function displayvote() 
			{
				$.post('javaprocess/tickbox.php', {vidid: <?php echo $id; ?>, sesh: '<?php echo isset($_SESSION['sesh'])? $_SESSION['sesh'] : '' ; ?>'},
				function(output) 
				{
					$('#tickbox').html(output).show();
					window.onload = displayvoteagain();
				});
			}
			
			function displayvoteagain() 
			{
				$.post('javaprocess/tickbox.php', {vidid: <?php echo $id; ?>, sesh: '<?php echo isset($_SESSION['sesh'])? $_SESSION['sesh'] : '' ; ?>'},
				function(output) 
				{
					$('#tickbox').html(output).show();
				});
			}
			
			function buttonprocess()
			{
				if (button == 0)
				{
					button = 1;
					buttondisplay(1);
				}
				else if (button == 1)
				{
					button = 0;
					buttondisplay(0);
				}
			}
			
			function buttondisplay(button)
			{
				$.post('javaprocess/button.php', {more: button},
				function(output)
				{
					$('#button').html(output).show();
				});
			
				if (button == 0)
				{
					$.post('javaprocess/info.php', {vidid: <?php echo $id; ?>},
					function(output)
					{
						_gaq.push(['_trackEvent', 'userAction', 'info']);
						$('#info').html(output).show();
					});
				}
				else if (button == 1)
				{
					$.post('javaprocess/info.php',
					function(output)
					{
						$('#info').html(output).hide();
					});
				}
			}

		 	//--fade in page-----------------------------------------------------------------------------------------
			$('.content').hide();
			function load()
			{
				$('.content').fadeIn(700);
				$('#loading').hide();
			}
			
			
			//--scroll to top-----------------------------------------------------------------------------------------
			function scroller()
			{
				$('html, body').animate({ scrollTop: 0 }, 'slow');
			}
			///--foreverscroll-----------------------------------------------------------------------------------------
			function getDocHeight() 
			{
				var D = document;
				return Math.max(
				Math.max(D.body.scrollHeight, D.documentElement.scrollHeight),
				Math.max(D.body.offsetHeight, D.documentElement.offsetHeight),
				Math.max(D.body.clientHeight, D.documentElement.clientHeight)
			)};
			
			
            $(window).scroll(function(){
					if ($(this).scrollTop() < 100) {
						$('.top').fadeOut(700);
					} else {
						$('.top').fadeIn(700);
					}
					
					if($(window).scrollTop() + $(window).height() == getDocHeight()) 
					{
						
						if (document.getElementById("ready")) 
						{
							var element = document.getElementById("ready");
						  	element.parentNode.removeChild(element);
						 	$('#loading').fadeIn(700);
							
							$.ajax(
							{
									url: 'http://yew.tv/javaprocess/LoadMoreVideosAll.php?loadedVideo=' + $(".exclude:last").html(),
									success: function(html)
									{
										if (html)
										{
											$("#Videos").append(html);
											$('#loading').fadeOut(700);
										 }
										 else
										 {
											$('#loading').replaceWith("<div class='top'  id='loading' onclick='scroller();' >Top^</div>");
										 }
									
									}
							});
						}
					}
				
            });
			
        </script>
</html>
