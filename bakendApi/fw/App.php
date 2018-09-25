<?php
require_once 'Paths.php';
class App extends Core{

    //protected $BASEDIR  = "http://localhost/baseProject2/"; 
    protected $BASEDIR  = PROJECT;
    protected $ENV = 'DEV';
    
    /**
    * sanitize url
    * @param String $url
    * @return String sanitize url
    */
    protected function sanitizeURL($u){
        $sanitize = filter_var($u, FILTER_SANITIZE_URL);
        $sanitize = str_replace('\\', '/', $sanitize);
        $sanitize = str_replace('//', '/', $sanitize);
        $sanitize = ltrim($sanitize, '/');
        $sanitize = rtrim($sanitize, '/');
        return $sanitize;
    }

    /**
    * Call the contoller
    */
    protected function callController($request){
        $route = self::sanitizeURL($request['route']);
        
        unset($request['route']);
        $params = [];
        
        $r = explode('/', $route);
        #controller
        $controller = (isset($r[$this->posCtrl]) && $this->posCtrl > -1) ? $r[$this->posCtrl] : 'index';
        #action
        $action = (isset($r[$this->posAction])) ? $r[$this->posAction] : 'index';

        unset($r[$this->posCtrl]); unset($r[$this->posAction]);

        foreach($r as $p){ array_push($params, $p); }

        $classname = strtolower($controller) . '_controller';

        if(class_exists($classname)){
            if(method_exists($classname, $action)){
                $v = new $classname($params, $request);
                $v->$action();
            }else{
                $_helpers = new Helpers();
                $_helpers->showErrorPage();
            }
        }else{
            $_helpers = new Helpers();
            $_helpers->showErrorPage();
        }
    }

    /**
    * Render a complete view
    * @param String $name
    * @param String $extension
    */
    public function render($name, $extension = 'php'){
        require_once APPDIR::Views . $name . '.' . $extension;
    }

    /**
    * Render a partial view
    * @param String $name
    * @return String partial
    */
    public function renderPartial($name, $extension = 'php'){
        $extension = (empty($extension)) ? 'php' : $extension;
        $env = $this->ENV;
        require_once APPDIR::Views . 'partials/_' . $name . '.' . $extension;
    }
    
    
    public function setHeaders($statusCode){
        $text = '';
        switch($statusCode){
            case '200': $text = 'Ok'; break;
            case '201': $text = 'Created'; break;
            case '304': $text = 'Not Modified'; break;
            case '400': $text = 'Bad Request'; break;
            case '401': $text = 'Unauthorized'; break;
            case '403': $text = 'Access Denied'; break;
            case '405': $text = 'Method Not Allowed'; break;
        }
        $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');

        header($protocol . ' ' . $statusCode . ' ' . $text);
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST');
        header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
    }

    /**
    * Return a json response
    * @param Array $data
    * @return json object
    */
    public function responseJSON($data, $statusCode = '200'){

        $dt = $this->md_array_map('utf8_encode', $data);

        $this->setHeaders($statusCode);

        return json_encode($dt);
    }
}
