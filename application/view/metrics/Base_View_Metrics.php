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

	public function renderMetrics($title, $charts, $additionalHeader = '')
	{
        $metrics  = '<h3 "' . $title . '">' . $title . '</h3>' . "\n";
        $metrics .= '<br><br><br><br>' . "\n";

        $metrics .= $additionalHeader;

        $count = count($charts);
        for ( $i = 0; $i < $count; ++$i )
        {
            $chart = $charts[$i];            
            $name = $chart->GetName();

            $metrics .= '<h4 "' . $name . '">' . $name . '</h4>'. "\n";

            $metrics .= '<br>'. "\n";

            $metrics .= '<div id="canvas-holder'.$i.'">'. "\n";
            $metrics .= '   <canvas id="chart-area' . $i . '" width="300" height="300"/>'. "\n";
		    $metrics .= '</div>'. "\n";

            $metrics .= '<br><br><br>'. "\n";
        }

        $metrics .= '<script src="../Chart/Chart.js"></script>'. "\n";
        $metrics .= '<script>'. "\n";
        for ( $i = 0; $i < $count; ++$i )
        {
            $chart = $charts[$i];
            $metrics .= $chart->GetJavaScript_DataSet( $i );
        }

        $metrics .= "\n" . '   window.onload = function()'. "\n";
        $metrics .= '   {'. "\n";

        for( $i = 0; $i < $count; ++$i )
        {
            $chart = $charts[$i];
            $metrics .= $chart->GetJavaScript_CreateChart( $i );
        }
        $metrics .= '   }'. "\n";
        $metrics .= '</script>';

		$this->renderBody($metrics);
	}
}
?>