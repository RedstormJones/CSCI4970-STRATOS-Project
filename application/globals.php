<?php
if (session_status() !== PHP_SESSION_ACTIVE) 
{
   session_start();
}

define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('APP', ROOT . 'application' . DIRECTORY_SEPARATOR);
include 'DBconnect.php';
$URL_BASE = "http://127.0.0.1/";

class Globals
{
    function getParam($param, $default = '' )
    {
        $result = $default;
        if      ( isset($_GET[$param])  ) $result = $_GET[$param];
        else if ( isset($_POST[$param]) ) $result = $_POST[$param];

        return $result;
    }

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

    function getCurrentUserName()
    {
        if(isset($_SESSION['user']))
        {
            return $_SESSION['user'];    
        }
    }

    function getCurrentUserPid()
    {
        if(isset($_SESSION['pid']))
        {
            return $_SESSION['pid'];    
        }
    }
}
?>
