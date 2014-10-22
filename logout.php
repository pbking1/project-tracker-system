<?php 
session_start();
// Destroy the session
session_destroy();
// Clears session variables
$_SESSION = array();
// Redirect back to loign page
header( 'Location: /dajacinc/dev/index.php' ) ;
?>