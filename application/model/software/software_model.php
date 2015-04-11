<?php
require_once('../../globals.php');
require APP . 'model\Base_Model.php';
#include "..\Base_Model.php";

class Software_Model Extends Base_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->sql_ShowAllSoftware = "
				SELECT
                    `sid`
                  , `name`
                  , `last_mdfd_user`
                  , `last_mdfd_tmst`
                FROM
                    `StSftInst`
                WHERE
                    `logl_del` = FALSE;";
        $this->query_ShowAllSoftware = $this->db->prepare($this->sql_ShowAllSoftware);
    }

    public function showAllSoftware()
    {
        $this->query_ShowAllSoftware->execute();
        return $this->query_ShowAllSoftware->fetchAll();
    }

	public function addSoftware($name)
	{

	}
}

?>
