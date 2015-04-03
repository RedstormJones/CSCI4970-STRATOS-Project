<?php

class LoginController
{
	private $user;
	private $pwd;

	public function __construct($lmodel)
	{
		$this->model = $lmodel;
	}

	# Methods (actions) for login controller
	public function authenticate($user, $pwd)
	{
		$this->model->authenticate($user, $pwd);
	}
}