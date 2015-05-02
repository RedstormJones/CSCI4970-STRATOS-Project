<?php
<<<<<<< HEAD

class Base_Controller extends Globals
=======
class Base_Controller
>>>>>>> origin/dev
{
	protected $model;
	protected $view;
    protected $globals;
	protected $index;
    protected $user;
    protected $pid;

<<<<<<< HEAD

	public function __construct(Base_Model $model, Base_View $view, Globals $globals, $index, $mustBeLoggedIn = true)
=======
	public function __construct(Base_Model $model, Base_View $view, $index, $mustBeLoggedIn = true)
>>>>>>> origin/dev
	{
		$this->model = $model;
		$this->view = $view;
        $this->globals = $globals;
		$this->index = $index;
<<<<<<< HEAD
        
        $this->user = $this->globals->getCurrentUserName();
        $this->pid = $this->globals->getCurrentUserPid();

        if ( $mustBeLoggedIn )
        {
            if (!isset($_SESSION['pid']))
            {
                $URL_BASE= $GLOBALS["URL_BASE"];
                $URL = $URL_BASE."application/view/login/login_index.php";
                $this->simpleRedirect($URL);
            }
        }
    }

=======
		
		if ( $mustBeLoggedIn )
		{
			if (!isset($_SESSION['pid']))
			{
				$URL_BASE= $GLOBALS["URL_BASE"];
				$URL = $URL_BASE."application/view/login/login_index.php";
				$this->simpleRedirect($URL);
			}
		}
	}
>>>>>>> origin/dev
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

    public function validateInputNotEmpty( $data )
    {
        $data = $this->validateInput( $data );
        if ( $data == '' )
        {
            return $data;
        }
        else
        {
            return $data;
        }
    }

    public function validateInput( $data, $allowNull = false )
    {
        if( $data == null )
        {
            if ( $allowNull ) return null;
            else return "";
        }

        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function preCall()
    {
        $this->model->startTransaction();
    }

    public function postCall( $succeeded )
    {
        $this->model->endTransaction( $succeeded );
    }

    public function handleException( $e )
    {
        $this->renderBody( $e );
    }
}

?>
