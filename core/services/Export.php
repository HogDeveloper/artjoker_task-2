<?php

namespace core\services;

class Export {

    private static $instance = null;

    public function __construct()
    {
    }

    public static function getInstance(){
        if(!isset(self::$instance)){
            return new self;
        }
        return self::$instance;
    }

    public function export(){
       return [1,2,3];
    }
}