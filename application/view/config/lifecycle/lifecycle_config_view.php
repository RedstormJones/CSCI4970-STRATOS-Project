<?php
require_once('../../../globals.php');
require APP . 'view\config\Ref_Config_Base_View.php';

class Lifecycle_Config_View Extends Ref_Config_Base_View
{
    public function renderForm( $recordList )
    {
        $description = "<br><br>This form changes the 'Lifecyle' options available when creating or updating work tickets. <br><br>

                    Add Lifecycle options for work tickets by clicking the Update button and specifying the new Lifecycle name. 
                    If the new option is created to replace an existing one then :<br><br>
                            1. Select the old Lifecycle in the displayed list of options<br>
                            2. Find and select the new Lifecycle in the options drop down list<br>
                            3. Click Reassign and Delete";
        $this->renderBaseForm( $recordList, $description, '' );
    }

    public function renderAddOrUpdate( $isUpdate, $life_cycl_id, $name )
    {
        $body = "<br><br><br>"; 
        $body .= '<form id="Add" name="AddOrUpdateLifecycle" method="post" class="dark-matter" action="lifecycle_config_index.php">
                    <h1>Lifecycle ' . ($isUpdate ? 'Updating' : 'Adding') . ' Form
                        <span>Please fill all the fields.</span>
                    </h1>
                    <p>
                    <label for="textfield">Name:</label>
                    <input type="text" required="" placeholder="Enter Name" name="name" id="title" value="' . $name . '">
                    ' . ($isUpdate ? '<input type="hidden" name="life_cycl_id" value="' . $life_cycl_id . '">' : '') . '
                    <input type="submit" style="margin-left: 35%" class="button" name="action" value="'. ($isUpdate ? 'Update' : 'Add') . ' Lifecycle">
                    </labelc>
                </form>';
        $this->renderBody( $body );
    }
}

?>