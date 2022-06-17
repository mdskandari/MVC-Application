<?php

require '../vendor/autoload.php';

error_reporting(E_ALL);
//extract(['debug' => true], EXTR_SKIP);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');


$router = require "../App/Web.php";
$router->dispatch($_SERVER['QUERY_STRING']);




