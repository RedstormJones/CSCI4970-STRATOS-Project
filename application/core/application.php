<?php

class Application
{
	private $url_controller = null;
	private $url_action = null;
	private $url_params = array();


	# "Starts" the application
	# calls the controller/method or fallback, depending on URL elements
	public function __construct()
	{
		# create an array of URL parts
		$this->splitUrl();


		# check for controller, if none given load home page
		if(!$this->url_controller) {
			header('Location: /application/view/home/home_index.php');
		}
		# elseif controller given, check if such a controller exists
		elseif (file_exists(APP . 'controller/' . $this->url_controller . '.php')) {

			# if yes then load this file and create this controller
			require APP . 'controller/' . $this->url_controller . 'php';
			$this->url_controller = new $this->url_controller();

			# check for method and if yes, that the method exists
			if(method_exists($this->url_controller, $this->url_action)) {
				if(!empty($this->url_params)) {
					# call the method and pass the arguments to it
					call_user_func_array(array($this->url_controller, $this->url_action), $this->url_params);
				}
				else {
					# if no params are given then just call the method
					$this->url_controller->{$this->url_action}();
				}
			}
			else {
				if(strlen($this->url_controller) == 0) {
					# no action defined - call the default index() method
					$this->url_controller->index();
				}
				else {
					header('location: ' . URL . 'error');
				}
			}
		}
		else {
			header('location: ' . URL . 'error');
		}
	}


	# Get and split the URL into parts
	private function splitUrl()
	{
		if(isset($_GET['url'])) {
			# split the URL
			$url = trim($_GET['url'], '/');
			$url = filter_var($url, FILTER_SANITIZE_URL);
			$url = explode('/', $url);

			# assign URL parts to corresponding properties
			$this->url_controller = isset($url[0]) ? $url[0] : null;
			$this->url_action = isset($url[1]) ? $url[1] : null;

			# store the URL params
			$this->url_params = array_values($url);


			# uncomment the following lines for debugging
			echo 'Controller: ' . $this->url_controller . '<br>';
			echo 'Action: ' . $this->url_action . '<br>';
			echo 'Params: ' . $this-url_params . '<br>';
		}
	}
}