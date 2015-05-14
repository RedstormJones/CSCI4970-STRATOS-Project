<?php
	require_once("../../../globals.php");
	require APP . 'model\metrics\User\users_model.php';
	require APP . 'controller\metrics\User\users_controller.php';
	require APP . 'view\metrics\User\users_view.php';

	$globals = new Globals();
	$model = new Users_Model();
	$view  = new Users_View();
	$contr = new Users_Controller($model, $view, $globals, 'users_index.php');

	$globals->handleURL($contr);
?>