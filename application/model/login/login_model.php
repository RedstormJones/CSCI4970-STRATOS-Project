<?php
require_once('../../globals.php');
require APP . 'model\Base_Model.php';


class Login_Model Extends Base_Model
{
	public function __construct()
	{
		parent::__construct();
		$sql = "SELECT user,pass FROM `stuserinst` WHERE user=:user AND pass=:pwd";
		$this->query = $this->db->prepare($sql);
	}

	public function authenticate($user, $pwd)
	{
		$this->query->execute(
			array( ':user' 				=> $user 
				 , ':pwd'				=> $pwd
				 )
			);
		$result = $this->query->fetchAll();
		if ( count($result) == 0 ) return false;
		return true;
	}
}

?>