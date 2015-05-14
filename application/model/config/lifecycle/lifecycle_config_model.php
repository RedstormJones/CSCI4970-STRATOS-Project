<?php
require APP . 'model\config\Ref_Config_Base_Model.php';

class Lifecycle_Config_Model Extends Ref_Config_Base_Model
{
    public function __construct()
    {
        parent::__construct( 'StLfeCyclConf' );
    }

<<<<<<< HEAD
	/**
	* Update the Life Cycle drop down menu that display on the add or update ticket form on the ticket page
	*
	* @param $old : String ( hold the current Life Cycle value)
	* @param $new : String ( the new Life Cycle value)
	* @param $user : String ( hold the name of the current logged in user)
	*/
=======
>>>>>>> origin/dev
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

<<<<<<< HEAD
	/**
	* Delete the selected Life Cycle
	*
	* @param $old : String ( hold the name of the selceted Life Cycle)
	* @param $user : string ( hold the name of the user who commit the deletion) 
	*/
=======
>>>>>>> origin/dev
    protected function deleteConfig( $old, $user )
    {
        $this->query_DeleteLifecycle->execute( 
                array( ':life_cycl_id'          => $old 
                     , ':last_mdfd_user'        => $user
                     ) 
            );
    }

<<<<<<< HEAD
	/**
	* Update the selected Life Cycle
	*
	* @param $life_cycl_id : Integer ( hold Life Cycle number)
	* @param $name : String ( hold the name of the selected Life Cycle)
	* @param $is_timed : Integer ( hold the value if the Life Cycle is timed or not: 1 timed / 0 not timed)
	* @param $user : string ( hold the name of the user who commit the update) 
	*/
=======
>>>>>>> origin/dev
	public function updateLifecycle( $life_cycl_id, $name, $is_timed, $user )
	{
		$this->query_UpdateLifecycle->execute( 
                array( ':life_cycl_id'          => $life_cycl_id
                     , ':name'                  => $name
                     , ':is_timed'              => $is_timed
                     , ':last_mdfd_user'        => $user
                     ) 
            );
	}

<<<<<<< HEAD
	/**
	* Add a new Life Cycle
	*
	* @param $name : String ( hold the name of the Life Cycle )
	* @param $is_timed : Integer ( hold the value if the Life Cycle is timed or not: 1 timed / 0 not timed)	
	* @param $user : string ( hold the name of the user who commit the add) 
	*/
=======
>>>>>>> origin/dev
	public function addLifecycle( $name, $is_timed, $user )
	{
		$this->query_AddLifecycle->execute( 
                array( ':name'                  => $name
                     , ':is_timed'              => $is_timed
                     , ':last_mdfd_user'        => $user
                     ) 
            );
	}

	/**
	* return the Life Cycle
	*
	* @param $life_cycl_id : Integer ( hold the Life Cycle number)
	* 
	* return the Life Cycle number
	*/
	public function getLifecycle( $life_cycl_id )
	{
		$this->query_GetLifecycle->execute( 
                array( ':life_cycl_id'          => $life_cycl_id
                     ) 
            );
		return $this->query_GetLifecycle->fetch();
	}

	/**
	* Database Queries
	* Find affected level, update ticket reference
	* Delete, update, and add Life Cycle
	* return Life Cycle number
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
