<?php
require_once('../../../globals.php');
require APP . 'model\config\Ref_Config_Base_Model.php';

class Category_Config_Model Extends Ref_Config_Base_Model
{
    public function __construct( )
    {
        parent::__construct( 'StCatgConf'
                           , 'cid'
                           , 'name'
                           , array(
                                    array( 'StTktInst', 'catg' )
                                  )
                           );
    }
}

?>
