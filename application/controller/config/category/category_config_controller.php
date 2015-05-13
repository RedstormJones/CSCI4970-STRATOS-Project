<?php
require APP . 'controller\config\Ref_Config_Base_Controller.php';

class Category_Config_Controller Extends Ref_Config_Base_Controller
{
    /**
    * Uses the model to get data for rendering the Category configuration form.
    * Then commands the view to render the form to the webpage
    */
   	public function noAction()
    {
        $resultList = $this->model->queryForm();
        $formElements = array();
        foreach( $resultList as $result )
        {
            $id = isset($result->cid) ? $result->cid : "";
            $name = isset($result->name) ? $result->name : "";
            $formElements[] = array($id,$name);
        }
        $this->view->renderForm( $formElements );
    }

    /**
    * First validates the user-added Category and checks that $name is not empty.
    * Then commands the model to add the new Category to the database and finally
    * calls startFresh() to refresh the application for displaying the changes
    */
    public function Add_Category()
    {
        $name = $this->validateInputNotEmpty($this->globals->getParam( 'name', null ));
        
        if ($name == '')
        {
            $body = '<h5> Inlcude text in field<h5>';
            $this->view->renderBody($body);
            exit;
        }
        
        $this->model->addCategory( $name, $this->user );
        $this->startFresh();
    }

    /**
    * First gets and validates the updated Category and checks that $name is not empty.
    * Then commands the model to add the new Category to the database and finally
    * calls startFresh() to refresh the application for displaying the changes
    */
    public function Update_Category()
    {
        $cid = $this->globals->getParam( 'cid', null );
        $name = $this->validateInputNotEmpty($this->globals->getParam( 'name', null ));
        
        if ($name == '')
        {
            $body = '<h5> Inlcude text in field<h5>';
            $this->view->renderBody($body);
            exit;
        }
        $this->model->updateCategory( $cid, $name, $this->user );
        $this->startFresh();
    }

    /**
    * Enumerates the original Category configuration data and the new or udpated
    * Category configuration data and commands the view to render it to the webpage
    *
    * @param $isUpdate : Boolean (specifies whether the data is new or is an update)
    */
    public function addOrUpdate( $isUpdate )
    {
        $cid        = $isUpdate ? $this->globals->getParam( 'original' ) : '';
        $name       = $isUpdate ? $this->model->getCategory( $cid )->name : '';
        $this->view->renderAddOrUpdate( $isUpdate, $cid, $name );
   }
}

?>
