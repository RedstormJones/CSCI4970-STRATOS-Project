<?php
require APP . 'controller\config\Ref_Config_Base_Controller.php';

class Primtx_Config_Controller extends Ref_Config_Base_Controller
{
    /**
    * Uses the model to get data for rendering the Priority Matrix configuration form.
    * Then commands the view to render the form to the webpage
    */
   	public function noAction()
    {
        $resultList = $this->model->queryForm();
        $formElements = array();
        foreach( $resultList as $result )
        {
            $aff_level = $result->aff_level;
            $aff_name = $result->aff_name;

            $severity = $result->severity;
            $severity_name = $result->severity_name;

            $priority = $result->priority;
            $priority_name = $result->priority_name;

            $id = $aff_level . '|' . $severity . '|' . $priority;
            $formElements[] = array($id,$aff_name,$severity_name,$priority_name);
        }
        $this->view->renderForm( $formElements );
    }

    #-------------------------------------------------------------#
    # Removes the original Priority Matrix data from the database #
    #-------------------------------------------------------------#
    public function Delete()
    {
        $ids        = $this->getIds( $this->globals->getParam('original') );
        $aff_level  = $ids[0];
        $severity   = $ids[1];
        $priority   = $ids[2];
        $user       = $this->globals->getCurrentUserName();
        $this->model->deletePriMtx( $aff_level, $severity, $priority, $user );

        $this->startFresh();
    }

    /**
    * Validates user-added Priority Matrix data and instructs the model 
    * to update the database, then calls startFresh() to show the new 
    * Priority Matrix configuration changes
    */
    public function Add_Entry()
    {
        $aff_level = $this->globals->getParam( 'AffMenu', null );
        $severity = $this->globals->getParam( 'SevMenu', null );
        $priority = $this->globals->getParam( 'PriMenu', null );

        $user       = $this->globals->getCurrentUserName();

        $this->model->addPriMtx( $aff_level, $severity, $priority, $user );
        $this->startFresh();
    }

    /**
    * Validates modified Priority Matrix data and instructs the model 
    * to update the database, then calls startFresh() to show the new 
    * Priority Matrix configuration changes
    */
    public function Update_Entry()
    {
        $aff_level = $this->globals->getParam( 'AffMenu', null );
        $severity = $this->globals->getParam( 'SevMenu', null );
        $priority = $this->globals->getParam( 'PriMenu', null );

        $user       = $this->globals->getCurrentUserName();

        $this->model->updatePriMtx( $aff_level, $severity, $priority, $user );
        $this->startFresh();
    }

    /**
    * Enumerates the original Priority Matrix configuration data and the new or udpated
    * Priority Matrix configuration data and commands the view to render it to the webpage
    *
    * @param $isUpdate : Boolean (specifies whether the data is new or is an update)
    */
    public function addOrUpdate( $isUpdate )
    {
        $ids        = $isUpdate ? $this->getIds( $this->globals->getParam("original") ) : array('','','');
        $aff_level  = $ids[0];
        $severity   = $ids[1];
        $priority   = $ids[2];

        $aff_levels = array();
        $results    = $this->model->GetAffLevels();
        foreach( $results as $result )
        {
            $id     = $result->aff_level;
            $name   = $result->name;
            $aff_levels[] = array( $id, $name );
        }

        $severities = array();
        $results    = $this->model->GetSeverities();
        foreach( $results as $result )
        {
            $id     = $result->severity;
            $name   = $result->name;
            $severities[] = array( $id, $name );
        }

        $priorities = array();
        $results    = $this->model->GetPriorities();
        foreach( $results as $result )
        {
            $id     = $result->priority;
            $name   = $result->name;
            $priorities[] = array( $id, $name );
        }

        $this->view->renderAddOrUpdate( $isUpdate, $aff_levels, $severities, $priorities, $aff_level, $severity, $priority );
    }

    /**
    * Gets the Priority IDs of the original Priorty Matrix
    *
    * @param $original
    * 
    * @return a set of Priority IDs
    */
    protected function getIds( $original )
    {
        return explode( '|' , $original );
    }
}

?>