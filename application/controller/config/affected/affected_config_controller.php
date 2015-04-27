<?php
require_once('../../../globals.php');
require APP . 'controller\config\Ref_Config_Base_Controller.php';

class Affected_Config_Controller Extends Ref_Config_Base_Controller
{
    public function noAction()
    {
        $resultList = $this->model->queryForm();
        $formElements = array();
        foreach( $resultList as $result )
        {
            $id = isset($result->aff_level) ? $result->aff_level : "";
            $name = isset($result->name) ? $result->name : "";
            $formElements[] = array($id,$name);
        }
        $this->view->renderForm( $formElements );
    }
   
    public function Add_Affected()
    {
        $name = getParam( 'name', null );
        $this->model->addAffected( $name );
        $this->startFresh();
    }

    public function Update_Affected()
    {
        $aff_level = getParam( 'aff_level', null );
        $name = getParam( 'name', null );
        $this->model->updateAffected( $aff_level, $name );
        $this->startFresh();
    }

    public function addOrUpdate( $isUpdate )
    {
        $aff_level  = $isUpdate ? getParam( 'original' ) : '';
        $name       = $isUpdate ? $this->model->getAffected( $aff_level )->name : '';
        $this->view->renderAddOrUpdate( $isUpdate, $aff_level, $name );
   }
}

?>
