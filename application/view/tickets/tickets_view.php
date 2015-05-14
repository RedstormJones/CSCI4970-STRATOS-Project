<?php
include "..\Base_View.php";

class Tickets_View extends Base_View
{
    /**
     * Creates the html to display the Global tickes, then sends the html to 
     * renderBody() function in the base view to render the html to web
     * 
     * @param $ticketlist : : Array (holds the lists of tickets objects)
     * @param $start : Integer (holds the starting number of tickets to be displayed in webpage)
     */
    public function renderTickets($ticketlist, $start)
    {
        $body = '<h3 "All Service Tickets">All Service Tickets</h3>';
        
        #------------------------------------------------#
        # Uncomment the addition to $body below to make  #
        # the search bar appear on the STRATOS Home page #
        #------------------------------------------------#        
        #$body .= '<div class="pull-right">
        #        <form class="form-inline" role="form">
        #            <div class="form-group">
        #                <label class="sr-only" for="search-text">Search Active Tickets :</label>
        #                <input type="text" id="search-text" placeholder="Enter Ticket #">
        #                <button type="button" id="search-btn">Search</button>
        #            </div>
        #        </form>
        #    </div>';
        
        $body .= "<br><br>";
        $body .= '<table>
            <tr>
                <th>Ticket#</th>
                <th>Title</th>      
                <th>Subjects</th>
                <th>Priority</th>
                <th>Status</th>     
                <th>Created</th>
                <th>Last Updated</th>
            </tr>';

        $body .= "<tbody>";
            foreach($ticketlist as $ticket)
            {
                $body .= "<tr>";
                $id = $ticket[0];
                $column = 0;
                foreach($ticket as $cell)
                {
                    if ( $column == 1 )
                    {
                        $body .= '<td><a href="tickets_index.php?action=Update&tid=' . $id . '">' . $cell . '</a></td>';
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
            $body .= '<form action="tickets_index.php">';
            $body .= '<input type="hidden" name="start" value="'. $start .'">';
            $body .= '<input type="hidden" name="displayed" value="' . count($ticketlist) . '">';
            $body .= '<input type=submit class="button" value="Previous" name="action">';
            $body .= '<input type=submit class="button" value="New Ticket" name="action">';
            $body .= '<input type=submit class="button" value="Next" name="action">';
            $body .= '</form>';
        $body .= '</div>';

        $this->renderBody($body);
    }

    /**
     * Creates the html for the drop down lists used to set/update service tickets
     * options.
     * 
     * @param $elementName : String (holds the variable name of the menu)
     * @param $label : String (Holds the title name of the menu)
     * @param $tuples : Array (holds the information id and name on the genneral data)
     * @param $selected : String (holds the selected option to be displayed in the menu)
     * 
     * @return string that has the html for creating dropdown.
     */
    public function renderDropdown($elementName, $label, $tuples, $selected)
    {
        $b = '<label style="margin-left: 15%" for="select">' . $label . '</label>';
        $b .= '<select name="' . $elementName . '" id="select" selected="' . $selected . '" size="1">
                    <option value="">Please Select</option>';

        foreach($tuples as $tuple)
        {
            $value = $tuple[0];
            $display = $tuple[1];
            $b .= '<option ';
            if ( $value == $selected )
                $b .= 'selected="selected" ';
            $b .= 'value="' . $value . '">' . $display . '</option>';
        }

        $b .= "</select>";
        return $b;
    }

    /**
     * Creates the html for the add/update hardware form, then calls the function
     * renderBody() in the base view to display in the webpage and renderDropDown()
     * from this same file to get drop down menus.
     * 
     * @param $persons : Array (holds all the person's information)
     * @param $users : Array (holds all the user's information)
     * @param $categories : Array (holds all the category information)
     * @param $affectedLevels : Array (holds all the affected level information)
     * @param $severityLevels : Array (holds all the severity level information)
     * @param $lifecycles : Array (holds all the lifecycle's information)
     * @param $isUpdate : Boolean (whether to add or update ticket)
     * @param $title : String (Holds the title of the ticket)
     * @param $desc : String (holds the description of the ticket)
     * @param $cust : String (holds the customer of the ticket)
     * @param $assigned : String (holds the assigned to of the ticket)
     * @param $category : String (holds the category of the ticket)
     * @param $affected : String (holds the affected level of the ticket)
     * @param $severity : String (holds the severity of the ticket)
     * @param $lifecycle : String (holds the lifecycle of the ticket)
     * @param $est : Integer (holds the estimated of the ticket)
     * @param $tid : Integer (holds the eid of the ticket)
     */
    public function renderForm( $persons
                              , $users
                              , $categories
                              , $affectedLevels
                              , $severityLevels 
                              , $lifecycles
                              , $isUpdate
                              , $title
                              , $desc
                              , $cust
                              , $assigned
                              , $category
                              , $affected
                              , $severity
                              , $lifecycle
                              , $est
                              , $tid
                              )
    {
        $body  = '<br><br><br>';
        $body .= '<form id="Add" name="AddOrUpdateTicket" method="post" class="dark-matter" action="tickets_index.php">';
        $body .= '  <h1>';
        $body .=        ($isUpdate ? 'Update' : 'Add') . ' Ticket';
        $body .= '      <span>Please fill all the fields.</span>';
        $body .= '  </h1>';

        $body .= '  <label for="textfield">Title:</label>';
        $body .= '      <input type="text" placeholder="Enter Subject" name="title" id="title" value="' . $title . '">';

        $body .= '  <label for="textfield">Description:</label>';
        $body .= '      <textarea id="description" placeholder="Enter details about the ticket" name="des">' . $desc . '</textarea>';
                    
        $body .=    $this->renderDropdown("cust"         , "Customer:"       , $persons          , $cust         );
        $body .=    $this->renderDropdown("assignee"     , "Assign To:"      , $users            , $assigned     );
        $body .=    $this->renderDropdown("cid"          , "Category:"       , $categories       , $category     );
        $body .=    $this->renderDropdown("affLvl"       , "Affected Level:" , $affectedLevels   , $affected     );
        $body .=    $this->renderDropdown("sev"          , "Severity:"       , $severityLevels   , $severity     );
        $body .=    $this->renderDropDown("lifecycle"    , "Lifecycle:"      , $lifecycles       , $lifecycle    );

        $body .= '  <label for="textfield">Estimated Hours:</label>';
        $body .= '      <input type="number" placeholder="Enter Hours" name="estHrs" id="estHrs" value="' . $est . '">';

        $body .= '      <input type="hidden" name="tid" value="' . $tid . '">';
        
        if ( $isUpdate )
        {
            $body .= '  <input type="submit" class="button" style="margin-left: 34%" value="Update Ticket" id="update" name="action">';

            $body .= '  <br><br>';

            $body .= '  <input type="submit" class="button" style="margin-left: 34.6%" value="Delete Ticket" id="delete" name="action">';
        }
        else
        {
            $body .= '  <input type="submit" class="button" style="margin-left: 35%" value="Add Ticket" name="action">';
        }
        $body .= '</form>';

        $this->renderBody($body);
    }
}

?>
