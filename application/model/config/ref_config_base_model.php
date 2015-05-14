<?php
require APP . 'model\Base_Model.php';

class Ref_Config_Base_Model Extends Base_Model
{
<<<<<<< HEAD

	/**
	* Collect the value from the Affected Level, Category, Priority, or Severity database tables
	* 
	* @param $table : String ( hold the table data) 
	*/
=======
>>>>>>> origin/dev
    public function __construct( $table )
    {
        $this->table = $table;
        
        parent::__construct();
    }

<<<<<<< HEAD
	/**
	* Reassign and delete a value from the database
	*/
=======
>>>>>>> origin/dev
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

<<<<<<< HEAD
	/**
	* Override the old value with the new value 
	*/
=======
>>>>>>> origin/dev
    protected function updateReferences( $old, $new, $user )
    {
        
    }
<<<<<<< HEAD
	
	/**
	* Override in children as necessary
	*/
=======

>>>>>>> origin/dev
    protected function deleteReferences( $old, $user )
    {
        
    }

<<<<<<< HEAD
	/**
	* Override in children as necessary
	*/
=======
>>>>>>> origin/dev
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
