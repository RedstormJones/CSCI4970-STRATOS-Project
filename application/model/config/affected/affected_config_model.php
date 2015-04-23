<?php
require_once('../../../globals.php');
require APP . 'model\config\Ref_Config_Base_Model.php';

class Affected_Config_Model Extends Ref_Config_Base_Model
{
	public function __construct( )
	{
		parent::__construct( 'StAffLvlConf'
						   , 'aff_level'
						   , 'name'
						   , array(
									array( 'StTktInst', 'aff_level' )
								  )
						   , array(
									array( 'StPriMtxConf', 'aff_level' )
								  )
						   , true
						   );

		$this->sql_UpdateAffected =
			"UPDATE
				`StAffLvlConf`
			 SET
				`name` = :name
			  , `last_mdfd_user` = :last_mdfd_user
			 WHERE
				`aff_level` = :aff_level;";
		$this->sql_AddAffected =
			"INSERT INTO
				`StAffLvlConf`
				( `aff_level`
				, `name`
				, `last_mdfd_user`
				)
				VALUES
				(
				  :aff_level
				, :name
				, :last_mdfd_user
				);";
		$this->sql_GetAffected =
			"SELECT
				*
			 FROM
				`StAffLvlConf`
			 WHERE
				`aff_level` = :aff_level";

		$this->query_UpdateAffected  = $this->db->prepare( $this->sql_UpdateAffected );
		$this->query_AddAffected = $this->db->prepare( $this->sql_AddAffected );
		$this->query_GetAffected = $this->db->prepare( $this->sql_GetAffected );
	}

	public function updateAffected( $aff_level, $name )
	{
		return $this->query_UpdateAffected->execute(
														array( ':aff_level'		 => $aff_level
															 , ':name'			  => $name
															 , ':last_mdfd_user'	=> getCurrentUserName()
															 )
												   );
	}

	public function addAffected( $name )
	{
		$aff_level = $this->GetAndUpdateNextKey('StAffLvlConf');
		return $this->query_AddAffected->execute(
													array( ':aff_level'		 => $aff_level
														 , ':name'			  => $name
														 , ':last_mdfd_user'	=> getCurrentUserName()
														 )
												);
	}

	public function getAffected( $aff_level )
	{
		$this->query_GetAffected->execute( array( ':aff_level' => $aff_level ) );
		return $this->query_GetAffected->fetch();
	}
}

?>
