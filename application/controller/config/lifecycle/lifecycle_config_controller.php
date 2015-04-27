<?php
require_once('../../../globals.php');
require APP . 'controller\config\Ref_Config_Base_Controller.php';

class Lifecycle_Config_Controller Extends Ref_Config_Base_Controller
{
   	public function noAction()
    {
        $resultList = $this->model->queryForm();
        $formElements = array();
        foreach( $resultList as $result )
        {
            $id = isset($result->life_cycl_id) ? $result->life_cycl_id : "";
            $name = isset($result->name) ? $result->name : "";
            $formElements[] = array($id,$name);
        }
        $this->view->renderForm( $formElements );
    }

    public function Add_LifeCycle()
    {
        $name = getParam( 'name', null );
        $this->model->addLifecycle( $name );
        $this->startFresh();
    }

    public function Update_Lifecycle()
    {
        $life_cycl_id = getParam( 'life_cycl_id', null );
        $name = getParam( 'name', null );
        $this->model->updateLifecycle( $life_cycl_id, $name );
        $this->startFresh();
    }

    public function addOrUpdate( $isUpdate )
    {
        $life_cycl_id   = $isUpdate ? getParam( 'original' ) : '';
        $name           = $isUpdate ? $this->model->getLifecycle( $life_cycl_id )->name : '';
        $this->view->renderAddOrUpdate( $isUpdate, $life_cycl_id, $name );
   }
}

?>