<?php

require '../vendor/autoload.php';


error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->safeLoad();

require '../config/database.php';

$router = require "../config/Web.php";
$router->dispatch($_SERVER['QUERY_STRING']);




