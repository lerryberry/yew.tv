<?php
$seush = session_name("suesh_name");
session_set_cookie_params(0, '/', '.yew.tv');
session_start();
session_destroy();
header('location: http://yew.tv/login.php');
?>