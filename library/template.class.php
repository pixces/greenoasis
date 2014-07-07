<?php
class Template
{
    protected $variables = array();
    protected $_controller;
    protected $_action;
    protected $_templateFile;
    protected $_flashObject = null;

    public function __construct($controller, $action)
    {
        $this->_controller = $controller;
        $this->_action = $action;
    }

    /** Set Variables **/
    public function set($name, $value)
    {
        $this->variables[$name] = $value;
    }

    public function setTemplate($template){
        $this->_templateFile = $template;
    }

    /** function to set flash message from the controller */
    public function setMessage($message,$type='s'){
        $this->getFlashObj()->set($type,$message);
    }

    /** function to get instance of message class */
    public function getFlashObj(){
        if (!isset($this->_flashObject)){
            $this->_flashObject = new Message();
        }
        return $this->_flashObject;
    }

    /** Display Template **/

    public function render($doNotRenderHeader = 0)
    {
        $html = new HTML;
        $flash = $this->getFlashObj();
        extract($this->variables);

        $template_filename = !empty($this->_templateFile) ? $this->_templateFile : $this->_action;

        if ($doNotRenderHeader == 0) {

            if (file_exists(ROOT . DS . 'application' . DS . 'views' . DS . $this->_controller . DS . 'header.php')) {
                include (ROOT . DS . 'application' . DS . 'views' . DS . $this->_controller . DS . 'header.php');
            } else {
                include (ROOT . DS . 'application' . DS . 'views' . DS . 'header.php');
            }
        }

        /*if (file_exists(ROOT . DS . 'application' . DS . 'views' . DS . $this->_controller . DS . $this->_action . '.php')) {
            include (ROOT . DS . 'application' . DS . 'views' . DS . $this->_controller . DS . $this->_action . '.php');
        }*/

        //convert all view file names to lowercasse
        if (file_exists(ROOT . DS . 'application' . DS . 'views' . DS . $this->_controller . DS . strtolower($template_filename) . '.php')) {
            include (ROOT . DS . 'application' . DS . 'views' . DS . $this->_controller . DS . strtolower($template_filename) . '.php');
        }


        if ($doNotRenderHeader == 0) {
            if (file_exists(ROOT . DS . 'application' . DS . 'views' . DS . $this->_controller . DS . 'footer.php')) {
                include (ROOT . DS . 'application' . DS . 'views' . DS . $this->_controller . DS . 'footer.php');
            } else {
                include (ROOT . DS . 'application' . DS . 'views' . DS . 'footer.php');
            }
        }
    }

    public function renderJson(){
        if ($this->variables['data']){
            $this->_response($this->variables['data']);
        } else {
            $this->_response($this->variables['error'],400);
        }
    }

    private function _response($data, $status = 200) {
        header("HTTP/1.1 " . $status . " " . $this->_requestStatus($status));
        //return json_encode($data);
        echo json_encode($data);
    }

    private function _requestStatus($code) {
        $status = array(
            100 => 'Continue',
            101 => 'Switching Protocols',
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-Authoritative Information',
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content',
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Found',
            303 => 'See Other',
            304 => 'Not Modified',
            305 => 'Use Proxy',
            306 => '(Unused)',
            307 => 'Temporary Redirect',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required',
            408 => 'Request Timeout',
            409 => 'Conflict',
            410 => 'Gone',
            411 => 'Length Required',
            412 => 'Precondition Failed',
            413 => 'Request Entity Too Large',
            414 => 'Request-URI Too Long',
            415 => 'Unsupported Media Type',
            416 => 'Requested Range Not Satisfiable',
            417 => 'Expectation Failed',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Timeout',
            505 => 'HTTP Version Not Supported');
        return ($status[$code])?$status[$code]:$status[500];
    }

}