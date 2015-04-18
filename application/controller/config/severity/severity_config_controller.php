<?php
require_once('../../../globals.php');
require APP . 'controller\config\Ref_Config_Base_Controller.php';

class Severity_Config_Controller Extends Ref_Config_Base_Controller
{
   	public function noAction()
    {
        $resultList = $this->model->queryForm();
        $formElements = array();
        foreach( $resultList as $result )
        {
            $id = isset($result->severity) ? $result->severity : "";
            $name = isset($result->name) ? $result->name : "";
            $formElements[] = array($id,$name);
        }
        $this->view->renderForm( $formElements );
    }
}

?>
