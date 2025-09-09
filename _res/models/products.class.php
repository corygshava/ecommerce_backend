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
				[
					'inputable'=> true,
					'table_able' => true,
					'intype' => 'text',
					'dtype' => 'text',
					'caption' => 'product name',
					'required' => true,
					'db' => 'p_name', 
					'dt' => 0],
				[
					'inputable'=> true,
					'table_able' => true,
					'intype' => 'number',
					'dtype' => 'int',
					'caption' => 'stock amount',
					'db' => 'p_stock', 
					'dt' => 1],
				[
					'inputable'=> true,
					'table_able' => true,
					'intype' => 'number',
					'dtype' => 'int',
					'caption' => 'product price (ksh)',
					'db' => 'p_price', 
					'dt' => 2],
				[
					'inputable'=> false,
					'table_able' => true,
					'intype' => 'text',
					'dtype' => 'text',
					'caption' => 'photos',
					'db' => 'p_photos', 
					'dt' => 3],
				[
					'inputable'=> true,
					'table_able' => false,
					'intype' => 'textarea',
					'dtype' => 'text',
					'caption' => 'short description',
					'db' => 'p_desc', 
					'dt' => 4],
				[
					'inputable'=> false,
					'table_able' => false,
					'intype' => 'number',
					'dtype' => 'int',
					'db' => 'id', 
					'dt' => 5,
					'formatter' => function ($d, $row) {return $row;}]
			];
		}

		public function getdata(){
			self::$extraWhere = self::$extraWhere == "" ? " publish = 1" : self::$extraWhere;
			$where = $this->lastcondition == "" ? self::$extraWhere : $this->lastcondition;

			$sql = "SELECT * FROM ".self::$tableName." WHERE $where";

			say($sql,"products class");
			$this->response = Qrun::run($sql);
		}

		public function getcount(){
			self::$extraWhere = self::$extraWhere == "" ? " publish = 1" : self::$extraWhere;
			$where = $this->lastcondition == "" ? self::$extraWhere : $this->lastcondition;

			$sql = "SELECT COUNT(*) as amt FROM ".self::$tableName." WHERE $where";

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
			$thetable = self::$tableName;
			$sql = "INSERT INTO `$thetable` (`p_name`,`p_stock`,`p_price`,`p_desc`,`created_by`) VALUES (?,?,?,?,?)";
			$vals = array(
				$values['p_name'],
				$values['p_stock'],
				$values['p_price'],
				$values['p_desc'],
				$values['created_by'],
				// 'end'
			);
			$typs = array(
				PDO::PARAM_STR,		// p_name
				PDO::PARAM_INT,		// p_stock
				PDO::PARAM_INT,		// p_price
				PDO::PARAM_STR,		// p_desc
				PDO::PARAM_INT,		// created_by
			);

			say("vals: ".count($vals),"products class");
			say("typs: ".count($typs),"products class");
			// exit();

			if(count($vals) !== count($typs)){
				$this->response = mekresponse("vals: ".count($vals)."<br>typs: ".count($typs)."<hr>".json_encode($vals));
				return;
			}

			say($sql,"products class");
			$this->response = Qrun::run($sql,$vals,$typs);
		}
	}