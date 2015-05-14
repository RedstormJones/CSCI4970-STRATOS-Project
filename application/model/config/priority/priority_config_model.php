<?php
require APP . 'model\config\Ref_Config_Base_Model.php';

class Priority_Config_Model Extends Ref_Config_Base_Model
{
    public function __construct()
    {
        parent::__construct( 'StPriConf' );
    }

	/**
	* Update the priority matrix drop down menu that display on the add or update of priority matrix form on the priority matrix page
	*
	* @param $old : String ( the current priority matrix value)
	* @param $user : String ( hold the name of the current logged in user)
	*/
    protected function deleteReferences( $old, $user )
    {
        $this->query_DeletePriMtxReferences->execute( 
                array( ':old'                   => $old 
                     , ':last_mdfd_user'        => $user
                     ) 
            );
    }

	/**
	* Delete the selected Priority
	*
	* @param $old : String ( hold the name of the selected Priority)
	* @param $user : string ( hold the name of the user who commit the deletion) 
	*/
    protected function deleteConfig( $old, $user )
    {
        $this->query_DeletePriority->execute( 
                array( ':priority'              => $old 
                     , ':last_mdfd_user'        => $user
                     ) 
            );
    }


	/**
	* Update the selected Priority
	*
	* @param $life_cycl_id : Integer ( hold the selected Life Priority number)
	* @param $name : String ( hold the selected name of the Priority)
	* @param $user : string ( hold the name of the user who commit the update) 
	*/
	public function updatePriority( $priority, $name, $user )
	{
		$this->query_UpdatePriority->execute( 
                array( ':priority'              => $priority
                     , ':name'                  => $name
                     , ':last_mdfd_user'        => $user
                     ) 
            );
	}


	/**
	* Add a new Priority
	*
	* @param $name : String ( hold the name of the Priority )
	* @param $user : string ( hold the name of the user who commit the add) 
	*/
	public function addPriority( $name, $user )
	{
		$this->query_AddPriority->execute( 
                array( ':name'                  => $name
                     , ':last_mdfd_user'        => $user
                     ) 
            );
	}

	/**
	* return the Priority
	*
	* @param $priority : Integer ( hold the Priority number)
	* 
	* return the Priority number
	*/
	public function getPriority( $priority )
	{
		$this->query_GetPriority->execute( 
                array( ':priority'              => $priority
                     ) 
            );
		return $this->query_GetPriority->fetch();
	}

	/**
	* Database Queries
	* Delete Priority Matrix references 
	* Delete, update, and add Priority 
	* return Priority number
	*/
    protected function SetUpQueries()
    {
        parent::SetUpQueries();

        $this->sql_DeletePriMtxReferences = "
            UPDATE
                `StPriMtxConf`
            SET
                `logl_del` = TRUE
              , `last_mdfd_user` = :last_mdfd_user
            WHERE
                `priority` = :old";
        $this->query_DeletePriMtxReferences = $this->db->prepare( $this->sql_DeletePriMtxReferences );

        $this->sql_DeletePriority = "
            UPDATE
                `StPriConf`
            SET
                `logl_del` = TRUE
              , `last_mdfd_user` = :last_mdfd_user
            WHERE
                `priority` = :priority";
		$this->query_DeletePriority = $this->db->prepare( $this->sql_DeletePriority );

		$this->sql_UpdatePriority = "
            UPDATE
				`StPriConf`
			SET
				`name` = :name
			  , `last_mdfd_user` = :last_mdfd_user
              , `logl_del` = FALSE
            WHERE
				`priority` = :priority;";
		$this->query_UpdatePriority = $this->db->prepare( $this->sql_UpdatePriority );

		$this->sql_AddPriorrty = "
			INSERT INTO
				`StPriConf`
				( `name`
				, `last_mdfd_user`
				)
				VALUES
				(
				  :name
				, :last_mdfd_user
				)";
        $this->query_AddPriority = $this->db->prepare( $this->sql_AddPriorrty );

		$this->sql_GetPriority = "
			SELECT
				*
			FROM
				`StPriConf`
			WHERE
				`priority` = :priority";
        $this->query_GetPriority = $this->db->prepare( $this->sql_GetPriority );
    }
}

?>
