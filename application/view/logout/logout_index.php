<?php
	require_once("../../globals.php");
	session_destroy();
	$location = "../login/login_index.php";
	
	echo '
	<script type="text/javascript"> 
		window.location.href = "' . $location . '"
	</script>';
?>