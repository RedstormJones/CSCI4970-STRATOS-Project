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
		if ( $this->model->authenticate($user, $pwd) )
		{
			?>
				<script type="text/javascript">
					window.location.href = 'http://127.0.0.1/application/view/home/home_index.php';
				</script>
			<?php
		}
		else
		{
			$this->noAction();
		}
	}
}
?>