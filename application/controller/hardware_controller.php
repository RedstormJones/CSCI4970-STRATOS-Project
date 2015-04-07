<?php
include "Base_Controller.php";

class Hardware_Controller Extends Base_Controller
{
	public function showAllHardware()
	{
		$hardware_objects = $this->model->showAllHardware();
		$rows = array();
		foreach( $hardware_objects as $hardware )
		{
            $eid            = isset($hardware->eid) ? $hardware->eid : "";
            $name           = isset($hardware->name) ? $hardware->name : "";
            $vendor         = isset($hardware->vendor) ? $hardware->vendor : "";
            $model          = isset($hardware->model) ? $hardware->model : "";
            $serial         = isset($hardware->serial) ? $hardware->serial : "";
            $type           = isset($hardware->type) ? $hardware->type : "";
            $loc            = isset($hardware->loc) ? $hardware->loc : "";
            $status         = isset($hardware->status) ? $hardware->status : "";
            $last_mdfd_tmst = isset($hardware->last_mdfd_tmst) ? $hardware->last_mdfd_tmst : "";
			$rows[]         = array( $eid, $name, $vendor, $model, $serial, $type, $loc, $status, $last_mdfd_tmst );
		}
		$this->view->renderHardware($rows);
	}
}

?>
