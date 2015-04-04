<?php
include "Base_View.php";


class Tickets_View Extends Base_View
{
    public function renderTicket($tid, $title, $cname, $pname, $lname, $insrt_tmst, $last_mdfd_tmst)
    {
        echo "<tr>";
            echo '<td>' . ($tid) . '</td>';
            echo '<td>' . ($title) . '</td>';
            echo '<td>' . ($cname) . '</td>';
            echo '<td>' . ($pname) . '</td>';
            echo '<td>' . ($lname) . '</td>';
            echo '<td>' . ($insrt_tmst) . '</td>';
            echo '<td>' . ($last_mdfd_tmst) . '</td>';
        echo "</tr>";
    }


	public function renderTickets($ticketlist)
	{
        $body = '<h3 title="All Active Tickets">All Active Tickets</h3>';
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
                    $body .= '<td>' . (isset($ticket->tid) ? $ticket->tid : "") . '</td>';
                    $body .= '<td>' . (isset($ticket->title) ? $ticket->title : "") . '</td>';
                    $body .= '<td>' . (isset($ticket->cname) ? $ticket->cname : "") . '</td>';
                    $body .= '<td>' . (isset($ticket->pname) ? $ticket->pname : "") . '</td>';
                    $body .= '<td>' . (isset($ticket->lname) ? $ticket->lname : "") . '</td>';
                    $body .= '<td>' . (isset($ticket->insrt_tmst) ? $ticket->insrt_tmst : "") . '</td>';
                    $body .= '<td>' . (isset($ticket->last_mdfd_tmst) ? $ticket->last_mdfd_tmst : "") . '</td>';
                $body .= "</tr>";
            }
            $body .= '</tbody>
        </table>
        <br><br>';
        $body .= '<div style="text-align: center">';
            $body .= '<form action="addtickets.php">';
            $body .= '<input type="hidden" name="action" value="showTicketForm">';
            $body .= '<input type=submit class="button" value="Add Ticket">';
            $body .= '</form>';
        $body .= '</div>';

        $this->renderBody($body);
	}


    public function getMenu($table, $col1, $col2, $selectName, $name)
    {
        $b = '<label style="margin-left: 15%" for="select">' . $name . '</label>';
        $b .= '<select name="' . $selectName . '" id="select" size="1">
                    <option value="Please Select">Please Select</option>
                    <!--<!Manually making dropdown because need to display more than one column -->';
        foreach($table as $t)
        {
            $b .= "<option value=" . $t->$col1 . ">" . $t->$col2 . "</option>";
        }
        $b .= "</select>";
        return $b;
    }


    public function getMenu2($table, $col1, $col2, $col3, $selectName, $name)
    {
        $b = '<label style="margin-left: 15%" for="select">' . $name . '</label>';
        $b .= '<select name="' . $selectName . '" id="select" size="1">
                    <option value="Please Select">Please Select</option>
                    <!--<!Manually making dropdown because need to display more than one column -->';
        foreach($table as $t)
        {
            $b .= "<option value=" . $t->$col1 . ">" . $t->$col2;
            $b .= " " . $t->$col3 . "</option>";
        }
        $b .= "</select>";
        return $b;
    }


    public function renderForm($cust_menu, $assign_menu, $categ_menu, $aff_menu, $sev_menu)
    {
        $body = "<br><br><br>";
        $body .= '<form id="Add" name="AddTicket" method="post" class="dark-matter" action="ATForm.php">
                    <h1>Ticket Adding Form
                        <span>Please fill all the fields.</span>
                    </h1>
                    <p>
                        <label for="textfield">Title:</label>
                        <input type="text" placeholder="Enter Subject" name="title" id="title">

                        <label for="textfield">Description:</label>
                        <textarea id="description" placeholder="Enter details about the ticket" name="des"></textarea>';
                        $body .= $this->getMenu2($cust_menu, "pid", "fname", "lname", "cust", "Customer:");
                        $body .= $this->getMenu($assign_menu, "pid", "user", "assignee", "Assign To:");
                        $body .= $this->getMenu($categ_menu, "cid", "name", "category", "Category:");
                        $body .= $this->getMenu($aff_menu, "aff_level", "name", "affLvl", "Affected Level:");
                        $body .= $this->getMenu($sev_menu, "severity", "name", "sev", "Severity:");
        $body .= '<label for="textfield">Location:</label>
                    <input type="text" placeholder="Enter Room Number" name="location" id="location">
                    <label for="textfield">Estimated Hours:</label>
                    <input type="number" placeholder="Enter Hours" name="estHrs" id="estHrs">
                    <br><br><br>
                    <labelc>
                        <input type="submit" class="button" value="Add Ticket" id="add" name="action">
                    </labelc>
                    <labelc>
                        <input type="submit" class="button" value="Go Back" name="action">
                    </labelc>
                </form>';

        $this->renderBody($body);
    }

}

?>