<?php
require APP . 'controller\config\Ref_Config_Base_Controller.php';

class Lifecycle_Config_Controller Extends Ref_Config_Base_Controller
{
    #-------------------------------------------#
    # gets data for the Lifecycle Configuration #
    # form and instructs the view to render it  #
    #-------------------------------------------#
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

    #--------------------------------------------------------#
    # Validates user-added Lifecycle and instructs the       #
    # model to update the database, then calls startFresh()  #
    # to show the new Lifecycle configuration changes        #
    #--------------------------------------------------------#
    public function Add_LifeCycle()
    {
        $name = $this->validateInputNotEmpty($this->globals->getParam( 'name', null ));
        
        if ($name == '')
        {
            $body = '<h5> Inlcude text in field<h5>';
            $this->view->renderBody($body);
            exit;
        }
        
        $timed = $this->globals->getParam( 'timed', '' ) == 'on';
        $this->model->addLifecycle( $name, $timed, $this->user );
        $this->startFresh();
    }

    #-------------------------------------------------------#
    # Validates modified Lifecycle and instructs the        #
    # model to update the database, then calls startFresh() #
    # to show the new Lifecycle configuration changes       #
    #-------------------------------------------------------#
    public function Update_Lifecycle()
    {
        $life_cycl_id = $this->globals->getParam( 'life_cycl_id', null );
        $name = $this->validateInputNotEmpty($this->globals->getParam( 'name', null ));
        
        if ($name == '')
        {
            $body = '<h5> Inlcude text in field<h5>';
            $this->view->renderBody($body);
            exit;
        }
        $timed = $this->globals->getParam( 'timed', '' ) == 'on';
        $this->model->updateLifecycle( $life_cycl_id, $name, $timed, $this->user );
        $this->startFresh();
    }

    #-------------------------------------------------------#
    # Gets the Lifecycle configuration data using the model #
    # and renders the data to the webpage using the view    #
    #-------------------------------------------------------#
    public function addOrUpdate( $isUpdate )
    {
        $life_cycl_id   = $isUpdate ? $this->globals->getParam( 'original' ) : '';
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