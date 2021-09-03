<?php
error_reporting(E_ALL);

require_once "configs/app.php";
require_once "vendor/autoload.php";

spl_autoload_register(function ($className) {
    require_once(APP_DIR . "/" . str_replace("\\", "/", $className) . ".php");
});

echo "<pre>";

$config = \core\engine\Config::getInstance();
$config->load(APP_DIR . "configs/params.php");

$app = new \core\engine\Application(APP_DIR . "configs/bootstrap.php");
$app->output();
print_r("test");
