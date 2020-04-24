<?php
use app\Router;

error_reporting(E_ALL);
ini_set('display_errors', 1);

$url = $_SERVER['REQUEST_URI'];

$autoloadFunction = function($class){
    $path = str_replace('\\','/', $class.'.php');
    if (file_exists($path)) {
        require $path;
    }
};

spl_autoload_register($autoloadFunction);
session_start();

$router = new Router();
$router->runAction();
