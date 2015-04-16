<?php
require_once('../../../globals.php');
require APP . 'view\Base_View.php';

class Ref_Config_Base_View Extends Base_View
{
    public function renderBaseForm( $recordList, $additionalForms )
    {
        $body                            = '<form id="Existing" name="DeleteOrUpdate" method="get" class="dark-matter" action="">';
        $body                           .= '    <h1>Configuration Form</h1>';
        $body                           .= '        <p>';
        foreach( $recordList as $record )
        {
            $id     = $record[0];
            $name   = $record[1];
            $body                       .= '        <input type="radio" name="original" value="' . $id . '" checked>' . $name . '';
            $body                       .= '        <br>';
        }

        $body                           .= '        <br>';
        $body                           .= '        <label for="select">Reassign To:</label>';
        $body                           .= '        <select name="reassign" id="select" size="1">';
        foreach( $recordList as $record )
        {
            $id     = $record[0];
            $name   = $record[1];
            $body                       .= '            <option value="' . $id . '">' . $name . '</option>';
        }
        $body                           .= '        </select>';
        $body                           .= '        </p>';
        $body                           .= '        <br>';
            
        $body                           .= '            <labelc>';
        $body                           .= '                <input type="submit" class="button" value="Reassign and Delete" id="delete" name="action">';
        $body                           .= '            </labelc>';

        $body                           .= '            <labelc>';
        $body                           .= '                <input type="submit" class="button" value="Update" id="update" name="action">';
        $body                           .= '            </labelc>';
        $body                           .= '    </form>';

        $this->renderBody( $body . $additionalForms );
    }
}

?>
