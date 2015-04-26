<?php
    require_once('../../globals.php');
    require APP . 'model\Account_Settings\Account_Settings_model.php';
    require APP . 'controller\Account_Settings\Account_Settings_Controller.php';
    require APP . 'view\Account_Settings\Account_Settings_View.php';

    $model = new Account_Settings_model();
    $view = new Account_Settings_View();
    $contr = new Account_Settings_Controller($model, $view);

    handleURL($contr);

?>
