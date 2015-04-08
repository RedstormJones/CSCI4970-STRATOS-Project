<?php
    require_once('../../globals.php');
    require APP . 'model\software_model.php';
    require APP . 'controller\software_controller.php';
    require APP . 'view\software_view.php';

    $smodel = new Software_Model();
    $sview = new Software_View();
    $scontr = new Software_Controller($smodel, $sview);

    handleURL($scontr);
?>