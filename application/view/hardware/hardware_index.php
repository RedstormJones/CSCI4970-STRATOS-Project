<?php
    require_once('../../globals.php');
    require APP . 'model\Hardware_model.php';
    require APP . 'controller\Hardware_controller.php';
    require APP . 'view\Hardware_view.php';

    $tmodel = new Hardware_Model();
    $tview = new Hardware_View();
    $tcontr = new Hardware_Controller($tmodel, $tview);

    $tcontr->showAllHardware();

?>
