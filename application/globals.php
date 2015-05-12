<?php

#--------------------#
# Starts the session #
#--------------------#
if (session_status() !== PHP_SESSION_ACTIVE) 
{
   session_start();
}


#-------------------------------------#
# define global variables and include #
# the database connection information #
#-------------------------------------#
define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('APP', ROOT . 'application' . DIRECTORY_SEPARATOR);
include 'DBconnect.php';
$URL_BASE = "http://127.0.0.1/";



class Globals
{
    #----------------------------------------------#
    # Gets the parameters from either the URL _GET #
    # variables or the session _POST variables     #
    #----------------------------------------------#
    function getParam($param, $default = '' )
    {
        $result = $default;
        if      ( isset($_GET[$param])  ) $result = $_GET[$param];
        else if ( isset($_POST[$param]) ) $result = $_POST[$param];

        return $result;
    }

    #-----------------------------------------------#
    # Parses the URL to execute the correct methods #
    # in the controllers and uses the getParam()    #
    # method to get the actual method name          #
    #-----------------------------------------------#
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

    #----------------------------------------------#
    # Gets the username of the currently logged on #
    # user from the session data, which was set    #
    # during the login process                     #
    #----------------------------------------------#
    function getCurrentUserName()
    {
        if(isset($_SESSION['user']))
        {
            return $_SESSION['user'];    
        }
    }

    #----------------------------------------------#
    # Gets the pid of the currently logged on user #
    # from the session data, which was set during  #
    # the login process                            #
    #----------------------------------------------#
    function getCurrentUserPid()
    {
        if(isset($_SESSION['pid']))
        {
            return $_SESSION['pid'];    
        }
    }
}
?>
