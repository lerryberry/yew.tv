<?php
if (isset($_SESSION['sesh']))
{
	//blacken button of page user is on
	$activity = ($_SERVER['PHP_SELF'] == '/activity.php')? "color:black;font-style:normal;" : "" ;
	$channel = ($_SERVER['PHP_SELF'] == '/submit-a-video.php')? "color:black;font-style:normal;" : "" ;
	$account = ($_SERVER['PHP_SELF'] == '/account.php')? "color:black;font-style:normal;" : "" ;
	
	echo "	<h3><a style='".$activity."' href='activity.php'>Activity</a> | <a class='hidden' style='".$channel."' href='submit-a-video.php'>Submit</a> <t class='hidden' >|</t> <a style='".$account."' href='account.php'>Account</a></h3><hr>";
}
else 
{
	echo "<br><center>You are not logged in. <a href='http://yew.tv/login.php?location=".$_SERVER['HTTP_HOST']."".$_SERVER['REQUEST_URI']."'>login</a></center>";
}
?>