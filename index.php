<?php

use components\Router;

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

define('ROOT', $_SERVER['DOCUMENT_ROOT']);
require_once ROOT . '/components/Autoloader.php';

use components\Autoloader;

Autoloader::register();

$router = new Router();
$router->run();