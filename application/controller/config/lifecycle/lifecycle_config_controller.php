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
            $timed = $result->is_timed;
            $formElements[] = array($id,$name,$timed);
        }
        $this->view->renderForm( $formElements );
    }

    public function Add_LifeCycle()
    {
        $name = getParam( 'name', null );
        $timed = getParam( 'timed', '' ) == 'on';
        $this->model->addLifecycle( $name, $timed );
        $this->startFresh();
    }

    public function Update_Lifecycle()
    {
        $life_cycl_id = getParam( 'life_cycl_id', null );
        $name = getParam( 'name', null );
        $timed = getParam( 'timed', '' ) == 'on';
        $this->model->updateLifecycle( $life_cycl_id, $name, $timed );
        $this->startFresh();
    }

    public function addOrUpdate( $isUpdate )
    {
        $life_cycl_id   = $isUpdate ? getParam( 'original' ) : '';
        $name           = '';
        $timed          = false;
        if ( $isUpdate )
        {
            $lifecycle  = $this->model->getLifecycle( $life_cycl_id );
            $name       = $lifecycle->name;
            $timed      = $lifecycle->is_timed;
        }
        $this->view->renderAddOrUpdate( $isUpdate, $life_cycl_id, $name, $timed );
   }
}

?>