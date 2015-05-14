<?php
require APP . 'view\config\Ref_Config_Base_View.php';

class Priority_Config_View extends Ref_Config_Base_View
{
    /**
     *  Displays configurable information for the priority options on service
     * tickets. Uses the function in base class to display form.
     * 
     * @param $recordList : Array (this holds the information about priority configuration)
     */
    public function renderForm( $recordList )
    {
        $description = "<br><br>This form changes the 'Priority' options available when creating or updating work tickets.<br><br>

                    Add Priority options for work tickets by clicking the Update button and specifying the new 
                    <br> Priority name. If the new option is created to replace an existing one then :<br><br>
                    1. Select the old Priority in the displayed list of options<br>
                    2. Find and select the new Priority in the options drop down list<br>
                    3. Click Reassign and Delete";
        $this->renderBaseForm( $recordList, $description, '' );
    }

    /**
     *  Allows users to add new ticket priority options or reassign current
     * priority options to other values. 
     * 
     * @param $isUpdate : Boolean (this will decide whether user is adding or updating)
     * @param $priority : Integer (holds number of priority)
     * @param $name : String (string that holds the name of the priority corresponding to the number)
     */
    public function renderAddOrUpdate( $isUpdate, $priority, $name )
    {
        $body = "<br><br><br>"; 
        $body .= '<form id="Add" name="AddOrUpdatePriority" method="post" class="dark-matter" action="priority_config_index.php">
                    <h1>Priority ' . ($isUpdate ? 'Updating' : 'Adding') . ' Form
                        <span>Please fill all the fields.</span>
                    </h1>
                    <p>
                    <label for="textfield">Name:</label>
                    <input type="text" required="" placeholder="Enter Name" name="name" id="title" value="' . $name . '">
                    ' . ($isUpdate ? '<input type="hidden" name="priority" value="' . $priority . '">' : '') . '
                    <input type="submit" style="margin-left: 35%" class="button" name="action" value="'. ($isUpdate ? 'Update' : 'Add') . ' Priority">
                    </labelc>
                </form>';
        $this->renderBody( $body );
    }
}

?>
