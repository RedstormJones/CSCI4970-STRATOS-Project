<?php
require_once('../../../globals.php');
require APP . 'model\config\Ref_Config_Base_Model.php';

class Lifecycle_Config_Model Extends Ref_Config_Base_Model
{
    public function __construct()
    {
        parent::__construct( 'StLfeCyclConf', 'life_cycl_id', 'name' );
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

    protected function deleteConfig( $old )
    {
        $this->query_DeleteLifecycle->execute( 
                array( ':life_cycl_id'          => $old 
                     , ':last_mdfd_user'        => getCurrentUserName()
                     ) 
            );
    }

	public function updateLifecycle( $life_cycl_id, $name, $is_timed )
	{
		$this->query_UpdateLifecycle->execute( 
                array( ':life_cycl_id'          => $life_cycl_id
                     , ':name'                  => $name
                     , ':is_timed'              => $is_timed
                     , ':last_mdfd_user'        => getCurrentUserName()
                     ) 
            );
	}

	public function addLifecycle( $name, $is_timed )
	{
		$this->query_AddLifecycle->execute( 
                array( ':name'                  => $name
                     , ':is_timed'              => $is_timed
                     , ':last_mdfd_user'        => getCurrentUserName()
                     ) 
            );
	}

	public function getLifecycle( $life_cycl_id )
	{
		$this->query_GetLifecycle->execute( 
                array( ':life_cycl_id'          => $life_cycl_id
                     ) 
            );
		return $this->query_GetLifecycle->fetch();
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
                `life_cycl_id` = :old";
        $this->query_GetAffectedTickets = $this->db->prepare( $this->sql_GetAffectedTickets );

        $this->sql_UpdateTicketReferences = "
            UPDATE
                `StTktInst`
            SET
                `life_cycl_id` = :new
              , `last_open_time` = :last_open_time
              , `last_mdfd_user` = :last_mdfd_user
            WHERE
                `tid` = :tid";
        $this->query_UpdateTicketReferences = $this->db->prepare( $this->sql_UpdateTicketReferences );

        $this->sql_DeleteLifecycle = "
            UPDATE
                `StLfeCyclConf`
            SET
                `logl_del` = TRUE
              , `last_mdfd_user` = :last_mdfd_user
            WHERE
                `life_cycl_id` = :life_cycl_id";
		$this->query_DeleteLifecycle = $this->db->prepare( $this->sql_DeleteLifecycle );

		$this->sql_UpdateLifecycle = "
            UPDATE
				`StLfeCyclConf`
			SET
				`name` = :name
			  , `is_timed` = :is_timed
              , `last_mdfd_user` = :last_mdfd_user
              , `logl_del` = FALSE
            WHERE
				`life_cycl_id` = :life_cycl_id;";
		$this->query_UpdateLifecycle = $this->db->prepare( $this->sql_UpdateLifecycle );

		$this->sql_AddLifecycle = "
			INSERT INTO
				`StLfeCyclConf`
				( `name`
                , `is_timed`
				, `last_mdfd_user`
				)
				VALUES
				(
				  :name
                , :is_timed
				, :last_mdfd_user
				)";
        $this->query_AddLifecycle = $this->db->prepare( $this->sql_AddLifecycle );

		$this->sql_GetLifecycle = "
			SELECT
				*
			FROM
				`StLfeCyclConf`
			WHERE
				`life_cycl_id` = :life_cycl_id";
        $this->query_GetLifecycle = $this->db->prepare( $this->sql_GetLifecycle );
    }
}

?>
