<?php
require_once('../../../globals.php');
require APP . 'model\config\Ref_Config_Base_Model.php';

class Affected_Config_Model Extends Ref_Config_Base_Model
{
    public function __construct()
    {
        parent::__construct( 'StAffLvlConf', 'aff_level', 'name' );
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
        $this->query_DeleteAffected->execute( 
                array( ':aff_level'             => $old 
                     , ':last_mdfd_user'        => getCurrentUserName()
                     ) 
            );
    }

	public function updateAffected( $aff_level, $name )
	{
		$this->query_UpdateAffected->execute( 
                array( ':aff_level'             => $aff_level
                     , ':name'                  => $name
                     , ':last_mdfd_user'        => getCurrentUserName()
                     ) 
            );
	}

	public function addAffected( $name )
	{
		$this->query_AddAffected->execute( 
                array( ':name'                  => $name
                     , ':last_mdfd_user'        => getCurrentUserName()
                     ) 
            );
	}

	public function getAffected( $aff_level )
	{
		$this->query_GetAffected->execute( 
                array( ':aff_level'             => $aff_level
                     ) 
            );
		return $this->query_GetAffected->fetch();
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