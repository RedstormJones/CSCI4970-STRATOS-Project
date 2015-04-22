<?php
require_once('../../globals.php');
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
            $this->view->renderHardware($rows, $start);
    }
    
    public function Next()
    {
        $start = (int)getParam( 'start' , 0 );
        $prev_displayed = getParam( 'displayed', '10' );
        if ( $prev_displayed == '10' )
        {
            $start += 10; 
        }

        $this->showAllHardware( $start );
    }

    public function Previous()
    {
        $start = (int)getParam( 'start' , 10 ) - 10;
        if ( $start < 0 ) $start = 0;
        $this->showAllHardware( $start );
    }

    public function New_Hardware()
    {
        $this->view->renderForm(FALSE);
    }
   
    public function Update()
    {
        $eid = getParam('eid');
        $hardware = $this->model->getHardware( $eid )[0];

        $this->view->renderForm( true
                           , $eid
                           , $hardware->name
                           , $hardware->vendor
                           , $hardware->model
                           , $hardware->serial
                           , $hardware->type
                           , $hardware->loc
                           , $hardware->status);
    }
            
    public function Add_Hardware()
    {
        $this->validateHardware(FALSE);
    }
    
    public function Update_Hardware()
    {
        $this->validateHardware( true );
    }
    
    public function Delete_Hardware()
    {
        $eid = getParam( 'eid' );
        $this->model->deleteHardware( $eid );
        $this->showAllHardware(0);
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
        
    public function validateHardware( $isUpdate)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") 
         {
             $eid       = $this->validate_input(    getParam('eid'      , null) );
             $name      = $this->validate_input(    getParam('name'      , null) );
             $vendor    = $this->validate_input(    getParam("vendor"      , null) );
             $model     = $this->validate_input(    getParam("model"      , null) );
             $serial    = $this->validate_input(    getParam("serial"      , null) );
             $type      = $this->validate_input(    getParam("type"      , null) );
             $loc       = $this->validate_input(    getParam("loc"      , null) );
             $status    = $this->validate_input(    getParam("status"      , null) );
         }

         $result = $isUpdate ? $this->model->updateHardware($eid, $name, $vendor, $model, $serial, $type, $loc, $status)
                            : $this->model->addHardware($name, $vendor, $model, $serial, $type, $loc, $status);
         if(!$result)
         {
             renderBody("Error: New hardware insert failed in database");
         }
         else
         {
            ?>
                <script type="text/javascript">
                    window.location.href = 'http://127.0.0.1/application/view/hardware/hardware_index.php';
                </script>
            <?php
         }
    }
}

?>
