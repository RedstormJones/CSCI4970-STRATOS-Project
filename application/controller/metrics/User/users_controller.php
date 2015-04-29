<?php
require APP . 'controller\metrics\Base_Controller_Metrics.php';

class Users_Controller Extends Base_Controller_Metrics
{
    public function noAction()
    {
        $this->view->renderGlobals();
    }
}
?>