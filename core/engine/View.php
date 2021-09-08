<?php

namespace core\engine;

class View
{
    private static $resourcesDir = "";
    private static $imagesDir = "images/";
    private static $cssDir = "css/";
    private static $jsDir = "js/";
    private static $templatesDir = "views/";

    public static $output = "";

    public static function setResourcesDir($pathToResources)
    {
        if(is_dir($pathToResources)){
            self::$resourcesDir = $pathToResources;
        }
    }

    public static function renderTemplate($pathToTemplate, array $data = [])
    {
        $template = $pathToTemplate . ".php";
        if (file_exists($template)) {
            extract($data);
            ob_start();
            require($template);
            return ob_get_clean();
        }
        throw new \Exception('Template not found: ' . $template. '!');
    }

    private static function createTemplate()
    {
        return "<h1>Some generate template</h1>";
    }

}