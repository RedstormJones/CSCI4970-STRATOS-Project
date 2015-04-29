<?php
require APP . 'view\Base_View.php';

class Base_View_Metrics Extends Base_View
{
	public function renderMetrics($metrics)
	{
		$this->renderBody($metrics);
	}
}
?>