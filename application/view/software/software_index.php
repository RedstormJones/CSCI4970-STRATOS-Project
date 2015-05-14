<?php
    require_once('../../globals.php');
    require APP . 'model\software\Software_model.php';
    require APP . 'controller\software\Software_controller.php';
    require APP . 'view\software\Software_view.php';

	$globals = new Globals();
    $smodel = new Software_Model();
    $sview = new Software_View();
    $scontr = new Software_Controller($smodel, $sview, $globals, "software_index.php");

    $globals->handleURL($scontr);

?>
