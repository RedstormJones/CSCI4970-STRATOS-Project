<?php
	require_once('../../globals.php');
	require APP . 'model\home\Home_Model.php';
	require APP . 'controller\home\Home_Controller.php';
	require APP . 'view\home\Home_View.php';

	$hmodel = new Home_Model();
	$hview = new Home_View();
	$hcontr = new Home_Controller($hmodel, $hview);

	handleURL($hcontr);
?>