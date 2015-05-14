<?php
require APP . 'view\Base_View.php';

class Base_View_Metrics extends Base_View
{
    /** 
     * Creates the html for displaying the metrics charts for both global and user based
     * metrics. To create the metrics charts, this view makes use of the following methods
     * in the PGP chart file corresponding to the chart name value set with
     * $name=$chart->GetName() :
     *      GetJavaScript_DataSet()
     *      GetJavaScript_CreateChart()
     * 
     * @param $title : String (Holds the title of the chart)
     * @param $charts : Array (Holds the data values of the charts)
     * @param $additionalHeader : String (Used to pass header)
     * 
     *      <note> $additionalHeader = '' if no parameter provided in function call
     */
    public function renderMetrics($title, $charts, $additionalHeader = '')
    {
        $metrics  = '<h3 "' . $title . '">' . $title . '</h3>' . "\n";
        $metrics .= '<br>' . "\n";

        $metrics .= $additionalHeader;

        $count = count($charts);
        for ( $i = 0; $i < $count; ++$i )
        {
            $chart = $charts[$i];            
            $name = $chart->GetName();

            $metrics .= '<h4 style="text-align:center;" "' . $name . '">' . $name . '</h4>'. "\n";

            $metrics .= '<br>'. "\n";

            $metrics .= '<div id="canvas-holder'.$i.'">'. "\n";
            $metrics .= '   <canvas id="chart-area' . $i . '" width="300" height="300"/>'. "\n";
		    $metrics .= '</div>'. "\n";

            $metrics .= '<br><br><br><br><br>'. "\n";
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