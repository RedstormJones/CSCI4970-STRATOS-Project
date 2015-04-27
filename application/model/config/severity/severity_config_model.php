<?php
require_once('../../../globals.php');
require APP . 'model\config\Ref_Config_Base_Model.php';

class Severity_Config_Model Extends Ref_Config_Base_Model
{
    public function __construct()
    {
        parent::__construct( 'StSvrLvlConf', 'severity', 'name' );
    }

    protected function updateReferences( $old, $new )
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
                         , ':last_mdfd_user'    => getCurrentUserName()
                         )
                );
        }
    }

    protected function deleteReferences( $old )
    {
        $this->query_DeletePriMtxReferences->execute( 
                array( ':old'                   => $old 
                     , ':last_mdfd_user'        => getCurrentUserName()
                     ) 
            );
    }

    protected function deleteConfig( $old )
    {
        $this->query_DeleteSeverity->execute( 
                array( ':severity'              => $old 
                     , ':last_mdfd_user'        => getCurrentUserName()
                     ) 
            );
    }

	public function updateSeverity( $severity, $name )
	{
		$this->query_UpdateSeverity->execute( 
                array( ':severity'              => $severity
                     , ':name'                  => $name
                     , ':last_mdfd_user'        => getCurrentUserName()
                     ) 
            );
	}

	public function addSeverity( $name )
	{
		$this->query_AddSeverity->execute( 
                array( ':name'                  => $name
                     , ':last_mdfd_user'        => getCurrentUserName()
                     ) 
            );
	}

	public function getSeverity( $severity )
	{
		$this->query_GetSeverity->execute( 
                array( ':severity'              => $severity
                     ) 
            );
		return $this->query_GetSeverity->fetch();
	}

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
