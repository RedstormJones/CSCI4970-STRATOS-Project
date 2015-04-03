<?php
require_once('DBconnect.php');

class LoginModel
{
	private $db;

	public function __construct()
	{
		try {
			$db = DBconnect::getInstance();
		}
		catch (PDOException $e) {
			exit('ERROR: Database connection failed');
		}
	}

	public function authenticate($user, $pwd)
	{
		echo $user . "<br>";
		echo $pwd;
		$sql = "SELECT user,pass FROM `stuserinst` WHERE user=`$user` AND pass=`$pwd`";
		$prepstmt = $this->db->prepare($sql);
		$prepstmt->execute();
		$result = $prepstmt->fetchAll();
		echo $result;
		echo "<br>";
		#return $prepstmt->fetchAll();
	}
}

?>