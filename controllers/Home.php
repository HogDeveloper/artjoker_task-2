<?php

namespace controllers;

use core\engine\Application as App;
use core\engine\Controller as BaseController;
use core\engine\Model;
use core\engine\Response;
use core\engine\View;
use models\Users;

class Home extends BaseController {

    public function index()
    {
        $data = [];
        $data["title"] = "Welcome home page";
        $data["result"] = Users::use()->getAllRows();
        $data["useTable"] = Users::use()->getTable();
        App::$response->setOutput("index", $data);
    }

}