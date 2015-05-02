<?php
require APP . 'controller\Base_Controller.php';

class Tickets_Controller Extends Base_Controller
{
    public function noAction()
    {
        $this->showAllTickets( 0 );
    }

    public function showAllTickets( $start )
    {
        $ticket_objects = $this->model->showAllTickets($start);

        $rows = array();
        foreach( $ticket_objects as $ticket )
        {
            $tid                        = isset($ticket->tid) ? $ticket->tid : "";
            $title                      = isset($ticket->title) ? $ticket->title : "";
            $cname                      = isset($ticket->cname) ? $ticket->cname : "";
            $pname                      = isset($ticket->pname) ? $ticket->pname : "";
            $lname                      = isset($ticket->lname) ? $ticket->lname : "";
            $insrt_tmst                 = isset($ticket->insrt_tmst) ? $ticket->insrt_tmst : "";
            $last_mdfd_tmst             = isset($ticket->last_mdfd_tmst) ? $ticket->last_mdfd_tmst : "";
            $rows[]                     = array( $tid, $title, $cname, $pname, $lname, $insrt_tmst, $last_mdfd_tmst);
        }
        $this->view->renderTickets($rows, $start);
    }

    public function Next()
    {
        $start = (int)$this->globals->getParam( 'start' , 0 );
        $prev_displayed = $this->globals->getParam( 'displayed', '10' );
        if ( $prev_displayed == '10' )
        {
            $start += 10; 
        }

        $this->showAllTickets( $start );
    }

    public function Previous()
    {
        $start = (int)$this->globals->getParam( 'start' , 10 ) - 10;
        if ( $start < 0 ) $start = 0;
        $this->showAllTickets( $start );
    }

    public function New_Ticket()
    {
        $this->_Ticket_Form( false );
    }

    public function Update()
    {
        $tid = $this->globals->getParam('tid');
        $ticket = $this->model->getTicket( $tid );

        $this->_Ticket_Form( true
                           , $ticket->title
                           , $ticket->description
                           , $ticket->opener
                           , $ticket->assignee
                           , $ticket->catg
                           , $ticket->aff_level
                           , $ticket->severity
                           , $ticket->life_cycl_id
                           , $ticket->expct_hours 
                           , $ticket->tid
                           );
    }

    private function _Ticket_Form( $isUpdate = false
                                 , $db_title = ''
                                 , $db_desc = ''
                                 , $db_cust = ''
                                 , $db_assigned = ''
                                 , $db_catg = ''
                                 , $db_affected = ''
                                 , $db_severity = ''
                                 , $db_lifecycle = ''
                                 , $db_est = ''
                                 , $db_tid = ''
                                 )
    {
        $personsResult                  = $this->model->getAllPersons();
        $persons                        = array();
        $users                          = array();
        foreach( $personsResult as $person )
        {
            $pid                        = $person->pid;
            $fname                      = isset($person->fname) ? $person->fname : "";
            $lname                      = isset($person->lname) ? $person->lname : "";
            $user                       = isset($person->user) ? $person->user : null;

            $name                       = $fname . ($fname == "" ? "" : " ") . $lname;

            $resultingPerson            = array( $pid, $name );
            $persons[]                  = $resultingPerson;
            if ( $user != null ) 
                $users[]                = $resultingPerson;
        }
    
        $categoriesResult               = $this->model->getAllCategories();
        $categories                     = array();
        foreach( $categoriesResult as $category )
        {
            $cid                        = $category->cid;
            $name                       = $category->name;
            $categories[]               = array( $cid, $name );
        }
		
        $affectedLevelsResult           = $this->model->getAllAffectedLevels();
        $affectedLevels                 = array();
        foreach( $affectedLevelsResult as $affectedLevel )
        {
            $aff_level                  = $affectedLevel->aff_level;
            $name                       = $affectedLevel->name;
            $affectedLevels[]           = array( $aff_level, $name );
        }
        
        $severityLevelResult            = $this->model->getAllSeverityLevels();
        $severityLevels                 = array();
        foreach( $severityLevelResult as $severityLevel )
        {
            $severity                   = $severityLevel->severity;
            $name                       = $severityLevel->name;
            $severityLevels[]           = array( $severity, $name );
        }

        $lifecycleResult                = $this->model->getAllLifecycles();
        $lifecycles                     = array();
        foreach( $lifecycleResult as $lifecycle )
        {
            $life_cycl_id               = $lifecycle->life_cycl_id;
            $name                       = $lifecycle->name;
            $lifecycles[]               = array( $life_cycl_id, $name );
        }

        $this->view->renderForm($persons, $users, $categories, $affectedLevels, $severityLevels, $lifecycles, $isUpdate
                               , $db_title, $db_desc, $db_cust, $db_assigned, $db_catg, $db_affected, $db_severity, $db_lifecycle, $db_est, $db_tid );
    }

    public function Update_Ticket()
    {
        $this->validateTicket( true );
        $this->startFresh();
    }

    public function Add_Ticket()
    {
        $this->validateTicket( false );
        $this->startFresh();
    }

    public function Delete_Ticket()
    {
        $tid = $this->globals->getParam( 'tid' );
        $this->model->deleteTicket( $tid, $this->user );
        $this->startFresh();
    }

    public function validateTicket( $isUpdate )
    {
        $tid                            = $this->globals->getParam("tid", null);
        $title                          = $this->validateInputNotEmpty(    $this->globals->getParam("title"    , null) );
        $description                    = $this->validateInput(            $this->globals->getParam("des"      , null) );
        $customer                       = $this->validateInputNotEmpty(    $this->globals->getParam("cust"     , null) );
        $assignee                       = $this->validateInputNotEmpty(    $this->globals->getParam("assignee" , null) );
        $category                       = $this->validateInputNotEmpty(    $this->globals->getParam("cid"      , null) );
        $affLvl                         = $this->validateInputNotEmpty(    $this->globals->getParam("affLvl"   , null) );
        $severity                       = $this->validateInputNotEmpty(    $this->globals->getParam("sev"      , null) );
        $estTime                        = $this->validateInputNotEmpty(    $this->globals->getParam("estHrs"   , null) );
        $life_cycl_id                   = $this->validateInputNotEmpty(    $this->globals->getParam("lifecycle", null) );
        
        if ($title == '' || $customer == '' || $assignee == '' || $affLvl == '' 
                || $category == '' || $severity == '' || $estTime == '' 
                || $life_cycl_id == '')
        {
            $body = '<h5> Inlcude text in field or Select from drop-down menu<h5>';
            $this->view->renderBody($body);
            exit;
        }

        if ( $isUpdate )
        {
            $result = $this->model->updateTicket( $tid, $title, $description, $customer, $assignee, $category
                                                , $affLvl, $severity, $estTime, $life_cycl_id, $this->user );
        }
        else
        {
            $result = $this->model->addTicket($title, $description, $customer, $assignee, $category, $affLvl, $severity, $life_cycl_id, $estTime, $this->user);        
            
        }

        if($result)
        {
            $this->startFresh();
        }
    }
}

?>
