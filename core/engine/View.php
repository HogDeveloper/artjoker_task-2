<?php

namespace core\engine;

class View
{
    private static $pathToTemplate = null;
    private static $data = [];
    private static $resourcesDir = "";
    private static $imagesDir = "images/";
    private static $cssDir = "css/";
    private static $jsDir = "js/";
    private static $templatesDir = "views/";

    public static $output = "";

    public static function render($pathToTemplate = null, $data = null)
    {
        self::$pathToTemplate = $pathToTemplate;
        self::$data = $data;
        return self::createTemplate();
    }

    public static function setResourcesDir($pathToResources)
    {
        if(is_dir($pathToResources)){
            self::$resourcesDir = $pathToResources;
        }
    }

    private static function createTemplate()
    {
        return "<h1>Some generate template</h1>";
    }

}