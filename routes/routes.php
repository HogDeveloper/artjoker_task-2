<?php

    return [
        "/" => [
            "GET" => [
                "controller" => "homeController",
                "action" => "index",
                "params" => "",
            ],
        ],
        "/calc/about/sdfsdf" => [
            "GET" => [
                "controller" => "homeController",
                "action" => "about",
                "params" => "",
            ],
        ],
        "/export/" => [
            "GET" => [
                "controller" => "exportController",
                "action" => "export",
                "params" => "",
            ],
        ],
        "/calc/(.+)/(.+)/(.+)" => [
            "GET" => [
                "controller" => "homeController",
                "action" => "calc",
                "params" => "$1/$2/$3",
            ],
        ],
        "/calc/(.+)/(.+)" => [
            "GET" => [
                "controller" => "homeController",
                "action" => "calc",
                "params" => "$1/$2",
            ],
        ],
    ];