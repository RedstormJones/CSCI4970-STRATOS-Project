<?php
require APP . 'view\metrics\Base_View_Metrics.php';

class Globals_View extends Base_View_Metrics
{
    /**
     * Passes along the metrics chart data to the renderMatrics()
     * method in the Base_View_Metrics file for actual rendering to the webpage.
     * 
     * @param $charts : Array (holds the charts to be presented in the global page)
     */
    public function renderGlobals( $charts )
    {
        $this->renderMetrics( 'Service Ticket Metrics', $charts );
    }
}
?>