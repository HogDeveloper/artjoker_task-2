<?php

namespace core\engine;

class Config
{
    protected array $configs = [];

    private static $instance = null;

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function load($pathToFile)
    {
        if(file_exists($pathToFile)){
            $this->configs = array_merge($this->configs, require($pathToFile));
        } else {
            throw new \Exception('Error: Could not load config ' . $pathToFile . '!');
        }
    }

    public function get($property)
    {
        return (isset($this->configs[$property])) ? $this->configs[$property] : null;
    }

}