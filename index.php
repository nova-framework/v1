<?php
ob_start();
	
//set timezone
date_default_timezone_set('Europe/London');

//site address
define('DIR','http://domain.com/');
define('DOCROOT', dirname(__FILE__));

//database details ONLY NEEDED IF USING A DATABASE
define('DB_TYPE','mysql');
define('DB_HOST','localhost');
define('DB_NAME','database name');
define('DB_USER','username');
define('DB_PASS','password');
define('PREFIX','smvc_');

//set prefix for sessions
define('SESSION_PREFIX','smvc_');

//optionall create a constant for the name of the site
define('SITETITLE','Simple MVC Framework');

//include password helper
require('helpers/password.php');

function autoloadsystem($class) {

   $filename = DOCROOT . "/core/" . strtolower($class) . ".php";
   if(file_exists($filename)){
      require $filename;
   }

   $filename = DOCROOT . "/helpers/" . strtolower($class) . ".php";
   if(file_exists($filename)){
      require $filename;
   } 
 
}
spl_autoload_register("autoloadsystem");

set_exception_handler('logger::exception_handler');
set_error_handler('logger::error_handler');

$app = new Bootstrap();
$app->setController('welcome');
$app->setTemplate('default');
$app->init();

ob_flush();

?>
