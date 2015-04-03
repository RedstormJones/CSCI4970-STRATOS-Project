<?php
	require_once('../../globals.php');
	require APP . 'model\Home_Model.php';
	require APP . 'controller\Home_Controller.php';
	require APP . 'view\Home_View.php';

	$hmodel = new Home_Model();
	$hview = new Home_View();
	$hcontr = new Home_Controller($hmodel, $hview);

	$hcontr->renderBody("Hello World");
?>