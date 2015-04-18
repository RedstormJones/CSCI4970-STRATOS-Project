<?php
require_once('../../globals.php');
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
            $rows[]                     = array( $tid, $title, $cname, $pname, $lname, $insrt_tmst, $last_mdfd_tmst );
        }
        $this->view->renderTickets($rows, $start);
    }

    public function Next()
    {
        $start = (int)getParam( 'start' , 0 );
        $prev_displayed = getParam( 'displayed', '10' );
        if ( $prev_displayed == '10' )
        {
            $start += 10; 
        }

        $this->showAllTickets( $start );
    }

    public function Previous()
    {
        $start = (int)getParam( 'start' , 10 ) - 10;
        if ( $start < 0 ) $start = 0;
        $this->showAllTickets( $start );
    }

    public function Add_Ticket()
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

        $this->view->renderForm($persons, $users, $categories, $affectedLevels, $severityLevels);
    }

    public function validate_input($data)
    {
    	if(!$data)
    	{
    		return "";
    	}
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function validateTicket()
    {
        $title                          = $this->validate_input(    getParam("title"    , null) );
        $description                    = $this->validate_input(    getParam("des"      , null) );
        $customer                       = $this->validate_input(    getParam("cust"     , null) );
        $assignee                       = $this->validate_input(    getParam("assignee" , null) );
        $category                       = $this->validate_input(    getParam("category" , null) );
        $affLvl                         = $this->validate_input(    getParam("affLvl"   , null) );
        $severity                       = $this->validate_input(    getParam("sev"      , null) );
        $estTime                        = $this->validate_input(    getParam("estHrs"   , null) );

        $result = $this->model->addTicket($title, $description, $customer, $assignee, $category, $affLvl, $severity, $estTime);
        if(!$result)
        {
            renderBody("Error: New ticket insert failed in database");
        }
        else
        {
            ?>
                <script type="text/javascript">
                    window.location.href = 'tickets_index.php';
                </script>
            <?php
        }
    }
}

?>
