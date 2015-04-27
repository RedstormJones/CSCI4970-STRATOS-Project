<?php
    require_once('../../../globals.php');
    require APP . 'model\config\priority\priority_config_model.php';
    require APP . 'controller\config\priority\priority_config_controller.php';
    require APP . 'view\config\priority\priority_config_view.php';

    $model = new Priority_Config_Model();
    $view  = new Priority_Config_View();
    $contr = new Priority_Config_Controller($model, $view, 'priority_config_index.php');
    
    handleURL($contr);
?>
