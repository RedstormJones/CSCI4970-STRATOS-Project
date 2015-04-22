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
                $id = $software[0];
                $check = 0;
                
                foreach($software as $cell)
                {
                    if ($check == 1)
                    {    
                        $body .= '<td><a href="software_index.php?action=Update&sid=' . $id . '">' . $cell . '</a></td>';
                    }
                    else
                    {
                        $body .= '<td>' . $cell . '</td>';
                    }
                    
                    $check += 1;
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
            $body .= '<input type="submit" class="button" value="Previous" name="action">';
            $body .= '<input type="submit" class="button" value="New Software" name="action">';
            $body .= '<input type="submit" class="button" value="Next" name="action">';
            $body .= '</form>';
        $body .= '</div>';

        $this->renderBody($body);
    }

    public function renderForm($isUpdate, $sid = '', $name = '')
    {
        $body = "<br><br><br>";
        if($isUpdate == TRUE)
        {
            $body .= '<form id="Update" name="UpdateSoftware" method="post" class="dark-matter" action="Software_index.php">
        
                    <h1>Software Updating Form
                        <span>Please fill all the fields.</span>
                    </h1>';
        }
        else 
        {    
            $body .= '<form id="Add" name="AddSoftware" method="post" class="dark-matter" action="Software_index.php">
                        <h1>Software Adding Form
                            <span>Please fill all the fields.</span>
                        </h1>';
        }
        $body .=        '<p>
                            <input type="hidden" name="sid" value="' . $sid . '">
                            <label for="textfield">Name:</label>
                            <input type="text" required="" placeholder="Enter Name" name="name" value="' . $name .'" id="name">';
                   
                if($isUpdate == TRUE)
                {
                    $body .= '<labelc>                
                                <input type="submit" class="button" style="margin-left: 35%" value="Update Software" id="update" name="action">            
                                </labelc>            
                                <labelc>                
                                <input type="submit" class="button" style="margin-left: 65%" value="Delete Software" id="delete" name="action">';
                }
                else 
                {    
                    $body .= '<input type="submit" name="action" style="margin-left: 35%" class="button" value="Add Software">';
                }  
            $body .= '</labelc>
                </form>';
        $this->renderBody($body);
    }
}
?>