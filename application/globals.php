<?php
#session_start('oid');
define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('APP', ROOT . 'application' . DIRECTORY_SEPARATOR);
include 'DBconnect.php';


function handleURL($contr)
{
    if( (isset($_GET['action']) && !empty($_GET['action'])) 
    	|| ((isset($_POST['action'])) && !empty($_POST['action'])) )
    {
    	$func = "";
    	if(isset($_GET['action'])) 
    	{
    		$func = $_GET['action'];
    	}
    	else
    	{
    		$func = $_POST['action'];
    	}
        $contr->{$func}();
    }
    else
    {
        $contr->noAction();
		#header("Location: view\home\home_index.php");
    }
}

?>