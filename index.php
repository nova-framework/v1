<?php
ob_start();
	
//set timezone
date_default_timezone_set('Europe/London');

//site address
define('DIR','http://example.com/');
define('DOCROOT', dirname(__FILE__));

//database details ONLY NEEDED IF USING A DATABASE
define('DB_TYPE','mysql');
define('DB_HOST','localhost');
define('DB_NAME','database name');
define('DB_USER','root');
define('DB_PASS','root');
define('PREFIX','smvcf_');

//set prefix for sessions
define('SESSION_PREFIX','smvcf_');

//optionall create a constant for the name of the site
define('SITETITLE','Simple MVC Framework');

function __autoload($class) {

   $filename = DOCROOT . "/core/" . strtolower($class) . ".php";
   if(file_exists($filename)){
      require_once $filename;
   }

   $filename = DOCROOT . "/helpers/" . strtolower($class) . ".php";
   if(file_exists($filename)){
      require_once $filename;
   } 
 
}

set_exception_handler('logger::exception_handler');
set_error_handler('logger::error_handler');

$app = new Bootstrap();
$app->setController('welcome');
$app->setTemplate('default');
$app->init();

ob_flush();

?>