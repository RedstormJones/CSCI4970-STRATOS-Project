<?php
require APP . 'model\config\Ref_Config_Base_Model.php';

class Category_Config_Model Extends Ref_Config_Base_Model
{
    public function __construct()
    {
        parent::__construct( 'StCatgConf', 'cid', 'name' );
    }
   
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

    protected function deleteConfig( $old, $user )
    {
        $this->query_DeleteCategory->execute( 
                array( ':cid'                   => $old 
                     , ':last_mdfd_user'        => $user
                     ) 
            );
    }

	public function updateCategory( $cid, $name, $user )
	{
		$this->query_UpdateCategory->execute( 
                array( ':cid'                   => $cid
                     , ':name'                  => $name
                     , ':last_mdfd_user'        => $user
                     ) 
            );
	}

	public function addCategory( $name, $user )
	{
		$this->query_AddCategory->execute( 
                array( ':name'                  => $name
                     , ':last_mdfd_user'        => $user
                     ) 
            );
	}

	public function getCategory( $cid )
	{
		$this->query_GetCategory->execute( 
                array( ':cid'                   => $cid
                     ) 
            );
		return $this->query_GetCategory->fetch();
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
                `catg` = :old";
        $this->query_GetAffectedTickets = $this->db->prepare( $this->sql_GetAffectedTickets );

        $this->sql_UpdateTicketReferences = "
            UPDATE
                `StTktInst`
            SET
                `catg` = :new
              , `last_open_time` = :last_open_time
              , `last_mdfd_user` = :last_mdfd_user
            WHERE
                `tid` = :tid";
        $this->query_UpdateTicketReferences = $this->db->prepare( $this->sql_UpdateTicketReferences );

        $this->sql_DeleteCategory = "
            UPDATE
                `StCatgConf`
            SET
                `logl_del` = TRUE
              , `last_mdfd_user` = :last_mdfd_user
            WHERE
                `cid` = :cid";
		$this->query_DeleteCategory = $this->db->prepare( $this->sql_DeleteCategory );

		$this->sql_UpdateCategory = "
            UPDATE
				`StCatgConf`
			SET
				`name` = :name
			  , `last_mdfd_user` = :last_mdfd_user
              , `logl_del` = FALSE
            WHERE
				`cid` = :cid;";
		$this->query_UpdateCategory = $this->db->prepare( $this->sql_UpdateCategory );

		$this->sql_AddCategory = "
			INSERT INTO
				`StCatgConf`
				( `name`
				, `last_mdfd_user`
				)
				VALUES
				(
				  :name
				, :last_mdfd_user
				)";
        $this->query_AddCategory = $this->db->prepare( $this->sql_AddCategory );

		$this->sql_GetCategory = "
			SELECT
				*
			FROM
				`StCatgConf`
			WHERE
				`cid` = :cid";
        $this->query_GetCategory = $this->db->prepare( $this->sql_GetCategory );
    }
}

?>
