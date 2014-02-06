<?php

/** Autoload any classes that are required **/
function __autoload($className)
{
    if (file_exists(ROOT . DS . 'library' . DS . strtolower($className) . '.class.php')) {
        require_once(ROOT . DS . 'library' . DS . strtolower($className) . '.class.php');
    } else if (file_exists(ROOT . DS . 'application' . DS . 'controllers' . DS . strtolower($className) . '.php')) {
        require_once(ROOT . DS . 'application' . DS . 'controllers' . DS . strtolower($className) . '.php');
    } else if (file_exists(ROOT . DS . 'application' . DS . 'models' . DS . strtolower($className) . '.php')) {
        require_once(ROOT . DS . 'application' . DS . 'models' . DS . strtolower($className) . '.php');
    } else if (file_exists(ROOT . DS . 'library' . DS . 'social' . DS . strtolower($className) . '.php')) {
        require_once(ROOT . DS . 'library' . DS . 'social' . DS . strtolower($className) . '.php');
    } else {
        /* Error Generation Code Here */
        echo "Class definition for " . strtolower($className) . ' was not found';
        debug_print_backtrace();
    }
}


class Loader
{

    private $routing = array();
    private $default = array();

    //initalize the class
    public function __construct($config)
    {
        /** Get Required Files **/
        #initialize all data
        $this->removeMagicQuotes();
        $this->unregisterGlobals();
        $this->load_config($config);
        $this->callHook();
    }

    public function removeMagicQuotes()
    {
        if (get_magic_quotes_gpc()) {
            $_GET = Utils::stripSlashesDeep($_GET);
            $_POST = Utils::stripSlashesDeep($_POST);
            $_COOKIE = Utils::stripSlashesDeep($_COOKIE);
        }
    }

    /** Check register globals and remove them **/
    public function unregisterGlobals()
    {
        if (ini_get('register_globals')) {
            $array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
            foreach ($array as $value) {
                foreach ($GLOBALS[$value] as $key => $var) {
                    if ($var === $GLOBALS[$key]) {
                        unset($GLOBALS[$key]);
                    }
                }
            }
        }
    }

    /** Secondary Call Function **/
    public function performAction($controller, $action, $queryString = null, $render = 0)
    {
        $controllerName = ucfirst($controller) . 'Controller';
        $dispatch = new $controllerName($controller, $action);
        $dispatch->render = $render;
        return call_user_func_array(array($dispatch, $action), $queryString);
    }

    /** Routing **/
    public function routeURL($url)
    {
        //global $routing;
        foreach ($this->routing as $pattern => $result) {
            if (preg_match($pattern, $url)) {
                return preg_replace($pattern, $result, $url);
            }
        }
        return ($url);
    }

    /** Main Call Function **/
    public function callHook()
    {
        #get the request_method
        #get the request query
        $query = $_SERVER['QUERY_STRING'];

        if ($query) {
            parse_str($query, $request);

            //check for request method
            $request['http_method'] = $_SERVER['REQUEST_METHOD'];

            //check if the request is an ajax
            if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
                $request['is_ajax'] = true;
            }

            //set the url as a request parameter
            $url = $request['url'] . "/";

            //unset the url param since
            unset($request['url']);

            //check if the url is an api call
            //Append method to the call for REST calls
            if (preg_match('/^api/', $url)) {
                $url = $url . "get/";
                $request['request_type'] = 'api';
            }

            //make the request a global array
            $_REQUEST = $request;

            //remove the request array
            unset($request);
        }

        //global $default;
        $queryString = array();

        if (!isset($url)) {
            $controller = $this->default['controller'];
            $action = $this->default['action'];
        } else {
            $url = rtrim($this->routeURL($url), '/');

            $urlArray = array();
            $urlArray = explode("/", $url);

            $controller = $urlArray[0];
            array_shift($urlArray);
            if (isset($urlArray[0])) {
                $action = $urlArray[0];
                array_shift($urlArray);
            } else {
                $action = 'index'; // Default Action
            }
            $queryString = $urlArray;
        }

        $_REQUEST['controller'] = $controller;
        $_REQUEST['action'] = $action;
        $_REQUEST['queryString'] = $queryString;

        //print_r(array($controller,$action,$queryString));
        $controllerName = ucfirst($controller) . 'Controller';
        $dispatch = new $controllerName($controller, $action);

        if ((int)method_exists($controllerName, $action)) {
            if (method_exists($controllerName, 'beforeAction')) {
                call_user_func_array(array($dispatch, "beforeAction"), $queryString);
            }
            call_user_func_array(array($dispatch, $action), $queryString);

            if (method_exists($controllerName, 'afterAction')) {
                call_user_func_array(array($dispatch, "afterAction"), $queryString);
            }
        } else {
            /* Error Generation Code Here */
        }
    }

    public function load_config($config)
    {
        //set routing
        if ($config['routing']) {
            $this->routing = $config['routing'];
        }

        //set default controller and actions
        if ($config['default']) {
            $this->default = $config['default'];
        }

        //define rest all constants
        $this->defineConstants($config['db']);
        $this->defineConstants($config['params']);


        #get the paths form css, js and image folders
        define('SITE_CSS', SITE_URL . DS . 'public/css/');
        define('SITE_JS', SITE_URL . DS . 'public/js/');
        define('SITE_IMAGE', SITE_URL . DS . 'public/images/');
        define('SITE_UPLOAD', SITE_URL . DS . 'public/upload/');
        define('UPLOAD_DST_DIR', ROOT . DS . 'public' . DS . 'upload');

        //load the general configuration from the db
        Configurator::loadConfiguration();

    }

    public function defineConstants($array)
    {
        if (isset($array) && $array) {
            foreach ($array as $name => $val) {
                define(strtoupper($name), $val);
            }
        }
    }

    /** GZip Output **/
    public function gzipOutput()
    {
        $ua = $_SERVER['HTTP_USER_AGENT'];

        if (0 !== strpos($ua, 'Mozilla/4.0 (compatible; MSIE ')
            || false !== strpos($ua, 'Opera')
        ) {
            return false;
        }

        $version = (float)substr($ua, 30);
        return (
            $version < 6
                || ($version == 6 && false === strpos($ua, 'SV1'))
        );
    }
}

$loader = new Loader($config);
