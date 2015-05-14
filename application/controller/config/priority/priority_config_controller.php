<?php
require APP . 'controller\config\Ref_Config_Base_Controller.php';

class Priority_Config_Controller extends Ref_Config_Base_Controller
{
    /**
    * Uses the model to get data for rendering the Priority configuration form.
    * Then commands the view to render the form to the webpage
    */
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

    /**
    * First validates the user-added Priority and checks that $name is not empty.
    * Then commands the model to add the new Priority to the database and finally
    * calls startFresh() to refresh the application for displaying the changes
    */
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

    /**
    * First gets and validates the updated Priority and checks that $name is not empty.
    * Then commands the model to add the new Priority to the database and finally
    * calls startFresh() to refresh the application for displaying the changes
    */
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

    /**
    * Enumerates the original Priority configuration data and the new or udpated
    * Priority configuration data and commands the view to render it to the webpage
    *
    * @param $isUpdate : Boolean (specifies whether the data is new or is an update)
    */
    public function addOrUpdate( $isUpdate )
    {
        $priority   = $isUpdate ? $this->globals->getParam( 'original' ) : '';
        $name       = $isUpdate ? $this->model->getPriority( $priority )->name : '';
        $this->view->renderAddOrUpdate( $isUpdate, $priority, $name );
   }
}

?>
