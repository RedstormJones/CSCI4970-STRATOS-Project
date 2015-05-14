<?php
require APP . 'model\config\Ref_Config_Base_Model.php';

class Category_Config_Model extends Ref_Config_Base_Model
{
    public function __construct()
    {
        parent::__construct( 'StCatgConf' );
    }
   
   /**
	* Update the Category drop down menu that display on the add or update ticket form on the ticket page
	*
	* @param $old : String ( the current Category value)
	* @param $new : String ( the new Category value)
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
	* Delete the selected Category
	*
	* @param $old : String ( hold the name of the selected Category)
	* @param $user : string ( hold the name of the user who commit the deletion) 
	*/
    protected function deleteConfig( $old, $user )
    {
        $this->query_DeleteCategory->execute( 
                array( ':cid'                   => $old 
                     , ':last_mdfd_user'        => $user
                     ) 
            );
    }


	/**
	* Update the selected Category
	*
	* @param $cid : Integer ( hold Category number)
	* @param $name : String ( hold the name of the selected Category)
	* @param $user : string ( hold the name of the user who commit the update) 
	*/
	public function updateCategory( $cid, $name, $user )
	{
		$this->query_UpdateCategory->execute( 
                array( ':cid'                   => $cid
                     , ':name'                  => $name
                     , ':last_mdfd_user'        => $user
                     ) 
            );
	}

	/**
	* Add a new Category
	*
	* @param $name : String ( hold the name of the Category )
	* @param $user : string ( hold the name of the user who commit the add) 
	*/
	public function addCategory( $name, $user )
	{
		$this->query_AddCategory->execute( 
                array( ':name'                  => $name
                     , ':last_mdfd_user'        => $user
                     ) 
            );
	}

	/**
	* return the Category number
	*
	* @param $cid : Integer ( hold the Category number)
	* 
	* return the Category number
	*/
	public function getCategory( $cid )
	{
		$this->query_GetCategory->execute( 
                array( ':cid'                   => $cid
                     ) 
            );
		return $this->query_GetCategory->fetch();
	}

	/**
	* Database Queries
	* Find affected level, update ticket reference
	* Delete, update, and add Category
	* return Category number
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
