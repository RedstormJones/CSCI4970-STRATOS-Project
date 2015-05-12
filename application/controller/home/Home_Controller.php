<?php
require APP . 'controller\Base_Controller.php';

class Home_Controller Extends Base_Controller
{
	#---------------------------------#
	# Commands the view to render the #
	# application's home page 		  #
	#---------------------------------#
    public function noAction()
    {
        $this->view->renderHome('<h3 "STRATOS - Schedule">STRATOS - Schedule</h3>');
    }

}

?>