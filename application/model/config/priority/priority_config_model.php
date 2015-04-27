<?php
require_once('../../../globals.php');
require APP . 'model\config\Ref_Config_Base_Model.php';

class Priority_Config_Model Extends Ref_Config_Base_Model
{
    public function __construct()
    {
        parent::__construct( 'StPriConf', 'priority', 'name' );
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
        $this->query_DeletePriority->execute( 
                array( ':priority'              => $old 
                     , ':last_mdfd_user'        => getCurrentUserName()
                     ) 
            );
    }

	public function updatePriority( $priority, $name )
	{
		$this->query_UpdatePriority->execute( 
                array( ':priority'              => $priority
                     , ':name'                  => $name
                     , ':last_mdfd_user'        => getCurrentUserName()
                     ) 
            );
	}

	public function addPriority( $name )
	{
		$this->query_AddPriority->execute( 
                array( ':name'                  => $name
                     , ':last_mdfd_user'        => getCurrentUserName()
                     ) 
            );
	}

	public function getPriority( $priority )
	{
		$this->query_GetPriority->execute( 
                array( ':priority'              => $priority
                     ) 
            );
		return $this->query_GetPriority->fetch();
	}

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
