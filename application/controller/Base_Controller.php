<?php

class Base_Controller
{
	protected $db;
	protected $model;
	protected $view;

	public function __construct(Base_Model $model, Base_View $view)
	{
		$this->model = $model;
		$this->view = $view;
	}

	public function renderBody($body)
	{
		$this->view->renderBody($body);
	}
}

?>