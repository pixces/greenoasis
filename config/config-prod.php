<?php
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 'Off');
ini_set('log_errors', 'On');
ini_set('error_log', ROOT . DS . 'tmp' . DS . 'error.log');

return array(
    'db'=>array(
        'name' => 'dubaigot_greenoasis',
        'user' => 'dubaigot_green',
        'password' => 'green@1234',
        'host' => 'localhost',
        'charset' => 'utf8',
        'collate' => '',
    ),
    'error_reporting' => 'E_ALL ^E_NOTICE',
    'display_errors' => 'Off',
    'log_errors' => 'On',
    'error_log' => ROOT . DS . 'tmp' . DS . 'error.log',
);