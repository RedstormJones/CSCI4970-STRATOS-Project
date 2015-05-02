<?php
	require_once("../../globals.php");
<<<<<<< HEAD

	session_destroy();
	
	$location = "../login/login_index.php";
	
	echo '	<script type="text/javascript"> 
				window.location.href = "' . $location . '"
			</script>';
?>
=======
	session_destroy();
	$location = "../login/login_index.php";
	
	echo '
	<script type="text/javascript"> 
		window.location.href = "' . $location . '"
	</script>';
?>
>>>>>>> origin/dev
