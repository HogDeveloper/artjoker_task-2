<?php
require_once "app.php";

return [
    "router" => [
        \core\engine\Router::class => [
            "dependencies" => [
                "request" => \core\libs\Request::class,
                "response" => \core\libs\Response::class
            ]
        ],
    ],
    "viewer" => [
        \core\engine\View::class => []
    ]
];