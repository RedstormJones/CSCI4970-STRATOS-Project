<?php
/**
* Configuration data for database connection options (host, dbname, user, passwd, etc.)
*/
require APP . 'config/configuration.php';


/**
* The DBconnect class establishes a connection to the database for models
*/
class DBconnect
{
	private static $instance = NULL;

	private function __construct() {;}
	
	private function __clone() {;}

	/**
	* Creates an instance of the database connection and is used  
	* in the Base_Model.php file when model objects are instantiated
	*
	* @return a PHP Data Object connection to the database
	*/
	public static function getInstance()
	{
		if(!isset(self::$instance)) {
			$options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
			self::$instance = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASS, $options);		
		}
		return self::$instance;
	}
}
?>