<?php
	require_once("../../globals.php");

	#-----------------#
	# end the session #
	#-----------------#
	session_destroy();
	
	
	#-----------------------------------------#
	# redirect webpage back to the login page #
	#-----------------------------------------#
	$location = "../login/login_index.php";
	
	echo '	<script type="text/javascript"> 
				window.location.href = "' . $location . '"
			</script>';
?>
