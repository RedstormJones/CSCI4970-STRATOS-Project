<?php
require APP . 'model\Base_Model.php';

class Login_Model Extends Base_Model
{

	/**
	* Check the user username and password 
	* if the user exist in the database, it return the user pid number 
	* else the user does not exist in the database 
	*  and the system will refresh the page
	* 
	* @param $user : String ( hold the user's name )
	* @param $pwd : String ( hold the user's password )
	*/
	public function authenticate($user, $pwd)
	{
		$this->query_Authenticate->execute(
			array( ':user' 				=> $user 
				 , ':pwd'				=> $pwd
				 )
			);
		$result = $this->query_Authenticate->fetch();
		
		if ( !$result ) return null;
		return $result->pid;
	}
	/**
	* Database Query to check if the enter user name and password are exist in the database
	*
	*/
    public function SetUpQueries()
    {
        parent::SetUpQueries();
        $sql_Authenticate = "
            SELECT 
                stprsninst.pid 
            FROM 
                `stuserinst` 
            INNER JOIN 
                `stprsninst` 
            ON 
                stuserinst.pid = stprsninst.pid 
            WHERE 
                user = :user 
                AND 
                pass = :pwd";
		$this->query_Authenticate = $this->db->prepare($sql_Authenticate);
    }
}

?>