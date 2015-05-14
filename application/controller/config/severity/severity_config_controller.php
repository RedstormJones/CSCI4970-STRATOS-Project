<?php
require APP . 'controller\config\Ref_Config_Base_Controller.php';

class Severity_Config_Controller extends Ref_Config_Base_Controller
{
    /**
    * Uses the model to get data for rendering the Severity configuration form.
    * Then commands the view to render the form to the webpage
    */
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

    /**
    * First validates the user-added Severity and checks that $name is not empty.
    * Then commands the model to add the new Severity to the database and finally
    * calls startFresh() to refresh the application for displaying the changes
    */
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

    /**
    * First gets and validates the updated Severity and checks that $name is not empty.
    * Then commands the model to add the new Severity to the database and finally
    * calls startFresh() to refresh the application for displaying the changes
    */
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

    /**
    * Enumerates the original Severity configuration data and the new or udpated
    * Severity configuration data and commands the view to render it to the webpage
    *
    * @param $isUpdate : Boolean (specifies whether the data is new or is an update)
    */
    public function addOrUpdate( $isUpdate )
    {
        $severity   = $isUpdate ? $this->globals->getParam( 'original' ) : '';
        $name       = $isUpdate ? $this->model->getSeverity( $severity )->name : '';
        $this->view->renderAddOrUpdate( $isUpdate, $severity, $name );
   }
}

?>
