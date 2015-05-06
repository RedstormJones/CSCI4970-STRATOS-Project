<?php
require APP . 'controller\config\Ref_Config_Base_Controller.php';

class Severity_Config_Controller Extends Ref_Config_Base_Controller
{
    # Gets data for the Severity configuration form
    # and instructs the view to render it
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

    # Validates user-added Severity data and instructs the 
    # model to update the database, then calls startFresh()
    # to show the new Severity configuration changes
    public function Add_Severity()
    {
        $name = $this->validateInputNotEmpty($this->globals->getParam( 'name', null ));
        
        if ($name == '')
        {
            $body = '<h5> Inlcude text in field<h5>';
            $this->view->renderBody($body);
            exit;
        }
        $this->model->addSeverity( $name, $this->user );
        $this->startFresh();
    }

    # Validates modified Severity data and instructs the 
    # model to update the database, then calls startFresh()
    # to show the new Severity configuration changes
    public function Update_Severity()
    {
        $severity = $this->globals->getParam( 'severity', null );
        $name = $this->validateInputNotEmpty($this->globals->getParam( 'name', null ));
        
        if ($name == '')
        {
            $body = '<h5> Inlcude text in field<h5>';
            $this->view->renderBody($body);
            exit;
        };
        $this->model->updateSeverity( $severity, $name, $this->user );
        $this->startFresh();
    }

    # Gets the Severity configuration data using the model
    # and renders the data to the webpage using the view
    public function addOrUpdate( $isUpdate )
    {
        $severity   = $isUpdate ? $this->globals->getParam( 'original' ) : '';
        $name       = $isUpdate ? $this->model->getSeverity( $severity )->name : '';
        $this->view->renderAddOrUpdate( $isUpdate, $severity, $name );
   }
}

?>
