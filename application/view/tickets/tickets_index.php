<?php
    require_once('../../globals.php');
    require APP . 'model\tickets\tickets_model.php';
    require APP . 'controller\tickets\tickets_controller.php';
    require APP . 'view\tickets\tickets_view.php';

    $globals = new Globals();
    $tmodel = new Tickets_Model();
    $tview = new Tickets_View();
    $tcontr = new Tickets_Controller($tmodel, $tview, $globals, "tickets_index.php");
    
    $globals->handleURL($tcontr);
?>