<?php
require APP . 'view\Base_View.php';

class Ref_Config_Base_View Extends Base_View
{
    public function renderBaseForm( $recordList, $description )
    {
        $body                            = '<form id="Existing" name="DeleteOrUpdate" method="get" class="dark-matter" action="">';
        $body                           .= '    <h1>Configuration Form';
        $body                           .= '        <span>' . $description . '</span>';     
        $body                           .= '    </h1>';
        foreach( $recordList as $record )
        {
            $id     = $record[0];
            $name   = $record[1];
            $body                       .= '    <input type="radio" name="original" value="' . $id . '" checked>' . $name . '';
            $body                       .= '    <br>';
        }

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
        $body                           .= '        <input type="submit" class="button" style="ttext-align: center" value="Update" id="update" name="action">';
        $body                           .= '    </labelc>';
        
        $body                           .= '    <labelc>';
        $body                           .= '        <input type="submit" class="button" style="text-align: right" value="Add" id="add" name="action">';
        $body                           .= '    </labelc>';
        $body                           .= '    </div>';
        $body                           .= '</form>';

        $this->renderBody( $body );
    }
}

?>
