<?php
	try{
		$this->dbh->beginTransaction();
		$result->execute();
		$this->id = $this->dbh->lastInsertId();
		$this->dbh->commit();
		$this->response = 1;
	} catch (PDOException $e) {
		$this->dbh->rollback();
		$this->response = $e->getMessage();
	}

