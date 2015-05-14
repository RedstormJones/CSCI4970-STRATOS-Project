<?php
require APP . 'controller\Base_Controller.php';

class Software_Controller extends Base_Controller
{
    /**
    * Default method to execute if no specific controller method is provided.
    * Redirects application control to the showAllSoftware() method and passes
    * the value of 0 so that the software rendered starts at the beginning of 
    * the software dataset
    */
    public function noAction()
    {
        $this->showAllSoftware(0);
    }

    /**
    * Commands the model to get all software data and then builds an array of
    * software objects to use in the view for rendering to the webpage
    *
    * @param $start : Int (used for paging the software data rendered to the webpage - 10 count)
    */
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

    /**
    * Displays the next 10 elements of software data.
    */
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

    /**
    * Displays the previous 10 elements of software data.
    */
    public function Previous()
    {
        $start = (int)$this->globals->getParam( 'start' , 10 ) - 10;
        if ( $start < 0 ) $start = 0;
        $this->showAllSoftware( $start );
    }

    /**
    * Commands the view to render the form for adding new software
    */
    public function New_Software()
    {
        $this->view->renderForm( false );
    }

    /**
    * Gets the current software data from the model and commands the view
    * to render the form for updating software, passing the data received
    * from the model as parameters to pre-populate the software fields
    */
    public function Update()
    {
        $sid = $this->globals->getParam('sid');
        $software = $this->model->getSoftware( $sid );
        $this->view->renderForm( true, $sid, $software->name);
    }

    /**
    * Validates the updated software data and refreshes the application
    */
    public function Update_Software()
    {
        $this->validateSoftware( true );
        $this->startFresh();
    }

    /**
    * Validates the new software data and refreshes the application
    */
    public function Add_Software()
    {
        $this->validateSoftware( false );
        $this->startFresh();
    }

    /**
    * Gets the software ID from the environmet variables and 
    * commands the model to mark the software entry in the 
    * database corresponding to the given sid as removed, 
    * then refreshes the application
    */
    public function Delete_Software()
    {
        $sid = $this->globals->getParam( 'sid' );
        $this->model->deleteSoftware( $sid, $this->user );
        $this->startFresh();
    }

    /**
    * Validates the new / updated software data and commands the model 
    * to update the data or insert it as new, then refreshes the application
    * 
    * @param $isUpdate : Boolean (specifies whether this modification is new data or is updating existing data)
    */
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
