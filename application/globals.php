<?php
session_start();
define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('APP', ROOT . 'application' . DIRECTORY_SEPARATOR);
include 'DBconnect.php';


function getParam($param, $default = '' )
{
    $result = $default;
    if      ( isset($_GET[$param])  ) $result = $_GET[$param];
    else if ( isset($_POST[$param]) ) $result = $_POST[$param];

    return $result;
}

function handleURL($contr)
{
    $func = getParam('action' , 'noAction');
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
    return 'JVosik';
}

function getCurrentUserPid()
{
    return 2;
}

?>
