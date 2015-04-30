<?php
require APP . 'view\metrics\Base_View_Metrics.php';

class Globals_View Extends Base_View_Metrics
{
	public function renderGlobals( $charts )
	{
        $metrics  = '<h3 "Service Ticket Metrics">Service Ticket Metrics</h3>';
        $metrics .= '<br><br><br>';

        $count = count($charts);
        for ( $i = 0; $i < $count; ++$i )
        {
            $chart = $charts[$i];
            $name = $chart[0];

            $metrics .= '<h4 "' . $name . '">' . $name . '</h4>' . "\n";
            $metrics .= '<br>'. "\n";
            $metrics .= '<div id="canvas-holder' . $i . '">'. "\n";
            $metrics .= '   <canvas id="chart-area' . $i . '" width="300" height="300"/>'. "\n";
		    $metrics .= '</div>'. "\n";
            $metrics .= '<br>'. "\n";
        }

        $metrics .= '<script src="..\Chart\Chart.js"></script>'. "\n";
        $metrics .= '<script>'. "\n";
        for ( $i = 0; $i < $count; ++$i )
        {
            $chart = $charts[$i];
            $name = $chart[0];
            $data = $chart[1];

            $metrics .= '   var pieData' . $i . ' = ['. "\n";
            $count_data = count($data);
            for( $j = 0; $j < $count_data; ++$j )
            {
                $datum = $data[$j];
                $label = $datum[0];
                $value = $datum[1];

                $colorScheme = $this->colorValues[$j];
                $color = $colorScheme[0];
                $highlight = $colorScheme[1];

                $metrics .= '           {' . "\n";
                $metrics .= '               value: ' . $value. "\n";
                $metrics .= '             , color: "' . $color . '"'. "\n";
                $metrics .= '             , highlight: "' . $highlight . '"'. "\n";
                $metrics .= '             , label: "' . $label . '"'. "\n";
                $metrics .= '           },'. "\n";
            }
            $metrics .= '   ];'. "\n";
        }

        $metrics .= '   window.onload = function()'. "\n";
        $metrics .= '   {'. "\n";

        for( $i = 0; $i < $count; ++$i )
        {
            $metrics .= '   var ctx = document.getElementById("chart-area' . $i . '").getContext("2d");'. "\n";
            $metrics .= '   window.myPie' . $i . ' = new Chart(ctx).Pie(pieData' . $i . ')'. "\n";
        }
        $metrics .= '   }'. "\n";
        $metrics .= '</script>';
		$this->renderMetrics($metrics);
	}
}
?>