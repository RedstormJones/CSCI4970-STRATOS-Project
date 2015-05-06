<?php
require APP . 'model\Base_Model.php';

class Ref_Config_Base_Model Extends Base_Model
{
    public function __construct( $table )
    {
        $this->table = $table;
        
        parent::__construct();
    }

	public function reassignAndDelete( $old, $new, $user )
	{
		$this->updateReferences( $old, $new, $user );
        $this->deleteReferences( $old, $user );
        $this->deleteConfig( $old, $user );
	}
	
	public function queryForm()
	{
		$this->query_SelectFormElements->execute();
		return $this->query_SelectFormElements->fetchAll();
	}

    protected function updateReferences( $old, $new, $user )
    {
        // Override in children as necessary
    }

    protected function deleteReferences( $old, $user )
    {
        // Override in children as necessary
    }

    protected function deleteConfig( $old, $user )
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
