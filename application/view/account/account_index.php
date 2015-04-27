<?php
    require_once('../../globals.php');
    require APP . 'model\account\account_model.php';
    require APP . 'controller\account\account_controller.php';
    require APP . 'view\account\account_view.php';

    $model = new Account_Model();
    $view = new Account_View();
    $contr = new Account_Controller($model, $view, 'account_index.php');

    handleURL($contr);

?>
