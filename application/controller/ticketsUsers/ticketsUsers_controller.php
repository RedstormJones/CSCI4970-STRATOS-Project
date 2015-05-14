<?php
require APP . 'controller\Base_Controller.php';

class TicketsUsers_Controller extends Base_Controller
{
    /**
    * Redirects application control to the showUserTickets() method
    */
    public function noAction()
    {
        $this->showUserTickets( 0 );
    }

    /**
    * Creates the array of ticket objects to render in the tickets view
    * from data returned by the model
    * 
    * @param $start : Int (used for paging the tickets view - 10 count)
    */
    public function showUserTickets( $start )
    {
        $ticket_objects = $this->model->showUserTickets($start, $this->globals->getCurrentUserPid());

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

    /**
    * Displays the next 10 elements of ticket data.
    */
    public function Next()
    {
        $start = (int)$this->globals->getParam( 'start' , 0 );
        $prev_displayed = $this->globals->getParam( 'displayed', '10' );
        if ( $prev_displayed == '10' )
        {
            $start += 10; 
        }

        $this->showUserTickets( $start );
    }

    /**
    * Displays the previous 10 elements of ticket data.
    */
    public function Previous()
    {
        $start = (int)$this->globals->getParam( 'start' , 10 ) - 10;
        if ( $start < 0 ) $start = 0;
        $this->showUserTickets( $start );
    }

    /**
    * Redirects application control to _Ticket_Form() and passes 
    * false as the parameter to indicate this is a new ticket form
    */
    public function New_Ticket()
    {
        $this->_Ticket_Form( false );
    }

    /**
    * Gets ticket information from the model using ticket
    * ID store in the environment variables. Then sends 
    * this data to the _Ticket_Form() method for rendering
    * the pre-populated form to the webpage
    */
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

    /**
    * Sets up data for use in the ticket form fields and then 
    * commands the view to render the ticket form
    *
    * @param $isUpdate : String (specifies whether this is a new ticket or updated information)
    * @param $db_title : String (ticket title)
    * @param $db_desc : String (ticket description)
    * @param $db_cust : String (ticket customer)
    * @param $db_assigned : String (ticket assignee)
    * @param $db_catg : String (ticket category)
    * @param $db_affected : String (ticket affected level)
    * @param $db_severity : String (ticket severity level)
    * @param $db_lifecycle : String (ticket lifecycle)
    * @param $db_est : String (ticket estimated time)
    * @param $db_tid : String (ticket ID)
    */
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

    /**
    * Validates the updated ticket data and refreshes the application
    */
    public function Update_Ticket()
    {
        $this->validateTicket( true );
        $this->startFresh();
    }

    /**
    * Validates the new ticket data and refreshes the application
    */
    public function Add_Ticket()
    {
        $this->validateTicket( false );
        $this->startFresh();
    }

    /**
    * Commands the model to mark the ticket entry in the database corresponding 
    * to the given tid as removed, then refreshes the application
    */
    public function Delete_Ticket()
    {
        $tid = $this->globals->getParam( 'tid' );
        $this->model->deleteTicket( $tid, $this->user );
        $this->startFresh();
    }

    /**
    * Validates the new / updated ticket data and commands the 
    * model to update the data or insert it as new, then refreshes 
    * the application 
    */
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
