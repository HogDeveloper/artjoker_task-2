<?php

namespace core\engine;

final class Registry
{
    public static function setRegistry($pathToSettings, &$registry)
    {
        if(file_exists($pathToSettings)){
            $classes = require($pathToSettings);
            foreach ($classes as $dir => $value) {
                if(is_array($value) && !empty($value)){
                    foreach ($value as $class){
                        if(!isset($registry[$class])){
                            $registry[self::getClassName($class)] = self::createInstance($class);
                        }
                    }
                }else{
                    if(!isset($registry[$value])){
                        $registry[self::getClassName($value)] = self::createInstance($value);
                    }
                }
            }
        }else{
            throw new \Exception("File " . $pathToSettings . " not found");
        }
        return $registry;
    }

    private static function getClassName($class)
    {
        $parseStr = explode("\\", $class);
        return strtolower($parseStr[count($parseStr) - 1]);
    }

    private static function createInstance($class)
    {
        try {
            return (method_exists($class, "getInstance")) ? $class::getInstance() : new $class;
        } catch(\Exception $e) {
            throw new \Exception($class . " not found");
        }
    }
}