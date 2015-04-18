<?php
require_once('../../../globals.php');
require APP . 'model\config\Ref_Config_Base_Model.php';

class Affected_Config_Model Extends Ref_Config_Base_Model
{
    public function __construct( )
    {
        parent::__construct( 'StAffLvlConf'
                           , 'aff_level'
                           , 'name'
                           , array(
                                    array( 'StPriMtxConf', 'aff_level' )
                                  , array( 'StTktInst', 'aff_level' )
                                  )
                           );
    }
}

?>
