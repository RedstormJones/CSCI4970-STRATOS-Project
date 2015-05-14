<?php

class Base_Model
{
	protected $db;

	/**
	* Create a connection with the database using the current database connection options in the DBconnect.php file
	* Set up the time to America/Chicago
	*/
	public function __construct()
	{
		$this->db = DBconnect::getInstance();
        $this->SetUpQueries();
        date_default_timezone_set('America/Chicago');
	}
	
	/* Start the transaction with the database */
    public function startTransaction()
    {
        $this->db->beginTransaction();
    }
	
	/** 
	* End the transaction depend on the transaction result
	*
	* @Param $succeeded : Boolean ( if true: commit /else: rollback)
	*/
    public function endTransaction( $succeeded )
    {
        if ( $succeeded )
        {
            $this->db->commit();
        }
        else
        {
            $this->db->rollback();
        }
    }

<<<<<<< HEAD
	/**
	* Send an email to the customer and the assignee person if the customer add or update a ticket
	*
	* @ param $isUpdate : Boolean ( if true: ticket exist and it's updated /else false : a new ticket )
	* @ param $title : String ( hold the appropriate title "Update / Add" of the email)
	* @ param $customer: String ( hold the customer information)
	* @ param $assignee: String ( hold the assignee person information)
	*/
=======
>>>>>>> origin/dev
    public function MailUpdateorAdd($isUpdate, $title, $customer, $assignee)
    {
        if ($isUpdate)
        {
            $subject = "Ticket Updated: " .$title;
            $message = "The ticket has been updated.";
        }
        else
        {
            $subject = "Ticket Added: " .$title;
            $message = "The ticket has been added.";
        }
        
        $headers = "From: stpkiproject@gmail.com";
        
<<<<<<< HEAD
        /*  
		* Sends email to the Customer 
		*/
=======
        // Sends email to the Customer
>>>>>>> origin/dev
        $this->query_GetEmail->execute(array( ':pid' => $customer));
        $to = $this->query_GetEmail->fetch(0);
        mail($to->email, $subject, $message, $headers);
        
<<<<<<< HEAD
        /* 
		* Sends email to the Assignee
		*/
=======
        // Sends email to the Assignee
>>>>>>> origin/dev
        $this->query_GetEmail->execute(array( ':pid' => $assignee));
        $to = $this->query_GetEmail->fetch(0);
        mail($to->email, $subject, $message, $headers);
    }
    
<<<<<<< HEAD
	/**
	* Update the ticket number 
	*/
=======
>>>>>>> origin/dev
    public function GetUpdatedTicketTimeByTid( $tid )
    {
        $this->query_GetTicket->execute( array( ':tid' => $tid ) );
        $ticket = $this->query_GetTicket->fetch();

        return $this->GetUpdatedTicketTime( $ticket );
    }

	/**
	* Update ticket time 
	*
	* return $last_open_time : String ( hold the ticket time)
	*/
    public function GetUpdatedTicketTime( $ticket )
    {
        $life_cycl_id = $ticket->life_cycl_id;
        $this->query_GetLifeCyclIsTimed->execute( array( ':life_cycl_id' => $life_cycl_id ) );
        $life_cycl = $this->query_GetLifeCyclIsTimed->fetch();

        $last_open_time = $ticket->last_open_time;

        if ( $life_cycl->is_timed && !$ticket->logl_del )
        {
            $last_open_time = $last_open_time + (time() - strtotime($ticket->last_mdfd_tmst))/3600;
        }

        return $last_open_time;
    }

	/**
	* Database Queries 
	*/
    protected function SetUpQueries()
    {
        $this->sql_GetLifeCyclIsTimed = "
            SELECT
                `is_timed`
            FROM
                `StLfeCyclConf`
            WHERE
                `life_cycl_id` = :life_cycl_id";
        $this->query_GetLifeCyclIsTimed = $this->db->prepare($this->sql_GetLifeCyclIsTimed);

        $this->sql_GetTicket = "
            SELECT
                *
            FROM
                `StTktInst`
            WHERE
                `tid` = :tid";
        $this->query_GetTicket = $this->db->prepare($this->sql_GetTicket);
    }
}

?>