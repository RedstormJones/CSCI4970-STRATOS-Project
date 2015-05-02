<?php
require APP . 'view\metrics\Base_View_Metrics.php';

class Globals_View Extends Base_View_Metrics
{
	public function renderGlobals( $charts )
	{
        $metrics  = '<h3 "Service Ticket Metrics">Service Ticket Metrics</h3>' . "\n";
        $metrics .= '<br><br><br><br>' . "\n";

        $count = count($charts);
        for ( $i = 0; $i < $count; ++$i )
        {
            $chart = $charts[$i];            
            $name = $chart[1];

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
            $type = $chart[0];
            $name = $chart[1];
            $data = $chart[2];
        
            // Type 0 = Doughnut, Type 1 = Pie, Type 2 = Bar
            if ($type==1 || $type==0)
            {
                $metrics .= '   var data' . $i . ' = ['. "\n";
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
                    $metrics .= '               value: ' . round($value, 2) . "\n";
                    $metrics .= '             , color: "' . $color . '"'. "\n";
                    $metrics .= '             , highlight: "' . $highlight . '"'. "\n";
                    $metrics .= '             , label: "' . $label . '"'. "\n";
                    $metrics .= '           },'. "\n";
                }
                $metrics .= '   ];'. "\n";
            } 
            else if ($type==2) 
            {
                $metrics .= ' var data' . $i . ' = {';
                $count_data = count($data);
                $metrics .= "\n" . 'labels : [';
                for( $j = 0; $j < $count_data; ++$j )
                {
                    $datum = $data[$j];
                    $label = $datum[0];
                                        
                    if ($j == ($count_data - 1))
                    {
                        $metrics .= '"' . $label . '"],';
                    }
                    else
                    {
                        $metrics .= '"'. $label . '",';
                    }
                }
                
                $metrics .= "\n" . 'datasets : [
                                    {
                                        fillColor : "rgba(20,120,120,0.5)",
                                        strokeColor : "rgba(220,220,220,0.8)",
                                        highlightFill: "rgba(220,220,220,0.75)",
                                        highlightStroke: "rgba(220,220,220,1)",
                                        data : [';
                for( $j = 0; $j < $count_data; ++$j )
                {
                    $datum = $data[$j];
                    $value = $datum[1];
                    
                    if ($j==($count_data-1))
                    {
                        $metrics .= $value . ']
                         
                                    }
                                ]
                            }' . "\n";
                    }
                    else
                    {
                        $metrics .= $value . ', ';
                    }
                }
            }
        }

        $metrics .= "\n" . '   window.onload = function()'. "\n";
        $metrics .= '   {'. "\n";

        for( $i = 0; $i < $count; ++$i )
        {
            $chart = $charts[$i];
            $type = $chart[0];
            
            if ($type==1)
            {
                $metrics .= '   var ctx = document.getElementById("chart-area' . $i . '").getContext("2d");'. "\n";
                $metrics .= '   window.Chart' . $i . ' = new Chart(ctx).Pie(data' . $i . ')'. "\n";
            }
            else if ($type==0)
            {
                $metrics .= '   var ctx = document.getElementById("chart-area' . $i . '").getContext("2d");'. "\n";
                $metrics .= '   window.Chart' . $i . ' = new Chart(ctx).Doughnut(data' . $i . ')'. "\n";
            }
            else if ($type==2)
            {
                $metrics .= '   var ctx = document.getElementById("chart-area' . $i . '").getContext("2d");'. "\n";
                $metrics .= '   window.myBar = new Chart(ctx).Bar(data' . $i . ');'. "\n";
            }
        }
        $metrics .= '   }'. "\n";
        $metrics .= '</script>';

        #--------------------------------------------#
        # Send the metrics data to Base_View_Metrics #
        # for rendering in the web browser           #
        #--------------------------------------------#
		$this->renderMetrics($metrics);
	}
}
?>