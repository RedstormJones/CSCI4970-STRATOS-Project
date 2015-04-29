<?php
	require_once("../../../globals.php");
	require APP . 'model\metrics\Global\globals_model.php';
	require APP . 'controller\metrics\Global\globals_controller.php';
	require APP . 'view\metrics\Global\globals_view.php';

	$model = new Globals_Model();
	$view  = new Globals_View();
	$contr = new Globals_Controller($model, $view, 'globals_index.php');

	handleURL($contr);
?>