<?php
require APP . 'controller\config\Ref_Config_Base_Controller.php';

class Affected_Config_Controller Extends Ref_Config_Base_Controller
{
    # gets data for the Affected Configuration 
    # form and instructs the view to render it
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

    # Validates user-added affected level and instructs the 
    # model to update the database, then calls startFresh()
    # to show the new Affected level configuration changes
    public function Add_Affected()
    {
        $name = $this->validateInputNotEmpty($this->globals->getParam( 'name', null ));
        
        if ($name == '')
        {
            $body = '<h5> Inlcude text in field<h5>';
            $this->view->renderBody($body);
            exit;
        }
        $this->model->addAffected( $name, $this->user );
        $this->startFresh();
    }

    # Validates modified affected level data and instructs the 
    # model to update the database, then calls startFresh()
    # to show the new Affected level configuration changes
    public function Update_Affected()
    {
        $aff_level = $this->globals->getParam( 'aff_level', null );
        $name = $this->validateInputNotEmpty($this->globals->getParam( 'name', null ));
        
        if ($name == '')
        {
            $body = '<h5> Include text in field<h5>';
            $this->view->renderBody($body);
            exit;
        }
        $this->model->updateAffected( $aff_level, $name , $this->user );
        $this->startFresh();
    }

    # Gets the Affected level configuration data using the model
    # and renders the data to the webpage using the view
    public function addOrUpdate( $isUpdate )
    {
        $aff_level  = $isUpdate ? $this->globals->getParam( 'original' ) : '';
        $name       = $isUpdate ? $this->model->getAffected( $aff_level )->name : '';
        $this->view->renderAddOrUpdate( $isUpdate, $aff_level, $name );
   }
}

?>
