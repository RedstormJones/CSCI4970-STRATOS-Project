<?php
require APP . 'view\Base_View.php';

class Hardware_View Extends Base_View
{
    public function renderHardware($hardwarelist, $start)
    {
        $body  = '<h3 title="All Active Hardware">All Active Hardware</h3>';
        $body .= "<br><br><br>";

        $body .= '<table>';
        $body .= '  <tr>';
        $body .= '      <th>Hardware#</th>';
        $body .= '      <th>Name</th>';
        $body .= '      <th>Vendor</th>';
        $body .= '      <th>Model</th>';
        $body .= '      <th>Serial</th>';
        $body .= '      <th>Type</th>';
        $body .= '      <th>Location</th>';
        $body .= '      <th>Status</th>';
        $body .= '      <th>Last Updated</th>';
        $body .= '  </tr>';

        $body .= "  <tbody>";
        foreach($hardwarelist as $hardware)
        {
            $body .= "<tr>";

            $id = $hardware[0];
            $column = 0;
                
            foreach($hardware as $cell)
            {
                if ($column == 1)
                {    
                    $body .= '<td><a href="hardware_index.php?action=Update&eid=' . $id . '">' . $cell . '</a></td>';
                }
                else
                {
                    $body .= '<td>' . $cell . '</td>';
                }
                    
                $column += 1;
            }
            $body .= "</tr>";
        }
        $body .= '  </tbody>';
        $body .= '</table>';
        $body .= '<br><br>';

        $body .= '<div style="text-align: center">';
        $body .= '  <form action="hardware_index.php">';
        $body .= '      <input type="hidden" name="start" value="'. $start .'">';
        $body .= '      <input type="hidden" name="displayed" value="' . count($hardwarelist) . '">';
        $body .= '      <input type=submit class="button" value="Previous" name="action">';
        $body .= '      <input type=submit class="button" value="New Hardware" name="action">';
        $body .= '      <input type=submit class="button" value="Next" name="action">';
        $body .= '  </form>';
        $body .= '</div>';

        $this->renderBody($body);
    }

    public function renderForm($isUpdate
                                , $eid = ''
                                , $name = ''
                                , $vendor = ''
                                , $model = ''
                                , $serial = ''
                                , $type = ''
                                , $location = ''
                                , $status = '')
    {
        $statuses = array( array( "BRKN", "Broken" )
                         , array( "CHOT", "Checked Out" )
                         , array( "CHIN", "Checked In" ) 
                         );

        $body  = '<br><br><br>';
        $body .= '  <form id="Update" name="AddOrUpdateHardware" method="post" class="dark-matter" action="hardware_index.php">';
        $body .= '      <h1>Hardware ' . ($isUpdate ? 'Updating' : 'Adding') . ' Form';
        $body .= '          <span>Please fill all the fields.</span>';
        $body .= '      </h1>';

        $body .= '      <label for="textfield">Name:</label>';
        $body .= '          <input type="text" required="" placeholder="Enter Name" name="name" value="' . $name . '" id="name">';

        $body .= '      <label for="textfield">Vendor:</label>';
        $body .= '          <input type="text" required="" placeholder="Enter Vendor" name="vendor" value="' . $vendor . '" id="vendor">';

        $body .= '      <label for="textfield">Model:</label>';
        $body .= '          <input type="text" placeholder="Enter Model" name="model" value="' . $model . '" id="model">';

        $body .= '      <label for="textfield">Serial:</label>';
        $body .= '          <input type="text" placeholder="Enter Serial No." name="serial" value="' . $serial . '" id="serial">';

        $body .= '      <label for="textfield">Type:</label>';
        $body .= '          <input type="text" placeholder="Enter Type" name="type" value="' . $type . '" id="type">';

        $body .= '      <label for="textfield">Location:</label>';
        $body .= '          <input type="text" required="" placeholder="Enter Location" name="loc" value="' . $location . '" id="loc">';

        $body .= '      <input type="hidden" name="eid" value="' . $eid . '">';

        $body .= '      <label style="margin-left: 15%" for="select">Status</label>';
        $body .= '          <select name="status" id="select" selected="' . $status . '" size="1">';
        $body .= '              <option value="">Please Select</option>';
        
        foreach ( $statuses as $cur )
        {
            $code = $cur[0];
            $dspl = $cur[1];
            $body .= '          <option value="' . $code . '"' . ($code == $status ? ' selected="selected"' : '' ) . ' >' . $dspl . '</option>';
        }

        if( $isUpdate )
        {
            $body .= '  <labelc>';
            $body .= '      <input type="submit" class="button" style="margin-left: 17%" value="Update Hardware" id="update" name="action">';
            $body .= '  </labelc>';
            $body .= '  <labelc>';
            $body .= '      <input type="submit" class="button" value="Delete Hardware" id="delete" name="action">';
            $body .= '  </labelc>';
        }
        else 
        {    
            $body .= '  <labelc>';
            $body .= '      <input type="submit" name="action" style="margin-left: 35%" class="button" value="Add Hardware">';
            $body .= '  </labelc>';
        }        
        $body .= '  </form>';
        $this->renderBody($body);
    }

}

?>
