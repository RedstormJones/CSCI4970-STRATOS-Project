<?php
require APP . 'view\metrics\Base_View_Metrics.php';

class Users_View Extends Base_View_Metrics
{
	public function renderGlobals()
	{
		$metrics = '<h3 "Service Ticket Metrics">User Metrics</h3>';
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
                                                color: "#00FF99",
                                                highlight: "#4DFFB8",
                                                label: "Green"
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