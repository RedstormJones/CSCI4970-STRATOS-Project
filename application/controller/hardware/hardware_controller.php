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
    
    public function Add_Hardware()
    {
        $this->view->renderForm(FALSE);
    }
    
    public function Update()
    {
        $this->view->renderForm(TRUE);
    }
    
    public function Update_Hardware()
    {
        
    }
    
    public function Delete_Hardware()
    {
        
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
            ?>
                <script type="text/javascript">
                    window.location.href = 'http://127.0.0.1/application/view/hardware/hardware_index.php';
                </script>
            <?php
         }
    }
}

?>
