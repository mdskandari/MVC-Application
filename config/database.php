<?php


use \Illuminate\Database\Capsule\Manager as Capsule;


$capsule = new Capsule();

$capsule->addConnection([
    'driver' => 'mysql',
    'host' => 'localhost',
    'port' => '3306',
    'database' => 'mvc_application',
    'username' => 'root',
    'password' => '123456789',
    'charset' => 'utf8',
    'collection' => 'utf8_general_ci'
]);


$capsule->bootEloquent();