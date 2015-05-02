<?php
require APP . 'controller\config\Ref_Config_Base_Controller.php';

class Priority_Config_Controller Extends Ref_Config_Base_Controller
{
   	public function noAction()
    {
        $resultList = $this->model->queryForm();
        $formElements = array();
        foreach( $resultList as $result )
        {
            $id = isset($result->priority) ? $result->priority : "";
            $name = isset($result->name) ? $result->name : "";
            $formElements[] = array($id,$name);
        }
        $this->view->renderForm( $formElements );
    }

    public function Add_Priority()
    {
        $name = $this->validateInputNotEmpty($this->globals->getParam( 'name', null ));
        
        if ($name == '')
        {
            $body = '<h5> Inlcude text in field<h5>';
            $this->view->renderBody($body);
            exit;
        }
        $this->model->addPriority( $name, $this->user );
        $this->startFresh();
    }

    public function Update_Priority()
    {
        $priority = $this->globals->getParam( 'priority', null );
        $name = $this->validateInputNotEmpty($this->globals->getParam( 'name', null ));
        
        if ($name == '')
        {
            $body = '<h5> Inlcude text in field<h5>';
            $this->view->renderBody($body);
            exit;
        };
        $this->model->updatePriority( $priority, $name, $this->user );
        $this->startFresh();
    }

    public function addOrUpdate( $isUpdate )
    {
        $priority   = $isUpdate ? $this->globals->getParam( 'original' ) : '';
        $name       = $isUpdate ? $this->model->getPriority( $priority )->name : '';
        $this->view->renderAddOrUpdate( $isUpdate, $priority, $name );
   }
}

?>
