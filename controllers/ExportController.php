<?php

namespace controllers;

class ExportController extends Controller{

    private $exportService;

    public function __construct()
    {
        parent::__construct();
    }

    public function export(){
        $this->display("export", $this->exportService->export());
    }
}
