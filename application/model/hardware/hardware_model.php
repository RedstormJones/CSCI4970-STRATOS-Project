<?php
require_once('../../globals.php');
require APP . 'model\Base_Model.php';

class Hardware_Model Extends Base_Model
{
  public function __construct()
	{
		parent::__construct();
		$this->sql_ShowAllHardware = "
				SELECT
                    `eid`
                  , `name`
                  , `vendor`
                  , `model`
                  , `serial`
                  , `type`
                  , `loc`
                  , `status`
                  , `last_mdfd_tmst`
                FROM
                    `StEqpInst`
                WHERE
                    logl_del = FALSE;";
    $this->query_ShowAllHardware = $this->db->prepare($this->sql_ShowAllHardware);
  }

  public function showAllHardware()
  {
      $this->query_ShowAllHardware->execute();
      return $this->query_ShowAllHardware->fetchAll();
  }

  public function addHardware($name, $vendor, $model, $serial, $type, $loc, $status)
  {

  }
}

?>
