<?php

namespace core\engine;

final class Registry
{

    private static $instance = null;

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function setRegistry($pathToSettings, &$registry)
    {
        if(file_exists($pathToSettings)){
            $classes = require($pathToSettings);
            foreach ($classes as $dir => $value) {
                if(is_array($value) && !empty($value)){
                    foreach ($value as $class){
                        if(!isset($registry[$this->getClassName($class)])){
                            $registry[self::getClassName($class)] = self::createInstance($class);
                        }
                    }
                }else{
                    if(!empty($value) && !isset($registry[$this->getClassName($value)])){
                        $registry[self::getClassName($value)] = self::createInstance($value);
                    }
                }
            }
        }else{
            throw new \Exception("File " . $pathToSettings . " not found");
        }
        return $registry;
    }

    public function register($className, &$registry)
    {
        $className = $this->getClassName($className);
        if(!isset($registry[$className])){
            $registry[self::getClassName($className)] = self::createInstance($className);
        }
    }

    public function getClassName($class)
    {
        $parseStr = explode("\\", $class);
        return strtolower($parseStr[count($parseStr) - 1]);
    }

    public function createInstance($class, $settings = [])
    {
        try {
            return (method_exists($class, "getInstance")) ? $class::getInstance($settings) : new $class($settings);
        } catch(\Exception $e) {
            throw new \Exception($class . " not found");
        }
    }

}