<?php

    return [
        "routes" => [
            "/" => [
                "GET" => [
                    "controller" => \controllers\Home::class,
                    "action" => "index",
                    "params" => "",
                ],
            ],
            "/home" => [
                "GET" => [
                    "controller" => \controllers\Home::class,
                    "action" => "index",
                    "params" => "",
                ],
            ],
            "/about" => [
                "GET" => [
                    "controller" => \controllers\Home::class,
                    "action" => "about",
                    "params" => "",
                ],
            ],
            "/export" => [
                "GET" => [
                    "controller" => \controllers\Export::class,
                    "action" => "export",
                    "params" => "",
                ],
            ],
            "/user" => [
                "GET" => [
                    "controller" => \controllers\User::class,
                    "action" => "index",
                    "params" => "",
                ],
            ],
            "/calc/(.+)/(.+)/(.+)" => [
                "GET" => [
                    "controller" => \controllers\Home::class,
                    "action" => "calc",
                    "params" => "$1/$2/$3",
                ],
            ],
            "/calc/(.+)/(.+)" => [
                "GET" => [
                    "controller" => \controllers\Home::class,
                    "action" => "calc",
                    "params" => "$1/$2",
                ],
            ],
            "404" => [
                "GET" => [
                    "controller" => \controllers\Error::class
                ]
            ]
        ]
    ];