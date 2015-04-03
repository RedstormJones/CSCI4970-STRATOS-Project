<?php
include "Base_Controller.php";

class Tickets_Controller Extends Base_Controller
{
	public function showAllTickets()
	{
		#$alltickets = ((Tickets_Model) $this->model)->showAllTickets();
		$alltickets = $this->model->showAllTickets();
		$this->view->renderTickets($alltickets);
	}

	public function addTicket()
	{
		$this->view->renderBody("I made it here!!");
		$this->model->addTicket();
	}
}

?>