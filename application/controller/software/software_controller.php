<?php
require_once('../../globals.php');
require APP . 'controller\Base_Controller.php';

class Software_Controller Extends Base_Controller
{
    public function noAction()
    {
        $this->showAllSoftware(0);
    }

	public function showAllSoftware( $start )
	{
		$software_objects = $this->model->showAllSoftware( $start );
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
       
    public function New_Software()
    {
        $this->view->renderForm(FALSE);
    }
    
    public function Update()
    {
        $sid = getParam('sid');
        $software = $this->model->getSoftware( $sid )[0];
        $this->view->renderForm(TRUE, $sid, $software->name);
    }
    
    public function Update_Software()
    {
        $this->validateSoftware(TRUE);
    }
    
    public function Add_Software()
    {
        $this->validateSoftware(FALSE);
    }
    
    public function Delete_Software()
    {
        $sid = getParam( 'sid' );
        $this->model->deleteSoftware( $sid );
        $this->showAllSoftware(0);
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
    
    public function validateSoftware($isUpdate)
	{
        if ($_SERVER["REQUEST_METHOD"] == "POST") 
        {
            $sid       = $this->validate_input(    getParam('sid'      , null) );
            $name      = $this->validate_input(    getParam('name'     , null) );        
        }

        $result = $isUpdate ? $this->model->updateSoftware($sid, $name)
                            : $this->model->addSoftware($name);
        if(!$result)
        {
            $this->renderBody("Error: New software insert failed in database");
        }
        else
        {
            $this->startFresh();
        }
	}
}
?>
