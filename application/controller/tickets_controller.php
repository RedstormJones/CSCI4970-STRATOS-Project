<?php
include "Base_Controller.php";

class Tickets_Controller Extends Base_Controller
{
	public function showAllTickets()
	{
		$ticket_objects = $this->model->showAllTickets();
		$rows = array();
		foreach( $ticket_objects as $ticket )
		{
			$tid			= isset($ticket->tid) ? $ticket->tid : "";
			$title			= isset($ticket->title) ? $ticket->title : "";
			$cname			= isset($ticket->cname) ? $ticket->cname : "";
			$pname			= isset($ticket->pname) ? $ticket->pname : "";
			$lname			= isset($ticket->lname) ? $ticket->lname : "";
			$insrt_tmst		= isset($ticket->insrt_tmst) ? $ticket->insrt_tmst : "";
			$last_mdfd_tmst = isset($ticket->last_mdfd_tmst) ? $ticket->last_mdfd_tmst : "";
			$rows[] = array( $tid, $title, $cname, $pname, $lname, $insrt_tmst, $last_mdfd_tmst );
		}
		$this->view->renderTickets($rows);
	}

	public function showTicketForm()
	{
		$cust_menu = $this->model->getMenu("stprsninst");
		$assign_menu = $this->model->getMenu("stuserinst");
		$categ_menu = $this->model->getMenu("stcatgconf");
		$aff_menu = $this->model->getMenu("stafflvlconf");
		$sev_menu = $this->model->getMenu("stsvrlvlconf");

		$this->view->renderForm($cust_menu, $assign_menu, $categ_menu, $aff_menu, $sev_menu);
	}
}

?>
