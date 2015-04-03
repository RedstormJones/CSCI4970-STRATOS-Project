<?php
require APP . 'config/configuration.php';

	class DBconnect
	{
		private static $instance = NULL;

		private function __construct() {;}
		private function __clone() {;}
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