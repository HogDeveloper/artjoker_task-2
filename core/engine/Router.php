<?php


namespace core\engine;

use core\engine\interfaces\IRouter;

class Router implements IRouter
{
    private Application $app;
    private static self $instance;
    private array $routes;

    public function __construct(Application $app, array $routes)
    {
        $this->app = $app;
        $this->routes = $routes;
    }

    public static function getInstance(Application $app, array $routes){
        if(self::$instance === null){
            self::$instance = new self($app, $routes);
        }

        return self::$instance;
    }

    public function loadController(){
        $requestArr = explode("?", $_SERVER["REQUEST_URI"]);
        $requestUri = $requestArr[0];
        $controllerIsFound = false;

        foreach($this->routes as $pattern => $route) {
            if (!isset($route[$_SERVER["REQUEST_METHOD"]])) {
                continue;
            }
            // #^/calc/(.*)/(.*)$#  /calc/2/3 $1/$2     2/3/4 [2,3]
            if(preg_match("#^".$pattern."$#", $requestUri)){
                $params = preg_replace("#^".$pattern."$#", $route[$_SERVER["REQUEST_METHOD"]]["params"], $requestUri);
                $params = explode("/", $params);
                $data = $route[$_SERVER["REQUEST_METHOD"]];
                $controller = new $data["controller"]();

                if(!method_exists($controller, $data["action"])){
                    $this->loadErrorController();
                    return;
                }

                call_user_func_array([$controller, $data["action"]], $params);
                $controllerIsFound = true;
                break;
            }
        }
        if(!$controllerIsFound){
            $this->loadErrorController();
        }
    }

    public function loadErrorController()
    {
        $controllerName = $this->routes["404"]["GET"]["controller"];
        $action = 'index';
        $controller = new $controllerName();
        call_user_func_array([$controller, $action], []);
    }

}