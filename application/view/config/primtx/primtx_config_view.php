<?php
require APP . 'view\config\Ref_Config_Base_View.php';

class Primtx_Config_View Extends Ref_Config_Base_View
{
    #-----------------------------------#
    # displays configurable information #
    # for the Priority Matrix options   #
    #-----------------------------------#
    public function renderForm( $recordList )
    {
        $description = "<br><br>This form changes the association between Affected Level and Severity to their respective Priority for tickets.<br><br>

                    Priority matrix entries must be filled out before the Affected Level and Severity can be used in ticket creation.
                    If adding new Priority Matrix entries:<br><br>
                            1. Add the new Affected Level using the configuration screen<br>
                            2. For each current Severity, add a Priority Matrix entry for the new Affected Level<br><br>
                            or<br><br>
                            1. Add the new Severity using the configuration screen<br>
                            2. For each current Affected Level, add a Priority Matrix entry for the new Severity";
        $this->renderBaseForm( $recordList, $description );
    }

    #-----------------------------------------#
    # displays the actual html form for       #
    # configuring the Priority Matrix options #
    #-----------------------------------------#
    public function renderBaseForm( $recordList, $description )
    {
        $body                            = '<form id="Existing" name="DeleteOrUpdate" method="get" class="dark-matter" action="">';
        $body                           .= '    <h1>Configuration Form';
        $body                           .= '        <span>' . $description . '</span>';     
        $body                           .= '    </h1>';

        $body                           .= '    <table class="tablef">';
        $body                           .= '        <tr>';
        $body                           .= '            <th>Affected</th>';
        $body                           .= '            <th>Severity</th>';
        $body                           .= '            <th>Priority</th>';
        $body                           .= '        </tr>';
        foreach( $recordList as $record )
        {
            $ids            = $record[0];
            $aff_level      = $record[1];
            $severity       = $record[2];
            $priority       = $record[3];

            $body                       .= '        <tr>';
            $body                       .= '            <td><input type="radio" name="original" value="' . $ids . '">' . $aff_level . '</td>';
            $body                       .= '            <td>' . $severity . '</td>';
            $body                       .= '            <td>' . $priority . '</td>';
            $body                       .= '        </tr>';
        }
        $body                           .= '    </table>';

        $body                           .= '    <br>';
        
        $body                           .= '    <div align="center"';

        $body                           .= '        <labelc>';
        $body                           .= '            <input type="submit" class="button" style="text-align: center" value="Update" id="update" name="action">';
        $body                           .= '        </labelc>';
        
        $body                           .= '        <labelc>';
        $body                           .= '            <input type="submit" class="button" style="text-align: center" value="Add" id="add" name="action">';
        $body                           .= '        </labelc>';

        $body                           .= '        <labelc>';
        $body                           .= '            <input type="submit" class="button" style="text-align: center" value="Delete" id="update" name="action">';
        $body                           .= '        </labelc>';

        $body                           .= '    </div>';
        $body                           .= '</form>';

        $this->renderBody( $body );
    }

    #-------------------------------------------------------#
    # allows users to create new Priority Matrix options or #
    # reassign current options to other existing values     #
    #-------------------------------------------------------#
    public function renderAddOrUpdate( $isUpdate, $aff_levels, $severities, $priorities, $aff_level, $severity, $priority )
    {
        $body  = '<br><br><br>'; 
        $body .= '<form id="Add" name="AddOrUpdatePriMtx" method="get" class="dark-matter" action="primtx_config_index.php">';
        $body .= '  <h1>Priority Matrix ' . ($isUpdate ? 'Updating' : 'Adding') . ' Form';
        $body .= '      <span>Please fill all the fields.</span>';
        $body .= '  </h1>';

        $body .= '  <label for="textfield">Affected Level:</label>';
        $body .= '      <select name="AffMenu" id="select" size="1">';
        foreach( $aff_levels as $opt_aff_level )
        {
            $id     = $opt_aff_level[0];
            $name   = $opt_aff_level[1];

            $isSelected = $id == $aff_level;
            if ( !$isUpdate or $isSelected )
            {
                $selected = $isSelected ? ' selected="selected"' : '';
                $body .= '      <option value="' . $id . '" ' . $selected . '>' . $name . '</option>';
            }
        }
        $body .= '      </select>';

        $body .= '  <label for="textfield">Severity:</label>';
        $body .= '      <select name="SevMenu" id="select" size="1">';
        foreach( $severities as $opt_severity )
        {
            $id     = $opt_severity[0];
            $name   = $opt_severity[1];

            $isSelected = $id == $severity;
            if ( !$isUpdate or $isSelected )
            {
                $selected = $isSelected ? ' selected="selected"' : '';
                $body .= '      <option value="' . $id . '" ' . $selected . '>' . $name . '</option>';
            }
        }
        $body .= '      </select>';

        $body .= '  <label for="textfield">Priority:</label>';
        $body .= '      <select name="PriMenu" id="select" size="1">';
        foreach( $priorities as $opt_priority )
        {
            $id     = $opt_priority[0];
            $name   = $opt_priority[1];

            $selected = $id == $priority ? ' selected="selected"' : '';

            $body .= '      <option value="' . $id . '" ' . $selected . '>' . $name . '</option>';
        }
        $body .= '      </select>';

        $body .= '  <br>';

        $body .= '      <input type="submit" style="margin-left: 35%" class="button" name="action" value="'. ($isUpdate ? 'Update' : 'Add') . ' Entry">';
        $body .= '  </labelc>';
        $body .= '</form>';

        $this->renderBody( $body );
    }
}

?>