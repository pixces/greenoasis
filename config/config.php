<?php
return array(

    'params'=>array(
        'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
        'site_url'=>'http://localhost:8888/greenoasis', //site url
        'currency'=>'$',
    ),
    /* default controller and actions */
    'default'=>array(
        'controller' => 'pages',
        'action' => 'index',
    ),

    /* all routing rules comes under here */
    'routing' => array(
        '/admin\/(.*)/' 					        => 'admin/\1',
        //'/admin\/(.*?)\/(.*?)\/(.*)/'		        => 'admin/\1_\2/\3',
        //'/admin\/(.*?)\/(.*?)\/(.*)/'  	        => '\1/admin_\2/\3',
        '/packages\/(view)\/(.*?)\/(.*)/'   	    => 'tour/view/\1/\2',
        '/packages\/(holiday|tour|combo)\/(.*)/'    => 'tour/index/\1/\2',
        '/packages\/(.*?)\/(.*)/'   	            => 'tour/\1/\2',
        '/hotel\/(.*?)\/(.*)/'		                => 'hotel/\1/\2',
        '/visa\/(.*?)\/(.*)/'		                => 'visa/\1/\2',
        '/agent\/(.*)/' 					        => 'agent/\1',
        '/pages\/(.*)/' 					        => 'pages/\1',
        '/(.*?)\/(.*)/'						        => 'pages/display/\1/\2'
    ),

    /** Irregular Words

    'irregularWords' = array(
    'singular' => 'plural'
    );
    **/
    'irregularWords' => array(

    ),
);