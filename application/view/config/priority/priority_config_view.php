<?php
require_once('../../../globals.php');
require APP . 'view\config\Ref_Config_Base_View.php';

class Priority_Config_View Extends Ref_Config_Base_View
{
    public function renderForm( $recordList )
    {
        $this->renderBaseForm( $recordList, '' );
    }
}

?>
