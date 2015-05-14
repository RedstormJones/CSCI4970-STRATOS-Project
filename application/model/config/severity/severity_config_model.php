<?php
require APP . 'model\config\Ref_Config_Base_Model.php';

class Severity_Config_Model Extends Ref_Config_Base_Model
{
    public function __construct()
    {
        parent::__construct( 'StSvrLvlConf' );
    }

	/**
	* Update the Severity drop down menu that display on the add or update ticket form on the ticket page 
	*
	* @param $old : String ( the selected Severity value)
	* @param $new : String ( the new Severity value)
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
	* Delete the Severity reference that display on the priority matrices page
	*
	* @param $old : String ( hold the selected value of the Severity)
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
	* Delete the selected Severity
	*
	* @param $old : String ( hold the selected name of the Severity)
	* @param $user : string ( hold the name of the user who commit the deletion) 
	*/
    protected function deleteConfig( $old, $user )
    {
        $this->query_DeleteSeverity->execute( 
                array( ':severity'              => $old 
                     , ':last_mdfd_user'        => $user
                     ) 
            );
    }

	/**
	* Update the selected Severity
	*
	* @param $severity : Integer ( hold the selected Severity number )
	* @param $name : String ( hold the selected name of the Severity)
	* @param $user : string ( hold the name of the user who commit the update) 
	*/
	public function updateSeverity( $severity, $name, $user )
	{
		$this->query_UpdateSeverity->execute( 
                array( ':severity'              => $severity
                     , ':name'                  => $name
                     , ':last_mdfd_user'        => $user
                     ) 
            );
	}

	/**
	* Add a new Severity
	*
	* @param $name : String ( hold the name of the Severity)
	* @param $user : string ( hold the name of the user who commit the addition) 
	*/
	public function addSeverity( $name, $user )
	{
		$this->query_AddSeverity->execute( 
                array( ':name'                  => $name
                     , ':last_mdfd_user'        => $user
                     ) 
            );
	}

	/**
	* return the Severity number
	*
	* @param $severity : Integer ( hold the Severity number)
	* 
	* return the Severity number
	*/
	public function getSeverity( $severity )
	{
		$this->query_GetSeverity->execute( 
                array( ':severity'              => $severity
                     ) 
            );
		return $this->query_GetSeverity->fetch();
	}

	/**
	* Database Queries
	* Find affected level, update ticket reference
	* Delete, update, and add Severities
	* return Severities number
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
                `severity` = :old";
        $this->query_GetAffectedTickets = $this->db->prepare( $this->sql_GetAffectedTickets );

        $this->sql_UpdateTicketReferences = "
            UPDATE
                `StTktInst`
            SET
                `severity` = :new
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
                `severity` = :old";
        $this->query_DeletePriMtxReferences = $this->db->prepare( $this->sql_DeletePriMtxReferences );

        $this->sql_DeleteSeverity = "
            UPDATE
                `StSvrLvlConf`
            SET
                `logl_del` = TRUE
              , `last_mdfd_user` = :last_mdfd_user
            WHERE
                `severity` = :severity";
		$this->query_DeleteSeverity = $this->db->prepare( $this->sql_DeleteSeverity );

		$this->sql_UpdateSeverity = "
            UPDATE
				`StSvrLvlConf`
			SET
				`name` = :name
			  , `last_mdfd_user` = :last_mdfd_user
              , `logl_del` = FALSE
            WHERE
				`severity` = :severity;";
		$this->query_UpdateSeverity = $this->db->prepare( $this->sql_UpdateSeverity );

		$this->sql_AddSeverity = "
			INSERT INTO
				`StSvrLvlConf`
				( `name`
				, `last_mdfd_user`
				)
				VALUES
				(
				  :name
				, :last_mdfd_user
				)";
        $this->query_AddSeverity = $this->db->prepare( $this->sql_AddSeverity );

		$this->sql_GetSeverity = "
			SELECT
				*
			FROM
				`StSvrLvlConf`
			WHERE
				`severity` = :severity";
        $this->query_GetSeverity = $this->db->prepare( $this->sql_GetSeverity );
    }
}

?>
