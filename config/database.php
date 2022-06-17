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
    'collation' => 'utf8_general_ci'
]);



// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();