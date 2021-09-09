<?php

namespace controllers;

use core\engine\Application as App;
use core\engine\Controller as BaseController;

class Error {

    public function __construct()
    {

    }

    public function index(){
        App::$response->setOutput("404", []);
    }
}
