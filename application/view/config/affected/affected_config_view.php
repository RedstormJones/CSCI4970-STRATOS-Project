<?php
require APP . 'view\config\Ref_Config_Base_View.php';

class Affected_Config_View extends Ref_Config_Base_View
{
    
    /**
     *  Displays configurable information for the Affected Level options on service
     * tickets. Uses the function in base class to display form.
     * 
     * @param $recordList : Array (this holds the information about Affected Level configuration)
     */
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
    
    /**
     *  Allows users to add new ticket Affected Level options or reassign current
     * Affected Level options to other values. 
     * 
     * @param $isUpdate : Boolean (this will decide whether user is adding or updating)
     * @param $aff_level : Integer (holds number of affected level)
     * @param $name : String (string that holds the name of the affected level corresponding to the number)
     */
    public function renderAddOrUpdate( $isUpdate, $aff_level, $name )
    {
        $body = "<br><br><br>"; 
        $body .= '<form id="Add" name="AddOrUpdateAffected" method="post" class="dark-matter" action="affected_config_index.php">
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
