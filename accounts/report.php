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
        //report
        if (isset($_GET['id']))
        {
            $id = mysql_real_escape_string($_GET['id']);
            require "connect.php";
            $query = mysql_query("UPDATE videos SET active = '3' WHERE id='".$id."'");
        }
        echo "<div class='center' ><br>Your report was successfully submitted.</div>";
        $query = mysql_query("SELECT channel FROM videos WHERE id='".$id."'");
        while ($row = mysql_fetch_assoc($query))
        {
            $channel = $row['channel'];
        }
        header ("Refresh: 3; URL=http://".$channel.".yew.tv?id=".$id."");
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