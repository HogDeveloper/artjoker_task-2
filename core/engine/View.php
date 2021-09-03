<?php

namespace core\engine;

class View
{
    private static $pathToTemplate = null;
    private static $data = [];

    public static $template;

    public static function render($pathToTemplate, $data)
    {
        self::$pathToTemplate = $pathToTemplate;
        self::$data = $data;
        self::createTemplate();
    }

    private static function createTemplate()
    {
        self::$template = "<h1>Some generate template</h1>";
    }

}