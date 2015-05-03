<?php
require APP . 'view\metrics\Base_View_Metrics.php';
require APP . 'view\metrics\Chart\Chart_Includes.php';

class Globals_View Extends Base_View_Metrics
{
	public function renderGlobals( $charts )
	{
        $this->renderMetrics( 'Service Ticket Metrics', $charts );
	}
}
?>