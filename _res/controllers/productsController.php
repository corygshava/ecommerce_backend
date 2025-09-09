<?php
	include __DIR__.'/../models/products.class.php';
	include __DIR__.'/useropsController.php';

	productops::mekinstance();

	class productops{
		public static $modelinstance;

		public static function mekinstance(){
			if(self::$modelinstance == null){
				self::$modelinstance = new products();
			}
		}

		public static function getinstance(){
			if(self::$modelinstance == null){
				self::mekinstance();
			}

			return self::$modelinstance;
		}

		public static function get_products($data,&$res){
			$myclass = self::getinstance();

			$res = mekresponse("good so far",true);

			if($myclass == null){
				say("somethings wrong here","productops");
				
				$res = mekresponse("product instance missing",true);
				throw new Exception("product instance missing", 1);
			}
			$myclass->getdata();
			$res = $myclass->response;
		}

		public static function get_products_count($data,&$res){
			$myclass = self::getinstance();

			$res = mekresponse("good so far",true);

			if($myclass == null){
				say("somethings wrong here","productops");
				
				$res = mekresponse("product instance missing",true);
				throw new Exception("product instance missing", 1);
			}

			$myclass->getcount();
			$res = $myclass->response;
		}

		public static function add_products($data,&$res){
			$myclass = self::getinstance();

			/**
			 	[isapi] => yes
			    [rt] => add_products
			    [p_name] => nothing
			    [p_stock] => 23
			    [p_price] => 123
			    [p_desc] => 123
			    [operation] => add
			    [accesskey] => jkmistral
			*/


			if(isset($data['p_name'], $data['p_stock'], $data['p_price'], $data['p_desc'])){
				$usr = new userops();
				$uid = $usr->getudata();

				if($uid != null){
					$udt = ["created_by" => $uid[0]];
					$data = array_merge($data,$udt);
					$myclass->create($data);
				} else {
					$myclass->response = ["success" => false,"result" => "invalid sessiondata"];
				}
			}

			$res = $myclass->response;
		}

		public static function get_class_fields($mode,&$res){
			$myclass = self::getinstance();
			$fields = [];

			if($mode === 'input'){
				$fields = $myclass::getinputFields();
			} else {
				$fields = $myclass::getviewFields();
			}

			$res = $fields;
		}
	}
?>