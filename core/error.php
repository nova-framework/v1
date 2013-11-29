<?php 

class Error extends Controller {

	private $_error = null; 

	public function __construct($error){
		parent::__construct();
		$this->_error = $error;
	}

	public function index(){
		//display the error and stop
		//die($this->_error);
		
		$data['error'] = $this->_error;
		
		$this->_view->rendertemplate('header',$data);
		$this->_view->render('error/404',$data);
		$this->_view->rendertemplate('footer',$data);
		
	}

}