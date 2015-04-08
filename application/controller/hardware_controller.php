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
        
        public function showHardwareForm()
	{
		$this->view->renderForm();
	}
        
        public function validate_input($data)
        {
            if(!$data)
            {
                    return "";
            }
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        
        public function validateHardware()
	{
            if ($_SERVER["REQUEST_METHOD"] == "POST") 
             {
                 $name = $this->validate_input($_POST["name"]);
                 $vendor = $this->validate_input($_POST["vendor"]);
                 $model = $this->validate_input($_POST["model"]);
                 $serial = $this->validate_input($_POST["serial"]);
                 $type = $this->validate_input($_POST["type"]);
                 $loc = $this->validate_input($_POST["loc"]);
                 $status = $this->validate_input($_POST["status"]);
             }

             $result = $this->model->addHardware($name, $vendor, $model, $serial, $type, $loc, $status);
             if(!$result)
             {
                 renderBody("Error: New hardware insert failed in database");
             }
             else
             {
                     header("Location: hardware_index.php");
             }
	}
}

?>
