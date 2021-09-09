<?php

namespace controllers;

use core\engine\Controller as BaseController;

class Export extends BaseController{

    private $exportService;

    public function __construct()
    {
        parent::__construct();
    }

//    public function export(){
//        $this->display("export", $this->exportService->export());
//    }
}
