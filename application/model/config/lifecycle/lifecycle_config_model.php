<?php
require_once('../../../globals.php');
require APP . 'model\config\Ref_Config_Base_Model.php';

class Lifecycle_Config_Model Extends Ref_Config_Base_Model
{
    public function __construct( )
    {
        parent::__construct( 'StLfeCyclConf'
                           , 'life_cycl_id'
                           , 'name'
                           , array( 
                                    array( 'StTktInst', 'life_cycl_id' )
                                  )
                           );
    }
}

?>