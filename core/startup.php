<?php
error_reporting(E_ALL);

require_once "configs/variables.php";
require_once "vendor/autoload.php";

spl_autoload_register(function ($className) {
    require_once(APP_DIR . "/" . str_replace("\\", "/", $className) . ".php");
});

$app = new \core\engine\Application();

// load configs & params
$app->config->load(APP_DIR . "configs/config.php");

// run registrar
$app->registrar->setRegistry(APP_REGISTRY, $app->registry);

// init db (needle config for connect DB)
$app->registerDB(\core\engine\DB::class,
    [
        $app->env->get("DB_USER_NAME"),
        $app->env->get("DB_USER_PASSWORD"),
        $app->env->get("DB_NAME"),
        $app->env->get("DB_PORT"),
        $app->env->get("DB_DRIVER")
    ]
);

// set routes routes
$app->registerRouter(\core\engine\Router::class, APP_ROUTES);

// set response
$app->registerResponse(\core\engine\Response::class);
$app->response->addHeader("Connection: keep-alive");
$app->response->addHeader("Content-Type: text/html; charset=utf-8");

echo "<pre>";
print_r($app);
// set base dir with css, js, images, templates

// set headers response
//\core\engine\Response::addHeader("Connection: keep-alive");
//\core\engine\Response::addHeader("Content-Type: text/html; charset=utf-8");
//
//\core\engine\Response::setOutput(View::$output);
//\core\engine\Response::output();
