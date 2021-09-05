<?php
require_once "app.php";

return [
    // Libs
    APP_DIR . "core/libs" => [],
    // Services
    APP_DIR . "core/services" => [
        \core\services\Export::class
    ]
];