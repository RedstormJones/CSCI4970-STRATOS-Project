<?php
define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('APP', ROOT . 'application' . DIRECTORY_SEPARATOR);
include 'DBconnect.php';


function handleURL($contr)
{
    if(isset($_GET['action']) && !empty($_GET['action']))
    {
        $contr->{$_GET['action']}();
    }
}

?>