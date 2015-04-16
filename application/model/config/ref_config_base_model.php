<?php
require_once('../../../globals.php');
require APP . 'model\Base_Model.php';

class Ref_Config_Base_Model Extends Base_Model
{
    public function __construct( $table, $prikey_col, $label_col, $references )
    {
		parent::__construct();

        $this->table                    = $table;
        $this->prikey_col               = $prikey_col;
        $this->label_col                = $label_col;

        $this->arr_QueryUpdateReferences = array();
        foreach ( $references as $reference )
        {
            $ref_table                  = $reference[0];
            $ref_column                 = $reference[1];
            $sql                        = "UPDATE " . $ref_table . " SET " . $ref_column . " = :new WHERE " . $ref_column . " = :old;";
            $query                      = $this->db->prepare( $sql );

            $this->arr_QueryUpdateReferences[] = $query;
        }

        $this->sql_DeleteConfig = "DELETE FROM " . $table . " WHERE " . $prikey_col . " = :key;";
        $this->query_DeleteConfig = $this->db->prepare($this->sql_DeleteConfig);

        $this->sql_SelectFormElements = "SELECT " . $prikey_col . " , " . $label_col . " FROM " . $table;
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

        $this->query_DeleteConfig->execute(
            array( ':key'               => $old )
        );
    }

    public function queryForm()
    {
        $this->query_SelectFormElements->execute();

        return $this->query_SelectFormElements->fetchAll();
    }
}

?>
