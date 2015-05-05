<?php

    require_once('../../../globals.php');
    require APP . 'model\config\primtx\primtx_config_model.php';
    require APP . 'controller\config\primtx\primtx_config_controller.php';
    require APP . 'view\config\primtx\primtx_config_view.php';

    $globals = new Globals();
    $model = new Primtx_Config_Model();
    $view  = new Primtx_Config_View();
    $contr = new Primtx_Config_Controller($model, $view, $globals, 'primtx_config_index.php');
    
    $globals->handleURL($contr);
?>
