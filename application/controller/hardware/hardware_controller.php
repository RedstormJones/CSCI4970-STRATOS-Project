<?php
require APP . 'controller\Base_Controller.php';

class Hardware_Controller Extends Base_Controller
{
    public function noAction()
    {
        $this->showAllHardware(0);
    }

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

    public function Previous()
    {
        $start = (int)$this->globals->getParam( 'start' , 10 ) - 10;
        if ( $start < 0 ) $start = 0;
        $this->showAllHardware( $start );
    }

    public function New_Hardware()
    {
        $this->view->renderForm( false );
    }
   
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
            
    public function Add_Hardware()
    {
        $this->validateHardware( false );
        $this->startFresh();
    }
    
    public function Update_Hardware()
    {
        $this->validateHardware( true );
        $this->startFresh();
    }
    
    public function Delete_Hardware()
    {
        $eid = $this->globals->getParam( 'eid' );
        $this->model->deleteHardware( $eid, $this->user );
        $this->startFresh();
    }
        
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
