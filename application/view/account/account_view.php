<?php
require APP . 'view\Base_View.php';

class Account_View extends Base_View
{

    /** 
     * Displays the configurable information for the currently logged
     * on user and allows the user to change this information
     * 
     * @param $pid : Integer (that hold the person identification number)
     * @param $fname : String (a string that holds the first name)
     * @param $lname : String (a string that holds the last name)
     * @param $user : String (a string that holds the user name)
     * @param $email : String (a string that holds the email address)
     * @param $phone : String (a string that holds the phone number)
     */
    public function renderForm($pid, $fname, $lname, $user, $email, $phones)
    {
        $body = '<h3 title="Current User Information">Current ' . $user .' Information</h3>';
        $body .= "<br><br><br>";
		
		$body .= '<form id="upform" action="account_index.php" >';

        $body .= '  <table>';
        $body .= '      <tr>';
        $body .= '          <th>First name</th>';
        $body .= '          <th>Last name</th>';
        $body .= '          <th>Email</th>';
        $body .= '      </tr>';
           
        $body .= '      <tr>';
		$body .= '          <td> <input type="text" name="fname" value="'. $fname .'"> </td> ';
		$body .= '          <td> <input type="text" name="lname" value="'. $lname .'" > </td>';
		$body .= '          <td> <input type="email" name="email" value="'. $email .'"> </td>';
	    $body .= '  </table>';

        $body .= '  <input type="hidden" name ="pid" value="' . $pid . '">';

        $body .= '  <br><br>';

        $body .= '  <table>';
        $body .= '      <tr>';
        $body .= '          <th>Type</th>';
        $body .= '          <th>Country Code</th>';
        $body .= '          <th>Area Code</th>';
        $body .= '          <th>Local</th>';
        $body .= '          <th>Local</th>';
        $body .= '          <th>Delete</th>';
        $body .= '      </tr>';

        $phone_types = array( array( "HOME", "Home Phone" )
                            , array( "BUSN", "Work Phone" )
                            , array( "CELL", "Mobile Phone" ) 
                            );

        $phone_count = count($phones);
        for( $i = 0; $i < 3; ++$i )
        {
            $row    = $i < $phone_count ? $phones[$i] : null;

            $type   = $row ? $row[0] : '';
            $intl   = $row ? $row[1] : '';
            $area   = $row ? $row[2] : '';
            $phone1 = $row ? $row[3] : '';
            $phone2 = $row ? $row[4] : '';
            
            $body .= '  <tr>';
            $body .= '      <td>';
            $body .= '          <select name="Phone" id="Phone">';
            foreach( $phone_types as $phone_type )
            {
                $code  = $phone_type[0];
                $dspl  = $phone_type[1];
                $sel   = $code == $type ? 'selected="selected"' : '';
                $body .= '          <option ' . $sel . ' value="' . $code . '">' . $dspl . '</option>"';
            }
            $body .= '          </select>';
            $body .= '      </td>';
            $body .= '      <td> <input type="text" value="' . $intl      . '" name="phone_intl_'.$i      . '"> </td>';
            $body .= '      <td> <input type="text" value="' . $area      . '" name="phone_area_'.$i      . '"> </td>';
            $body .= '      <td> <input type="text" value="' . $phone1    . '" name="phone_phone1_'.$i    . '"> </td>';
            $body .= '      <td> <input type="text" value="' . $phone2    . '" name="phone_phone2_'.$i    . '"> </td>';
            $body .= '      <td> <input type="checkbox" name="phone_del_' . $i . '" ' . ($row ? '' : 'checked') . '> </td>';
            $body .= '  </tr>';
        }

        $body .= '  </table>';

        $body .= '  <br><br>';
                    
        $body .= '  <div style="text-align: center">';
        $body .= '      <input type=submit class="button" name="action" value="Update Account Settings">';
        $body .= '  </div>';
        $body .= '</form>';

        $this->renderBody($body);
    }

}

?>