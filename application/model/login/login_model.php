<?php
require_once('../../globals.php');
require APP . 'model\Base_Model.php';


class Login_Model Extends Base_Model
{
	public function __construct()
	{
		parent::__construct();
		// Here:
		//$sql = "SELECT user,pass FROM `stuserinst` WHERE user=:user AND pass=:pwd";
		$sql = "SELECT stprsninst.pid FROM `stuserinst` INNER JOIN `stprsninst` ON stuserinst.pid = stprsninst.pid WHERE user=:user AND pass=:pwd";
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
		
		if ( count($result) == 0 ) return null;
		return $result[0]->pid;
	}
}

?>