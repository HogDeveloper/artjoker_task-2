<?php

namespace controllers;

use core\engine\Application as App;
use core\engine\Controller as BaseController;
use core\engine\Model;
use core\engine\Response;
use core\engine\View;
use models\Users;

class Home extends BaseController {
    public function __construct()
    {

    }

    public function index()
    {
        $data = [];
        $data["title"] = "Welcome home page";
//        Users::use()->getAllRows();
        App::$response->setOutput("index", $data);
    }

//    protected function loadModel($modelName, $modelAlias = ""){
//        $alias = $modelAlias;
//        if($alias === ""){
//            $alias = $modelName;
//        }
//
//        $model = "\\models\\" . $modelName;
//
//        $this->$alias = new $model();
//    }

//    protected function display($viewName, $data = []){
//
//        extract($data);
//
//        require_once($_SERVER["DOCUMENT_ROOT"] . "/views/" . $viewName . ".php");
//    }
}