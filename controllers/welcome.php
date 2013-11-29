<?php

class Welcome extends Controller{

	public function __construct(){
		parent::__construct();
	}

	public function index(){

		$data['title'] = 'Welcome';

		$this->_view->rendertemplate('header',$data);
		$this->_view->render('welcome/welcome',$data);
		$this->_view->rendertemplate('footer',$data);
	}
	
}