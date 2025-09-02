<?php
	/**
		* @author 		Cornelius Shava
		* @version 		1.0, 29/08/2025
		* @email 		corygshava777+coderdr@gmail.com
		* @copyright 	(c) 2025 Corygproductions
		* 
		* @datecreated 	29/08/2025 12:59am
		* @lastupdated	29/08/2025 12:59am
		* 
		* NOTES
			* this script depends on the addlog script for running in production environments
	*/

	class logs{
		// data table variables
		public $dbh;
		public static $primaryKey = "log_id";
		public static $tableName = "logs";
		public static $GET;
		public static $extraWhere;
		public static $myAssignedLocs;
		public static $myAssignedSkus;
		public static $columns;
		public static $db;
		public static $joinQuery;
		public static $group_by;

		// columns (table fields)
		public $id;
		public $action;
		public $payload;
		public $module;

		// runtime data
		public $response;

		public function __construct(){
			$this->dbh = db::getInstance();
		}

		public function create(){
			$sql = "INSERT INTO `".self::$primaryKey."`(
				`action`,
				`payload`,
				`module`
			) VALUES (
				:action,
				:payload,
				:module
			)";

			$result = $this->dbh->prepare($sql);

			$result->bindParam(':action', $this->action, PDO::PARAM_STR);
			$result->bindParam(':payload', $this->payload, PDO::PARAM_STR);
			$result->bindParam(':module', $this->module, PDO::PARAM_STR);

			// cos i felt too lazy to type this 5 more times and its the same effin code each time
			include '../_snippets/dbh_exec_snippet.php';

			return $this->response;
		}

		public function log_to_file($value='file logger called'){
			$logline = $value;

			include '../_sitedata/addlog.php';
		}
	}

	$logline = "logs class was accessed";
	include '../_sitedata/addlog.php';
?>