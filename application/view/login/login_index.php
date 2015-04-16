<?php
	require_once("../../globals.php");
    require APP . 'model\login\login_model.php';
    require APP . 'controller\login\login_controller.php';
    require APP . 'view\login\login_view.php';

	$lmodel = new Login_Model();
	$lview = new Login_View();
	$lcontr = new Login_Controller($lmodel, $lview);

	handleURL($lcontr);
?>

