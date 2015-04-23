<?php
require_once('../../../globals.php');
require APP . 'model\Base_Model.php';

class Ref_Config_Base_Model Extends Base_Model
{
	public function __construct( $table
				   , $prikey_col
				   , $label_col
				   , $references_to_change
				   , $references_to_delete
				   , $affects_tickets )
	{
		parent::__construct();

		$this->table                    = $table;
		$this->prikey_col               = $prikey_col;
		$this->label_col                = $label_col;
		$this->affects_tickets          = $affects_tickets;

		$this->arr_QueryUpdateReferences = array();
		foreach ( $references_to_change as $reference )
		{
			$ref_table                  = $reference[0];
			$ref_column                 = $reference[1];
			$sql                        = "UPDATE " . $ref_table . " SET " . $ref_column . " = :new WHERE " . $ref_column . " = :old;";
			$query                      = $this->db->prepare( $sql );
	
			$this->arr_QueryUpdateReferences[] = $query;
		}
	
		$this->arr_QueryDeleteReferences = array();
		foreach ( $references_to_delete as $reference )
		{
			$ref_table                  = $reference[0];
			$ref_column                 = $reference[1];
			$sql                        = "UPDATE " . $ref_table . " SET logl_del = TRUE WHERE " . $ref_column . " = :old;";
			$query                      = $this->db->prepare( $sql );
	
			$this->arr_QueryDeleteReferences[] = $query;
		}
	
		$this->sql_DeleteConfig = "UPDATE " . $table . " SET logl_del = TRUE WHERE " . $prikey_col . " = :key;";
		$this->query_DeleteConfig = $this->db->prepare($this->sql_DeleteConfig);
	
		$this->sql_SelectFormElements = "SELECT " . $prikey_col . " , " . $label_col . " FROM " . $table . " WHERE logl_del = FALSE";
		$this->query_SelectFormElements = $this->db->prepare($this->sql_SelectFormElements);
	}
	
	public function reassignAndDelete( $old, $new )
	{
		foreach( $this->arr_QueryUpdateReferences as $query )
		{
			$query->execute(
				array( ':old'               => $old
				     , ':new'               => $new
				     )
			);
		}
	
		foreach( $this->arr_QueryDeleteReferences as $query )
		{
			$query->execute(
				array( ':old' => $old )
			);
		}
	
		$this->query_DeleteConfig->execute(
			array( ':key' => $old )
		);
	}
	
	public function queryForm()
	{
		$this->query_SelectFormElements->execute();
		return $this->query_SelectFormElements->fetchAll();
	}
}

?>
