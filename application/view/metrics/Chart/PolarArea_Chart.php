<?php
include_once "Base_Chart.php";
class PolarArea_Chart extends Base_Chart
{
    #----------------------------------------------#
    # Sets up the dataset for the polar area chart #
    #----------------------------------------------#
    public function GetJavaScript_DataSet( $var_idx )
    {
    	$js                 = '   var data' . $var_idx . ' = ' . "\n";
        $js                .= '   ['. "\n";
        $count_data         = count($this->data);
        for( $i = 0; $i < $count_data; ++$i )
        {
            $datum          = $this->data[$i];
            $label          = $datum[0];
            $value          = $datum[1];

            $colorScheme    = $this->GetColorScheme($i);
            $color          = $colorScheme[0];
            $highlight      = $colorScheme[1];

            $js            .= '           {' . "\n";
            $js            .= '               value:         ' . round($value, 2) . "\n";
            $js            .= '             , color:        "' . $color      . '"'. "\n";
            $js            .= '             , highlight:    "' . $highlight  . '"'. "\n";
            $js            .= '             , label:        "' . $label      . '"'. "\n";
            $js            .= '           },'. "\n";
        }
        $js                .= '   ];'. "\n";
        return $js;
    }

    #------------------------------#
    # Creates the polar area chart #
    #------------------------------#
    public function GetJavaScript_CreateChart( $var_idx )
    {
        $js                 = '         var ctx                       = document.getElementById("chart-area' . $var_idx . '").getContext("2d");'. "\n";
        $js                .= '         window.Chart' . $var_idx . '  = new Chart(ctx).PolarArea(data' . $var_idx . ')'. "\n";
        return $js;
    }
}
?>