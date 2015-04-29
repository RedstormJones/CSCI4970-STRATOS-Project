<?php
	require_once("../../../globals.php");
	require APP . 'model\metrics\User\users_model.php';
	require APP . 'controller\metrics\User\users_controller.php';
	require APP . 'view\metrics\User\users_view.php';

	$model = new Users_Model();
	$view  = new Users_View();
	$contr = new Users_Controller($model, $view, 'users_index.php');

	handleURL($contr);
?>