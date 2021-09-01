<?php

namespace core\libs;

class DotEnv
{
    private $params = [];
    private $fileName = ".env";
    public $rootDirectory = "";
    private static $instance = null;

    public function __construct()
    {
        $this->rootDirectory = $_SERVER["DOCUMENT_ROOT"];
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new DotEnv();
        }
        return self::$instance;
    }

    public function changeRootDirectory($pathToRootDirectory)
    {
        if(!$this->fileExist($pathToRootDirectory . $this->fileName)){
            throw new \Exception("file .env not fount");
        }
        $this->rootDirectory = $pathToRootDirectory;
    }

    public function parseEnv()
    {
        if(!$this->fileExist($this->rootDirectory . $this->fileName)){
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
        return $this->params;
    }

    private function fileExist($pathToFile)
    {
        if(!file_exists($pathToFile)){
            return false;
        }
        return true;
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