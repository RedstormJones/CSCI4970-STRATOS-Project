<?php
require APP . 'view\config\Ref_Config_Base_View.php';

class Severity_Config_View Extends Ref_Config_Base_View
{
    public function renderForm( $recordList )
    {
        $description = "<br><br>This form changes the 'Severity' options available when creating or updating work tickets.<br><br>

                        Add Severity options for work tickets by clicking the Update button and specifying the new Severity name. 
                        If the new option is created to replace an existing one then :<br><br>
                        1. Select the old Severity in the displayed list of options<br>
                        2. Find and select the new Severity in the options drop down list<br>
                        3. Click Reassign and Delete";
        $this->renderBaseForm( $recordList, $description );
    }

    public function renderAddOrUpdate( $isUpdate, $severity, $name )
    {
        $body = "<br><br><br>"; 
        $body .= '<form id="Add" name="AddOrUpdateSeverity" method="post" class="dark-matter" action="severity_config_index.php">
                    <h1>Severity ' . ($isUpdate ? 'Updating' : 'Adding') . ' Form
                        <span>Please fill all the fields.</span>
                    </h1>
                    <p>
                    <label for="textfield">Name:</label>
                    <input type="text" required="" placeholder="Enter Name" name="name" id="title" value="' . $name . '">
                    ' . ($isUpdate ? '<input type="hidden" name="severity" value="' . $severity . '">' : '') . '
                    <input type="submit" style="margin-left: 35%" class="button" name="action" value="'. ($isUpdate ? 'Update' : 'Add') . ' Severity">
                    </labelc>
                </form>';
        $this->renderBody( $body );
    }
}

?>
