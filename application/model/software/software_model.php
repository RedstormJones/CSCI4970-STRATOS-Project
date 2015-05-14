<?php
require APP . 'model\Base_Model.php';

class Software_Model Extends Base_Model
{
	/**
	* Collect all software information from the software table 
	* 
	* @param $start : String ( hold the table information)
	*/
    public function showAllSoftware($start)
    {
        $this->query_ShowAllSoftware->bindParam(':start',$start,PDO::PARAM_INT);
        $this->query_ShowAllSoftware->execute();
        return $this->query_ShowAllSoftware->fetchAll();
    }
    
	/**
	* Collect specific software information from the database using the software number
	* 
	* @param $sid : Integer ( hold the software number)
	*/
    public function getSoftware( $sid )
    {
        $this->query_GetSoftware->execute( array( ':sid' => $sid ) );
        return $this->query_GetSoftware->fetch();
    }

<<<<<<< HEAD
	/**
	* Add a new software to the database
	* 
	* @param $name : String ( hold the software's name)
	* @param $user : String ( hold the name of the user who commit the addition) 
	*/
=======
>>>>>>> origin/dev
    public function addSoftware($name, $user)
    {
        $this->query_InsertSoftware->execute(
            array( ':name'              => $name
                 , ':last_mdfd_user'    => $user
                 )
        );
    }
    
<<<<<<< HEAD
	/**
	* delete a software from the database
	* 
	* @param $sid : Integer ( hold the software's number)
	* @param $user : String ( hold the name of the user who commit the deletion) 
	*/
=======
>>>>>>> origin/dev
    public function deleteSoftware( $sid, $user )
    {
        $this->query_DeleteSoftware->execute( 
            array( ":sid"               => $sid 
                 , ":last_mdfd_user"    => $user
                 )             
        );
    }
    
<<<<<<< HEAD
	/**
	* Update a software information to the database
	* 
	* @param $sid : Integer ( hold the software number)
	* @param $name : String ( hold the software name)
	* @param $user : String ( hold the name of the user who commit the update) 
	*/
=======
>>>>>>> origin/dev
    public function updateSoftware( $sid, $name, $user)
    {
        $this->query_UpdateSoftware->execute(
            array( ':sid'               => $sid
                 , ':name'              => $name
                 , ':last_mdfd_user'    => $user
                 )
        );
    }

	/**
	* Database Queries
	* Display software
	* Delete, update, and add software
	*/
    protected function SetUpQueries()
    {
        parent::SetUpQueries();
        $this->sql_ShowAllSoftware = "
            SELECT
                `sid`
              , `name`
              , `last_mdfd_user`
              , `last_mdfd_tmst`
            FROM
                `StSftInst`
            WHERE
                `logl_del` = FALSE
            LIMIT
                 :start, 10";
        $this->query_ShowAllSoftware = $this->db->prepare($this->sql_ShowAllSoftware);

        $this->sql_InsertSoftware = "
            INSERT INTO 
                `StSftInst` 
                ( `name`
                , `last_mdfd_user`
                ) 
                VALUES 
                ( :name
                , :last_mdfd_user
                )";
        $this->query_InsertSoftware = $this->db->prepare($this->sql_InsertSoftware);

        $this->sql_GetSoftware ="
             SELECT
                *
             FROM
                `StSftInst`
             WHERE
                sid = :sid";
        $this->query_GetSoftware = $this->db->prepare($this->sql_GetSoftware);

        $this->sql_UpdateSoftware = "
            UPDATE
                `StSftInst`
            SET
                `name` = :name
              , `last_mdfd_user` = :last_mdfd_user
            WHERE
                `sid` = :sid";
        $this->query_UpdateSoftware = $this->db->prepare($this->sql_UpdateSoftware);

        $this->sql_DeleteSoftware = "
            UPDATE
                `StSftInst`
            SET
                `logl_del` = TRUE
              , `last_mdfd_user` = :last_mdfd_user
            WHERE
                `sid` = :sid";
        $this->query_DeleteSoftware = $this->db->prepare($this->sql_DeleteSoftware);                
    }
}
?>