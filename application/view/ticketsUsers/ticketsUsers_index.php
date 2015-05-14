<?php
    require_once('../../globals.php');
    require APP . 'model\ticketsUsers\ticketsUsers_model.php';
    require APP . 'controller\ticketsUsers\ticketsUsers_controller.php';
    require APP . 'view\ticketsUsers\ticketsUsers_view.php';

    $globals = new Globals();
    $tmodel = new TicketsUsers_Model();
    $tview = new TicketsUsers_View();
    $tcontr = new TicketsUsers_Controller($tmodel, $tview, $globals, "ticketsUsers_index.php");
    
    $globals->handleURL($tcontr);
?>