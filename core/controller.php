<?php

class Controller {

	protected $_view;
	protected $_model;
	protected $_url;

	function __construct(){
		$this->_view = new view();
		$this->_getUrl();
	
	}

	public function loadModel($name){

		$modelpath = 'models/'.$name.'_model.php';

		if(file_exists($modelpath)){
			require $modelpath;

			$modelName = ucwords($name).'_Model';
			$this->_model = new $modelName();
		}

	}

	protected function _getUrl(){
		$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : NULL;
		$url = filter_var($url, FILTER_SANITIZE_URL);
		$this->_url = explode('/',$url);
	}
}
