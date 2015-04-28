<?php
require_once('../../../globals.php');
require APP . 'controller\config\Ref_Config_Base_Controller.php';

class Category_Config_Controller Extends Ref_Config_Base_Controller
{
   	public function noAction()
    {
        $resultList = $this->model->queryForm();
        $formElements = array();
        foreach( $resultList as $result )
        {
            $id = isset($result->cid) ? $result->cid : "";
            $name = isset($result->name) ? $result->name : "";
            $formElements[] = array($id,$name);
        }
        $this->view->renderForm( $formElements );
    }

    public function Add_Category()
    {
        $name = $this->validateInputNotEmpty(getParam( 'name', null ));
        
        if ($name == '')
        {
            $body = '<h5> Inlcude text in field<h5>';
            $this->view->renderBody($body);
            exit;
        }
        
        $this->model->addCategory( $name );
        $this->startFresh();
    }

    public function Update_Category()
    {
        $cid = getParam( 'cid', null );
        $name = $this->validateInputNotEmpty(getParam( 'name', null ));
        
        if ($name == '')
        {
            $body = '<h5> Inlcude text in field<h5>';
            $this->view->renderBody($body);
            exit;
        }
        $this->model->updateCategory( $cid, $name );
        $this->startFresh();
    }

    public function addOrUpdate( $isUpdate )
    {
        $cid        = $isUpdate ? getParam( 'original' ) : '';
        $name       = $isUpdate ? $this->model->getCategory( $cid )->name : '';
        $this->view->renderAddOrUpdate( $isUpdate, $cid, $name );
   }
}

?>
