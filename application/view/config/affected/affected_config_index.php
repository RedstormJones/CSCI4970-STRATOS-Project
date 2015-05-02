<?php
    require_once('../../../globals.php');
    require APP . 'model\config\affected\affected_config_model.php';
    require APP . 'controller\config\affected\affected_config_controller.php';
    require APP . 'view\config\affected\affected_config_view.php';

    $globals = new Globals();
    $model = new Affected_Config_Model();
    $view  = new Affected_Config_View();
    $contr = new Affected_Config_Controller($model, $view, $globals, 'affected_config_index.php');
    
    $globals->handleURL($contr);
?>
