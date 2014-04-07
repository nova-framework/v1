<?php

class Controller extends Bootstrap {

	protected $_view;

	public function __construct(){
		parent::__construct();
		$this->_view = new view();
	}


	//function to load model on request
	public function loadModel($name){

		$modelpath = strtolower('models/'.$name.'.php');

		//try to load and instantiate model		
		if(file_exists($modelpath)){
			
			require $modelpath;

			//break name into sections based on a / 
			$parts = explode('/',$name);

			//use last part of array
			$modelName = ucwords(end($parts));

			//instantiate object
			$model = new $modelName();

		} else {
			$this->_error("Model does not exist: ".$modelpath);
			return false;
		}

		//return object to controller
		return $model;

	}

}
