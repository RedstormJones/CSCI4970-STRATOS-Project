<?php

class Base_Model
{
	protected $db;

	public function __construct()
	{
		$this->db = DBconnect::getInstance();

		$this->sql_GetNextKey = "
			SELECT
				`key`
			FROM 
				`StNxtPriKeyInst`
			WHERE
				`table` = :table;";
		$this->query_GetNextKey = $this->db->prepare($this->sql_GetNextKey);

		$this->sql_SetNextKey = "
			UPDATE
				`StNxtPriKeyInst`
			SET
				`key` = :key
			WHERE
				`table` = :table;";
		$this->query_SetNextKey = $this->db->prepare($this->sql_SetNextKey);
	}

	public function GetAndUpdateNextKey( $table )
	{
		$this->query_GetNextKey->execute( array( ':table' => $table ) );
		$result = $this->query_GetNextKey->fetchAll();

		$key = $result[0]->key;

		$this->query_SetNextKey->execute( array( ':table' => $table, ':key' => ($key+1) ) );
		return $key;
	}
}

?>
