<?php
require_once('../../globals.php');
require APP . 'controller\Base_Controller.php';

class Software_Controller Extends Base_Controller
{
    public function noAction()
    {
        $this->showAllSoftware(0);
    }

    public function showAllSoftware($start)
    {
        $software_objects = $this->model->showAllSoftware($start);
        $rows = array();
        foreach( $software_objects as $software )
        {
            $sid            = isset($software->sid) ? $software->sid : "";
            $name           = isset($software->name) ? $software->name : "";
            $last_mdfd_user = isset($software->last_mdfd_user) ? $software->last_mdfd_user : "";
            $last_mdfd_tmst = isset($software->last_mdfd_tmst) ? $software->last_mdfd_tmst : "";
            $rows[]         = array( $sid, $name, $last_mdfd_user, $last_mdfd_tmst );
        }
        $this->view->renderSoftware($rows, $start);
    }
        
    public function Next()
    {
        $start = (int)getParam( 'start' , 0 );
        $prev_displayed = getParam( 'displayed', '10' );
        if ( $prev_displayed == '10' )
        {
            $start += 10; 
        }

        $this->showAllSoftware( $start );
    }

    public function Previous()
    {
        $start = (int)getParam( 'start' , 10 ) - 10;
        if ( $start < 0 ) $start = 0;
        $this->showAllSoftware( $start );
    }
       
    public function Add_Software()
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
