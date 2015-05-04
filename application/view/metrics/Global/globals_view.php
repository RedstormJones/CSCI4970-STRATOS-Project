<?php
require APP . 'view\metrics\Base_View_Metrics.php';

class Globals_View Extends Base_View_Metrics
{
	public function renderGlobals( $charts )
	{
        $this->renderMetrics( 'Service Ticket Metrics', $charts );
	}
}
?>