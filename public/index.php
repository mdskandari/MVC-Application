<?php

require '../vendor/autoload.php';
require '../config/database.php';

error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');


$router = require "../config/Web.php";
$router->dispatch($_SERVER['QUERY_STRING']);




