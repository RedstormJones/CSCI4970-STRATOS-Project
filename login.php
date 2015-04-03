<?php
require_once('application/globals.php');

	$username = $_POST['name'];
	$passwd = $_POST['passwd'];
	$con = mysqli_connect("127.0.0.1","root","section80","pki_stratos");
	if(mysqli_connect_errno($con))
	{
		echo "Failed to connect to MySQL DB: " . mysqli_connect_errno();
	}
	else
	{
		$query = "SELECT user,pass FROM `stuserinst` WHERE user='$username' AND pass='$passwd'";
		$result = mysqli_query($con,$query);
		mysqli_close($con);

		if(!$result || mysqli_num_rows($result) <= 0)
		{
			header("Location: index.php");
		}
		else
		{
			require APP . 'core/application.php';
			$app = new Application();
		}
	}
?>
