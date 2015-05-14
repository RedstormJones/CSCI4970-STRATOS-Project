<?php
include_once "Base_Chart.php";
class Line_Chart extends Base_Chart
{
    #----------------------------------------#
    # Sets up the dataset for the line chart #
    #----------------------------------------#
    public function GetJavaScript_DataSet( $var_idx )
    {
        $count_data         = count($this->data);
        $colorScheme        = $this->GetColorScheme(1);
        $color              = $colorScheme[0];
        $highlight          = $colorScheme[1];
        $js                 = '   var data' . $var_idx . ' = ' . "\n";
        $js                .= '   {'. "\n";
        $js                .= '         labels: ' . "\n";
        $js                .= '         [' . "\n";
        for( $i = 0; $i < $count_data; ++$i )
        {
            $datum          = $this->data[$i];
            $label          = $datum[0];

            $js            .= '             "' . $label . '",' . "\n";
        }
        $js                .= '         ],' . "\n";

        $js                .= '         datasets :' . "\n";
        $js                .= '         [' . "\n";
        $js                .= '             {' . "\n";
        $js                .= '                   fillColor:        "' . $color     . '"' . "\n";
        $js                .= '                 , strokeColor:      "' . $color     . '"' . "\n";
        $js                .= '                 , highlightFill:    "' . $highlight . '"' . "\n";
        $js                .= '                 , highlightStroke:  "' . $highlight . '"' . "\n";
        $js                .= '                 , highlightStroke:  "' . $highlight . '"' . "\n";
        $js                .= '                 , data:' . "\n";
        $js                .= '                 [' . "\n";
        for( $i = 0; $i < $count_data; ++$i )
        {
            $datum          = $this->data[$i];
            $value          = $datum[1];

            $js            .= '                     ' . $value . ',' . "\n";
        }
        $js                .= '                 ]' . "\n";
        $js                .= '              }' . "\n";
        $js                .= '          ]' . "\n";
        $js                .= '   };'. "\n";
        return $js;
    }

    #------------------------#
    # Creates the line chart #
    #------------------------#
    public function GetJavaScript_CreateChart( $var_idx )
    {
        $js                 = '         var ctx                      = document.getElementById("chart-area' . $var_idx . '").getContext("2d");'. "\n";
        $js                .= '         window.Chart' . $var_idx . ' = new Chart(ctx).Line(data' . $var_idx . ')'. "\n";
        return $js;
    }
}

?>