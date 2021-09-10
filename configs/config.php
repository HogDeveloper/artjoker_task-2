<?php
require_once "variables.php";

return [
    "adminEmail" => "some@test.com",
    "test" => "test parameter",
    "logger" => [
        "errorDisplay" => false,
        "errorLog" => true,
        "pathToSave" => APP_DIR . "/logs",
        "format" => "___ %date: PHP %level, %message, in line %line. File: %file", // keywords (%date, %level, %message, %file)
        "trackedErrors" => [
            E_USER_ERROR,
            E_ERROR,
            E_USER_WARNING,
            E_WARNING,
            E_NOTICE,
            E_USER_NOTICE,
            E_USER_DEPRECATED,
            E_DEPRECATED
        ]
    ]
];