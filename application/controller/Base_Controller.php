<?php

class Base_Controller
{
	protected $model;
	protected $view;
	protected $index;

	public function __construct(Base_Model $model, Base_View $view, $index='')
	{
		$this->model = $model;
		$this->view = $view;
		$this->index = $index;
	}

	public function noAction()
	{
		$this->view->renderBody("ERR: No action");
	}

	public function renderBody($body)
	{
		$this->view->renderBody($body);
	}

	public function simpleRedirect( $url )
	{
		echo '<script type="text/javascript"> window.location.href = "' . $url . '" </script>';
    	}

	public function startFresh()
	{
		$this->simpleRedirect( $this->index );
	}
}

?>
