<?php

class Database extends PDO{
	
	function __construct(){

		try {
			parent::__construct(DB_TYPE.':host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASS);
			$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e){
			Logger::newMessage($e);
			logger::customErrorMsg();
		}

	}

	public function select($sql,$array = array(), $fetchMode = PDO::FETCH_OBJ){

		$stmt = $this->prepare($sql);
		foreach($array as $key => $value){
			$stmt->bindValue("$key", $value);
		}

		$stmt->execute();
		return $stmt->fetchAll($fetchMode);
	}

	public function insert($table, $data){

		ksort($data);

		$fieldNames = implode(',', array_keys($data));
		$fieldValues = ':'.implode(', :', array_keys($data));

		$stmt = $this->prepare("INSERT INTO $table ($fieldNames) VALUES ($fieldValues)");

		foreach($data as $key => $value){
			$stmt->bindValue(":$key", $value);
		}

		$stmt->execute();		

	}

	public function update($table, $data, $where){

		ksort($data);

		$fieldDetails = NULL;
		foreach($data as $key => $value){
			$fieldDetails .= "$key = :$key,";
		}
		$fieldDetails = rtrim($fieldDetails, ',');

		$whereDetails = NULL;
		foreach($where as $key => $value){
			$whereDetails .= "$key = :$key,";
		}
		$whereDetails = rtrim($whereDetails, ',');
	
		$stmt = $this->prepare("UPDATE $table SET $fieldDetails WHERE $whereDetails");

		foreach($data as $key => $value){
			$stmt->bindValue(":$key", $value);
		}

		foreach($where as $key => $value){
			$stmt->bindValue(":$key", $value);
		}

		$stmt->execute();

	}

	public function delete($table, $where, $limit = 1){

		ksort($data);

		$whereDetails = NULL;
		foreach($where as $key => $value){
			$whereDetails .= "$key = :$key,";
		}
		$whereDetails = rtrim($whereDetails, ',');
	
		$stmt = $this->prepare("DELETE FROM $table WHERE $whereDetails LIMIT $limit");

		foreach($where as $key => $value){
			$stmt->bindValue(":$key", $value);
		}

		$stmt->execute();

	}

	public function emptytable($table){
		return $this->exec("TRUNCATE TABLE $table");
	}

}
