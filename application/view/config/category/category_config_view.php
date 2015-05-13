<?php
require APP . 'view\config\Ref_Config_Base_View.php';

class Category_Config_View extends Ref_Config_Base_View
{
    /**
     *  Displays information for the Category options on service
     * tickets. Uses the function in base class to display form.
     * 
     * @param $recordList : Array (this holds the information about Category configuration)
     */
    public function renderForm( $recordList )
    {
        $description = "<br><br>This form changes the 'Category' options available when creating or updating work tickets.<br><br>

                        Add Category options for work tickets by clicking the Update button and specifying the new Category name. 
                        If the new option is created to replace an existing one then :<br><br>
                        1. Select the old Category in the displayed list of options<br>
                        2. Find and select the new Category in the options drop down list<br>
                        3. Click Reassign and Delete";
        $this->renderBaseForm( $recordList, $description, '' );    
    }

    /**
     *  Allows users to add new ticket Category options or reassign current
     * Category options to other values. 
     * 
     * @param $isUpdate : Boolean (this will decide whether user is adding or updating)
     * @param $cid : Integer (holds number of category)
     * @param $name : String (string that holds the name of the category corresponding to the number)
     */
    public function renderAddOrUpdate( $isUpdate, $cid, $name )
    {
        $body = "<br><br><br>"; 
        $body .= '<form id="Add" name="AddOrUpdateCategory" method="post" class="dark-matter" action="category_config_index.php">
                    <h1>Category ' . ($isUpdate ? 'Updating' : 'Adding') . ' Form
                        <span>Please fill all the fields.</span>
                    </h1>
                    <p>
                    <label for="textfield">Name:</label>
                    <input type="text" required="" placeholder="Enter Name" name="name" id="title" value="' . $name . '">
                    ' . ($isUpdate ? '<input type="hidden" name="cid" value="' . $cid . '">' : '') . '
                    <input type="submit" style="margin-left: 35%" class="button" name="action" value="'. ($isUpdate ? 'Update' : 'Add') . ' Category">
                    </labelc>
                </form>';
        $this->renderBody( $body );
    }
}

?>
