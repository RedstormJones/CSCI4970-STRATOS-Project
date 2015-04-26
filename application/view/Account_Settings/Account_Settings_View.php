<?php
require APP . 'view\Base_View.php';

class Account_Settings_View Extends Base_View
{
    public function render_Account_Settings($pid, $fname, $lname, $user, $email, $rows)
    {
        $body = '<h3 title="Current User Information">Current ' . $user .' Information</h3>';
        $body .= "<br><br><br>";
		
		$body .= '<form id="upform" action="Account_Settings_Index.php" >';

        $body .= '<table>
            <tr>
                <th>First name</th> 
                <th>Last name</th>      
                <th>Email</th>
            </tr>';
           
        $body .= "<tr>";
		$body .= '<input type="hidden" name ="pid" value="' . $pid . '">';
		$body .= '<td> <input type="text" name="fname" value="'. $fname .'"> </td> ';
		$body .= '<td> <input type="text" name="lname" value="'. $lname .'" > </td>';
		$body .= '<td> <input type="email" name="email" value="'. $email .'"> </td>';
		$body .= '</table>';
		$body .="<br> <br>";
		$body .= '<table>
				<tr>
			     <th>Type</th>
                 <th>Country Code</th>     
                <th>Area Code</th>
                <th>Local</th>
                <th>Local</th>
			</tr>';
			for( $i = 0; $i < 5; ++$i )
            {
				$row = $i < count($rows) ? $rows[$i] : null;
				$body .= "<tr>";
				$type = $row ? $row[0] : '';
				$intl = $row[1];
				$area = $row[2];
				$phone1 = $row[3];
				$phone2 = $row[4];
				// Here is the drop down 
/*				$body .= '<td><select name="Phone" id="Phone" onchange="changeValue();">
							<option value="Home" >Home</option>"
							<option value="Busn" >Business</option>"
							<option value="Cell" >CellPhone</option>"
							</select></td>';

 ?>
				<script type="text/javascript">
				function changeValue()
				{
					var option=document.getElementById('Phone').value;
					if(option=="Home"){
						document.getElementById('phone_type_' . $i . '').value="HOME";
					}
					else if(option=="BUSN"){
						document.getElementById('phone_type_' . $i . '').value="BUSN";
					}
					else if(option=="CELL"){
						document.getElementById('phone_type_' . $i . '').value="CELL";
					}
				}
				</script>
 <?php				*/
				$body .= '<td> <input type="text" value="' . $type . '" name="phone_type_' . $i . '"> </td>';
				$body .= '<td> <input type="text" value="' . $intl . '" name="phone_intl_' . $i . '"> </td>';
				$body .= '<td> <input type="text" value="' . $area . '" name="phone_area_' . $i . '"> </td>';
				$body .= '<td> <input type="text" value="' . $phone1 . '" name="phone_phone1_' . $i . '"> </td>';
				$body .= '<td> <input type="text" value="' . $phone2 . '" name="phone_phone2_' . $i . '"> </td>';
				$body .= "</tr>";
            }

            
		$body .='</table>
        <br><br>';
					
        $body .= '<div style="text-align: center">';
        $body .= '<input type=submit class="button" name="action" value="Update Account Settings">';
		$body .= '<input type=submit class="button" onclick="myFunction()" value="Undo Changes">';
        $body .= '</form>';
        $body .= '</div>';

        $this->renderBody($body);
    }

}
?>
<script>
function myFunction() {
    document.getElementById("upform").reset();
}
</script>

<?php

?>
