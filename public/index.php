<?php
define('MEMORY_LIMIT', '128M');
@ini_set('memory_limit', MEMORY_LIMIT);
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 'Off');
ini_set('log_errors', 'On');


ob_start();
session_start();

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));
define ('ENVIRONMENT','development');
ini_set('error_log', ROOT . DS . 'tmp' . DS . 'error.log');


require_once (ROOT . DS . 'library' . DS . 'bootstrap.php');