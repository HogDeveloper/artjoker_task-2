<?php

namespace controllers;

class HomeController extends Controller{

    public function __construct()
    {
        parent::__construct();

        $this->loadModel("User", "user");
    }

    public function index(){
        $data = [
            "users" => $this->user->getAll(),
        ];

        $this->display("index", $data);
    }

    public function about(){
        echo "About page";
    }

    public function calc($a, $b, $c=0){
        echo $a + $b + $c;
    }
}
