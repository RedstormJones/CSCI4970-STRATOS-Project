<?php
require APP . 'controller\Base_Controller.php';

class Login_Controller Extends Base_Controller
{
<<<<<<< HEAD
	public function __construct($model, $view, $globals, $index)
	{
		parent::__construct($model, $view, $globals, $index, false);
	}

=======
		public function __construct($model, $view, $index)
	{
		parent::__construct($model, $view, $index, false);
	}
	
>>>>>>> origin/dev
	public function noAction()
	{
		$this->view->showLogin();
	}

	public function Log_In()
	{
		$user = $this->globals->getParam('username');
		$pwd = $this->globals->getParam('passwd');
		$pid = $this->model->authenticate($user, $pwd);
		//if ( $this->model->authenticate($user, $pwd) )
		if ( $pid != null )
		{
			$_SESSION['user'] = $user;
			$_SESSION['pid'] = $pid;
			$this->simpleRedirect("../home/home_index.php");
		}
		else
		{
			$this->noAction();
		}
	}
}
?>