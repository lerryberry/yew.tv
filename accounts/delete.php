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
        //check user
        $channel = mysql_real_escape_string($_GET['channel']);
        $code = mysql_real_escape_string($_GET['code']);
		
        require ("connect.php");
        $query = mysql_query("SELECT * FROM users WHERE token = '".$code."' AND channel = '#".$channel."' ");
        $rownum = mysql_num_rows($query);
        if ($rownum == 1)
        {
            $query = mysql_query("SELECT * FROM users WHERE channel = '#".$channel."' ");
            $row = mysql_num_rows($query);
            if ($row == 1)
            {
                //delete channel in tables
                $query = mysql_query("DELETE FROM feedback WHERE channel = '".$channel."' ");
                $query = mysql_query("DELETE FROM videos WHERE channel = '".$channel."' ");
                $query = mysql_query("UPDATE users SET channel = '' WHERE token='".$code."' ");
                
                //delete files
                if (file_exists("../channels/".$channel."/banner.gif"))
                {
                    unlink("../channels/".$channel."/banner.gif");
                }
                if (file_exists("../channels/".$channel."/banner.jpeg"))
                {
                    unlink("../channels/".$channel."/banner.jpeg");
                }
                if (file_exists("../channels/".$channel."/banner.jpg"))
                {
                    unlink("../channels/".$channel."/banner.jpg");
                }
                if (file_exists("../channels/".$channel."/banner.png"))
                {
                    unlink("../channels/".$channel."/banner.png");
                }
                if (file_exists("../channels/".$channel."/banner.pjpeg"))
                {
                    unlink("../channels/".$channel."/banner.pjpeg");
                }
                //if preview is there for some reason
				if (file_exists("../channels/".$channel."/stylepreview.css"))
				{
                	unlink("../channels/".$channel."/stylepreview.css");
				}
				
				unlink("../channels/".$channel."/style.css");
                
                //delete folder
                $myFolder = "../channels/".$channel."";
                rmdir($myFolder);
                echo "<div class='center' ><br>Channel Deleted.</div>";
                header("Refresh: 2;url=http://yew.tv");
            }
        }
		else
		{
			echo "<div class='center' ><br>An error occured, please try again.</div>";
            header("Refresh: 2;url=http://yew.tv/channel.php");
		}
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