<?php

$routing = array(
	'/admin\/(.*)/' 					=> 'admin/\1',
	//'/admin\/(.*?)\/(.*?)\/(.*)/'		=> 'admin/\1_\2/\3',
    //'/admin\/(.*?)\/(.*?)\/(.*)/'  	=> '\1/admin_\2/\3',
    '/hotel\/(.*?)\/(.*)/'		        => 'hotel/\1/\2',
    '/visa\/(.*?)\/(.*)/'		        => 'visa/\1/\2',
    '/packages\/(.*?)\/(.*)/'		    => 'tour/\1/\2',
    '/agent\/(.*)/' 					=> 'agent/\1',
    '/(.*?)\/(.*)/'						=> 'pages/display/\1/\2'
);

$default['controller'] = 'pages';
$default['action'] = 'index';