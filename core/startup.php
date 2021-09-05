<?php
error_reporting(E_ALL);

require_once "configs/app.php";
require_once "vendor/autoload.php";

use core\engine\Application;

spl_autoload_register(function ($className) {
    require_once(APP_DIR . "/" . str_replace("\\", "/", $className) . ".php");
});

echo "<pre>";

$app = new Application(APP_DIR . "configs/bootstrap.php");

// load configs & params
$app->config->load(APP_DIR . "configs/params.php");
$app->config->load(APP_DIR . "routes/routes.php");

// run registrar
$app->registrar->setRegistry(APP_DIR . "configs/registry.php", $app->registry);

// init db
$app->db->init([
    // $app->env->get("DB_NAME");
    // $app->env->get("DB_USER");
    // $app->env->get("DB_PASSWORD");
    // ....
]);

// register Viewer
//$app->registerViewer();

// get request
$app->output();
