<?php
	include __DIR__.'/../models/products.class.php';

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
			$myclass = self::$modelinstance;

			$res = [
				"success" => true,
				"message" => "good so far"
			];

			if($myclass == null){
				say("somethings wrong here","productops");
				exit();
			}
			$myclass->getdata();
			$res = $myclass->response;
		}

		public static function add_products($data,&$res){
			global $products;
			if(isset($data['p_name'], $data['p_stock'], $data['p_price'], $data['p_desc'])){
				$products->create($data);
			}

			$res = $products->response;
		}
	}

	productops::mekinstance();
?>