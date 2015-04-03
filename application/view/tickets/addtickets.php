<?php
    require_once('../../globals.php');
    include "../../core/Application.php";
    require APP . 'model\tickets_model.php';
    require APP . 'controller\tickets_controller.php';
    require APP . 'view\tickets_view.php';

    $tmodel = new Tickets_Model();
    $tview = new Tickets_View();
    $tcontr = new Tickets_Controller($tmodel, $tview);
    
    #$app = new Application();
    #if(isset($_GET['action']) && !empty($_GET['action']))
    #{
    #    $tcontr->{$_GET['action']}();
    #}

    handleURL($tcontr);
?>