<?php
require APP . 'controller\config\Ref_Config_Base_Controller.php';

class Category_Config_Controller Extends Ref_Config_Base_Controller
{
    #------------------------------------------#
    # gets data for the Category Configuration #
    # form and instructs the view to render it #
    #------------------------------------------#
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

    #-------------------------------------------------------#
    # Validates user-added category and instructs the       #
    # model to update the database, then calls startFresh() #
    # to show the new Category configuration changes        #
    #-------------------------------------------------------#
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

    #-------------------------------------------------------#
    # Validates modified Category data and instructs the    #
    # model to update the database, then calls startFresh() #
    # to show the new Category configuration changes        #
    #-------------------------------------------------------#
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

    #------------------------------------------------------#
    # Gets the Category configuration data using the model #
    # and renders the data to the webpage using the view   #
    #------------------------------------------------------#
    public function addOrUpdate( $isUpdate )
    {
        $cid        = $isUpdate ? $this->globals->getParam( 'original' ) : '';
        $name       = $isUpdate ? $this->model->getCategory( $cid )->name : '';
        $this->view->renderAddOrUpdate( $isUpdate, $cid, $name );
   }
}

?>
