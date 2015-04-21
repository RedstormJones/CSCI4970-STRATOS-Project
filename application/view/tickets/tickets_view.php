<?php
include "..\Base_View.php";

class Tickets_View Extends Base_View
{
    public function renderTickets($ticketlist, $start)
    {
        $body = '<h3 "All Active Tickets">All Active Tickets</h3>';
        $body .= "<br><br><br>";
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


    public function renderDropdown($elementName, $label, $tuples, $selected)
    {
        $b = '<label style="margin-left: 15%" for="select">' . $label . '</label>';
        $b .= '<select name="' . $elementName . '" id="select" selected="' . $selected . '" size="1">
                    <option value="Please Select">Please Select</option>';

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
                              , $last_open )
    {
        $body = "<br><br><br>";
        $form_title = "Add Ticket";
        if ( $isUpdate ) $form_title = "Update Ticket";

        $body .= '<form id="Add" name="AddTicket" method="post" class="dark-matter" action="tickets_index.php">
                    <h1>' . $form_title . '
                        <span>Please fill all the fields.</span>
                    </h1>
                    <p>
                    <label for="textfield">Title:</label>
                    <input type="text" placeholder="Enter Subject" name="title" id="title" value="' . $title . '">

                    <label for="textfield">Description:</label>
                    <textarea id="description" placeholder="Enter details about the ticket" name="des">' . $desc . '</textarea>';
                    
                    $body       .= $this->renderDropdown("cust"         , "Customer:"       , $persons          , $cust         );
                    $body       .= $this->renderDropdown("assignee"     , "Assign To:"      , $users            , $assigned     );
                    $body       .= $this->renderDropdown("cid"          , "Category:"       , $categories       , $category     );
                    $body       .= $this->renderDropdown("affLvl"       , "Affected Level:" , $affectedLevels   , $affected     );
                    $body       .= $this->renderDropdown("sev"          , "Severity:"       , $severityLevels   , $severity     );
                    if ( $isUpdate )
                    {
                        $body   .= $this->renderDropDown("lifecycle"    , "Lifecycle:"      , $lifecycles       , $lifecycle    );
                    }

                    $body .= '<label for="textfield">Estimated Hours:</label>
                                <input type="number" placeholder="Enter Hours" name="estHrs" id="estHrs" value="' . $est . '">
                            <br><br><br>
                            <labelc>';
 
                        if ( $isUpdate )
                        {
                            $body .= '<input type="submit" class="button" value="Update Ticket" name="action">';
                            $body .= '<input type="submit" class="button" value="Delete Ticket" name="action">';
                            $body .= '<input type="hidden" name="tid" value="' . $tid . '">';
                            $body .= '<input type="hidden" name="last_open" value="' . $last_open . '">';
                        }
                        else
                        {
                            $body .= '<input type="submit" class="button" value="Add Ticket" name="action">';
                        }
                    $body .= '</labelc>
                </form>';
        $this->renderBody($body);
    }



}

?>
