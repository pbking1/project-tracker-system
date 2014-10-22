<?php 
session_start();
if (isset($_SESSION["uid"])) {
	echo "Auth Pass";
}
else {
	$error = 'test';
	header( 'Location: /dajacinc/dev/index.php' ) ;
}


?>