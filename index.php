<?php
error_reporting(E_ALL);

require_once "core/startup.php";

use core\libs\DotEnv;
use core\libs\Config;

use core\engine\Loader;
use core\services\Export;

print_r(get_class_methods(Export::class));

//require_once "vendor/autoload.php";
//require_once "core/startup.php";
//require_once "core/libs/DotEnv.php";
//
//use core\libs\DotEnv;
//
//$dotEnv = new DotEnv($_SERVER['DOCUMENT_ROOT']);
//
//echo "<pre>";
//try {
//    var_dump($dotEnv->parseEnv());
//} catch (Exception $e) {
//    echo $e->getMessage();
//}

//\routes\Route::getInstance()->load();