<?php
require APP . 'view\config\Ref_Config_Base_View.php';

class Lifecycle_Config_View extends Ref_Config_Base_View
{
    /**
     *  Displays configurable information for the Lifecycle options on service
     * tickets. Uses the function in base class to display form.
     * 
     * @param $recordList : Array (this holds the information about Life Cycle configuration)
     */
    public function renderForm( $recordList )
    {
        $description = "<br><br>This form changes the 'Lifecyle' options available when creating or updating work tickets. <br><br>

                    Add Lifecycle options for work tickets by clicking the Update button and specifying the new Lifecycle name. 
                    If the new option is created to replace an existing one then :<br><br>
                            1. Select the old Lifecycle in the displayed list of options<br>
                            2. Find and select the new Lifecycle in the options drop down list<br>
                            3. Click Reassign and Delete";
        $this->renderBaseForm( $recordList, $description );
    }

    /**
     *  Displays the actual html form for configuring the Lifecycle
     * options on the service tickets. It overrides the actual base function.
     * 
     * @param $recordList : Array (that holds the data about Lifecyle configuration id and name)
     * @param $description : String (string holding the instruction that is to be displayed on form)
     */
    public function renderBaseForm( $recordList, $description )
    {
        $body                            = '<form id="Existing" name="DeleteOrUpdate" method="get" class="dark-matter" action="">';
        $body                           .= '    <h1>Configuration Form';
        $body                           .= '        <span>' . $description . '</span>';     
        $body                           .= '    </h1>';

        $body                           .= '    <table class="tablef">';
        $body                           .= '        <tr>';
        $body                           .= '            <th>Name</th>';
        $body                           .= '            <th>Timed</th>';
        $body                           .= '        </tr>';
        foreach( $recordList as $record )
        {
            $id     = $record[0];
            $name   = $record[1];
            $timed  = $record[2];
            $body                       .= '        <tr>';
            $body                       .= '            <td><input type="radio" name="original" value="' . $id . '">' . $name . '</td>';
            $body                       .= '            <td>' . ($timed ? 'Yes' : 'No') . '</td>';
            $body                       .= '        </tr>';
        }
        $body                           .= '    </table>';

        $body                           .= '    <br>';
        $body                           .= '    <label for="select">Reassign To:</label>';
        $body                           .= '    <select name="reassign" id="select" size="1">';
        
        foreach( $recordList as $record )
        {
            $id     = $record[0];
            $name   = $record[1];
            $body                       .= '        <option value="' . $id . '">' . $name . '</option>';
        }
        $body                           .= '    </select>';
        $body                           .= '    <br>';
        
        $body                           .= '    <div align="center"';
        $body                           .= '    <labelc>';
        $body                           .= '        <input type="submit" class="button" style="text-align: left" value="Reassign and Delete" id="delete" name="action">';
        $body                           .= '    </labelc>';

        $body                           .= '    <labelc>';
        $body                           .= '        <input type="submit" class="button" style="text-align: center" value="Update" id="update" name="action">';
        $body                           .= '    </labelc>';
        
        $body                           .= '    <labelc>';
        $body                           .= '        <input type="submit" class="button" style="text-align: right" value="Add" id="add" name="action">';
        $body                           .= '    </labelc>';
        $body                           .= '    </div>';
        $body                           .= '</form>';

        $this->renderBody( $body );
    }

    /**
     *  Allows users to add new ticket Lifecycle options or reassign current
     * Lifecycle options to other values. 
     * 
     * @param $isUpdate : Boolean (this will decide whether user is adding or updating)
     * @param $life_cycle_id : Integer (holds number of lifecycle)
     * @param $name : String (string that holds the name of the lifecycle corresponding to the number)
     * @param $timed : Boolean (holds whether or not it is timed or not)
     */
    public function renderAddOrUpdate( $isUpdate, $life_cycl_id, $name, $timed )
    {
        $body  = '<br><br><br>'; 
        $body .= '<form id="Add" name="AddOrUpdateLifecycle" method="get" class="dark-matter" action="lifecycle_config_index.php">';
        $body .= '  <h1>Lifecycle ' . ($isUpdate ? 'Updating' : 'Adding') . ' Form';
        $body .= '      <span>Please fill all the fields.</span>';
        $body .= '  </h1>';

        $body .= '  <label for="textfield">Name:</label>';
        $body .= '      <input type="text" required="" placeholder="Enter Name" name="name" id="title" value="' . $name . '">';
        $body .= '  <label for="textfield">Is timed: <input type="checkbox" name="timed" ' . ($timed ? 'checked' : '') . '></label>';

        $body .= '  <br>';

        $body .= '      <input type="hidden" name="life_cycl_id" value="' . $life_cycl_id . '">';
        $body .= '      <input type="submit" style="margin-left: 35%" class="button" name="action" value="'. ($isUpdate ? 'Update' : 'Add') . ' Lifecycle">';
        $body .= '  </labelc>';
        $body .= '</form>';

        $this->renderBody( $body );
    }
}

?>