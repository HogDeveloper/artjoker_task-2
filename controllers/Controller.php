<?php

namespace controllers;

abstract class Controller {
    public function __construct()
    {

    }

    protected function loadModel($modelName, $modelAlias = ""){
        $alias = $modelAlias;
        if($alias === ""){
            $alias = $modelName;
        }

        $model = "\\models\\" . $modelName;

        $this->$alias = new $model();
    }

    protected function display($viewName, $data = []){

        extract($data);

        require_once($_SERVER["DOCUMENT_ROOT"] . "/views/" . $viewName . ".php");
    }
}