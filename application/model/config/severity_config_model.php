<?php
require_once('../../../globals.php');
require APP . 'model\config\Ref_Config_Base_Model.php';

class Severity_Config_Model Extends Ref_Config_Base_Model
{
    public function __construct( )
    {
        parent::__construct( 'StSvrLvlConf'
                           , 'severity'
                           , 'name'
                           , array(
                                    array( 'StPriMtxConf', 'severity' )
                                  , array( 'StTktInst', 'severity' )
                                  )
                           );
    }
}

?>
