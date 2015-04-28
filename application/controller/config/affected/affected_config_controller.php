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
        $name = $this->validateInputNotEmpty(getParam( 'name', null ));
        
        if ($name == '')
        {
            $body = '<h5> Inlcude text in field<h5>';
            $this->view->renderBody($body);
            exit;
        }
        $this->model->addAffected( $name );
        $this->startFresh();
    }

    public function Update_Affected()
    {
        $aff_level = getParam( 'aff_level', null );
        $name = $this->validateInputNotEmpty(getParam( 'name', null ));
        
        if ($name == '')
        {
            $body = '<h5> Inlcude text in field<h5>';
            $this->view->renderBody($body);
            exit;
        }
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
