<?php
    require_once('../../../globals.php');
    require APP . 'model\config\category\category_config_model.php';
    require APP . 'controller\config\category\category_config_controller.php';
    require APP . 'view\config\category\category_config_view.php';

	$globals = new Globals();
    $model = new Category_Config_Model();
    $view  = new Category_Config_View();
    $contr = new Category_Config_Controller($model, $view, $globals, 'category_config_index.php');
    
    $globals->handleURL($contr);
?>
