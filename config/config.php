<?php

define('MEMORY_LIMIT', '128M');
@ini_set('memory_limit', MEMORY_LIMIT);

//config file that inclues all the files
ob_start();
session_start();

/** Configuration Variables **/
define ('ENVIRONMENT','development');
//define ('SITE_URL','http://demo.dubaigot.com');
define ('SITE_URL','http://localhost:8888/greenoasis');
define ('ENCRYPTION_SEED','3782adf93db49e7239836bb23072f31');
define ('PREFIX_LOGO', 'logo_');
define ('PREFIX_THUMB', 'tn_');
define ('PREFIX_SMALL', 'sm_');
define ('PREFIX_MEDIUM','md_');
define ('PREFIX_LARGE', 'lr_');
define ('IMG_WIDTH_THUMB', 100);
define ('IMG_HEIGHT_THUMB', 130);
define ('IMG_WIDTH_SMALL', 180);
define ('IMG_HEIGHT_SMALL', 210);
define ('IMG_WIDTH_MEDIUM', 275);
define ('IMG_HEIGHT_MEDIUM', 325);
define ('IMG_WIDTH_LARGE', 335);
define ('IMG_HEIGHT_LARGE', 390);
define ('MAX_IMAGE_COUNT', 10);     //maximum images that can be uploaded

//email setup
define ('SMTP_HOST', 'mail.dubaigot.com');
define ('SMTP_PORT', '26');
define ('SMTP_USER', 'noreply@dubaigot.com');
define ('SMTP_PASS', 'w7(cb$hFv(ye');
define ('ADMIN_EMAIL','admin@dubaigot.com');




#setup the environment 
#add database details
switch (ENVIRONMENT) {
	case 'development':
		error_reporting(E_ALL ^E_NOTICE );
        ini_set('display_errors', 'On');

        //create connections params
        define('DB_NAME', 'greenoasis');
        define('DB_USER', 'root');
        define('DB_PASSWORD', 'root');
        define('DB_HOST', 'localhost');
        define('DB_CHARSET', 'utf8');
        define('DB_COLLATE', '');
		break;
	case 'production':
		error_reporting(E_ALL ^ E_NOTICE);
        ini_set('display_errors', 'Off');
        ini_set('log_errors', 'On');
        ini_set('error_log', ROOT . DS . 'tmp' . DS . 'error.log');

        //create connection params
        define('DB_NAME', 'dubaigot_greenoasis');
        define('DB_USER', 'dubaigot_green');
        define('DB_PASSWORD', 'green@1234');
        define('DB_HOST', 'localhost');
        define('DB_CHARSET', 'utf8');
        define('DB_COLLATE', '');
		break;
}

#setup all default paths


