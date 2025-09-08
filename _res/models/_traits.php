<?php
	trait modelUtilities{
		// returns all the columns in the model
		public static function getmycolumns(){
			if(self::$columns === null){
				self::read();
			}

			$lst = self::$columns;
			$outlist = [];

			foreach($lst as $item){
				$wot = $item['db'];
				array_push($outlist, $wot);
			}

			return $outlist;
		}

		public static function getinputFields(){
			if(self::$columns === null){
				self::read();
			}

			$lst = self::$columns;
			$outlist = [];

			foreach($lst as $item){
				if($item['inputable']){
					$cap = isset($item['caption']) ? $item['caption'] : $item['db'];
					$req = isset($item['required']) ? $item['required'] : true;
					$wot = array("name" => $item['db'],"type" => $item['intype'], "caption" => $cap,"required" => $req);
					array_push($outlist, $wot);
				}
			}

			return $outlist;
		}
	}
?>