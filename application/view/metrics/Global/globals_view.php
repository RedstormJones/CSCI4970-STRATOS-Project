<?php
require APP . 'view\metrics\Base_View_Metrics.php';

class Globals_View Extends Base_View_Metrics
{
	public function renderGlobals()
	{
		$metrics = '<h3 "Service Ticket Metrics">Service Ticket Metrics</h3>';
		$metrics .= '<br><br><br>';
		$metrics .= '<script src="..\Chart\Chart.js"></script>';
        $metrics .= '<div id="canvas-holder">
			             <canvas id="chart-area" width="300" height="300"/>
		              </div>
                
                    <script>
                        var pieData = [
                                        {
                                                value: 300,
                                                color:"#F7464A",
                                                highlight: "#FF5A5E",
                                                label: "Red"
                                        },
                                        {
                                                value: 50,
                                                color: "#46BFBD",
                                                highlight: "#5AD3D1",
                                                label: "Green"
                                        },
                                        {
                                                value: 100,
                                                color: "#FDB45C",
                                                highlight: "#FFC870",
                                                label: "Yellow"
                                        },
                                        {
                                                value: 40,
                                                color: "#949FB1",
                                                highlight: "#A8B3C5",
                                                label: "Grey"
                                        },
                                        {
                                                value: 120,
                                                color: "#4D5360",
                                                highlight: "#616774",
                                                label: "Dark Grey"
                                        }

                                ];

                                window.onload = function(){
                                        var ctx = document.getElementById("chart-area").getContext("2d");
                                        window.myPie = new Chart(ctx).Pie(pieData);
                                };
                        </script>';
		$this->renderMetrics($metrics);
	}
}
?>