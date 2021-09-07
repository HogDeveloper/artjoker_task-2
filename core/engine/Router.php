<?php


namespace core\engine;

//use core\engine\Config;
use core\engine\interfaces\IRouter;

class Router implements IRouter
{
    public $get = [];
    public $post = [];
    public $cookie = [];
    public $files = [];
    public $server = [];

    private static $instance;
    private $routes;

    private function __construct()
    {
    }

    public static function getInstance(){
        if(self::$instance === null){
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function setRoutes(array $routes)
    {
        $this->routes = $routes;
    }

    public function load(){
        $requestUri = substr($_SERVER["REQUEST_URI"], 0, strpos($_SERVER["REQUEST_URI"], "?"));

        foreach($this->routes as $pattern => $route) {
            if (!isset($route[$_SERVER["REQUEST_METHOD"]])) {
                continue;
            }
            // #^/calc/(.*)/(.*)$#  /calc/2/3 $1/$2     2/3/4 [2,3]
            if(preg_match("#^".$pattern."$#", $requestUri)){
                $params = preg_replace("#^".$pattern."$#", $route[$_SERVER["REQUEST_METHOD"]]["params"], $requestUri);
                $params = explode("/", $params);
                $data = $route[$_SERVER["REQUEST_METHOD"]];
                //$controller = new $data["controller"]();
                $controller = (new \ioc\IoC())->getBean($data["controller"]);
                call_user_func_array([$controller, $data["action"]], $params);
                break;
            }
        }
    }

    public function controller($route, $data = array()) {
        // Sanitize the call
        $route = preg_replace('/[^a-zA-Z0-9_\/]/', '', (string)$route);

        // Keep the original trigger
        $trigger = $route;

        // Trigger the pre events
        $result = $this->registry->get('event')->trigger('controller/' . $trigger . '/before', array(&$route, &$data));

        // Make sure its only the last event that returns an output if required.
        if ($result != null && !$result instanceof Exception) {
            $output = $result;
        } else {
            $action = new Action($route);
            $output = $action->execute($this->registry, array(&$data));
        }

        // Trigger the post events
        $result = $this->registry->get('event')->trigger('controller/' . $trigger . '/after', array(&$route, &$data, &$output));

        if ($result && !$result instanceof Exception) {
            $output = $result;
        }

        if (!$output instanceof Exception) {
            return $output;
        }
    }

}