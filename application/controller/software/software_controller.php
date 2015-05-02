<?php
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
                    $sid                        = isset($software->sid)             ? $software->sid            : "";
                    $name                       = isset($software->name)            ? $software->name           : "";
                    $last_mdfd_user             = isset($software->last_mdfd_user)  ? $software->last_mdfd_user : "";
                    $last_mdfd_tmst             = isset($software->last_mdfd_tmst)  ? $software->last_mdfd_tmst : "";

                    $rows[]                     = array( $sid, $name, $last_mdfd_user, $last_mdfd_tmst );
		}
		$this->view->renderSoftware($rows, $start);
	}

    public function Next()
    {
        $start = (int)$this->globals->getParam( 'start' , 0 );
        $prev_displayed = $this->globals->getParam( 'displayed', '10' );
        if ( $prev_displayed == '10' )
        {
            $start += 10; 
        }

        $this->showAllSoftware( $start );
    }

    public function Previous()
    {
        $start = (int)$this->globals->getParam( 'start' , 10 ) - 10;
        if ( $start < 0 ) $start = 0;
        $this->showAllSoftware( $start );
    }
       
    public function New_Software()
    {
        $this->view->renderForm( false );
    }
    
    public function Update()
    {
        $sid = $this->globals->getParam('sid');
        $software = $this->model->getSoftware( $sid );
        $this->view->renderForm( true, $sid, $software->name);
    }
    
    public function Update_Software()
    {
        $this->validateSoftware( true );
        $this->startFresh();
    }
    
    public function Add_Software()
    {
        $this->validateSoftware( false );
        $this->startFresh();
    }
    
    public function Delete_Software()
    {
        $sid = $this->globals->getParam( 'sid' );
        $this->model->deleteSoftware( $sid, $this->user );
        $this->startFresh();
    }
    
    public function validateSoftware($isUpdate)
	{
        $sid        = $this->globals->getParam('sid', null);
        $name       = $this->validateInputNotEmpty( $this->globals->getParam('name', null) );

        if ($name == '')
        {
            $body = '<h5> Inlcude text in field<h5>';
            $this->view->renderBody($body);
            exit;
        }
        if ( $isUpdate )
        {
            $result = $this->model->updateSoftware($sid, $name, $this->user);
        }
        else
        {
            $result = $this->model->addSoftware($name, $this->user);
        }

        if( $result )
        {
            $this->startFresh();
        }
	}
}
?>
