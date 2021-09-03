<?php

namespace controllers;

use core\engine\Controller as BaseController;

class ExportController extends HomeController{

    private $exportService;

    public function __construct()
    {
        parent::__construct();
    }

    public function export(){
        $this->display("export", $this->exportService->export());
    }
}
