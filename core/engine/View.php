<?php

namespace core\engine;

class View
{
    private static $pathToTemplate = null;
    private static $data = [];

    public static $template;

    public static function render($pathToTemplate = null, $data = null)
    {
        self::$pathToTemplate = $pathToTemplate;
        self::$data = $data;
        return self::createTemplate();
    }

    private static function createTemplate()
    {
        return "<h1>Some generate template</h1>";
    }

}