<?php
    require_once('../../globals.php');
    require APP . 'model\metrics\metrics_model.php';
    require APP . 'controller\metrics\metrics_controller.php';
    require APP . 'view\metrics\metrics_view.php';

    $mmodel = new Metrics_Model();
    $mview = new Metrics_View();
    $mcontr = new Metrics_Controller($mmodel, $mview);

    handleURL($mcontr);
?>