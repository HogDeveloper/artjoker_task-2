<?php

spl_autoload_register(function ($className) {
    require_once($_SERVER["DOCUMENT_ROOT"] . "/" . str_replace("\\", "/", $className) . ".php");
});