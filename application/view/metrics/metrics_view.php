<?php
require APP . 'view\Base_View.php';

class Metrics_View Extends Base_View
{
	public function renderMetrics($metrics)
	{
		$metrics .= '<br><br>';
		$metrics .= 'PUT SOME SWEET METRICS HERE';
		$this->renderBody($metrics);
	}
}
?>