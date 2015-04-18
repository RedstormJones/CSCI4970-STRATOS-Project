<?php
include "..\Base_View.php";


class Software_View Extends Base_View
{

    public function renderSoftware($softwarelist, $start)
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
            $body .= '<form action="software_index.php">';
            $body .= '<input type="hidden" name="start" value="'. $start .'">';
            $body .= '<input type="hidden" name="displayed" value="' . count($softwarelist) . '">';
<<<<<<< HEAD
            $body .= '<input type="submit" class="button" value="Previous" name="action">';
            $body .= '<input type="submit" class="button" value="Add Software" name="action">';
            $body .= '<input type="submit" class="button" value="Next" name="action">';
=======
            $body .= '<input type=submit class="button" value="Previous" name="action">';
            $body .= '<input type=submit class="button" value="Add Software" name="action">';
            $body .= '<input type=submit class="button" value="Next" name="action">';
>>>>>>> 41949a12e8bab9623cd29faa3707bd33756ae8d7
            $body .= '</form>';
        $body .= '</div>';

        $this->renderBody($body);
    }

    public function renderForm()
    {
        $body = "<br><br><br>";
        $body .= '<form id="Add" name="AddSoftware" method="post" class="dark-matter" action="software_index.php">
                    <h1>Software Adding Form
                        <span>Please fill all the fields.</span>
                    </h1>
                    <p>
                    <label for="textfield">Name:</label>
                    <input type="text" required="" placeholder="Enter Name" name="name" id="title">';
                   
            $body .= '<input type="hidden" name="action" value="validateSoftware">';
            $body .= '<input type="submit" style="margin-left: 35%" class="button" value="Add Software">';
            $body .= '</labelc>
                </form>';
        $this->renderBody($body);
    }
}
?>
