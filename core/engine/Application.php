<?php

namespace core\engine;

use core\libs\DotEnv;
use core\engine\Config;
use core\engine\Registry;

class Application
{
    protected $registry = [];
    protected $settings = [];
    protected $pathToSettings = "";

    protected $config = null;
    protected $dotEnv = null;

    public function __construct($pathToSettings = null)
    {
        if(is_null($pathToSettings)){
            throw new \Exception("File settings not found");
        }

        $this->pathToSettings = $pathToSettings;
        $this->dotEnv = DotEnv::getInstance();
        $this->dotEnv->parseEnv();
        $this->config = Config::getInstance();
        $this->registry = Registry::setRegistry($this->pathToSettings, $this->registry);
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

    public function output()
    {

    }

}