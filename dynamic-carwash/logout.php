<?php
$_SESSION = array();
session_destroy(); // destroy session
header("location:login.php"); 
?>

