<?php
require_once "app.php";

return [
    // Router
    \core\engine\Router::class => [
        "dependencies" => [
            "request" => \core\libs\Request::class,
            "response" => \core\libs\Response::class
        ]
    ],
    // Viewer
    \core\engine\View::class => [

    ]
];