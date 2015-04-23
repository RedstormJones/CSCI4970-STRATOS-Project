<?php
    require_once('../../globals.php');
    require APP . 'model\software\Software_model.php';
    require APP . 'controller\software\Software_controller.php';
    require APP . 'view\software\Software_view.php';

    $smodel = new Software_Model();
    $sview = new Software_View();
    $scontr = new Software_Controller($smodel, $sview, "software_index.php");

    handleURL($scontr);

?>
