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
------------------------------------------------------------------------------------------------------------------------------------------------>      	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="keywords" content="yew tv log in , yew tv sign in, yewtv log in, yew.tv log in, yewtv sign in, yew.tv sign in, yew tv members area, yew tv login, yew tv signin" />  
    	<meta name="description" content="Yew tv members area log in page" />  
    	<script type="text/javascript" src="/java/jquery-1.7.2.min.js"></script>
        <?php include ('style/device.php'); ?>
        <link rel="shortcut icon" href="images/favicon.ico" />
		<title>Log in to your Yew tv account to enter the members area.</title>
    </head>
   <body onLoad="load()">
   <div class='body'>
   <div id='wrapper'>
<?php
require ('menu/main.php');
echo "<div class='content'>";

if (!isset($_SESSION['sesh']))
{
	?><br>
    <table id='login' cellspacing="5" border="0" cellpadding="0">
    <tr valign="top" align="left">
    <td width="350">
    <center>
     <br>
    <?php
	if (isset($_POST['login']))
	{
		require ('accounts/loginprocess.php');
	}
	$token = $_SESSION['formToken'] = md5(uniqid(mt_rand(), true ));
	?>

	<form id='login' action ="" method='POST'>
		<label id='login' class="input">Email:</label>
		<input class='field' type='text' name='email' value="<?php echo isset($_POST['email']) ? mysql_real_escape_string($_POST['email']) : '' ?>" />
        <label id='login' class="input">Password:</label>
        <input class='field' type ='password' name='password'  />
        <input type ='hidden' name='location' value="<?php echo (isset($_GET['location']))? mysql_real_escape_string($_GET['location']) : "yew.tv/activity.php" ; ?>" />
        <input type ='hidden' name='token' value="<?php echo $token; ?>" />
        <label id='login' class="input">&nbsp;</label>
		<input type ='submit' value='login' name='login' />
    </form>
    </center>
    </td>
     <td style='border-style:dotted;border-width:0 0 0 1px;' width="1" ></td>
    <td width="250" valign="top" align="left">
    <br><br>
	<?php
	$location = (isset($_GET['location']))? mysql_real_escape_string($_GET['location']) : "yew.tv/activity.php" ;
	
	//facebook code
	$loginUrl = $facebook->getLoginUrl(
	array(
		'scope' => 'email',
		'redirect_uri' => 'http://www.yew.tv/facebook/collect.php?location='.$location.'',
	));
	
	//show
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='".$loginUrl."'><img style='width:150%;max-width:200px;' src='../images/login-facebook-button.png'/></a>"; ?>
    </td>
    </tr>
    </table>
	<?php
}
else
{
	echo "<br/><center>".ucwords($username)."  is currnetly logged in, <a href='accounts/logout.php'>logout?</a></center>";
}
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