<?php
    require_once('../../globals.php');
    require APP . 'model\hardware_model.php';
    require APP . 'controller\hardware_controller.php';
    require APP . 'view\hardware_view.php';

    $hmodel = new Hardware_Model();
    $hview = new Hardware_View();
    $hcontr = new Hardware_Controller($hmodel, $hview);

    handleURL($hcontr);
?>