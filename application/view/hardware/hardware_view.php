<?php
require_once('../../globals.php');
require APP . 'view\Base_View.php';

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
            $body .= '<form action="hardware_index.php">';
            $body .= '<input type="hidden" name="action" value="showHardwareForm">';
            $body .= '<input type=submit class="button" value="Add Hardware">';
            $body .= '</form>';
        $body .= '</div>';

        $this->renderBody($body);
    }

    public function renderForm()
    {
        $body = "<br><br><br>"; 
        $body .= '<form id="Add" name="AddHardware" method="post" class="dark-matter" action="hardware_index.php">
                    <h1>Hardware Adding Form
                        <span>Please fill all the fields.</span>
                    </h1>
                    <p>
                    <label for="textfield">Name:</label>
                    <input type="text" placeholder="Enter Name" name="name" id="title">
                    
                    <label for="textfield">Vendor:</label>
                    <input type="text" placeholder="Enter Vendor" name="vendor" id="vendor">
                    
                    <label for="textfield">Model:</label>
                    <input type="text" placeholder="Enter Model" name="model" id="model">
                    
                    <label for="textfield">Serial:</label>
                    <input type="text" placeholder="Enter Serial No." name="serial" id="serial">
                    
                    <label for="textfield">Type:</label>
                    <input type="text" placeholder="Enter Type" name="type" id="type">
                    
                    <label for="textfield">Location:</label>
                    <input type="text" placeholder="Enter Location" name="loc" id="loc">
                    
                    <label style="margin-left: 15%" for="select">Status</label>
                    <select name="status" id="select" size="1">
                        <option value="Please Select">Please Select</option>
                        <option value="BRKN">Broken</option>
                        <option value="CHOT">Checked Out</option>
                        <option value="CHIN">Checked In</option>';

                    
            $body .= '<input type="hidden" name="action" value="validateHardware">';
            $body .= '<input type="submit" class="button" value="Add Hardware">';
            $body .= '</labelc>
                </form>';
        $this->renderBody($body);
    }

}

?>
