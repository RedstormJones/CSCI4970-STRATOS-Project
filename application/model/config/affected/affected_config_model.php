<?php
require APP . 'model\config\Ref_Config_Base_Model.php';

class Affected_Config_Model Extends Ref_Config_Base_Model
{
    public function __construct()
    {
        parent::__construct( 'StAffLvlConf' );
    }

	/**
	* Update the Affected Level drop down menu that display on the add or update ticket form on the ticket page 
	*
	* @param $old : String ( the current Affected Level)
	* @param $new : String ( the new Affected Level value)
	* @param $user : String ( hold the name of the current logged in user)
	*/
    protected function updateReferences( $old, $new, $user )
    {
        $this->query_GetAffectedTickets->execute( array( ':old' => $old ) );
        $affectedTickets = $this->query_GetAffectedTickets->fetchAll();

        foreach ( $affectedTickets as $ticket )
        {
            $last_open_time = $this->GetUpdatedTicketTime( $ticket );
            $this->query_UpdateTicketReferences->execute( 
                    array( ':tid'               => $ticket->tid
                         , ':new'               => $new
                         , ':last_open_time'    => $last_open_time
                         , ':last_mdfd_user'    => $user
                         )
                );
        }
    }

	/**
	* Delete the Affected Level reference that display on the priority matrices page
	*
	* @param $old : String ( hold the value of the selected Affected Level)
	* @param $user : string ( hold the name of the user who commit the deletion) 
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
	* Delete the selected Affected Level
	*
	* @param $old : String ( hold the name of the selected Affected Level)
	* @param $user : string ( hold the name of the user who commit the deletion) 
	*/
    protected function deleteConfig( $old, $user )
    {
        $this->query_DeleteAffected->execute( 
                array( ':aff_level'             => $old 
                     , ':last_mdfd_user'        => $user
                     ) 
            );
    }
	
	/**
	* Update the selected Affected Level
	*
	* @param $aff_level : Integer ( hold the selected Affected Level number )
	* @param $name : String ( hold the name of the Affected Level)
	* @param $user : string ( hold the name of the user who commit the update) 
	*/
	public function updateAffected( $aff_level, $name, $user )
	{
		$this->query_UpdateAffected->execute( 
                array( ':aff_level'             => $aff_level
                     , ':name'                  => $name
                     , ':last_mdfd_user'        => $user
                     ) 
            );
	}


	/**
	* Add a new Affected Level
	*
	* @param $name : String ( hold the name of the Affected Level)
	* @param $user : string ( hold the name of the user who commit the add) 
	*/
	public function addAffected( $name, $user )
	{
		$this->query_AddAffected->execute( 
                array( ':name'                  => $name
                     , ':last_mdfd_user'        => $user
                     ) 
            );
	}
	
	/**
	* return the Affected Level number
	*
	* @param $aff_level : Integer ( hold the Affected Level number)
	* 
	* return the Affected Level number
	*/
	public function getAffected( $aff_level )
	{
		$this->query_GetAffected->execute( 
                array( ':aff_level'             => $aff_level
                     ) 
            );
		return $this->query_GetAffected->fetch();
	}

	/**
	* Database Queries
	* Find affected level, update ticket reference, Delete Priority Matrix References
	* Delete, update, and add affected level 
	* return affected level number
	*/
    protected function SetUpQueries()
    {
        parent::SetUpQueries();

        $this->sql_GetAffectedTickets = "
            SELECT
                `tid`, `life_cycl_id`, `last_open_time`, `logl_del`, `last_mdfd_tmst`
            FROM
                `StTktInst`
            WHERE
                `aff_level` = :old";
        $this->query_GetAffectedTickets = $this->db->prepare( $this->sql_GetAffectedTickets );

        $this->sql_UpdateTicketReferences = "
            UPDATE
                `StTktInst`
            SET
                `aff_level` = :new
              , `last_open_time` = :last_open_time
              , `last_mdfd_user` = :last_mdfd_user
            WHERE
                `tid` = :tid";
        $this->query_UpdateTicketReferences = $this->db->prepare( $this->sql_UpdateTicketReferences );

        $this->sql_DeletePriMtxReferences = "
            UPDATE
                `StPriMtxConf`
            SET
                `logl_del` = TRUE
              , `last_mdfd_user` = :last_mdfd_user
            WHERE
                `aff_level` = :old";
        $this->query_DeletePriMtxReferences = $this->db->prepare( $this->sql_DeletePriMtxReferences );

        $this->sql_DeleteAffected = "
            UPDATE
                `StAffLvlConf`
            SET
                `logl_del` = TRUE
              , `last_mdfd_user` = :last_mdfd_user
            WHERE
                `aff_level` = :aff_level";
		$this->query_DeleteAffected = $this->db->prepare( $this->sql_DeleteAffected );

		$this->sql_UpdateAffected = "
            UPDATE
				`StAffLvlConf`
			SET
				`name` = :name
			  , `last_mdfd_user` = :last_mdfd_user
              , `logl_del` = FALSE
            WHERE
				`aff_level` = :aff_level;";
		$this->query_UpdateAffected = $this->db->prepare( $this->sql_UpdateAffected );

		$this->sql_AddAffected = "
			INSERT INTO
				`StAffLvlConf`
				( `name`
				, `last_mdfd_user`
				)
				VALUES
				(
				  :name
				, :last_mdfd_user
				)";
        $this->query_AddAffected = $this->db->prepare( $this->sql_AddAffected );

		$this->sql_GetAffected = "
			SELECT
				*
			FROM
				`StAffLvlConf`
			WHERE
				`aff_level` = :aff_level";
        $this->query_GetAffected = $this->db->prepare( $this->sql_GetAffected );
    }
}

?>