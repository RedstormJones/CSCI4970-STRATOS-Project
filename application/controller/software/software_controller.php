<?php
require_once('../../globals.php');
require APP . 'controller\Base_Controller.php';

class Software_Controller Extends Base_Controller
{
    public function noAction()
    {
        $this->showAllSoftware();
    }

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
       
    public function showSoftwareForm()
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
    
    public function validateSoftware()
	{
        if ($_SERVER["REQUEST_METHOD"] == "POST") 
         {
             $name = $this->validate_input($_POST["name"]);
         }

         $result = $this->model->addSoftware($name);
         if(!$result)
         {
             renderBody("Error: New software insert failed in database");
         }
         else
         {
            header("Location: software_index.php");
         }
	}
}
?>
