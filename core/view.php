<?php

class View {

	public function render($path,$data = false, $error = false){
		require "views/$path.php";
	}

	public function rendertemplate($path,$data = false){
		require "templates/".Session::get('template')."/$path.php";
	}
	
}