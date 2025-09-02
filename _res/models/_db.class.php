<?php
	/**
		* @author 		Cornelius Shava
		* @version 		1.0, 29/08/2025
		* @email 		corygshava777+coderdr@gmail.com
		* @copyright 	(c) 2025 Corygproductions
		* 
		* @datecreated 	29/08/2025 11:20am
		* @lastupdated	29/08/2025 11:59am
		* 
		* NOTES
			* this script depends on the sitedata script for running in production environments
	*/

	class db{
		// start instance
		private static $instance = NULL;

		// to prevent instantiation
		private function __construct(){}

		// prevents cloning
		private function __clone(){}

		/**
		 * Returns DB instance or creates first connection
		 * @return object (PDO)
		 * @access public
		*/

		public static function getInstance(){
			if(self::$instance === NULL){
				$sql_deets = self::getSqlDeets();

				// print_r($sql_deets);

				// create connection
				$us = $sql_deets['us'];
				$pw = $sql_deets['pw'];
				$pdoconnect = self::getPDOString($sql_deets);

				self::$instance = new PDO($pdoconnect,$us, $pw);
				self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				say("db instance created","db class");
			} else {
				say("db instance retreived","db class");
			}

			return self::$instance;
		}

		public static function getPDOString($deets){
			$db = $deets['db'];
			$hs = $deets['hs'];

			$res = "mysql:host=$hs;dbname=$db";

			return $res;
		}

		public static function getSqlDeets(){
			$res = '[
				"us" : "root",
				"pw" : "",
				"db" : "mvc_regent_db",
				"hs" : "localhost"
			]';

			// get db details from the setupfile
			$setuppath = __DIR__.'/../_sitedata/.sitedata.php';
			$return_obj = json_decode($res);

			if(is_file($setuppath)){
				include $setuppath;

				$return_obj = $dbobj;
				// echo "stf";
			} else {
				// stops running the script coz its just going to show an error later
				// echo "stfuppp<br>";
				$logline = "the setup file wasnt found";
				include __DIR__.'/../_sitedata/addlog.php';
				echo $logline;
				exit();
			}

			return $return_obj;
		}
	}
?>