<?php
require_once('../../globals.php');
require APP . 'controller\Base_Controller.php';

class Home_Controller Extends Base_Controller
{
    public function noAction()
    {
        $this->view->renderBody("Hey World");
    }

}

?>