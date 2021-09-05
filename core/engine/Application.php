<?php

namespace core\engine;

use core\engine\Registry;
use core\engine\DB;
use core\libs\DotEnv;
use core\engine\Config;
use core\engine\Registry as Reg;

class Application
{
    private $router = null;
    private $viewer = null;
    public $registrar = null;
    public $env = null;
    public $config = null;
    public $db = null;

    public $registry = [];

    public function __construct($pathToSettings = null)
    {
        if(is_null($pathToSettings)){
            throw new \Exception("Parameter is null");
        }
        if(!file_exists($pathToSettings)) {
            throw new \Exception("File " . $pathToSettings . " not found");
        }

        $this->registrar = Reg::getInstance();
        $this->config = $this->registrar->createInstance(Config::class);
        $this->env = $this->registrar->createInstance(DotEnv::class);
        $this->db = $this->registrar->createInstance(DB::class);

        $this->env->parseEnv();
//        $this->registerRouter($pathToSettings);
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

    private function registerRouter($pathToSettings)
    {
        if(is_null($this->router)) {
            $this->router = $this->registrar->createInstance();
        }
    }

    private function registerViewer(View $view, array $dependencies = [])
    {

    }

    public function output()
    {
       echo View::render();
    }

}