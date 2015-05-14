<?php
require APP . 'model\Base_Model.php';

class Ref_Config_Base_Model extends Base_Model
{

	/**
	* Collect the value from the Affected Level, Category, Priority, or Severity database tables
	* 
	* @param $table : String ( hold the table data) 
	*/
    public function __construct( $table )
    {
        $this->table = $table;
        
        parent::__construct();
    }

    /**
     * Reassign and deletes the old configuration
     * 
     * @param $old : (Holds the old confuration)
     * @param $new : (Holds the new configuration)
     * @param $user : (Holds the user information)
     */
	public function reassignAndDelete( $old, $new, $user )
	{
		$this->updateReferences( $old, $new, $user );
        $this->deleteReferences( $old, $user );
        $this->deleteConfig( $old, $user );
	}
	
	/**
	* execute the query
	*/
	public function queryForm()
	{
		$this->query_SelectFormElements->execute();
		return $this->query_SelectFormElements->fetchAll();
	}

	/**
	* Override the old value with the new value 
	*/
    protected function updateReferences( $old, $new, $user )
    {
        
    }
	
	/**
	* Override in children as necessary
	*/
    protected function deleteReferences( $old, $user )
    {
        
    }

	/**
	* Override in children as necessary
	*/
    protected function deleteConfig( $old, $user )
    {
        
    }

	/**
	* Database Query 
	*/
    protected function SetUpQueries()
    {
        parent::SetUpQueries();
        $this->sql_SelectFormElements = "SELECT * FROM " . $this->table . " WHERE logl_del = FALSE";
	    $this->query_SelectFormElements = $this->db->prepare($this->sql_SelectFormElements);
    }
}

?>
