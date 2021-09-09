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
    public static DB $db;
    public static Debugger $debug;

    public array $registry = [];

    public function __construct()
    {
        self::$registrar = Registrar::getInstance();
        self::$config = Config::getInstance();
        self::$env = DotEnv::getInstance();
        self::$env->parseEnv();
        self::$debug = Debugger::getInstance();
    }

    public function __get($property)
    {
        if(isset($this->registry[$property])){
            return $this->registry[$property];
        }
        return null;
    }

    public function __set($property, $value)
    {
        if(!isset($his->registry[$property])){
            $this->registry[$property] = $value;
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

    public function registerDB(DB $db)
    {
        self::$db = $db;
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