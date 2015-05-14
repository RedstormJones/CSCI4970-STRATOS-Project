<?php

/**
* Starts the session for the currently logged on user
*/
if (session_status() !== PHP_SESSION_ACTIVE) 
{
   session_start();
}


/**
* Define global variables and include the database connection information
*/
define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('APP', ROOT . 'application' . DIRECTORY_SEPARATOR);
$URL_BASE = "http://127.0.0.1/";
include 'DBconnect.php';


/**
* The Globals class defines utility methods used throughout the   
* application for URL parameter parsing and user session data
*/
class Globals
{
    /**
    * Gets an arbitrary parameter from either the _GET or _SESSION environment variables
    *
    * @param $param : String (the index provided for retreiving the proper parameter)
    * @param $default : String (used to pass through a default value if no parameters are set)
    *
    * 		<note> $default = '' if no parameter provided in function call
    *
    * @return the value stored in the environment variables for the given index or the default value
    */
    function getParam($param, $default = '' )
    {
        $result = $default;
        if      ( isset($_GET[$param])  ) $result = $_GET[$param];
        else if ( isset($_POST[$param]) ) $result = $_POST[$param];

        return $result;
    }

    /**
    * Uses the getParam() method to find the name of the controller method 
    * specified in either the $_GET[] or $_SESSION[] environment variables
    *
    * @param $contr : Controller object (the controller to use for executing the method)
    */
    function handleURL($contr)
    {
        $func = $this->getParam('action' , 'noAction');
        $func = str_replace(' ', '_', $func);

        $contr->preCall();
        $succeeded = false;
        try
        {    
            $contr->{$func}();
            $succeeded = true;
        }
        catch( Exception $e )
        {
            $contr->handleException( $e );
            $succeeded = false;
        }

        $contr->postCall( $succeeded );
    }

    /**
    * Gets the username of the currently logged on user from the session data, if it's set
    *
    * @return username of the currently logged on user, if set
    */
    function getCurrentUserName()
    {
        if(isset($_SESSION['user']))
        {
            return $_SESSION['user'];    
        }
    }

    /**
    * Gets the pid of the currently logged on user from the session data, if it's set
    *
    * @return pid of the currently logged on user, if set
    */
    function getCurrentUserPid()
    {
        if(isset($_SESSION['pid']))
        {
            return $_SESSION['pid'];    
        }
    }
}
?>
