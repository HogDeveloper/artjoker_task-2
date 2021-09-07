<?php
error_reporting(E_ALL);

require_once "configs/variables.php";
require_once "vendor/autoload.php";

use core\engine\Application;

spl_autoload_register(function ($className) {
    require_once(APP_DIR . "/" . str_replace("\\", "/", $className) . ".php");
});

echo "<pre>";

$app = new Application();

// load configs & params
$app->config->load(APP_DIR . "configs/bootstrap.php");
$app->config->load(APP_DIR . "configs/params.php");

// run registrar
$app->registrar->setRegistry(APP_REGISTRY_DIR, $app->registry);

// init db (needle config for connect DB)
$app->registerDB(
    [
        $app->env->get("DB_USER_NAME"),
        $app->env->get("DB_USER_PASSWORD"),
        $app->env->get("DB_NAME"),
        $app->env->get("DB_PORT"),
        $app->env->get("DB_DRIVER")
    ]
);

// set routes routes
$app->registerRouter(APP_ROUTES_DIR);

// set base dir with css, js, images, templates
$app->setResourcesDir(APP_RESOURCES_DIR);

// get response
$app->output();
