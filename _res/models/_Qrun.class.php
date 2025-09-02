<?php
	require_once __DIR__.'/_db.class.php';

	class Qrun {
		public static function run($sql, $params = [], $types = null) {
			$pdo = db::getInstance();

			try {
				$stmt = $pdo->prepare($sql);
				$pdo->beginTransaction();
				$ok = null;

				// If binding types provided
				if ($types !== null) {
					if (count($params) !== count($types)) {
						return ["success" => false, "result" => "Params and types count mismatch"];
					}

					foreach ($params as $i => $val) {
						$stmt->bindValue($i + 1, $val, $types[$i]); 
					}

					$ok = $stmt->execute();
				} else {
					$ok = $stmt->execute($params);
				}

				$lastid = $pdo->lastInsertId();
				$pdo->commit();

				// Detect result type
				if (stripos(trim($sql), "select") === 0) {
					$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
					return ["success" => true, "result" => $data,"lastid" => $lastid];
				} else {
					return ["success" => true, "result" => $ok,"gotten" => json_encode($ok)];
				}
			} catch (PDOException $e) {
				if($pdo->inTransaction()){
					$pdo->rollback();
				}

				$theresponse = $e->getMessage();

				return ["success" => false, "result" => $theresponse];
			}
		}
	}
