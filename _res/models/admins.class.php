<?php
	/**
		* @author 		Cornelius Shava
		* @version 		1.0, 01/09/2025
		* @email 		corygshava777+coderdr@gmail.com
		* @copyright 	(c) 2025 Corygproductions
		* 
		* @datecreated 	01/09/2025 16:05pm
		* @lastupdated	01/09/2025 16:05pm
		* 
		* NOTES
			* this script depends on the sitedata script for running in production environments
	*/

	class admins{
		public $dbh;
		public static $primaryKey = "id";
		public static $tableName = "admins";
		public static $GET;
		public static $extraWhere = "";
		public static $myAssignedLocs;
		public static $myAssignedSkus;
		public static $columns;
		public static $db;
		public static $joinQuery;
		public static $group_by;

		public $id;
		public $username;
		public $email;
		public $password;
		public $date_created;
		public $last_login;
		public $last_logout_request;

		public $response;
		public $lastquery;
		public $lastcondition = "";

		// helper for datatables
		public static function read(){
			self::$extraWhere = "publish = 1";
			self::$columns = [
				['db' => 'username', 'dt' => 0],
				['db' => 'email', 'dt' => 1],
				['db' => 'password', 'dt' => 2],
				['db' => 'date_created', 'dt' => 3],
				['db' => 'last_login', 'dt' => 4],
				['db' => 'last_logout_request', 'dt' => 5],
				['db' => 'id', 'dt' => 6, 'formatter' => function ($d, $row) {return $row;}]
			];
		}

		public function getdata(){
			$where = $this->lastcondition == "" ? self::$extraWhere : $this->lastcondition;

			$sql = "SELECT * FROM ".self::$tableName." WHERE $where";

			say($sql,"admins class");
			$this->response = Qrun::run($sql);
		}

		public function getdata_con($conditions=null,$logic = "XOR",$override = false){
			if(!is_array($conditions) || $conditions === null){
				$this->response = ["success" => false,"result" => "pass an array as the list of conditions"];
				return;
			}

			// takes in a list of conditions
			$joiner = "";

			if($joiner == "XOR"){
				$joiner = " or ";
			} elseif($logic = "XAND"){
				$joiner = " and ";
			} else {
				$this->response = ["success" => false,"result" => "invalid logic method"];
				return;
			}

			$fintxt = implode($joiner, $conditions);
			if(!$override){
				$fintxt .= " AND publish = 1";
			}

			$this->lastcondition = $fintxt;
			$this->getdata();
		}
	}