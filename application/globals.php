<?php
#session_start('oid');
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
    $contr->{$func}();
}

?>