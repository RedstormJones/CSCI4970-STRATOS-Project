<?php
require APP . 'view\Base_View.php';

class Hardware_View Extends Base_View
{
    public function renderHardware($hardwarelist, $start)
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
                $id = $hardware[0];
                $column = 0;
                
                foreach($hardware as $cell)
                {
                    if ($column == 1)
                    {    
                        $body .= '<td><a href="hardware_index.php?action=Update&hid=' . $id . '">' . $cell . '</a></td>';
                    }
                    else
                    {
                        $body .= '<td>' . $cell . '</td>';
                    }
                    
                    $column += 1;
                }
                $body .= "</tr>";
            }
            $body .= '</tbody>
        </table>
        <br><br>';
        $body .= '<div style="text-align: center">';
            $body .= '<form action="hardware_index.php">';
            $body .= '<input type="hidden" name="start" value="'. $start .'">';
            $body .= '<input type="hidden" name="displayed" value="' . count($hardwarelist) . '">';
            $body .= '<input type=submit class="button" value="Previous" name="action">';
            $body .= '<input type=submit class="button" value="Add Hardware" name="action">';
            $body .= '<input type=submit class="button" value="Next" name="action">';
            $body .= '</form>';
        $body .= '</div>';

        $this->renderBody($body);
    }

    public function renderForm($isUpdate)
    {
        $body = "<br><br><br>"; 
        if($isUpdate == TRUE)
        {
            $body .= '<form id="Update" name="UpdateHardware" method="post" class="dark-matter" action="hardware_index.php">
        
                    <h1>Hardware Updating Form
                        <span>Please fill all the fields.</span>
                    </h1>';
        }
        else 
        {    
            $body .= '<form id="Add" name="AddHardware" method="post" class="dark-matter" action="hardware_index.php">
                        <h1>Hardware Adding Form
                            <span>Please fill all the fields.</span>
                        </h1>';
        }
        $body .= ' <p>
                    <label for="textfield">Name:</label>
                    <input type="text" required="" placeholder="Enter Name" name="name" id="title">
                    
                    <label for="textfield">Vendor:</label>
                    <input type="text" required="" placeholder="Enter Vendor" name="vendor" id="vendor">
                    
                    <label for="textfield">Model:</label>
                    <input type="text" placeholder="Enter Model" name="model" id="model">
                    
                    <label for="textfield">Serial:</label>
                    <input type="text" placeholder="Enter Serial No." name="serial" id="serial">
                    
                    <label for="textfield">Type:</label>
                    <input type="text" placeholder="Enter Type" name="type" id="type">
                    
                    <label for="textfield">Location:</label>
                    <input type="text" required="" placeholder="Enter Location" name="loc" id="loc">
                    
                    <label style="margin-left: 15%" for="select">Status</label>
                    <select name="status" id="select" size="1">
                        <option value="Please Select">Please Select</option>
                        <option value="BRKN">Broken</option>
                        <option value="CHOT">Checked Out</option>
                        <option value="CHIN">Checked In</option>';

            if($isUpdate == TRUE)
            {
                $body .= ' "<labelc>                
                        <input type="submit" class="button" style="margin-left: 17%" value="Update Hardware" id="update" name="action">            
                        </labelc>            
                        <labelc>                
                        <input type="submit" class="button" value="Delete Hardware" id="delete" name="action">';
            }
            else 
            {    
                $body .= '<labelc><input type="hidden" name="action" value="validateHardware">';
                $body .= '<input type="submit" style="margin-left: 35%" class="button" value="Add Hardware">';
            }        
            $body .= '</labelc>
                </form>';
        $this->renderBody($body);
    }

}

?>
