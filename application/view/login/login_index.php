<?php
	require_once("../../globals.php");
    require APP . 'model\login\login_model.php';
    require APP . 'controller\login\login_controller.php';
    require APP . 'view\login\login_view.php';

    $globals = new Globals();
	$lmodel = new Login_Model();
	$lview = new Login_View();
	$lcontr = new Login_Controller($lmodel, $lview, $globals, "login_index.php");

	$globals->handleURL($lcontr);
?>

