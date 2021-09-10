<?php

namespace core\engine;

use core\engine\Registrar;
use core\libs\DotEnv;
use core\engine\Config;
use core\engine\Debugger;

class Application
{
    private Router $router;
    public static Response $response;
    public static Registrar $registrar;
    public static DotEnv $env;
    public static Config $config;
    public static Debugger $debug;

    public static array $registry = [];

    public function __construct()
    {
        self::$registrar = Registrar::getInstance();
        self::$config = Config::getInstance();
        self::$env = DotEnv::getInstance();
        self::$env->parseEnv();
        self::$debug = Debugger::getInstance();
    }

    public static function get($property)
    {
        if(isset(self::$registry[$property])){
            return self::$registry[$property];
        }
        return null;
    }

    public static function set($property, $value)
    {
        if(!isset(self::$registry[$property])){
            self::$registry[$property] = $value;
        }
    }

    public function has($key)
    {
        return (isset($this->registry[$key])) ? true : false;
    }

    public function registerRouter(Router $router)
    {
        $this->router = $router;
    }

    public function registerResponse(Response $response)
    {
        self::$response = $response;
    }

    public function output()
    {
        $this->router->loadController();
        self::$response->output();
    }

}