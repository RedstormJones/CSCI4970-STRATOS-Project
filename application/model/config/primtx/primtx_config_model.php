<?php
require APP . 'model\config\Ref_Config_Base_Model.php';

class Primtx_Config_Model Extends Ref_Config_Base_Model
{
    public function __construct()
    {
        parent::__construct( 'StPriMtxConf' );
    }

	/**
	* Delete the selected Priority Matrix
	*
	* @param $aff_level : Integer ( hold the number of the selected Affected Level)
	* @param $severity : Integer ( hold the number of the selectedSeverity)
	* @param $priority : Integer  ( hold the number of the selected Priority)
	* @param $user : string ( hold the name of the user who commit the deletion) 
	*/
    public function deletePriMtx( $aff_level, $severity, $priority, $user)
    {
        $this->query_DeletePriMtx->execute( 
                array( ':aff_level'             => $aff_level 
                     , ':severity'              => $severity
                     , ':priority'              => $priority
                     , ':last_mdfd_user'        => $user
                     ) 
            );
    }

	/**
	* Update the selected Priority Matrix
	*
	* @param $aff_level : Integer ( hold the number of the selected Affected Level)
	* @param $severity : Integer ( hold the number of the selected Severity)
	* @param $priority : Integer( hold the number of the selected Priority)
	* @param $user : string ( hold the name of the user who commit the update) 
	*/
	public function updatePriMtx( $aff_level, $severity, $priority, $user )
	{
		$this->query_UpdatePriMtx->execute( 
                array( ':aff_level'             => $aff_level 
                     , ':severity'              => $severity
                     , ':priority'              => $priority
                     , ':last_mdfd_user'        => $user
                     )  
            );
	}
	
	/**
	* Add a new Priority Matrix
	* if the Priority Matrix already exist, do not add a new one
	*
	* @param $aff_level : Integer ( hold the number of the selected Affected Level)
	* @param $severity : Integer ( hold the number of the selected Severity)
	* @param $priority : Integer ( hold the number of the selected Priority)
	* @param $user : string ( hold the name of the user who commit the add) 
	*/
	public function addPriMtx( $aff_level, $severity, $priority, $user )
	{
        $this->query_PriMtxExists->execute(
                array( ':aff_level'             => $aff_level 
                     , ':severity'              => $severity
                     )
            );
        if ( $this->query_PriMtxExists->fetch() )
        {
            $this->updatePriMtx( $aff_level, $severity, $priority, $user );
        }
        else
        {
		    $this->query_AddPriMtx->execute( 
                    array( ':aff_level'             => $aff_level 
                         , ':severity'              => $severity
                         , ':priority'              => $priority
                         , ':last_mdfd_user'        => $user
                         ) 
                );
        }
	}

	/**
	* The function will return all the Affected Level fields from the database
	* 
	* return the Affected Level
	*/
	public function getAffLevels()
	{
		$this->query_GetAffLevels->execute( 
            );
		return $this->query_GetAffLevels->fetchAll();
	}

	/**
	* The function will return all the Severities fields from the database
	* 
	* return the Severities
	*/
	public function getSeverities()
	{
		$this->query_GetSeverities->execute( 
            );
		return $this->query_GetSeverities->fetchAll();
	}

	/**
	* The function will return all the Priority fields from the database
	* 
	* return the Priority 
	*/
	public function getPriorities()
	{
		$this->query_GetPriorities->execute( 
            );
		return $this->query_GetPriorities->fetchAll();
	}
	
	/**
	* Database Queries
	* Delete, update, and add Priority Matrix
	* return the Affected Level, return the Severities, return the Priority 
	* return Priority Matrix
	*/
    protected function SetUpQueries()
    {
        parent::SetUpQueries();

        $this->sql_DeletePriMtx = "
            UPDATE
                `StPriMtxConf`
            SET
                `logl_del` = TRUE
              , `last_mdfd_user` = :last_mdfd_user
            WHERE
                `aff_level` = :aff_level
                AND `severity` = :severity
                AND `priority` = :priority";
		$this->query_DeletePriMtx = $this->db->prepare( $this->sql_DeletePriMtx );

		$this->sql_UpdatePriMtx = "
            UPDATE
				`StPriMtxConf`
			SET
                `priority` = :priority
              , `last_mdfd_user` = :last_mdfd_user
              , `logl_del` = FALSE
            WHERE
                `aff_level` = :aff_level
                AND `severity` = :severity";
		$this->query_UpdatePriMtx = $this->db->prepare( $this->sql_UpdatePriMtx );

        $this->sql_GetAffLevels = "
            SELECT
                *
            FROM
                `StAffLvlConf`
            WHERE
                logl_del = FALSE";
        $this->query_GetAffLevels = $this->db->prepare( $this->sql_GetAffLevels );

        $this->sql_GetSeverities = "
            SELECT
                *
            FROM
                `StSvrLvlConf`
            WHERE
                logl_del = FALSE";
        $this->query_GetSeverities = $this->db->prepare( $this->sql_GetSeverities );

        $this->sql_GetPriorities = "
            SELECT
                *
            FROM
                `StPriConf`
            WHERE
                logl_del = FALSE";
        $this->query_GetPriorities = $this->db->prepare( $this->sql_GetPriorities );

        $this->sql_PriMtxExists = "
            SELECT
                *
            FROM
                `StPriMtxConf`
            WHERE
                aff_level = :aff_level
                AND severity = :severity";
        $this->query_PriMtxExists = $this->db->prepare( $this->sql_PriMtxExists );

		$this->sql_AddPriMtx = "
			INSERT INTO
				`StPriMtxConf`
				( `aff_level`
                , `severity`
				, `priority`
                , `last_mdfd_user`
				)
				VALUES
				(
				  :aff_level
                , :severity
				, :priority
                , :last_mdfd_user
				)";
        $this->query_AddPriMtx = $this->db->prepare( $this->sql_AddPriMtx );

        $this->sql_SelectFormElements = "
            SELECT
                StAffLvlConf.aff_level
              , StAffLvlConf.name AS aff_name
              , StSvrLvlConf.severity
              , StSvrLvlConf.name AS severity_name
              , StPriConf.priority
              , StPriConf.name AS priority_name
            FROM
                StPriMtxConf
            INNER JOIN
                StAffLvlConf
            ON
                StAffLvlConf.aff_level = StPriMtxConf.aff_level
            INNER JOIN
                StSvrLvlConf
            ON
                StSvrLvlConf.severity = StPriMtxConf.severity
            INNER JOIN
                StPriConf
            ON
                StPriConf.priority = StPriMtxConf.priority
            WHERE
                StPriMtxConf.logl_del = FALSE
                AND StAffLvlConf.logl_del = FALSE
                AND StSvrLvlConf.logl_del = FALSE
                AND StPriConf.logl_del = FALSE";
        $this->query_SelectFormElements = $this->db->prepare( $this->sql_SelectFormElements );
    }
}

?>
