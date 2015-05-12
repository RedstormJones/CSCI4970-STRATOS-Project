<?php
require APP . 'view\metrics\Base_View_Metrics.php';

class Globals_View Extends Base_View_Metrics
{
	#-------------------------------------------------#
	# Passes along the metrics chart data to the 	  #
	# renderMetrics() method in the Base_View_Metrics #
	# file for actual rendering to the webpage		  #
	#-------------------------------------------------#
	public function renderGlobals( $charts )
	{
        $this->renderMetrics( 'Service Ticket Metrics', $charts );
	}
}
?>