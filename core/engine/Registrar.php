<?php

namespace core\engine;

final class Registrar
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
                        if(!isset($registry[$this->getValidClassName($class)])){
                            $registry[self::getValidClassName($class)] = self::createInstance($class);
                        }
                    }
                }else{
                    if(!empty($value) && !isset($registry[$this->getValidClassName($value)])){
                        $registry[self::getValidClassName($value)] = self::createInstance($value);
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
        $className = $this->getValidClassName($className);
        if(!isset($registry[$className])){
            $registry[self::getValidClassName($className)] = self::createInstance($className);
        }
    }

    public function getValidClassName($class)
    {
        $parseStr = explode("\\", $class);
        return strtolower($parseStr[count($parseStr) - 1]);
    }

    public function createInstance($class, array $settings = [])
    {
        try {
            if(empty($settings)){
                return (method_exists($class, "getInstance")) ?
                    $class::getInstance() :
                    new $class();
            }
            return (method_exists($class, "getInstance")) ?
                $class::getInstance($settings) :
                new $class($settings);
        } catch(\Exception $e) {
            throw new \Exception($class . " not found");
        }
    }

}