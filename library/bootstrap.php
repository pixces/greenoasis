<?php
$config = require_once(ROOT . DS . 'config' . DS . 'config.php');
$db = (ENVIRONMENT == 'development') ? require_once(ROOT . DS . 'config' . DS . 'config-dev.php') : require_once(ROOT . DS . 'config' . DS . 'config-prod.php');

$config = array_merge($config,$db);

require_once (ROOT . DS . 'library' . DS . 'common.php');
