<?php
require APP . 'controller\config\Ref_Config_Base_Controller.php';

class Lifecycle_Config_Controller extends Ref_Config_Base_Controller
{
    /**
    * Uses the model to get data for rendering the Lifecycle configuration form.
    * Then commands the view to render the form to the webpage
    */
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

    /**
    * First validates the user-added Lifecycle and checks that $name is not empty.
    * Then commands the model to add the new Lifecycle to the database and finally
    * calls startFresh() to refresh the application for displaying the changes
    */
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

    /**
    * First gets and validates the updated Lifecycle and checks that $name is not empty.
    * Then commands the model to add the new Lifecycle to the database and finally
    * calls startFresh() to refresh the application for displaying the changes
    */
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

    /**
    * Enumerates the original Lifecycle configuration data and the new or udpated
    * Lifecycle configuration data and commands the view to render it to the webpage
    *
    * @param $isUpdate : Boolean (specifies whether the data is new or is an update)
    */
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