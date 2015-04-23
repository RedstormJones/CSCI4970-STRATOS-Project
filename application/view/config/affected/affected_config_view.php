<?php
require_once('../../../globals.php');
require APP . 'view\config\Ref_Config_Base_View.php';

class Affected_Config_View Extends Ref_Config_Base_View
{
    public function renderForm( $recordList )
    {
        $description = "<br><br>This form changes the 'Affected Level' options available when creating or updating work tickets.
                        <br><br>
                        
                        Add Affected Level options for work tickets by clicking the Update button and specifying the new options name. If a new option is created to replace an existing one then 
                        <br><br>
                        1. Select the old option in the options list displayed<br>
                        2. Find and select the new option in the drop down list<br>
                        3. Click Reassign and Delete";
        $this->renderBaseForm( $recordList, $description );
    }
    
    public function renderAddOrUpdate( $isUpdate, $aff_level, $name )
    {
        $body = "<br><br><br>"; 
        $body .= '<form id="Add" name="AddAffected" method="post" class="dark-matter" action="affected_config_index.php">
                    <h1>Affected Level ' . ($isUpdate ? 'Updating' : 'Adding') . ' Form
                        <span>Please fill all the fields.</span>
                    </h1>
                    <p>
                    <label for="textfield">Name:</label>
                    <input type="text" required="" placeholder="Enter Name" name="name" id="title" value="' . $name . '">
                    ' . ($isUpdate ? '<input type="hidden" name="aff_level" value="' . $aff_level . '">' : '') . '
                    <input type="submit" style="margin-left: 35%" class="button" name="action" value="'. ($isUpdate ? 'Update' : 'Add') . ' Affected">
                    </labelc>
                </form>';
        $this->renderBody( $body );
    }
}

?>
