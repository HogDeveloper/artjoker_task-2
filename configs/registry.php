<?php
require_once "variables.php";

return [
    // Libs
    APP_DIR . "core/libs" => [

    ],
    // Services
    APP_DIR . "core/services" => [
        \core\services\Export::class,
        \core\libs\Mail::class
    ]
];