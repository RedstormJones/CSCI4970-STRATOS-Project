<?php
require_once('../../../globals.php');
require APP . 'model\Base_Model.php';

class Ref_Config_Base_Model Extends Base_Model
{
    public function __construct( $table, $prikey_col, $label_col )
    {
        $this->table = $table;
        $this->prikey_col = $prikey_col;
        $this->label_col = $label_col;

        parent::__construct();
    }

	public function reassignAndDelete( $old, $new )
	{
		$this->updateReferences( $old, $new );
        $this->deleteReferences( $old );
        $this->deleteConfig( $old );
	}
	
	public function queryForm()
	{
		$this->query_SelectFormElements->execute();
		return $this->query_SelectFormElements->fetchAll();
	}

    protected function updateReferences( $old, $new )
    {
        // Override in children as necessary
    }

    protected function deleteReferences( $old )
    {
        // Override in children as necessary
    }

    protected function deleteConfig( $old )
    {
        // Override in children as necessary
    }

    protected function SetUpQueries()
    {
        parent::SetUpQueries();
        $this->sql_SelectFormElements = "SELECT * FROM " . $this->table . " WHERE logl_del = FALSE";
	    $this->query_SelectFormElements = $this->db->prepare($this->sql_SelectFormElements);
    }
}

?>
