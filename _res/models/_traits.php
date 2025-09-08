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
	}
?>