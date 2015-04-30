<?php
require APP . 'view\Base_View.php';

class Base_View_Metrics Extends Base_View
{
	public $colorValues = array(  array("#F7464A", "#FF5A5E")
								, array("#46BFBD", "#5AD3D1")
								, array("#FDB45C", "#FFC870")
								, array("#949FB1", "#A8B3C5")
								, array("#4D5360", "#616774")
								, array("#3366CC", "#5C85D6")
								, array("#9900FF", "#B84DFF")
								, array("#00FF99", "#4DFFB8")
								, array("#FF7519", "#FF9147")
								, array("#191975", "#474791") );

	public function renderMetrics($metrics)
	{
		$this->renderBody($metrics);
	}
}
?>