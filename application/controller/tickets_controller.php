<?php
include "Base_Controller.php";

class Tickets_Controller Extends Base_Controller
{
	public function showAllTickets()
	{
		$alltickets = $this->model->showAllTickets();
		$this->view->renderTickets($alltickets);
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