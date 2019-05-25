<?php
ob_start("ob_gzhandler");
?>
<html>
<?php
$user_agent = empty($_SERVER['HTTP_USER_AGENT']) ? false : $_SERVER['HTTP_USER_AGENT'];
if (preg_match('/(iphone|ipod|android|blackberry|opera|mini|windows\sce|palm|smartphone|iemobile)/i', $user_agent) )
{
	//if it is a phone ignore this page
	header( "Refresh: 2; URL=account.php");
}
?>
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
		<meta name="keywords" content="start voting, enter competition" />  
   		<meta name="description" content="new user landing page" /> 
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php include ('style/device.php'); ?>
        <link rel="shortcut icon" href="images/favicon.ico" />
         <script type="text/javascript" src="/java/jquery-1.7.2.min.js"></script>
        <title></title>
        
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
            echo "<div class='content'>";
			require ('accounts/connect.php');
			//delete video player history
			if (isset($_SESSION['history']))
			{
				$_SESSION['history'] = '';
			}
			//get random channel
			$query = mysql_query("SELECT channel FROM videos WHERE active > '1' ORDER BY RAND() LIMIT 1");
			while ($row = mysql_fetch_assoc($query))
			{
				$channel = $row['channel'];
			}
			
			?>
            <Br><Br>
			<table id='login' cellspacing="5" border="0" cellpadding="0">
                <tr valign="top" align="left">
                    <td width="350" height="200px" >
                    	<?php echo "<a href='http://".$channel.".yew.tv'><img class='buttons' src='images/start-voting.png' /></a>";?>
                    </td>
                    <td style='border-style:dotted;border-width:0 0 0 1px;' width="1" ></td>
                    <td width="250" height="200px" valign="top" align="left">
                        <a href='submit-a-video.php'><img class='buttons' src='images/enter-competition.png' /></a>
                    </td>
                </tr>
            </table>
            
            <?php
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