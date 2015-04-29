<?php
require APP . 'controller\Base_Controller.php';

class Metrics_Controller Extends Base_Controller
{
    public function noAction()
    {
        $this->view->renderMetrics('<h3 "Service Ticket Metrics">Service Ticket Metrics</h3>');
    }

}

?>