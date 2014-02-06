<?php
error_reporting(E_ALL ^E_NOTICE);
ini_set('display_errors','On');

return array(
    'db'=>array(
        'name' => 'greenoasis',
        'user' => 'root',
        'password' => 'root',
        'host' => 'localhost',
        'charset' => 'utf8',
        'collate' => '',
    ),
    'error_reporting' => 'E_ALL ^E_NOTICE',
    'display_errors' => 'On',
);