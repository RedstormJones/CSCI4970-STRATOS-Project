<?php
    require_once('../../../globals.php');
    require APP . 'model\config\severity\severity_config_model.php';
    require APP . 'controller\config\severity\severity_config_controller.php';
    require APP . 'view\config\severity\severity_config_view.php';

	$globals = new Globals();
    $model = new Severity_Config_Model();
    $view  = new Severity_Config_View();
    $contr = new Severity_Config_Controller($model, $view, $globals, 'severity_config_index.php');
    
    $globals->handleURL($contr);
?>
