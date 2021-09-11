<?php
error_reporting(E_ALL);

require_once "configs/variables.php";
require_once "vendor/autoload.php";

use core\engine\Application;
use core\engine\Router;
use core\engine\Response;
use core\engine\DB;

spl_autoload_register(function ($className) {
    require_once(APP_DIR . "" . str_replace("\\", "/", $className) . ".php");
});

$app = new Application();
// load configs & params
$app::$config->load(APP_CONFIG);
$app::$config->load(APP_ROUTES);
// run registrar
$app::$registrar->setRegistry(APP_REGISTRY, $app::$registry);

// Logger init
$logger = $app::get("logger");
$logger->init($app::$config->get("logger"));

set_error_handler(function($errorLevel, $errorMessage, $errorFile, $errorLine) use ($logger, $app) {
    if ($app::$config->get("logger")["errorDisplay"]) {
        echo "<b>". $errorLevel ."</b>: ". $errorFile . ", on line: " . $errorLine . "</b>";
    }
    if ($app::$config->get("logger")["errorLog"] && $logger->isTrackedError($errorLevel)) {
        $logger->write($errorMessage, $errorLevel, $errorFile, $errorLine);
    }
    return true;
});

// set routes routes
$app->registerRouter(new Router($app, $app::$config->get("routes")));
// set response
$app->registerResponse(new Response($app, APP_RESOURCES_DIR));

// set DB settings
DB::setSettingsConnect(
    $app::$env->get("DB_USER_NAME"),
    $app::$env->get("DB_USER_PASSWORD"),
    $app::$env->get("DB_NAME"),
    $app::$env->get("DB_PORT"),
    $app::$env->get("DB_DRIVER")
);

// test for logger
\testLogger\GeneratorErrors::runGenerateError('test_1');
\testLogger\GeneratorErrors::runGenerateError('test_2');

// set headers output
$app::$response->addHeader("Connection: keep-alive");
$app::$response->addHeader("Content-Type: text/html; charset=utf-8");
$app->output();