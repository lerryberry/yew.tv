<?php
require ("../accounts/connect.php");
if ($_POST['more'] != 1)
{
	echo '▲' ;
}
else
{
	echo '▼' ;
}
?>