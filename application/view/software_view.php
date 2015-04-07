<?php
include "Base_View.php";


class Software_View Extends Base_View
{

    public function renderSoftware($softwarelist)
    {
        $body = '<h3 title="All Active Software">All Active Software</h3>';
        $body .= "<br><br><br>";

        $body .= '<table>
            <tr>
                <th>Software#</th>
                <th>Name</th>
                <th>Created</th>
                <th>Last Updated</th>
            </tr>';

        $body .= "<tbody>";
            foreach($softwarelist as $software)
            {
                $body .= "<tr>";
                foreach($software as $cell)
                {
                    $body .= '<td>' . $cell . '</td>';
                }
                $body .= "</tr>";
            }
            $body .= '</tbody>
        </table>
        <br><br>';
        $body .= '<div style="text-align: center">';
            $body .= '<form action="addsoftware.php">';
            $body .= '<input type="hidden" name="action" value="showSoftwareForm">';
            $body .= '<input type=submit class="button" value="Add Software">';
            $body .= '</form>';
        $body .= '</div>';

        $this->renderBody($body);
    }
}

?>
