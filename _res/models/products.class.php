<?php
	/**
		* @author 		Cornelius Shava
		* @version 		1.0, 07/09/2025
		* @email 		corygshava777+coderdr@gmail.com
		* @copyright 	(c) 2025 Corygproductions
		* 
		* @datecreated 	07/09/2025 15:05pm
		* @lastupdated	07/09/2025 20:53pm
		* 
		* NOTES
			* this script depends on the sitedata script for running in production environments
	*/

	include __DIR__.'/_traits.php';

	class products{
		// load the traits
		use modelUtilities;

		public $dbh;
		public static $primaryKey = "id";
		public static $tableName = "products";
		public static $GET;
		public static $extraWhere = "";
		public static $myAssignedLocs;
		public static $myAssignedSkus;
		public static $columns;
		public static $db;
		public static $joinQuery;
		public static $group_by;

		public $id;
		public $p_name;
		public $p_stock;
		public $p_price;
		public $p_photos;
		public $p_desc;

		public $response;
		public $lastquery;
		public $lastcondition = "";

		public function __construct(){
			// echo "made";
		}

		// CRUD functions

		// helper for datatables
		public static function read(){
			self::$extraWhere = "publish = 1";
			self::$columns = [
				['db' => 'p_name', 'dt' => 0],
				['db' => 'p_stock', 'dt' => 1],
				['db' => 'p_price', 'dt' => 2],
				['db' => 'p_photos', 'dt' => 3],
				['db' => 'p_desc', 'dt' => 4],
				['db' => 'id', 'dt' => 5, 'formatter' => function ($d, $row) {return $row;}]
			];
		}

		public function getdata(){
			self::$extraWhere = self::$extraWhere == "" ? " publish = 1" : self::$extraWhere;
			$where = $this->lastcondition == "" ? self::$extraWhere : $this->lastcondition;

			$sql = "SELECT * FROM ".self::$tableName." WHERE $where";

			say($sql,"products class");
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

		public function create($values){
			$sql = "INSERT INTO `".self::$tableName." 
			 (`p_name`,`p_stock`,`p_price`,`p_desc`)
			 VALUES (?,?,?,?)";

			say($sql,"products class");
			$this->response = Qrun::run($sql,$values);
		}
	}