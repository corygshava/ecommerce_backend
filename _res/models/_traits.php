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
			// returns which columns should be inputed
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

		public static function getviewFields(){
			// returns which columns should be viewed
			if(self::$columns === null){
				self::read();
			}

			// common columns that are in every table
			$commons = array(
				[
					'inputable'=> false,
					'table_able' => true,
					'intype' => 'date',
					'dtype' => 'date',
					'caption' => 'date added',
					'db' => 'date_created', 
					'dt' => 4],
				[
					'inputable'=> false,
					'table_able' => true,
					'intype' => 'number',
					'dtype' => 'number',
					'caption' => 'added by',
					'db' => 'created_by', 
					'dt' => 4],
			);

			$lst = self::$columns;

			$lst = array_merge($lst,$commons);
			$outlist = [];

			foreach($lst as $item){
				if($item['table_able']){
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