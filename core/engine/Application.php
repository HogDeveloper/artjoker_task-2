<?php

namespace core\engine;

use core\engine\Registry;
use core\engine\DB;
use core\libs\DotEnv;
use core\engine\Config;

class Application
{
    private $router = null;
    private $viewer = null;
    public $registrar = null;
    public $env = null;
    public $config = null;
    public $db = null;

    public $registry = [];

    public function __construct()
    {
//        if(is_null($pathToSettings)){
//            throw new \Exception("Parameter is null");
//        }
//        if(!file_exists($pathToSettings)) {
//            throw new \Exception("File " . $pathToSettings . " not found");
//        }
        $this->registrar = Registry::getInstance();
        $this->config = $this->registrar->createInstance(Config::class);
        $this->env = $this->registrar->createInstance(DotEnv::class);
        $this->env->parseEnv();
        $this->viewer = $this->config->get("viewer");
    }

    public function __get($property)
    {
        if(isset($this->registry[$property])){
            return $this->registry[$property];
        }
        if(isset($this->${$property})){
            return $this->${$property};
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

    public function registerRouter($pathToRoutes)
    {
        if (file_exists($pathToRoutes)){
            $routes = require($pathToRoutes);
            $this->router = $this->registrar->createInstance($this->config->get("router"));
            $this->router->setRoutes($routes);
        }
    }

    public function registerDB(array $settings)
    {
        list($userName, $userPassword, $dbName, $port, $driver) = $settings;
        $this->db = $this->registrar->createInstance($this->config->get("db"));
        $this->db->connect($userName, $userPassword, $dbName, $port, $driver);
    }

    public function setResourcesDir($pathToResourcesDir = "")
    {
        View::setResourcesDir($pathToResourcesDir);
    }

    public function output()
    {
        echo View::render();
    }

}