<!DOCTYPE html>

<html lang="en"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<title>PKI - STRATOS</title>
		<link rel="stylesheet" type="text/css" href="style.css" /> 
	</head>
	<body>
		<?php
			$username = $_POST['name'];
			$passwd = $_POST['email'];
			#echo $username;
			#echo "<br>";
			#echo $passwd;
			$con = mysqli_connect("127.0.0.1","root","section80","test");
			if(mysqli_connect_errno($con))
			{
				echo "Failed to connect to MySQL DB: " . mysqli_connect_errno();
			}
			else
			{
				$query = "SELECT username,password FROM `login` WHERE username='$username' AND password='$passwd'";
				$result = mysqli_query($con,$query);
				mysqli_close($con);

				if(!$result || mysqli_num_rows($result) <= 0)
				{
					header("Location: index.php");
					#echo "<br>Error - Login failed<br>";
				}
				else
				{
					header("Location: welcome.php");
					#echo "<br>";
					#echo "login accepted!";
					#echo "<br>";
				}
			}
		?>
	</body>
</html>
