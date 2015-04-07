<?php
include "Base_Controller.php";

class Software_Controller Extends Base_Controller
{
	public function showAllSoftware()
	{
		$software_objects = $this->model->showAllSoftware();
		$rows = array();
		foreach( $software_objects as $software )
		{
            $sid            = isset($software->sid) ? $software->sid : "";
            $name           = isset($software->name) ? $software->name : "";
            $last_mdfd_user = isset($software->last_mdfd_user) ? $software->last_mdfd_user : "";
            $last_mdfd_tmst = isset($software->last_mdfd_tmst) ? $software->last_mdfd_tmst : "";
			$rows[]         = array( $sid, $name, $last_mdfd_user, $last_mdfd_tmst );
		}
		$this->view->renderSoftware($rows);
	}
}

?>
