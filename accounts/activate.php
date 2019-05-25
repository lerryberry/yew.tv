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
        $code = mysql_real_escape_string($_GET['code']);
        require ("connect.php");
        $query = mysql_query("UPDATE users SET active='2' WHERE token='".$code."'");
        echo "<div class='center' ><br>Your account has been activated.<div>";
        header("Refresh: 2;url=../login.php");
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