<?php
    require_once('../../../globals.php');
    require APP . 'model\config\lifecycle\lifecycle_config_model.php';
    require APP . 'controller\config\lifecycle\lifecycle_config_controller.php';
    require APP . 'view\config\lifecycle\lifecycle_config_view.php';

    $lmodel = new Lifecycle_Config_Model();
    $lview = new Lifecycle_Config_View();
    $lcontr = new Lifecycle_Config_Controller($lmodel, $lview, 'lifecycle_config_index.php');
    
    handleURL($lcontr);
?>