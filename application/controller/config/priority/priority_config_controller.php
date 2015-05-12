<?php
require APP . 'controller\config\Ref_Config_Base_Controller.php';

class Priority_Config_Controller Extends Ref_Config_Base_Controller
{
    #-----------------------------------------------#
    # Gets data for the Priority configuration form #
    # and instructs the view to render it           #
    #-----------------------------------------------#
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

    #-------------------------------------------------------#
    # Validates user-added Priority data and instructs the  #
    # model to update the database, then calls startFresh() #
    # to show the new Priority configuration changes        #
    #-------------------------------------------------------#
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

    #-------------------------------------------------------#
    # Validates modified Priority data and instructs the    #
    # model to update the database, then calls startFresh() #
    # to show the new Priority configuration changes        #
    #-------------------------------------------------------#
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

    #------------------------------------------------------#
    # Gets the Priority configuration data using the model #
    # and renders the data to the webpage using the view   #
    #------------------------------------------------------#
    public function addOrUpdate( $isUpdate )
    {
        $priority   = $isUpdate ? $this->globals->getParam( 'original' ) : '';
        $name       = $isUpdate ? $this->model->getPriority( $priority )->name : '';
        $this->view->renderAddOrUpdate( $isUpdate, $priority, $name );
   }
}

?>
