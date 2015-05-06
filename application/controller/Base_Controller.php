<?php

class Base_Controller extends Globals
{
	protected $model;
	protected $view;
    protected $globals;
	protected $index;
    protected $user;
    protected $pid;

	public function __construct(Base_Model $model, Base_View $view, Globals $globals, $index, $mustBeLoggedIn = true)
	{
        # setup 
		$this->model = $model;
		$this->view = $view;
        $this->globals = $globals;
		$this->index = $index;
        
        # Username and pid of currently logged on user
        $this->user = $this->globals->getCurrentUserName();
        $this->pid = $this->globals->getCurrentUserPid();


        # Checks if the session index 'pid' is set. 
        # If not then kick user to the login page
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

    # fall back method for catching errors
	public function noAction()
	{
		$this->view->renderBody("ERR: No action");
	}

    # tell view to render the webpage using $body for the pagebody component
	public function renderBody($body)
	{
		$this->view->renderBody($body);
	}

    # enables URL redirection for controllers
	public function simpleRedirect( $url )
	{
		echo '<script type="text/javascript"> window.location.href = "' . $url . '" </script>';
    }

    # Calls simpleRedirect() on itself to refresh page
	public function startFresh()
	{
		$this->simpleRedirect( $this->index );
	}

    # the following two methods are used for general data validation
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

    # preCall() and postCall() establish 
    # transaction start and stop events
    public function preCall()
    {
        $this->model->startTransaction();
    }

    public function postCall( $succeeded )
    {
        $this->model->endTransaction( $succeeded );
    }

    # displays error message in webpage body
    public function handleException( $e )
    {
        $this->renderBody( $e );
    }
}

?>
