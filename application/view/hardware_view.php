<?php
include "Base_View.php";


class Hardware_View Extends Base_View
{

    public function renderHardware($hardwarelist)
    {
        $body = '<h3 title="All Active Hardware">All Active Hardware</h3>';
        $body .= "<br><br><br>";

        $body .= '<table>
            <tr>
                <th>Hardware#</th>
                <th>Name</th>      
                <th>Vendor</th>
                <th>Model</th>
                <th>Serial</th>
                <th>Type</th>     
                <th>Location</th>
                <th>Status</th>
                <th>Last Updated</th>
            </tr>';

        $body .= "<tbody>";
            foreach($hardwarelist as $hardware)
            {
                $body .= "<tr>";
                foreach($hardware as $cell)
                {
                    $body .= '<td>' . $cell . '</td>';
                }
                $body .= "</tr>";
            }
            $body .= '</tbody>
        </table>
        <br><br>';
        $body .= '<div style="text-align: center">';
            $body .= '<form action="addhardware.php">';
            $body .= '<input type="hidden" name="action" value="showHardwareForm">';
            $body .= '<input type=submit class="button" value="Add Hardware">';
            $body .= '</form>';
        $body .= '</div>';

        $this->renderBody($body);
    }
}

?>
