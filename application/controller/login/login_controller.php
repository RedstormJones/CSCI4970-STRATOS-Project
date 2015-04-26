<?php
require_once('../../globals.php');
require APP . 'controller\Base_Controller.php';


class Login_Controller Extends Base_Controller
{
	public function noAction()
	{
		$this->view->showLogin();
	}

	public function Log_In()
	{
		$user = getParam('username');
		$pwd = getParam('passwd');
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