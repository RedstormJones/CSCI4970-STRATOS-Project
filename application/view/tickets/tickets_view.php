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
                foreach($ticket as $cell)
                {
                    $body .= '<td>' . $cell . '</td>';
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
            $body .= '<input type=submit class="button" value="Add Ticket" name="action">';
            $body .= '<input type=submit class="button" value="Next" name="action">';
            $body .= '</form>';
        $body .= '</div>';

        $this->renderBody($body);
    }


    public function renderDropdown($elementName, $label, $tuples)
    {
        $b = '<label style="margin-left: 15%" for="select">' . $label . '</label>';
        $b .= '<select name="' . $elementName . '" id="select" size="1">
                    <option value="Please Select">Please Select</option>';

        foreach($tuples as $tuple)
        {
            $value = $tuple[0];
            $display = $tuple[1];
            $b .= "<option value=" . $value . ">" . $display . "</option>";
        }

        $b .= "</select>";
        return $b;
    }


    public function renderForm($persons, $users, $categories, $affectedLevels, $severityLevels)
    {
        $body = "<br><br><br>";
        $body .= '<form id="Add" name="AddTicket" method="post" class="dark-matter" action="tickets_index.php">
                    <h1>Ticket Adding Form
                        <span>Please fill all the fields.</span>
                    </h1>
                    <p>
                    <label for="textfield">Title:</label>
                    <input type="text" placeholder="Enter Subject" name="title" id="title">

                    <label for="textfield">Description:</label>
                    <textarea id="description" placeholder="Enter details about the ticket" name="des"></textarea>';
                    
                    $body .= $this->renderDropdown("cust"       , "Customer:"       , $persons);
                    $body .= $this->renderDropdown("assignee"   , "Assign To:"      , $users);
                    $body .= $this->renderDropdown("cid"        , "Category:"       , $categories);
                    $body .= $this->renderDropdown("affLvl"     , "Affected Level:" , $affectedLevels);
                    $body .= $this->renderDropdown("sev"        , "Severity:"       , $severityLevels);

                    $body .= '<label for="textfield">Location:</label>
                                <input type="text" placeholder="Enter Room Number" name="location" id="location">
                            <label for="textfield">Estimated Hours:</label>
                                <input type="number" placeholder="Enter Hours" name="estHrs" id="estHrs">
                            <br><br><br>
                            <labelc>';
                        $body .= '<input type="hidden" name="action" value="validateTicket">';
                        $body .= '<input type="submit" class="button" value="Add Ticket">';
                    $body .= '</labelc>
                </form>';
        $this->renderBody($body);
    }

}

?>
