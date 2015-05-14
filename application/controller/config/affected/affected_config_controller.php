<?php
require APP . 'controller\config\Ref_Config_Base_Controller.php';

class Affected_Config_Controller extends Ref_Config_Base_Controller
{
    /**
    * Uses the model to get data for rendering the
    * Affected Level configuration form. Then commands
    * the view to render the form to the webpage
    */
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

    /**
    * First validates the user-added Affected Level and checks that $name is not empty.
    * Then commands the model to add the new Affected Level to the database and finally
    * calls startFresh() to refresh the application for displaying the changes
    */
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

    /**
    * First gets and validates the updated Affected Level and checks that $name is not empty.
    * Then commands the model to add the new Affected Level to the database and finally
    * calls startFresh() to refresh the application for displaying the changes
    */
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

    /**
    * Enumerates the original Affected Level configuration data and the new or udpated
    * Affected Level configuration data and commands the view to render it to the webpage
    *
    * @param $isUpdate : Boolean (specifies whether the data is new or is an update)
    */
    public function addOrUpdate( $isUpdate )
    {
        $aff_level  = $isUpdate ? $this->globals->getParam( 'original' ) : '';
        $name       = $isUpdate ? $this->model->getAffected( $aff_level )->name : '';
        $this->view->renderAddOrUpdate( $isUpdate, $aff_level, $name );
   }
}

?>
