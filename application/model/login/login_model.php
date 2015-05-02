<?php
require APP . 'model\Base_Model.php';

class Login_Model Extends Base_Model
{
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