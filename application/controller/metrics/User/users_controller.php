<?php
require APP . 'controller\metrics\Base_Controller_Metrics.php';

class Users_Controller Extends Base_Controller_Metrics
{
    public function noAction()
    {
        $this->doRenderMetrics( $this->globals->getCurrentUserPid() );
    }

    public function doRenderMetrics( $user )
    {
        // Query all users
        // Queries based on $user
        // Call view
    }
}
?>