<?php
require_once "app.php";

return [
    // Router
    APP_DIR . "core/engine" => \core\engine\Router::class,
    // Libs
    APP_DIR . "core/libs" => [
        \core\libs\Request::class,
        \core\libs\Response::class
    ],
    // Services
    APP_DIR . "core/services" => [
        \core\services\Export::class
    ]
];