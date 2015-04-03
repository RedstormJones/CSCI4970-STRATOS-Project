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
        $body = '';
		$body .= "<br><br>";
        $body .= '<h style= title="All Active Tickets">All Active Tickets</h>';
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
            $body .= '<input type="hidden" name="action" value="addTicket">';
            $body .= '<input type=submit class="button" value="Add Ticket">';
            $body .= '</form>';
        $body .= '</div>';

        $this->renderBody($body);
	}

}

?>