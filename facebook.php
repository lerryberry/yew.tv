<?php
ob_start("ob_gzhandler");

require ('facebook/src/facebook.php');

$email = $facebook->api('/me?fields=email');
	  print_r($email);
	  echo $user_profile['first_name'];

?>