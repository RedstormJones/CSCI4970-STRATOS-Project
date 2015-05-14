<?php
require APP . 'controller\Base_Controller.php';

class Hardware_Controller extends Base_Controller
{
    /**
    * Default method to execute if no specific controller method is provided.
    * Redirects application control to the showAllHardware() method and passes
    * the value of 0 so that the hardware rendered starts at the beginning of 
    * the hardware dataset
    */
    public function noAction()
    {
        $this->showAllHardware(0);
    }

    /**
    * Commands the model to get all hardware data and then builds an array of
    * hardware objects to use in the view for rendering to the webpage
    *
    * @param $start : Int (used for paging the hardware data rendered to the webpage - 10 count)
    */
    public function showAllHardware($start)
    {
            $hardware_objects = $this->model->showAllHardware($start);
            $rows = array();
            foreach( $hardware_objects as $hardware )
            {
                $eid                    = isset($hardware->eid)             ? $hardware->eid            : "";
                $name                   = isset($hardware->name)            ? $hardware->name           : "";
                $vendor                 = isset($hardware->vendor)          ? $hardware->vendor         : "";
                $model                  = isset($hardware->model)           ? $hardware->model          : "";
                $serial                 = isset($hardware->serial)          ? $hardware->serial         : "";
                $type                   = isset($hardware->type)            ? $hardware->type           : "";
                $loc                    = isset($hardware->loc)             ? $hardware->loc            : "";
                $status                 = isset($hardware->status)          ? $hardware->status         : "";
                $last_mdfd_tmst         = isset($hardware->last_mdfd_tmst)  ? $hardware->last_mdfd_tmst : "";

                $rows[]                 = array( $eid, $name, $vendor, $model, $serial, $type, $loc, $status, $last_mdfd_tmst );
            }
            $this->view->renderHardware($rows, $start);
    }
    
    /**
    * Displays the next 10 elements of hardware data.
    */
    public function Next()
    {
        $start = (int)$this->globals->getParam( 'start' , 0 );
        $prev_displayed = $this->globals->getParam( 'displayed', '10' );
        if ( $prev_displayed == '10' )
        {
            $start += 10; 
        }

        $this->showAllHardware( $start );
    }

    /**
    * Displays the previous 10 elements of hardware data.
    */
    public function Previous()
    {
        $start = (int)$this->globals->getParam( 'start' , 10 ) - 10;
        if ( $start < 0 ) $start = 0;
        $this->showAllHardware( $start );
    }

    /**
    * Commands the view to render the form for adding new hardware
    */
    public function New_Hardware()
    {
        $this->view->renderForm( false );
    }

    /**
    * Gets the current hardware data from the model and commands the view
    * to render the form for updating hardware, passing the data received
    * from the model as parameters to pre-populate the hardware fields
    */
    public function Update()
    {
        $eid = $this->globals->getParam('eid');
        $hardware = $this->model->getHardware( $eid );

        $this->view->renderForm( true
                               , $eid
                               , $hardware->name
                               , $hardware->vendor
                               , $hardware->model
                               , $hardware->serial
                               , $hardware->type
                               , $hardware->loc
                               , $hardware->status
                               );
    }

    /**
    * Validates the new Hardware data and refreshes the application
    */
    public function Add_Hardware()
    {
        $this->validateHardware( false );
        $this->startFresh();
    }

    /**
    * Validates the updated Hardware data and refreshes the application
    */
    public function Update_Hardware()
    {
        $this->validateHardware( true );
        $this->startFresh();
    }
    
    /**
    * Gets the hardware ID from the environmet variables and 
    * commands the model to mark the Hardware entry in the 
    * database corresponding to the given eid as removed, 
    * then refreshes the application
    */
    public function Delete_Hardware()
    {
        $eid = $this->globals->getParam( 'eid' );
        $this->model->deleteHardware( $eid, $this->user );
        $this->startFresh();
    }

    /**
    * Validates the new / updated Hardware data and commands the model 
    * to update the data or insert it as new, then refreshes the application
    * 
    * @param $isUpdate : Boolean (specifies whether this modification is new data or is updating existing data)
    */ 
    public function validateHardware( $isUpdate )
    {
        $eid       = $this->globals->getParam('eid',null);
        $name      = $this->validateInputNotEmpty( $this->globals->getParam('name', null) );
        $vendor    = $this->validateInputNotEmpty( $this->globals->getParam("vendor", null) );
        $model     = $this->validateInputNotEmpty( $this->globals->getParam("model", null) );
        $serial    = $this->validateInputNotEmpty( $this->globals->getParam("serial", null) );
        $type      = $this->validateInputNotEmpty( $this->globals->getParam("type", null) );
        $loc       = $this->validateInput( $this->globals->getParam("loc", null) );
        $status    = $this->validateInputNotEmpty( $this->globals->getParam("status", null) );
        
        if ($name == '' || $vendor == '' || $model == '' ||
                $serial == '' || $type == ''|| $status == '')
        {
            $body = '<h5> Include text in field or Select from drop-down menu<h5>';
            $this->view->renderBody($body);
            exit;
        }

        if ( $isUpdate )
        {
            $result = $this->model->updateHardware($eid, $name, $vendor, $model, $serial, $type, $loc, $status, $this->user);
        }
        else
        {
            $result = $this->model->addHardware($name, $vendor, $model, $serial, $type, $loc, $status, $this->user);
        }
        
        if ( $result )
        {
            $this->startFresh();
        }
    }
}

?>
