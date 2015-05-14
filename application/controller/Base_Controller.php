<?php

class Base_Controller extends Globals
{
	protected $model;
	protected $view;
    protected $globals;
	protected $index;
    protected $user;
    protected $pid;

    /**
    * Sets up the pieces of the application and enumerates currently logged on user data, then checks to ensure
    * the user is in fact logged in. If the user's pid cannot be found in the session environment variables, then
    * the user is redirected back to the login page.
    *
    * @param $model : Model object (used for querying / updated the database)
    * @param $view : View object (used for rendering data and HTML to the webpage)
    * @param $globals : Globals object (provides access to necessary utility functions)
    * @param $index : String (contains the *_index.php filename for the index file that started this controller)
    * @param $mustBeLoggedIn : Boolean (login authorization setting - defaults to true)
    */
	public function __construct(Base_Model $model, Base_View $view, Globals $globals, $index, $mustBeLoggedIn = true)
	{
		$this->model = $model;
		$this->view = $view;
        $this->globals = $globals;
		$this->index = $index;
        
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

    /**
    * Acts as an error method if no action is specified for the method to execute 
    */
	public function noAction()
	{
		$this->view->renderBody("ERR: No action");
	}

    /**
    * Commands the view to render the data held in  
    * $body to the webpage as the pagebody section
    *
    * @param $body : String (a string of html that gets echo-ed out to the webpage in the view)
    */
	public function renderBody($body)
	{
		$this->view->renderBody($body);
	}

    /**
    * Enables URL redirection for controllers 
    *
    * @param $url : String (specifies where to redirect application control to)
    */
	public function simpleRedirect( $url )
	{
		echo '<script type="text/javascript"> window.location.href = "' . $url . '" </script>';
    }

    /**
    * Calls simpleRedirect() on itself to refresh page
    */
	public function startFresh()
	{
		$this->simpleRedirect( $this->index );
	}

    /**
    * Calls the validateInput() method to check that $data is not null and,
    * if $data is null, then it is allowed to be so
    * 
    * @param $data : String (new / updated data to validate)
    *
    * @return the data string
    */
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

    /**
    * Checks if the provided $data parameter is null and, if it is, checks that it's allowed
    * to be null and returns null or an empty string appropriately. If $data is not null then
    * the function formats the data correctly and calls htmlspecialchars() for data security, 
    * then finally returns the data
    * 
    * @param $data : String (new / updated data to validate)
    * @param $allowNull : Boolean (specifies whether data is allowed to be null - defaults to false)
    *
    * @return the data either as null, an empty string, or as validated data
    */
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

    /**
    * Commands the model to execute it's startTransaction() method
    */
    public function preCall()
    {
        $this->model->startTransaction();
    }

    /**
    * Commands the model to execute it's endTransaction() method
    *
    * @param $succeeded : Boolean (indicates to model whether or not transaction was successful)
    */
    public function postCall( $succeeded )
    {
        $this->model->endTransaction( $succeeded );
    }

    /**
    * Displays error information to the webpage
    *
    * @param $e : String (contains error data to display)
    */
    public function handleException( $e )
    {
        $this->renderBody( $e );
    }
}

?>
