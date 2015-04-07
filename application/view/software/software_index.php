<?php
    require_once('../../globals.php');
    require APP . 'model\Software_model.php';
    require APP . 'controller\Software_controller.php';
    require APP . 'view\Software_view.php';

    $tmodel = new Software_Model();
    $tview = new Software_View();
    $tcontr = new Software_Controller($tmodel, $tview);

    $tcontr->showAllSoftware();

?>
