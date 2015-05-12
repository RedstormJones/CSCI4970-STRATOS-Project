<?php
include "..\Base_View.php";

class Software_View Extends Base_View
{

    #-------------------------------------------------#
    # creates the html to display the software, then  #
    # sends the html to renderBody() in the base view #
    # to actually render the html to the webpage      #
    #-------------------------------------------------#
    public function renderSoftware($softwarelist, $start)
    {
        $body = '<h3 title="All Active Software">All Active Software</h3>';
        
        #---------------------------------------------------#
        # Uncomment the addition to $body below to make the #
        # search bar appear on the STRATOS Software page    #
        #---------------------------------------------------#
        #$body .= '<div class="pull-right">
        #        <form class="form-inline" role="form">
        #            <div class="form-group">
        #                <label class="sr-only" for="search-text">Search Software :</label>
        #                <input type="text" id="search-text" placeholder="Enter Software #">
        #                <button type="button" id="search-btn">Search</button>
        #            </div>
        #        </form>
        #    </div>';
        
        $body .= "<br><br>";

        $body .= '<table>';
        $body .= '    <tr>';
        $body .= '      <th>Software#</th>';
        $body .= '      <th>Name</th>';
        $body .= '      <th>Created</th>';
        $body .= '      <th>Last Updated</th>';
        $body .= '    </tr>';

        $body .= '  <tbody>';
        foreach($softwarelist as $software)
        {
            $body .= '<tr>';
            $id = $software[0];
            $column = 0;
            
            foreach($software as $cell)
            {
                if ($column == 1)
                {    
                    $body .= '<td><a href="software_index.php?action=Update&sid=' . $id . '">' . $cell . '</a></td>';
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
        $body .= '  <form action="software_index.php">';
        $body .= '      <input type="hidden" name="start" value="'. $start .'">';
        $body .= '      <input type="hidden" name="displayed" value="' . count($softwarelist) . '">';
        $body .= '      <input type="submit" class="button" value="Previous" name="action">';
        $body .= '      <input type="submit" class="button" value="New Software" name="action">';
        $body .= '      <input type="submit" class="button" value="Next" name="action">';
        $body .= '  </form>';
        $body .= '</div>';

        $this->renderBody($body);
    }

    #------------------------------------------------#
    # creates the html for the add / update software #
    # form, then sends the html to renderBody() in   #
    # the base view to render it to the webpage      #
    #------------------------------------------------#
    public function renderForm($isUpdate, $sid = '', $name = '')
    {
        $body  = '<br><br><br>';
        $body .= '  <form id="Update" name="AddOrUpdateSoftware" method="post" class="dark-matter" action="software_index.php">';
        $body .= '      <h1>Software ' . ($isUpdate ? 'Updating' : 'Adding') . ' Form';
        $body .= '          <span>Please fill all the fields.</span>';
        $body .= '      </h1>';

        $body .= '      <input type="hidden" name="sid" value="' . $sid . '">';

        $body .= '      <label for="textfield">Name:</label>';
        $body .= '          <input type="text" required="" placeholder="Enter Name" name="name" value="' . $name .'" id="name">';
                   
        if( $isUpdate )
        {
            $body .= '  <labelc>';
            $body .= '      <input type="submit" class="button" style="margin-left: 35%" value="Update Software" id="update" name="action">';
            $body .= '  </labelc>';
            $body .= '  <labelc>';
            $body .= '      <input type="submit" class="button" style="margin-left: 65%" value="Delete Software" id="delete" name="action">';
            $body .= '  </labelc>';
        }
        else 
        {    
            $body .= '  <labelc>';
            $body .= '      <input type="submit" name="action" style="margin-left: 117%" class="button" value="Add Software">';
            $body .= '  </labelc>';
        }
        $body .= '  </form>';
        $this->renderBody($body);
    }
}
?>