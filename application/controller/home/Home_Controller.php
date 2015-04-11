<?php
require_once('../../globals.php');
require APP . 'controller\Base_Controller.php';

class Home_Controller Extends Base_Controller
{
    public function noAction()
    {
        $this->view->renderHome('<h3 "STRATOS - Schedule">STRATOS - Schedule</h3>');
    }

}

?>