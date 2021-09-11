<?php

namespace core\services;

class Export {

    private static $instance = null;

    public function __construct()
    {
    }

    public static function getInstance(): Export
    {
        if(!isset(self::$instance)){
            return new self;
        }
        return self::$instance;
    }

    public function export(): array
    {
       return [1,2,3];
    }
}