<?php

//namespace routes;
//
//use core\libs\Config;
//
//class Route {
//
//    private static $instance;
//
//    private $routes;
//
//    private function __construct()
//    {
//        $this->routes = Config::getRoutes();
//    }
//
//    public static function getInstance(){
//        if(self::$instance === null){
//            self::$instance = new self();
//        }
//
//        return self::$instance;
//    }
//
//    public function load(){
//        $requestUri = substr($_SERVER["REQUEST_URI"], 0, strpos($_SERVER["REQUEST_URI"], "?"));
//
//        foreach($this->routes as $pattern => $route) {
//            if (!isset($route[$_SERVER["REQUEST_METHOD"]])) {
//                continue;
//            }
//            // #^/calc/(.*)/(.*)$#  /calc/2/3 $1/$2     2/3/4 [2,3]
//            if(preg_match("#^".$pattern."$#", $requestUri)){
//                $params = preg_replace("#^".$pattern."$#", $route[$_SERVER["REQUEST_METHOD"]]["params"], $requestUri);
//                $params = explode("/", $params);
//                $data = $route[$_SERVER["REQUEST_METHOD"]];
//                //$controller = new $data["controller"]();
//                $controller = (new \ioc\IoC())->getBean($data["controller"]);
//                call_user_func_array([$controller, $data["action"]], $params);
//                break;
//            }
//        }
//    }
//}