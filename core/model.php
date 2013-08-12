<?php 

class Model {

	protected $_db;
	
	function __construct(){
		//connect to PDO here.
		$this->_db = new Database();
	}
}