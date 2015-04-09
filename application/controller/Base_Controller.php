<?php

class Base_Controller
{
	protected $model;
	protected $view;

	public function __construct(Base_Model $model, Base_View $view)
	{
		$this->model = $model;
		$this->view = $view;
	}

	public function noAction()
	{
		$this->view->renderBody("ERR: No action");
	}

	public function renderBody($body)
	{
		$this->view->renderBody($body);
	}
}

?>