<?php

namespace controllers;

use core\engine\Controller as BaseController;
use core\engine\Application;

class Export extends BaseController{

    public function export(){
        Application::$response->outputJson(['test' => 'some test', 'test_2' => "some text"],  JSON_PRETTY_PRINT);
    }
}
