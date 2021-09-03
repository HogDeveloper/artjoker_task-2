<?php

namespace core\libs;

class DotEnv
{
    private $params = [];
    private $fileName = ".env";
    protected $rootDirectory = "";
    private static $instance = null;

    public function __construct()
    {
        $this->rootDirectory = APP_DIR;
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new DotEnv();
        }
        return self::$instance;
    }

    public function get($varName)
    {
        if(isset($_ENV[$varName])){
            return $_ENV[$varName];
        }
        return null;
    }

    public function set($varName, $value)
    {
        if(!isset($_ENV[$varName])){
            $_ENV[$varName] = $value;
        }
    }

    public function changeRootDirectory($pathToRootDirectory)
    {
        if(!file_exists($pathToRootDirectory . $this->fileName)){
            throw new \Exception("file .env not fount");
        }
        $this->rootDirectory = $pathToRootDirectory;
    }

    public function parseEnv()
    {
        if(!file_exists($this->rootDirectory . $this->fileName)){
            throw new \Exception("file .env not fount");
        }
        $contents = $this->stringTrim(file_get_contents($this->rootDirectory . $this->fileName, true, null, 0), [" "]);
        $arrayString = explode("\n", $contents);
        $arrayConformityType = [];
        foreach ($arrayString as $string){
            $parseString = explode("=", $string);
            $key = $this->stringTrim($parseString[0], [" "]);
            $value = $this->stringTrim($parseString[1], [" ", "\""]);

            if(strlen($key) === 0 || $key === ""){
                continue;
            }
            $type = $this->defineType($value);
            if(is_null($type)){
               continue;
            }
            settype($value, $type);
            $arrayConformityType[$key] = $value;
        }
        $this->params = array_merge($this->params,  $arrayConformityType);
        $this->createVariablesInScopeENV($this->params);
        unset($this->params);
    }

    private function createVariablesInScopeENV(&$arrayVariables)
    {
        $_ENV = array_merge($_ENV, $arrayVariables);
    }

    private function defineType(&$value)
    {
        switch ($value) {
            case $this->isNumeric($value) :
                return gettype(abs($value));
                break;
            case $this->isNull($value) :
                return "boolean";
                break;
            default:
                return "string";
                break;
        }
    }

    private function isNumeric(&$value)
    {
        if(is_numeric($value) && !preg_match("/[A-Za-z]/", $value)){
            return true;
        }
        return false;
    }

    private function isNull(&$value)
    {
        if(is_null($value) || $value === ""){
            return true;
        }
        return false;
    }

    private function stringTrim(&$string, $arrayPattern)
    {
        foreach ($arrayPattern as $pattern){
            $string = trim($string, $pattern);
        }
        return $string;
    }

}